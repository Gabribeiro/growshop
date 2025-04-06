/**
 * Solução radical: bloqueio total do w3_loadscripts
 * Este script deve ser carregado antes de qualquer outro código
 */
(function() {
  console.log('[W3-BLOCK] Bloqueando completamente o sistema w3_loadscripts');
  
  // Criar dummy de w3_loadscripts totalmente inofensivo
  window.w3_loadscripts = {
    // Método que simplesmente retorna uma Promise resolvida
    execute_script: function() {
      console.log('[W3-BLOCK] Tentativa de usar execute_script bloqueada');
      return Promise.resolve();
    },
    
    // Método que simplesmente retorna uma Promise resolvida
    load_scripts: function() {
      console.log('[W3-BLOCK] Tentativa de usar load_scripts bloqueada');
      return Promise.resolve();
    },
    
    // Método que simplesmente retorna uma Promise resolvida
    load_resources: function() {
      console.log('[W3-BLOCK] Tentativa de usar load_resources bloqueada');
      return Promise.resolve();
    },
    
    // Outros métodos que podem ser chamados
    triggerListener: function() {
      console.log('[W3-BLOCK] Tentativa de usar triggerListener bloqueada');
      return;
    },
    
    triggerListener_on_load: function() {
      console.log('[W3-BLOCK] Tentativa de usar triggerListener_on_load bloqueada');
      return;
    },
    
    w3_trigger_lazy_script: function() {
      console.log('[W3-BLOCK] Tentativa de usar w3_trigger_lazy_script bloqueada');
      return;
    },
    
    // Configurações vazias
    triggerEvents: [],
    eventOptions: {},
    w3_scripts: {
      normal: [],
      async: [],
      defer: [],
      lazy: []
    }
  };
  
  // Tornar impossível sobrescrever o objeto w3_loadscripts
  Object.defineProperty(window, 'w3_loadscripts', {
    writable: false,
    configurable: false
  });
  
  // Interceptar todas as chamadas a setAttribute, especificamente para bloquear '<script'
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    if (!name || typeof name !== 'string' || name.indexOf('<') !== -1 || name.indexOf('>') !== -1) {
      console.log('[W3-BLOCK] Bloqueando setAttribute com nome inválido:', name);
      return;
    }
    return originalSetAttribute.call(this, name, value);
  };
  
  // Interceptar XMLHttpRequest para bloquear chamadas externas
  var originalOpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function(method, url) {
    // Lista de serviços para bloquear
    var blockedServices = [
      'shopify', 'monorail', 'sentry', 'ingest.sentry', 
      'analytics', 'tracking', 'beacon'
    ];
    
    if (url && typeof url === 'string') {
      for (var i = 0; i < blockedServices.length; i++) {
        if (url.indexOf(blockedServices[i]) !== -1) {
          console.log('[W3-BLOCK] Bloqueando XHR para:', url);
          
          // Redirecionando para um endpoint vazio para evitar erros de rede
          arguments[1] = 'about:blank';
          
          // Marcar esta request para intercepção no send
          this._blocked = true;
          break;
        }
      }
    }
    
    return originalOpen.apply(this, arguments);
  };
  
  var originalSend = XMLHttpRequest.prototype.send;
  XMLHttpRequest.prototype.send = function() {
    if (this._blocked) {
      // Auto-resposta para requisições bloqueadas
      var xhr = this;
      
      // Simular uma resposta bem-sucedida
      setTimeout(function() {
        Object.defineProperty(xhr, 'readyState', { get: function() { return 4; } });
        Object.defineProperty(xhr, 'status', { get: function() { return 200; } });
        Object.defineProperty(xhr, 'statusText', { get: function() { return 'OK'; } });
        Object.defineProperty(xhr, 'responseText', { get: function() { return '{}'; } });
        
        // Disparar eventos de conclusão
        if (xhr.onreadystatechange) xhr.onreadystatechange();
        if (xhr.onload) xhr.onload();
      }, 0);
      
      return;
    }
    
    return originalSend.apply(this, arguments);
  };
  
  // Interceptar todas as chamadas fetch para bloquear requisições externas
  var originalFetch = window.fetch;
  window.fetch = function(url, options) {
    // Lista de serviços para bloquear
    var blockedServices = [
      'shopify', 'monorail', 'sentry', 'ingest.sentry', 
      'analytics', 'tracking', 'beacon'
    ];
    
    if (url && typeof url === 'string') {
      for (var i = 0; i < blockedServices.length; i++) {
        if (url.indexOf(blockedServices[i]) !== -1) {
          console.log('[W3-BLOCK] Bloqueando fetch para:', url);
          
          // Retornar uma resposta falsa bem-sucedida
          return Promise.resolve({
            ok: true,
            status: 200,
            statusText: 'OK',
            headers: new Headers({'Content-Type': 'application/json'}),
            json: function() { return Promise.resolve({}); },
            text: function() { return Promise.resolve('{}'); }
          });
        }
      }
    }
    
    return originalFetch.apply(this, arguments);
  };
  
  // Criar mock de Shopify para evitar erros
  window.Shopify = window.Shopify || {
    shop: "loja.local",
    locale: "pt-BR",
    currency: {
      active: "BRL",
      rate: "1.0",
      format: "R$ {{amount}}"
    },
    formatMoney: function() { return "R$ 0,00"; },
    Image: {
      getSizedImageUrl: function(url) { return url; }
    }
  };
  
  console.log('[W3-BLOCK] Bloqueio completo aplicado com sucesso');
})(); 
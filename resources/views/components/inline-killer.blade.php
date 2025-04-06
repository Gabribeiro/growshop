<script>
/**
 * KILLER extremamente agressivo para o sistema w3_loadscripts - VERSÃO FINAL
 */
(function() {
  // Definir variáveis globais que estão em falta
  window.w3_lazy_load_by_px = 200;
  window.blank_image_webp_url = "";
  window.google_fonts_delay_load = 1000;
  window.w3_mousemoveloadimg = false;
  window.w3_page_is_scrolled = false;
  window.w3_lazy_load_js = 1;
  window.w3_excluded_js = 0;
  
  console.log('[INLINE-KILLER-FINAL] Definindo variáveis globais necessárias');
  
  // Não modificar o Promise original
  // Em vez disso, interceptar as chamadas para o lazyload
  
  // Desativar as funções que causam problemas
  window.lazyload_img = function() { 
    console.log('[INLINE-KILLER-FINAL] lazyload_img desativado');
    return; 
  };
  
  window.lazyload_imgbgs = function() { 
    console.log('[INLINE-KILLER-FINAL] lazyload_imgbgs desativado');
    return; 
  };
  
  window.lazyloadimages = function() { 
    console.log('[INLINE-KILLER-FINAL] lazyloadimages desativado');
    return; 
  };
  
  window.w3_start_img_load = function() { 
    console.log('[INLINE-KILLER-FINAL] w3_start_img_load desativado');
    return; 
  };
  
  // Objeto dummy w3_loadscripts para substituir o original
  var dummy = {
    // Métodos vazios que retornam Promise vazio
    execute_script: function() { return window.Promise.resolve(); },
    load_scripts: function() { return window.Promise.resolve(); },
    load_resources: function() { return window.Promise.resolve(); },
    triggerListener: function() {},
    triggerListener_on_load: function() {},
    add_html_class: function() {},
    w3_trigger_lazy_script: function() {},
    
    // Propriedades vazias
    triggerEvents: [],
    eventOptions: {},
    w3_scripts: { normal: [], async: [], defer: [], lazy: [] }
  };
  
  // Prevenir redefinição da classe w3_loadscripts
  try {
    // Tentar definir primeiro para evitar o erro de já ter sido declarado
    window.w3_loadscripts = dummy;
    
    // Tornar impossível mudar
    Object.defineProperty(window, 'w3_loadscripts', {
      value: dummy,
      writable: false,
      configurable: false
    });
  } catch(e) {
    console.log('[INLINE-KILLER-FINAL] Já existe uma propriedade w3_loadscripts, alterando...');
    
    // Se já existir, tentar substituir manualmente suas propriedades
    for (var prop in dummy) {
      try {
        window.w3_loadscripts[prop] = dummy[prop];
      } catch(propError) {
        // Ignorar erros
      }
    }
  }
  
  // Bloquear XMLHttpRequest para serviços externos
  var originalOpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function(method, url) {
    if (url && typeof url === 'string' && 
        (url.includes('shopify') || url.includes('monorail') || 
         url.includes('sentry') || url.includes('analytics'))) {
      this._blocked = true;
      console.log('[INLINE-KILLER-FINAL] XMLHttpRequest bloqueado para:', url);
      arguments[1] = 'about:blank';
    }
    return originalOpen.apply(this, arguments);
  };
  
  var originalSend = XMLHttpRequest.prototype.send;
  XMLHttpRequest.prototype.send = function() {
    if (this._blocked) {
      var self = this;
      setTimeout(function() {
        if (self.onreadystatechange) {
          self.readyState = 4;
          self.status = 200;
          self.responseText = '{}';
          self.onreadystatechange();
        }
        if (self.onload) self.onload();
      }, 0);
      return;
    }
    return originalSend.apply(this, arguments);
  };
  
  // Bloquear todas as requisições para serviços externos
  var originalFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
        (url.includes('shopify') || url.includes('monorail') || 
         url.includes('sentry') || url.includes('analytics'))) {
      console.log('[INLINE-KILLER-FINAL] Requisição bloqueada para:', url);
      return Promise.resolve({
        ok: true,
        status: 200,
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); }
      });
    }
    return originalFetch.apply(this, arguments);
  };
  
  // Proteger setAttribute contra nomes inválidos como '<script'
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    if (!name || typeof name !== 'string' || name.indexOf('<') !== -1 || name.indexOf('>') !== -1) {
      console.log('[INLINE-KILLER-FINAL] setAttribute bloqueado para nome inválido');
      return;
    }
    try {
      originalSetAttribute.call(this, name, value);
    } catch(e) {
      console.log('[INLINE-KILLER-FINAL] Erro em setAttribute ignorado');
    }
  };
  
  // Proteger Array.prototype.forEach de erros
  var originalForEach = Array.prototype.forEach;
  Array.prototype.forEach = function(callback, thisArg) {
    if (!callback || typeof callback !== 'function') return;
    
    try {
      // Substituir por implementação mais segura
      for (var i = 0; i < this.length; i++) {
        try {
          callback.call(thisArg || null, this[i], i, this);
        } catch(e) {
          console.log('[INLINE-KILLER-FINAL] Erro em forEach ignorado');
        }
      }
    } catch(e) {
      console.log('[INLINE-KILLER-FINAL] Erro grave em forEach ignorado');
    }
  };
  
  // Mock para Shopify
  window.Shopify = window.Shopify || {
    shop: "loja.local",
    locale: "pt-BR",
    currency: {
      active: "BRL",
      rate: "1.0",
      format: "R$ @{{amount}}"
    },
    formatMoney: function() { return "R$ 0,00"; },
    Image: {
      getSizedImageUrl: function(url) { return url; }
    }
  };
  
  console.log('[INLINE-KILLER-FINAL] Script de bloqueio final aplicado com sucesso');
})();
</script> 
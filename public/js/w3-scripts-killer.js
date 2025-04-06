/**
 * KILLER extremamente agressivo para o sistema w3_loadscripts
 * Este script deve ser incluído como PRIMEIRO script na página
 */
(function() {
  console.log('[KILLER] Eliminando completamente o sistema w3_loadscripts');

  // Impedir completamente que w3_loadscripts seja definido como classe
  Object.defineProperty(window, 'w3_loadscripts', {
    value: {
      // Métodos vazios que retornam Promise resolvida
      execute_script: function() { return Promise.resolve(); },
      load_scripts: function() { return Promise.resolve(); },
      load_resources: function() { return Promise.resolve(); },
      triggerListener: function() {},
      triggerListener_on_load: function() {},
      w3_trigger_lazy_script: function() {},
      
      // Propriedades vazias
      triggerEvents: [],
      eventOptions: {},
      w3_scripts: { normal: [], async: [], defer: [], lazy: [] }
    },
    writable: false,
    configurable: false
  });
  
  // Impedir que a classe w3_loadscripts seja redefinida
  var originalDefineProperty = Object.defineProperty;
  Object.defineProperty = function(obj, prop, descriptor) {
    // Bloqueie definições de w3_loadscripts
    if (obj === window && prop === 'w3_loadscripts') {
      console.log('[KILLER] Tentativa de redefinir w3_loadscripts bloqueada');
      return obj;
    }
    return originalDefineProperty.apply(this, arguments);
  };
  
  // Sobrescrever o método setAttribute para nunca falhar com nomes inválidos
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    if (!name || typeof name !== 'string' || name.indexOf('<') !== -1 || name.indexOf('>') !== -1) {
      console.log('[KILLER] Bloqueando setAttribute com nome inválido:', name);
      return;
    }
    try {
      return originalSetAttribute.call(this, name, value);
    } catch(e) {
      console.log('[KILLER] Erro em setAttribute suprimido:', e.message);
    }
  };
  
  // Impedir que Array.prototype.forEach cause erros
  var originalForEach = Array.prototype.forEach;
  Array.prototype.forEach = function(callback, thisArg) {
    if (!callback || typeof callback !== 'function') {
      return;
    }
    
    try {
      for (var i = 0; i < this.length; i++) {
        try {
          callback.call(thisArg || null, this[i], i, this);
        } catch(e) {
          console.log('[KILLER] Erro em forEach suprimido:', e.message);
        }
      }
    } catch(e) {
      console.log('[KILLER] Erro grave em forEach suprimido:', e.message);
    }
  };
  
  // Garantir que document.write não seja chamado
  document.write = function() {
    console.log('[KILLER] Tentativa de document.write bloqueada');
  };
  
  // Bloquear requisições para serviços externos
  var originalFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
        (url.includes('shopify') || 
         url.includes('monorail') || 
         url.includes('sentry'))) {
      console.log('[KILLER] Bloqueando fetch para:', url);
      return Promise.resolve({
        ok: true,
        status: 200,
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); }
      });
    }
    return originalFetch.apply(this, arguments);
  };
  
  // Criar mocks para objetos externos
  window.Shopify = {
    formatMoney: function() { return "R$ 0,00"; },
    Image: { getSizedImageUrl: function(url) { return url; } }
  };
  
  window.ShopifyMonorail = {
    produce: function() { return Promise.resolve(); }
  };
  
  window.Sentry = {
    init: function() { return {}; },
    captureException: function() {},
    captureMessage: function() {}
  };

  console.log('[KILLER] Sistema w3_loadscripts completamente eliminado');
})(); 
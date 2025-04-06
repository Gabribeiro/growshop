/**
 * Manipulador de erros para problemas comuns na aplicação
 */
(function() {
  // Interceptar erros do querySelector para elementos não encontrados
  const originalQuerySelector = document.querySelector;
  document.querySelector = function() {
    try {
      return originalQuerySelector.apply(this, arguments);
    } catch (error) {
      console.warn('Erro capturado em querySelector:', error.message);
      return null;
    }
  };

  // Interceptar erros do setAttribute
  const originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    try {
      // Verificar se o nome do atributo é válido
      if (name && typeof name === 'string' && !name.includes('<') && !name.includes('>')) {
        return originalSetAttribute.call(this, name, value);
      } else {
        console.warn('Nome de atributo inválido ignorado:', name);
        return; // Importante: encerrar a função sem tentar definir o atributo
      }
    } catch (error) {
      console.warn('Erro capturado em setAttribute:', error.message);
    }
  };

  // Manipulador para Shopify/monorail
  window.addEventListener('error', function(event) {
    // Ignorar erros de requisições para endpoints Shopify
    if (event.filename && event.filename.includes('shopify')) {
      console.log('Ignorando erro relacionado ao Shopify:', event.message);
      event.preventDefault();
      return true;
    }
    
    // Capturar erros específicos de setAttribute com <script
    if (event.message && event.message.includes('setAttribute') && event.message.includes('script')) {
      console.log('Interceptando erro de setAttribute com script:', event.message);
      event.preventDefault();
      return true;
    }
  }, true);

  // Interceptar requisições para o Shopify/monorail
  const origFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
       (url.includes('shopify') || url.includes('monorail'))) {
      console.log('Interceptando requisição para:', url);
      return Promise.resolve({
        ok: true,
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); },
        blob: function() { return Promise.resolve(new Blob()); }
      });
    }
    return origFetch.apply(this, arguments);
  };

  // Polyfill para navegadores que não suportam CustomEvent
  if (typeof window.CustomEvent !== 'function') {
    window.CustomEvent = function(event, params) {
      params = params || { bubbles: false, cancelable: false, detail: null };
      const evt = document.createEvent('CustomEvent');
      evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
      return evt;
    };
  }

  // Patch para manipular o w3_loadscripts se existir
  document.addEventListener('DOMContentLoaded', function() {
    if (window.w3_loadscripts) {
      const originalExecuteScript = window.w3_loadscripts.execute_script;
      window.w3_loadscripts.execute_script = function() {
        try {
          return originalExecuteScript.apply(this, arguments);
        } catch (error) {
          console.warn('Erro capturado em execute_script:', error.message);
          return Promise.resolve();
        }
      };
    }
  });

  console.log('Manipulador de erros inicializado');
})(); 
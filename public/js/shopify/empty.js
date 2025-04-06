/**
 * Arquivo vazio para substituir scripts do Shopify
 */
window.Shopify = window.Shopify || {
  shop: "loja.local",
  locale: "pt-BR",
  currency: {
    active: "BRL",
    rate: "1.0",
    format: "R$ {{amount}}",
    money_format: "R$ {{amount}}"
  },
  formatMoney: function(cents) {
    if (typeof cents === 'string') cents = cents.replace('.', '');
    return 'R$ ' + (parseInt(cents || 0) / 100).toFixed(2).replace('.', ',');
  },
  Image: {
    getSizedImageUrl: function(url) { return url; }
  }
};

window.ShopifyMonorail = window.ShopifyMonorail || {
  produce: function() {
    console.log('ShopifyMonorail.produce interceptado');
    return Promise.resolve();
  }
};

// Mock para impedir erros com Sentry
window.Sentry = window.Sentry || {
  init: function() { return { scope: function() {} }; },
  captureException: function() {},
  captureMessage: function() {},
  setTag: function() {},
  configureScope: function() {}
};

// Interceptar requisições para o Shopify, monorail ou Sentry
(function() {
  const origFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
       (url.includes('shopify') || 
        url.includes('monorail') || 
        url.includes('sentry.io'))) {
      console.log('Interceptando requisição para:', url);
      return Promise.resolve({
        ok: true,
        status: 200,
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); },
        blob: function() { return Promise.resolve(new Blob()); }
      });
    }
    return origFetch.apply(this, arguments);
  };

  // Correção específica para o problema com w3_loadscripts
  if (typeof window.w3_loadscripts === 'undefined') {
    window.addEventListener('DOMContentLoaded', function() {
      if (window.w3_loadscripts) {
        const originalExecuteScript = window.w3_loadscripts.execute_script;
        window.w3_loadscripts.execute_script = function(e) {
          try {
            if (!e || !e.attributes) return Promise.resolve();
            
            return new Promise((resolve) => {
              let script = document.createElement('script');
              
              // Processar atributos com segurança
              Array.from(e.attributes || []).forEach((attr) => {
                try {
                  // Verificar por nomes de atributos inválidos
                  let name = attr.nodeName;
                  let value = attr.nodeValue;
                  
                  if (name && typeof name === 'string' && 
                      !name.includes('<') && !name.includes('>') &&
                      name !== 'type' && name !== 'data-src') {
                    
                    if (name === 'data-w3-type') {
                      name = 'type';
                    }
                    
                    script.setAttribute(name, value);
                  }
                } catch (err) {
                  console.warn('Erro ao processar atributo de script:', err);
                }
              });
              
              if (e.hasAttribute && e.hasAttribute('data-src')) {
                script.setAttribute('src', e.getAttribute('data-src'));
                script.addEventListener('load', resolve);
                script.addEventListener('error', resolve);
              } else if (e.text) {
                script.text = e.text;
                resolve();
              } else {
                resolve();
              }
              
              if (e.parentNode) {
                e.parentNode.replaceChild(script, e);
              } else {
                resolve();
              }
            });
          } catch (error) {
            console.warn('Erro capturado em execute_script:', error);
            return Promise.resolve();
          }
        };
      }
    });
  }
})();

// Mock para a função do Shopify Monorail
window.monorail = {
  produce: function() {
    console.log('monorail.produce interceptado');
    return Promise.resolve();
  }
};

// Patch para w3_loadscripts
document.addEventListener('DOMContentLoaded', function() {
  if (window.w3_loadscripts) {
    const origLoadScripts = window.w3_loadscripts.load_scripts;
    window.w3_loadscripts.load_scripts = function(e) {
      try {
        if (!e || !e.length) return Promise.resolve();
        return origLoadScripts.apply(this, arguments);
      } catch (error) {
        console.warn('Erro capturado em load_scripts:', error);
        return Promise.resolve();
      }
    };
    
    const origLoadResources = window.w3_loadscripts.load_resources;
    window.w3_loadscripts.load_resources = function() {
      try {
        return origLoadResources.apply(this, arguments);
      } catch (error) {
        console.warn('Erro capturado em load_resources:', error);
        return Promise.resolve();
      }
    };
  }
}); 
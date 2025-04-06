/**
 * Interceptor completo para Shopify, Sentry e outros serviços externos
 */
(function() {
  console.log('[BYPASS] Inicializando interceptor de requisições');

  // Mock para o Shopify
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
    },
    Checkout: {
      token: "fake-token-123456789"
    }
  };

  // Mock para Sentry
  window.Sentry = window.Sentry || {
    init: function() { 
      console.log('[BYPASS] Sentry.init interceptado');
      return { scope: function() {} }; 
    },
    captureException: function() { 
      console.log('[BYPASS] Sentry.captureException interceptado');
    },
    captureMessage: function() { 
      console.log('[BYPASS] Sentry.captureMessage interceptado');
    },
    setTag: function() {},
    configureScope: function() {},
    withScope: function(cb) { 
      cb && cb({
        setTag: function() {},
        setLevel: function() {}
      });
    }
  };

  // Mock para ShopifyMonorail
  window.ShopifyMonorail = window.ShopifyMonorail || {
    produce: function() {
      console.log('[BYPASS] ShopifyMonorail.produce interceptado');
      return Promise.resolve();
    }
  };

  // Mock para monorail
  window.monorail = window.monorail || {
    produce: function() {
      console.log('[BYPASS] monorail.produce interceptado');
      return Promise.resolve();
    }
  };

  // Mock para BOOMR (Boomerang)
  window.BOOMR = window.BOOMR || {
    init: function() { 
      console.log('[BYPASS] BOOMR.init interceptado');
      return true; 
    },
    addVar: function() { return true; },
    addVars: function() { return true; },
    subscribe: function() { return true; },
    snippetVersion: 12,
    application: "storefront-renderer",
    themeName: "Local Theme",
    themeVersion: "1.0",
    shopId: 123456,
    themeId: 654321,
    url: "about:blank"
  };

  // Implementação de resposta falsa para fetch
  function createFakeResponse(data) {
    return {
      ok: true,
      status: 200,
      statusText: "OK",
      headers: new Headers({
        "Content-Type": "application/json"
      }),
      json: function() { return Promise.resolve(data || {}); },
      text: function() { return Promise.resolve(JSON.stringify(data || {})); },
      blob: function() { return Promise.resolve(new Blob([JSON.stringify(data || {})])); }
    };
  }

  // Interceptar fetch para todos os serviços externos
  var originalFetch = window.fetch;
  window.fetch = function(url, options) {
    if (!url || typeof url !== 'string') {
      return originalFetch.apply(this, arguments);
    }

    // Lista de serviços para interceptar
    var blockedServices = [
      'shopify', 'monorail', 'sentry', 'ingest.sentry.io', 
      'analytics', 'tracking', 'stats', 'beacon', 'telemetry'
    ];

    // Verificar se a URL contém algum dos serviços bloqueados
    for (var i = 0; i < blockedServices.length; i++) {
      if (url.includes(blockedServices[i])) {
        console.log('[BYPASS] Interceptando fetch para:', url);
        return Promise.resolve(createFakeResponse({success: true}));
      }
    }

    // Passar adiante requisições não bloqueadas
    return originalFetch.apply(this, arguments);
  };

  // Interceptar XMLHttpRequest
  var originalXHROpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function(method, url) {
    if (!url || typeof url !== 'string') {
      return originalXHROpen.apply(this, arguments);
    }

    // Lista de serviços para interceptar
    var blockedServices = [
      'shopify', 'monorail', 'sentry', 'ingest.sentry.io',
      'analytics', 'tracking', 'stats', 'beacon', 'telemetry'
    ];

    // Verificar se a URL contém algum dos serviços bloqueados
    for (var i = 0; i < blockedServices.length; i++) {
      if (url.includes(blockedServices[i])) {
        console.log('[BYPASS] Interceptando XHR para:', url);
        this._bypassRequest = true;
        arguments[1] = 'about:blank'; // Redirecionar para URL inofensiva
        break;
      }
    }

    return originalXHROpen.apply(this, arguments);
  };

  var originalXHRSend = XMLHttpRequest.prototype.send;
  XMLHttpRequest.prototype.send = function() {
    if (this._bypassRequest) {
      // Simular uma resposta de sucesso após um pequeno delay
      var xhr = this;
      setTimeout(function() {
        // Definir propriedades de resposta
        Object.defineProperty(xhr, 'readyState', { get: function() { return 4; } });
        Object.defineProperty(xhr, 'status', { get: function() { return 200; } });
        Object.defineProperty(xhr, 'statusText', { get: function() { return 'OK'; } });
        Object.defineProperty(xhr, 'responseText', { get: function() { return '{"success": true}'; } });
        Object.defineProperty(xhr, 'response', { get: function() { return '{"success": true}'; } });
        
        // Disparar eventos
        if (xhr.onreadystatechange) xhr.onreadystatechange();
        if (xhr.onload) xhr.onload();
      }, 10);
      
      return;
    }
    
    return originalXHRSend.apply(this, arguments);
  };

  // Interceptar conexões WebSocket
  var originalWebSocket = window.WebSocket;
  window.WebSocket = function(url, protocols) {
    if (url && typeof url === 'string') {
      var blockedServices = ['shopify', 'sentry', 'analytics'];
      for (var i = 0; i < blockedServices.length; i++) {
        if (url.includes(blockedServices[i])) {
          console.log('[BYPASS] Interceptando WebSocket para:', url);
          // Criar um socket simulado
          return {
            url: url,
            send: function() { console.log('[BYPASS] WebSocket.send interceptado'); },
            close: function() { console.log('[BYPASS] WebSocket.close interceptado'); },
            addEventListener: function() {},
            removeEventListener: function() {},
            dispatchEvent: function() { return true; }
          };
        }
      }
    }
    
    return new originalWebSocket(url, protocols);
  };

  console.log('[BYPASS] Interceptor de requisições configurado com sucesso');
})(); 
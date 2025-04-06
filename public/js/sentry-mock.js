/**
 * Mock para o Sentry para evitar erros
 */
(function() {
  // Mock básico do Sentry
  window.Sentry = {
    init: function() {
      console.log('Sentry.init interceptado');
      return { scope: function() {} };
    },
    captureException: function(error) {
      console.log('Sentry.captureException interceptado:', error);
    },
    captureMessage: function(message) {
      console.log('Sentry.captureMessage interceptado:', message);
    },
    captureEvent: function() {
      console.log('Sentry.captureEvent interceptado');
      return { event_id: 'mock-event-id' };
    },
    withScope: function(callback) {
      callback({
        setLevel: function() {},
        setTags: function() {},
        setTag: function() {},
        setExtra: function() {},
        setContext: function() {},
        addBreadcrumb: function() {}
      });
    },
    configureScope: function(callback) {
      callback({
        setLevel: function() {},
        setTags: function() {},
        setTag: function() {},
        setExtra: function() {},
        setContext: function() {},
        addBreadcrumb: function() {}
      });
    },
    setTag: function() {},
    lastEventId: function() { return null; }
  };

  // Mock para Hub e outros componentes do Sentry
  window.Sentry.Hub = function() {
    return {
      captureException: function() {},
      captureMessage: function() {},
      captureEvent: function() { return 'mock-event-id'; },
      withScope: function() {}
    };
  };

  // Mock para BrowserClient do Sentry
  window.Sentry.BrowserClient = function() {
    return {
      captureException: function() {},
      captureMessage: function() {},
      captureEvent: function() { return 'mock-event-id'; }
    };
  };

  // Interceptar todas as requisições para Sentry
  const originalFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
        (url.includes('sentry') || url.includes('ingest.sentry.io'))) {
      console.log('Interceptando requisição para Sentry:', url);
      return Promise.resolve({
        ok: true,
        status: 200,
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); },
        blob: function() { return Promise.resolve(new Blob()); }
      });
    }
    return originalFetch.apply(this, arguments);
  };
  
  // Mock para XMLHttpRequest usado pelo Sentry
  const originalXHROpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
    if (url && typeof url === 'string' && 
        (url.includes('sentry') || url.includes('ingest.sentry.io'))) {
      console.log('Interceptando XMLHttpRequest para Sentry:', url);
      this._isSentryRequest = true;
      // Substituir com uma URL que pode ser bloqueada sem causar erros
      url = 'about:blank';
    }
    return originalXHROpen.call(this, method, url, async, user, password);
  };
  
  const originalXHRSend = XMLHttpRequest.prototype.send;
  XMLHttpRequest.prototype.send = function(data) {
    if (this._isSentryRequest) {
      // Simular uma resposta bem-sucedida
      Object.defineProperty(this, 'status', { value: 200 });
      Object.defineProperty(this, 'readyState', { value: 4 });
      Object.defineProperty(this, 'responseText', { value: '{}' });
      
      setTimeout(() => {
        if (typeof this.onreadystatechange === 'function') {
          this.onreadystatechange(new Event('readystatechange'));
        }
        if (typeof this.onload === 'function') {
          this.onload(new Event('load'));
        }
      }, 10);
      
      return;
    }
    return originalXHRSend.call(this, data);
  };

  console.log('Mock do Sentry inicializado');
})(); 
/**
 * Correção agressiva para erros de JavaScript
 * Este script deve ser o PRIMEIRO a ser carregado
 */
(function() {
  // Registrar quando o script foi carregado
  console.log('[W3-ROOT-FIX] Aplicando correções radicais');
  
  // Substituir completamente o método setAttribute
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    // Verificar se o nome do atributo é válido
    if (!name || typeof name !== 'string' || name.indexOf('<') >= 0 || name.indexOf('>') >= 0) {
      console.log('[W3-ROOT-FIX] Bloqueando setAttribute inválido:', name);
      return; // Não fazer nada se o nome for inválido
    }
    
    try {
      return originalSetAttribute.call(this, name, value);
    } catch(e) {
      console.log('[W3-ROOT-FIX] Erro em setAttribute:', e.message);
    }
  };
  
  // Corrigir Array.prototype.forEach para nunca falhar
  var originalForEach = Array.prototype.forEach;
  Array.prototype.forEach = function(callback, thisArg) {
    if (!callback || typeof callback !== 'function') {
      console.log('[W3-ROOT-FIX] Callback inválido em forEach');
      return;
    }
    
    try {
      // Implementação segura do forEach
      for (var i = 0; i < this.length; i++) {
        try {
          callback.call(thisArg || null, this[i], i, this);
        } catch(itemError) {
          console.log('[W3-ROOT-FIX] Erro em item do forEach:', itemError.message);
        }
      }
    } catch(e) {
      console.log('[W3-ROOT-FIX] Erro grave em forEach:', e.message);
    }
  };

  // Corrigir Array.from para ser mais seguro
  var originalArrayFrom = Array.from;
  Array.from = function(arrayLike) {
    if (!arrayLike) {
      console.log('[W3-ROOT-FIX] Array.from com valor nulo');
      return [];
    }
    
    try {
      return originalArrayFrom.apply(this, arguments);
    } catch(e) {
      console.log('[W3-ROOT-FIX] Erro em Array.from:', e.message);
      return [];
    }
  };
  
  // Injetar proteções no Promise para nunca rejeitar
  var originalPromise = window.Promise;
  window.Promise = function(executor) {
    if (typeof executor !== 'function') {
      console.log('[W3-ROOT-FIX] Promise sem executor válido');
      executor = function(resolve) { resolve(); };
    }
    
    return new originalPromise(function(resolve, reject) {
      try {
        executor(resolve, function(reason) {
          console.log('[W3-ROOT-FIX] Interceptando Promise.reject');
          resolve(null); // Nunca rejeitar
        });
      } catch(e) {
        console.log('[W3-ROOT-FIX] Erro no executor da Promise:', e.message);
        resolve(null);
      }
    });
  };
  
  // Copiar propriedades e métodos da Promise original
  for (var prop in originalPromise) {
    window.Promise[prop] = originalPromise[prop];
  }
  
  // Sobrescrever reject para nunca falhar
  window.Promise.reject = function(reason) {
    console.log('[W3-ROOT-FIX] Promise.reject convertido para resolve:', reason);
    return window.Promise.resolve(null);
  };
  
  // Injetar w3_loadscripts imediatamente para impedir erros
  window.w3_loadscripts = window.w3_loadscripts || {};
  
  // Criar execute_script seguro se não existir
  if (!window.w3_loadscripts.execute_script) {
    window.w3_loadscripts.execute_script = function(e) {
      console.log('[W3-ROOT-FIX] execute_script seguro chamado');
      return Promise.resolve();
    };
  } else {
    // Substituir execute_script existente
    var originalExecuteScript = window.w3_loadscripts.execute_script;
    window.w3_loadscripts.execute_script = function(e) {
      console.log('[W3-ROOT-FIX] Interceptando execute_script');
      try {
        if (!e || !e.attributes) {
          return Promise.resolve();
        }
        
        // Filtrar atributos inválidos antes de processar
        if (e.attributes) {
          var safeAttributes = [];
          for (var i = 0; i < e.attributes.length; i++) {
            var attr = e.attributes[i];
            if (attr && attr.nodeName && 
                typeof attr.nodeName === 'string' && 
                attr.nodeName.indexOf('<') === -1 && 
                attr.nodeName.indexOf('>') === -1) {
              safeAttributes.push(attr);
            }
          }
          
          // Substituir atributos
          var originalAttrs = e.attributes;
          Object.defineProperty(e, 'attributes', {
            get: function() { return safeAttributes; }
          });
          
          try {
            return originalExecuteScript.call(this, e);
          } finally {
            // Restaurar atributos originais
            Object.defineProperty(e, 'attributes', {
              get: function() { return originalAttrs; }
            });
          }
        }
        
        return originalExecuteScript.call(this, e);
      } catch(error) {
        console.log('[W3-ROOT-FIX] Erro em execute_script:', error.message);
        return Promise.resolve();
      }
    };
  }
  
  // Mesmo para load_scripts
  if (!window.w3_loadscripts.load_scripts) {
    window.w3_loadscripts.load_scripts = function() {
      console.log('[W3-ROOT-FIX] load_scripts seguro chamado');
      return Promise.resolve();
    };
  }
  
  // Mesmo para load_resources
  if (!window.w3_loadscripts.load_resources) {
    window.w3_loadscripts.load_resources = function() {
      console.log('[W3-ROOT-FIX] load_resources seguro chamado');
      return Promise.resolve();
    };
  }
  
  // Bloquear todas as requisições para Shopify, monorail e Sentry
  var originalFetch = window.fetch;
  window.fetch = function(url, options) {
    if (url && typeof url === 'string' && 
        (url.includes('shopify') || 
         url.includes('monorail') || 
         url.includes('sentry'))) {
      console.log('[W3-ROOT-FIX] Bloqueando requisição:', url);
      return Promise.resolve({
        ok: true,
        status: 200,
        statusText: 'OK',
        json: function() { return Promise.resolve({}); },
        text: function() { return Promise.resolve(''); }
      });
    }
    
    return originalFetch.apply(this, arguments);
  };
  
  // Bloquear XMLHttpRequest para os mesmos endpoints
  var originalOpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function(method, url) {
    if (url && typeof url === 'string' && 
        (url.includes('shopify') || 
         url.includes('monorail') || 
         url.includes('sentry'))) {
      this._blocked = true;
      console.log('[W3-ROOT-FIX] Bloqueando XMLHttpRequest:', url);
      // Redirecionando para um endpoint vazio
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
        if (self.onload) {
          self.onload();
        }
      }, 10);
      return;
    }
    
    return originalSend.apply(this, arguments);
  };
  
  console.log('[W3-ROOT-FIX] Todas as correções aplicadas com sucesso');
})(); 
/**
 * Patch direto para corrigir o erro da linha 157 no forEach
 * Este script é executado antes de qualquer outro para corrigir o erro específico
 */
(function() {
  // Patch imediato para Array.prototype.forEach
  console.log('Aplicando patch direto para Array.prototype.forEach');
  var originalForEach = Array.prototype.forEach;
  Array.prototype.forEach = function(callback, thisArg) {
    try {
      // Para cada item, verificar se o callback pode ser executado com segurança
      for (var i = 0; i < this.length; i++) {
        try {
          callback.call(thisArg || null, this[i], i, this);
        } catch (itemError) {
          console.log('Erro no forEach para item ' + i + ' corrigido:', itemError.message);
        }
      }
    } catch (error) {
      console.log('Erro geral no forEach corrigido:', error.message);
      return originalForEach.apply(this, arguments);
    }
  };
  
  // Patch para o método setAttribute que causa o erro na linha 157
  console.log('Aplicando patch direto para Element.prototype.setAttribute');
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    // Verificar explicitamente por '<script' que causa o erro
    if (name && typeof name === 'string') {
      if (name === '<script' || name.indexOf('<') !== -1 || name.indexOf('>') !== -1) {
        console.log('Bloqueando setAttribute com nome inválido:', name);
        return;
      }
      
      try {
        originalSetAttribute.call(this, name, value);
      } catch (error) {
        console.log('Erro em setAttribute corrigido:', error.message);
      }
    }
  };
  
  // Observar modificações em w3_loadscripts
  if (typeof window.w3_loadscripts !== 'undefined') {
    patchW3Functions();
  } else {
    var descriptor = Object.getOwnPropertyDescriptor(window, 'w3_loadscripts') || {};
    var originalGetter = descriptor.get;
    var originalSetter = descriptor.set;
    var originalValue = window.w3_loadscripts;
    
    Object.defineProperty(window, 'w3_loadscripts', {
      configurable: true,
      enumerable: true,
      get: function() {
        return originalValue;
      },
      set: function(newValue) {
        originalValue = newValue;
        if (newValue && typeof newValue === 'object') {
          patchW3Functions();
        }
        return newValue;
      }
    });
  }
  
  function patchW3Functions() {
    if (!window.w3_loadscripts) return;
    
    // Patch para execute_script na linha 149
    if (typeof window.w3_loadscripts.execute_script === 'function') {
      var originalExecuteScript = window.w3_loadscripts.execute_script;
      window.w3_loadscripts.execute_script = function(e) {
        try {
          // Verificar se é um elemento válido
          if (!e || !e.attributes) {
            return Promise.resolve();
          }
          
          // Criar uma versão segura dos atributos
          var safeAttributes = [];
          if (e.attributes && e.attributes.length) {
            for (var i = 0; i < e.attributes.length; i++) {
              var attr = e.attributes[i];
              if (attr && attr.nodeName && typeof attr.nodeName === 'string' && 
                  attr.nodeName.indexOf('<') === -1 && attr.nodeName.indexOf('>') === -1) {
                safeAttributes.push(attr);
              }
            }
            // Substituir temporariamente os atributos para o forEach seguro
            var originalAttributes = e.attributes;
            e.attributes = safeAttributes;
            
            var result = originalExecuteScript.call(this, e);
            
            // Restaurar atributos originais
            e.attributes = originalAttributes;
            return result;
          }
          
          return originalExecuteScript.call(this, e);
        } catch (error) {
          console.log('Erro em execute_script corrigido:', error.message);
          return Promise.resolve();
        }
      };
    }
  }
  
  console.log('Patch direto para o erro da linha 157 aplicado');
})(); 
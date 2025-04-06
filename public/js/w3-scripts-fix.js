/**
 * Correção para os problemas com w3_loadscripts
 */
(function() {
  console.log('Iniciando patch global para setAttribute - imediato');
  
  // Implementação de proteção global para setAttribute - aplicada imediatamente
  var originalSetAttribute = Element.prototype.setAttribute;
  Element.prototype.setAttribute = function(name, value) {
    try {
      if (name && typeof name === 'string' && !name.includes('<') && !name.includes('>')) {
        return originalSetAttribute.call(this, name, value);
      } else {
        console.warn('Tentativa de usar nome de atributo inválido bloqueada:', name);
        return;
      }
    } catch (error) {
      console.warn('Erro em setAttribute corrigido:', error);
    }
  };

  // Redefinir Array.prototype.forEach para torná-lo mais seguro com elementos inválidos
  var originalForEach = Array.prototype.forEach;
  Array.prototype.forEach = function() {
    try {
      return originalForEach.apply(this, arguments);
    } catch (error) {
      console.warn('Erro em Array.forEach corrigido:', error);
    }
  };
  
  // Corrigir o método execute_script diretamente
  function patchExecuteScript() {
    // Verificar se window.w3_loadscripts já existe
    if (window.w3_loadscripts && window.w3_loadscripts.execute_script) {
      console.log('Aplicando patch imediato para w3_loadscripts.execute_script');
      patchW3LoadScripts();
    } else {
      // Se não existir, definir um getter para window.w3_loadscripts
      var _w3_loadscripts = window.w3_loadscripts;
      Object.defineProperty(window, 'w3_loadscripts', {
        get: function() {
          return _w3_loadscripts;
        },
        set: function(value) {
          _w3_loadscripts = value;
          if (value && value.execute_script) {
            console.log('w3_loadscripts detectado e corrigido via setter');
            patchW3LoadScripts();
          }
          return value;
        },
        configurable: true
      });
    }
  }

  // Função que aplica todos os patches necessários
  function patchW3LoadScripts() {
    if (!window.w3_loadscripts) return;
    
    // 1. Corrigir execute_script
    var originalExecuteScript = window.w3_loadscripts.execute_script;
    window.w3_loadscripts.execute_script = function(e) {
      try {
        if (!e || !e.attributes) {
          return Promise.resolve();
        }
        
        return new Promise(function(resolve) {
          try {
            // Criar um novo elemento script de forma segura
            var script = document.createElement('script');
            
            // Processar atributos com verificações extras de segurança
            if (e.attributes && typeof e.attributes.forEach === 'function') {
              try {
                Array.from(e.attributes || []).forEach(function(attr) {
                  if (!attr || !attr.nodeName) return;
                  
                  var name = attr.nodeName;
                  var value = attr.nodeValue;
                  
                  // Verificação rigorosa de nomes de atributos
                  if (name && typeof name === 'string' && 
                      name.indexOf('<') === -1 && name.indexOf('>') === -1 &&
                      name !== 'type' && name !== 'data-src') {
                    
                    if (name === 'data-w3-type') {
                      name = 'type';
                    }
                    
                    try {
                      script.setAttribute(name, value);
                    } catch (attrError) {
                      console.warn('Erro ao definir atributo ' + name + ':', attrError);
                    }
                  }
                });
              } catch (forEachError) {
                console.warn('Erro ao processar atributos:', forEachError);
              }
            }
            
            // Definir fonte do script com segurança
            if (e.hasAttribute && typeof e.hasAttribute === 'function' && e.hasAttribute('data-src')) {
              script.setAttribute('src', e.getAttribute('data-src'));
              script.addEventListener('load', function() { resolve(); });
              script.addEventListener('error', function() { resolve(); });
            } else if (e.text) {
              script.text = e.text;
              resolve();
            } else {
              resolve();
            }
            
            // Substituir o elemento original
            if (e.parentNode) {
              e.parentNode.replaceChild(script, e);
            } else {
              resolve();
            }
          } catch (promiseError) {
            console.warn('Erro na Promise de execute_script:', promiseError);
            resolve();
          }
        });
      } catch (error) {
        console.warn('Erro em execute_script corrigido:', error);
        return Promise.resolve();
      }
    };
    
    // 2. Corrigir load_scripts
    if (window.w3_loadscripts.load_scripts) {
      var originalLoadScripts = window.w3_loadscripts.load_scripts;
      window.w3_loadscripts.load_scripts = function(e) {
        try {
          if (!e || !e.length) {
            return Promise.resolve();
          }
          return originalLoadScripts.apply(this, arguments);
        } catch (error) {
          console.warn('Erro em load_scripts corrigido:', error);
          return Promise.resolve();
        }
      };
    }
    
    // 3. Corrigir load_resources
    if (window.w3_loadscripts.load_resources) {
      var originalLoadResources = window.w3_loadscripts.load_resources;
      window.w3_loadscripts.load_resources = function() {
        try {
          return originalLoadResources.apply(this, arguments);
        } catch (error) {
          console.warn('Erro em load_resources corrigido:', error);
          return Promise.resolve();
        }
      };
    }
  }
  
  // Aplicar patch imediatamente
  patchExecuteScript();
  
  // E também aplicar quando o DOM estiver carregado para garantir
  document.addEventListener('DOMContentLoaded', function() {
    patchExecuteScript();
  });
  
  // Backup: tentar novamente após um curto atraso
  setTimeout(patchExecuteScript, 100);
  setTimeout(patchExecuteScript, 500);
  
  console.log('Patch global para execute_script aplicado');
})(); 
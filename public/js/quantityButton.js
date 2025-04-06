// Função para manipular os botões de quantidade no carrinho
function changeqQuantity() {
  try {
    const plusButton = document.querySelectorAll('.cart-items__item-plus');
    const minusButton = document.querySelectorAll('.cart-items__item-minus');
    const quantityBox = document.querySelectorAll('.cart-items__item-quantity');
    const prices = document.querySelectorAll('.product-money');
    const total = document.querySelector('.subtotal-money');
    
    // Verificar se o elemento total existe antes de acessar suas propriedades
    if (!total) {
      console.log('Elemento .subtotal-money não encontrado. Ignorando cálculos de totais.');
      return;
    }
    
    let totalPrice = parseFloat(total.innerHTML) || 0;
    let subTotal = 0;
    
    // Verificar se temos botões de quantidade para processar
    if (!plusButton.length || !minusButton.length || !quantityBox.length || !prices.length) {
      console.log('Elementos do carrinho não encontrados. Ignorando setup de botões de quantidade.');
      return;
    }
    
    for (let i = 0; i < plusButton.length; i++) {
      // Verificar se temos todas as referências necessárias para este índice
      if (!prices[i] || !quantityBox[i] || !plusButton[i] || !minusButton[i]) {
        console.log(`Elementos faltando para o item ${i}. Pulando configuração.`);
        continue;
      }
      
      const singlePrice = parseFloat(prices[i].innerHTML) || 0;
      
      plusButton[i].addEventListener('click', (e) => {
        e.preventDefault();
        const currentQuantity = parseInt(quantityBox[i].value) || 0;
        quantityBox[i].value = currentQuantity + 1;
        
        if (quantityBox[i].value > 1) {
          minusButton[i].disabled = false;
        } else {
          minusButton[i].disabled = true;
        }
        
        prices[i].innerHTML = parseFloat(singlePrice * quantityBox[i].value).toFixed(2);
        totalPrice += singlePrice;
        total.innerHTML = totalPrice.toFixed(2);
      });
      
      minusButton[i].addEventListener('click', (e) => {
        e.preventDefault();
        const currentQuantity = parseInt(quantityBox[i].value) || 0;
        
        if (currentQuantity > 1) {
          quantityBox[i].value = currentQuantity - 1;
          minusButton[i].disabled = false;
        } else {
          minusButton[i].disabled = true;
        }
        
        prices[i].innerHTML = parseFloat(singlePrice * quantityBox[i].value).toFixed(2);
        totalPrice -= singlePrice;
        total.innerHTML = totalPrice.toFixed(2);
      });
      
      quantityBox[i].addEventListener('change', (e) => {
        const currentQuantity = parseInt(quantityBox[i].value) || 0;
        
        if (currentQuantity >= 1) {
          prices[i].innerHTML = parseFloat(singlePrice * quantityBox[i].value).toFixed(2);
          
          for (let x = 0; x < quantityBox.length; x++) {
            if (prices[x]) {
              let sub = parseFloat(prices[x].innerHTML) || 0;
              subTotal += sub;
            }
          }
          
          total.innerHTML = subTotal.toFixed(2);
          subTotal = 0.00;
        }
      });
    }
  } catch (error) {
    console.log('Erro ao configurar controles de quantidade:', error);
  }
}

// Executar a função quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
  // Verificar se estamos na página do carrinho
  if (document.querySelector('#shopify-section-cart-drawer') || 
      document.querySelector('.cart-items__item-quantity')) {
    changeqQuantity();
  }
});

// Exportar a função para uso em outros módulos
window.changeqQuantity = changeqQuantity; 
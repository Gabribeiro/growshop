export default function changeqQuantity() {
  try {
    const plusButton = document.querySelectorAll('.cart-items__item-plus')
    const minusButton = document.querySelectorAll('.cart-items__item-minus')
    const quantityBox = document.querySelectorAll('.cart-items__item-quantity')
    const prices = document.querySelectorAll('.product-money')
    const total = document.querySelector('.subtotal-money')
    
    if (!total) {
      console.log('Elemento .subtotal-money não encontrado. Ignorando cálculos de totais.')
      return;
    }
    
    let totalPrice = parseFloat(total.innerHTML.replace(',', '.') || '0') || 0
    let subTotal = 0
    
    if (!plusButton.length || !minusButton.length || !quantityBox.length || !prices.length) {
      console.log('Elementos do carrinho não encontrados. Ignorando setup de botões de quantidade.')
      return;
    }
    
    for (let i = 0; i < plusButton.length; i++) {  
      if (!prices[i] || !quantityBox[i]) {
        console.log(`Elementos faltando para o item ${i}. Pulando configuração.`)
        continue;
      }
      
      const singlePrice = parseFloat((prices[i].innerHTML || '0').replace(',', '.')) || 0
      
      plusButton[i].addEventListener('click', (e) => {    
        e.preventDefault();
        try {
          const currentQuantity = parseInt(quantityBox[i].value || '0') || 0
          quantityBox[i].value = currentQuantity + 1
          if (quantityBox[i].value > 1) {     
            minusButton[i].disabled = false
          } else {
            minusButton[i].disabled = true
          }
          
          // Atualizar preço e total com verificações
          if (singlePrice && !isNaN(singlePrice)) {
            prices[i].innerHTML = (singlePrice * quantityBox[i].value).toFixed(2).replace('.', ',')
            
            // Calcular totalPrice novamente com base em todos os itens
            let newTotal = 0
            for (let j = 0; j < prices.length; j++) {
              if (prices[j]) {
                const itemPrice = parseFloat((prices[j].innerHTML || '0').replace(',', '.')) || 0
                newTotal += itemPrice
              }
            }
            total.innerHTML = newTotal.toFixed(2).replace('.', ',')
          }
        } catch (error) {
          console.error('Erro ao adicionar quantidade:', error)
        }
      })

      minusButton[i].addEventListener('click', (e) => {
        e.preventDefault();
        try {
          const currentQuantity = parseInt(quantityBox[i].value || '0') || 0
          if (currentQuantity > 1) {
            quantityBox[i].value = currentQuantity - 1
            minusButton[i].disabled = false
          } else {
            minusButton[i].disabled = true
          }
          
          // Atualizar preço e total com verificações
          if (singlePrice && !isNaN(singlePrice)) {
            prices[i].innerHTML = (singlePrice * quantityBox[i].value).toFixed(2).replace('.', ',')
            
            // Calcular totalPrice novamente com base em todos os itens
            let newTotal = 0
            for (let j = 0; j < prices.length; j++) {
              if (prices[j]) {
                const itemPrice = parseFloat((prices[j].innerHTML || '0').replace(',', '.')) || 0
                newTotal += itemPrice
              }
            }
            total.innerHTML = newTotal.toFixed(2).replace('.', ',')
          }
        } catch (error) {
          console.error('Erro ao diminuir quantidade:', error)
        }
      })

      quantityBox[i].addEventListener('change', (e) => {
        try {    
          const currentQuantity = parseInt(quantityBox[i].value || '0') || 0
          if (currentQuantity >= 1) {
            if (singlePrice && !isNaN(singlePrice)) {
              prices[i].innerHTML = (singlePrice * currentQuantity).toFixed(2).replace('.', ',')
              
              // Calcular subTotal novamente
              subTotal = 0
              for (let x = 0; x < prices.length; x++) {
                if (prices[x]) {
                  const sub = parseFloat((prices[x].innerHTML || '0').replace(',', '.')) || 0
                  subTotal += sub 
                }
              }       
              
              total.innerHTML = subTotal.toFixed(2).replace('.', ',')
            }
          } 
        } catch (error) {
          console.error('Erro ao alterar quantidade manualmente:', error)
        }
      })
    }
  } catch (error) {
    console.error('Erro ao configurar controles de quantidade:', error)
  }
}
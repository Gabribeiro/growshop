/**
 * local-shop.js - Funcionalidades locais para substituir Shopify/VastaShop
 */

// Objeto VastaShop para compatibilidade
window.VastaShop = {
    Cart: {
        current: {
            note: null,
            attributes: {},
            original_total_price: 0,
            total_price: 0,
            total_discount: 0,
            total_weight: 0.0,
            item_count: 0,
            items: [],
            requires_shipping: false,
            currency: "BRL",
            items_subtotal_price: 0,
            cart_level_discount_applications: [],
            checkout_charge_amount: 0
        },
        total_price: 0,
        total_quantity: 0
    },
    config: {
        enable_freeshipping_msg: true,
        freeshipping_msg: '+ Frete Grátis'
    }
};

// Configura o objeto de compatibilidade Shopify
window.Shopify = {
    Image: {
        loadImage: function(url) {
            // Implementação simples de carregamento de imagem
            const img = new Image();
            img.src = url;
            return img;
        },
        getSizedImageUrl: function(url, size) {
            // Retorna a URL da imagem sem modificação
            return url;
        }
    },
    currency: {
        active: "BRL",
        format: "R$ {{amount}}"
    }
};

// Configurações do carrinho
window.product_without_image = '/img/no-image.jpg';
window.cart_page = {
    discount_in_cart_page: "",
    text_cart_above_button_sucess: "Compra realizada com sucesso!",
    cart_discount_value: 0,
    cart_freeshipping_text: "+ Frete Grátis",
    text_cart_above_button: "",
    enable_day_on_message: false
};

// Função para atualizar descontos no carrinho
window.update_discount_cart = function(price, quantity) {
    console.log("Atualizando desconto no carrinho:", price, quantity);
    // Implementação local
    return true;
};

// Função auxiliar para Swatch
function setupSwatchItem() {
    const items = document.querySelectorAll('.template-collection .grid__item, .template-index .grid__item');
    items.forEach(function(item) {
        const swatchItems = item.querySelectorAll('.swatch-value-color');
        const imageWrapper = item.querySelector('.grid__item-image-wrapper');
        if (!imageWrapper) return;
        
        swatchItems.forEach(function(swatchItem) {
            const image = swatchItem.dataset.img;
            if (!image) return;
            
            swatchItem.addEventListener('mouseover', function() {
                imageWrapper.classList.add('grid__item--hidden-image');
                imageWrapper.style.backgroundImage = 'url("' + image + '")';
            });
            
            swatchItem.addEventListener('mouseleave', function() {
                imageWrapper.classList.remove('grid__item--hidden-image');
                imageWrapper.style.backgroundImage = 'unset';
            });
        });
    });
}

// Inicializa componentes quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    setupSwatchItem();
    
    // Inicializar players de YouTube
    setTimeout(function() {
        initYouTubeVideos();
    }, 100);
});

// Função para inicializar players de YouTube
function initYouTubeVideos() {
    var playerElements = document.getElementsByClassName('youtube-player');
    for (var n = 0; n < playerElements.length; n++) {
        var videoId = playerElements[n].dataset.id;
        if (!videoId) continue;
        
        var div = document.createElement('div');
        div.setAttribute('data-id', videoId);
        
        var thumbNode = document.createElement('img');
        thumbNode.src = '//i.ytimg.com/vi/' + videoId + '/hqdefault.jpg';
        div.appendChild(thumbNode);
        
        var playButton = document.createElement('div');
        playButton.setAttribute('class', 'play');
        div.appendChild(playButton);
        
        var background = document.createElement('div');
        background.setAttribute('class', 'play-background');
        playButton.appendChild(background);
        
        var icon = document.createElement('div');
        icon.setAttribute('class', 'play-icon');
        playButton.appendChild(icon);
        
        var leftSide = document.createElement('div');
        leftSide.setAttribute('class', 'play-left-side');
        icon.appendChild(leftSide);
        
        var rightSide = document.createElement('div');
        rightSide.setAttribute('class', 'play-right-side');
        icon.appendChild(rightSide);
        
        div.onclick = function() {
            labnolIframe(this);
        };
        
        playerElements[n].appendChild(div);
    }
}

function labnolIframe(div) {
    var iframe = document.createElement('iframe');
    iframe.setAttribute('src', 'https://www.youtube.com/embed/' + div.dataset.id + '?autoplay=1&rel=0');
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '1');
    iframe.setAttribute('allow', 'accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture');
    div.parentNode.replaceChild(iframe, div);
} 
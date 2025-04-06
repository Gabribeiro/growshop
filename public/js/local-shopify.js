/**
 * local-shopify.js - Implementação local do objeto Shopify
 */

window.Shopify = window.Shopify || {};

// Versão básica do Shopify para compatibilidade
window.Shopify = {
    shop: "loja.local",
    locale: "pt-BR",
    currency: {
        active: "BRL",
        rate: "1.0",
        format: "R$ {{amount}}",
        money_format: "R$ {{amount}}",
        money_with_currency_format: "R$ {{amount}} BRL"
    },
    country: "BR",
    theme: {
        name: "Local",
        id: "1",
        theme_store_id: null,
        role: "main",
        handle: "local",
        style: {
            id: null,
            handle: null
        }
    },
    cdnHost: "local",
    routes: {
        root: "/"
    },
    money_format: "R$ {{amount}}",
    
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
        },
        removeProtocol: function(url) {
            return url.replace(/http(s)?:/, '');
        }
    },

    formatMoney: function(cents, format) {
        if (typeof cents === 'string') {
            cents = cents.replace('.', '');
        }
        
        var value = '';
        var placeholderRegex = /\{\{\s*(\w+)\s*\}\}/;
        var formatString = format || this.money_format;

        function formatWithDelimiters(number, precision, thousands, decimal) {
            precision = precision || 2;
            thousands = thousands || '.';
            decimal = decimal || ',';

            if (isNaN(number) || number == null) {
                return 0;
            }

            number = (number / 100.0).toFixed(precision);

            var parts = number.split('.');
            var dollarsAmount = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1' + thousands);
            var centsAmount = parts[1] ? (decimal + parts[1]) : '';

            return dollarsAmount + centsAmount;
        }

        switch (formatString.match(placeholderRegex)[1]) {
            case 'amount':
                value = formatWithDelimiters(cents, 2);
                break;
            case 'amount_no_decimals':
                value = formatWithDelimiters(cents, 0);
                break;
            case 'amount_with_comma_separator':
                value = formatWithDelimiters(cents, 2, '.', ',');
                break;
            case 'amount_no_decimals_with_comma_separator':
                value = formatWithDelimiters(cents, 0, '.', ',');
                break;
        }

        return formatString.replace(placeholderRegex, value);
    }
};

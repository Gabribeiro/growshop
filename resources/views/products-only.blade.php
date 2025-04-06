@foreach ($products as $product)

    <div class="product-card__grid-item">



        <div class="product-card__grid-item-fullsize">

            <div title="RED-02" class="product-card__grid-item-link">

                <div class="product-card__grid-item-image-wrapper product-grid-item-image">

                    <a href="{{ $product->name == "Try Before Buy" ? 'design-your-own/' . $product->id : '/products/' . $product->id }}"

                        class="grid__item_image-link">
                        
                        @if($product->product_image)
                            <img id="784571288"
                            src="{{ '/storage/products/'.$product->product_image }}"
                            data-src="{{ '/storage/products/'.$product->product_image }}"
                            data-srcset="{{ '/storage/products/'.$product->product_image }}"
                            sizes="(max-width: 479px) 480px, (max-width: 767px) 768px, (max-width: 1019px) 1020px, (max-width: 1279px) 1280px"
                            class="responsive-image grid__item-image one"
                            data-class="LazyLoad"
                            alt="{{ $product->name }}">
                        @else
                            <div class="responsive-image grid__item-image one bg-light d-flex justify-content-center align-items-center" 
                                style="height: 250px; width: 100%;">
                                <span class="text-secondary" style="font-size: 18px;">Sem Imagem</span>
                            </div>
                        @endif

                    </a>

                </div>



                <div class="product-card__product-info">

                    <h3 class="product-card__item-title">

                        <a href="/products/{{ $product->id }}"

                            class="product-card__item-title-link">{{ $product->name == "Try Before Buy" ? $product->SKU : $product->name }}</a>

                    </h3>

                    <div class="product-card__item-description-wrapper">

                        <span class="product-card__item-description"></span>

                    </div>





                    

                    <div class="product-card__item-price-wrapper"><span class="product-card__item-price"><span

                                class=money>{{env('PAYMENT_CURRENCY_SYMBOL')}} {{ $product->price }}</span></span>



                    </div>

                </div>

            </div>

        </div>



        <style scoped>

            .product-card__grid-item {

                width: 23.5%;

                display: flex;

                align-items: center;

                flex-direction: column;

                position: relative;

                overflow: hidden;

            }



            .product-card__grid-item-fullsize {

                width: 100%;

                height: 100%;

                background-color: #EDEDED;

            }



            .product-card__grid-item-image-wrapper {

                position: relative;

                padding-top: 100%;

                overflow: hidden;

                width: 100%;

                transform: scale(1);

            }



            .product-card__grid-item-link {

                width: 100%;

                overflow: hidden;

            }



            .product-card__item-reviews-wrapper {

                padding: 0 8px;

            }



            .grid-uniform--s2 .product-card__grid-item {

                flex-basis: 48.5%;

            }



            .grid-uniform--s3 .product-card__grid-item {

                flex-basis: 32.1%;

            }



            .grid-uniform--s4 .product-card__grid-item {

                flex-basis: 23.5%;

            }



            body .product-page .product-variant-wrapper,

            body .product-page #rc_container {

                margin-bottom: 3px;

            }



            .ribbon {

                width: 75px;

                height: 75px;

                overflow: hidden;

                position: absolute;

                z-index: 8;

                pointer-events: none;

            }



            .ribbon::before,

            .ribbon::after {

                position: absolute;

                z-index: -1;

                content: '';

                display: block;

                border: 5px solid var(--tagBadgeBackgroundColor);

            }



            .ribbon span {

                background-color: var(--tagBadgeBackgroundColor);

                color: var(--tagBadgeTextColor);

                position: absolute;

                width: 185px;

                padding: 6px 0;

                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);

                font-size: var(--tagBadgeTextSmallSize);

                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);

                text-transform: uppercase;

                text-align: center;

                height: 27px;

                display: flex;

                justify-content: center;

                align-items: center;

            }



            .ribbon-top-left {

                top: -10px;

                left: -10px;

            }



            .ribbon-top-left::before,

            .ribbon-top-left::after {

                border-top-color: transparent;

                border-left-color: transparent;

            }



            .ribbon-top-left::before {

                top: 0;

                right: 0;

            }



            .ribbon-top-left::after {

                bottom: 0;

                left: 0;

            }



            .ribbon-top-left span {

                left: -62px;

                top: 17px;

                transform: rotate(-45deg);

            }



            .ribbon-top-right {

                top: -10px;

                right: -5px;

            }



            .ribbon-top-right::before,

            .ribbon-top-right::after {

                border-top-color: transparent;

                border-right-color: transparent;

            }



            .ribbon-top-right::before {

                top: 0;

                left: 0;

            }



            .ribbon-top-right::after {

                bottom: 0;

                right: 0;

            }



            .ribbon-top-right span {

                left: -48px;

                top: 17px;

                transform: rotate(45deg);

            }



            .product-half .ribbon {

                width: 120px;

                height: 120px;

            }



            .product-half .ribbon span {

                height: 45px;

            }



            .product-half .ribbon-top-left {

                top: -4px;

                left: 9px;

            }



            .product-half .ribbon-top-left span {

                left: -47px;

                top: 21px;

                font-size: var(--tagBadgeTextSize);

            }



            .soldout {

                margin: 0 auto;

                color: #e00;

                font-weight: bold;

            }



            .compare-price {

                color: var(--color-sale);

                font-size: var(--collectionProductComparePriceSize);

                margin-right: 5px;

                text-decoration: line-through;

                font-weight: bold;

            }



            /* Import CSS */



            .product-card____item-title {

                margin: 10px 0 3px 0;

            }



            .product-card__item-description-wrapper {

                text-align: left;

                padding: 0 8px;

            }



            .product-card____item-reviews-wrapper {

                text-align: left;

            }



            .grid__item-image {

                position: absolute;

                top: 50%;

                left: 50%;

                width: 100%;

                height: 100%;

                object-fit: cover;

                transform: translate(-50%, -50%) scale(1.01);

                transition: transform 1s cubic-bezier(0.215, 0.61, 0.355, 1);

            }



            .product-card__item-title {

                margin: 18.48px 0 3px 0;

                text-align: left;

                padding: 0 8px;

                font-size: var(--h3Size);

            }



            .product-card__item-title-link {

                color: #4b4b4b;

            }



            .product-card__item-compare-at-price,

            .product-card__item-price,

            .product-card__item-sold-out {

                font-weight: bold;

                text-align: center;

            }



            .product-card__item-compare-at-price {

                margin-right: 10px;

                color: var(--color-sale, #a00);

                text-decoration-line: line-through;

                font-size: var(--collectionProductComparePriceSize);

            }



            .product-card__item-price-wrapper {

                margin: 10px 0;

                text-align: left;

                padding: 0 8px;

            }



            .product-card__item-price {

                color: var(--color-price, rgb(25, 156, 25));

            }



            .product-card__item-price .money {

                font-size: var(--h3Size);

                margin: 0 4px 0 0;

            }



            .product-card__item-sold-out {

                display: block;

                color: var(--color_out_of_stock_label, #a00);

                margin: 10px 0;

                padding: 5px 0;

                background-color: var(--stock_warning_background_color);

                margin-bottom: 12px;

            }



                {

                margin-top: 3px;

                text-align: left;

                padding: 0 8px;

            }



            .grid__item--hidden-image img {

                opacity: 0;

                visibility: hidden;

            }



            @media (max-width: 1019px) {

                .grid-uniform--st2 .product-card__grid-item {

                    flex-basis: 48.5%;

                }



                .grid-uniform--st3 .product-card__grid-item {

                    flex-basis: 32.3%;

                }

            }



            @media (max-width: 767px) {



                .product-card__item-title,

                .product-card__item-price .money {

                    font-size: var(--h3SizeTablet);

                }



                .grid-uniform--sm1 .product-card__grid-item {

                    flex-basis: 94%;

                }



                .grid-uniform--sm2 .product-card__grid-item {

                    flex-basis: 48.5%;

                }



                .product-card__item-compare-at-price .money {

                    font-size: 12px;

                }

            }



            @media (max-width: 375px) {



                .product-card__item-title,

                .product-card__item-price .money {

                    font-size: var(--h3SizeMobile);

                }

            }

        </style>









    </div>

@endforeach


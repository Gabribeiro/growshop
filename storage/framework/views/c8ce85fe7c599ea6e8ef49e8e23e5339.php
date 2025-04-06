<div class="header__menu-wrapper desktop"><!-- start main-menu-new-layout.liquid (SNIPPET) -->

    <nav class="main-menu">

        <h3 class="hide">Main Menu</h3>



        <ul class="main-menu__list list--parent">

            <li class="main-menu__list-item">

                <a id="shop-menu" href="#" class="main-menu__item-anchor">SHOP

                    <!-- start icon-arrow-down.liquid (SNIPPET) -->

                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15"
                        fill="none">

                        <path d="M1.5 13.9326L7.5 7.93262L1.5 1.93262" stroke="#555555" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />

                    </svg></a>

                </a>

            </li>



            <li class="main-menu__list-item">

                <a id="hdr-nav-menu-4" href="/pages/design-your-own" class="main-menu__item-anchor">

                    TRY BEFORE BUY

                </a>

            </li>



            <li class="main-menu__list-item">

                <a id="hdr-nav-menu-4" href="/pages/about-us" class="main-menu__item-anchor">ABOUT US

                </a>

            </li>

            <style>
                #shopify-section-cc-header {

                    position: absolute;

                    top: 0;

                    left: 0;

                    width: 100%;

                    z-index: 99;

                }



                #index-layout .shopify-section:first-child,

                {

                padding-top: var(--header-height) !important;

                }





                #shopify-section-cc-header .cc-leftcontent a {

                    text-decoration: underline;

                }



                #shopify-section-cc-header .cc__headermegamenu_item {

                    visibility: hidden;

                    opacity: 0;

                    transition: all 0.3s ease;

                }



                #shopify-section-cc-header .cc__headermegamenu-parent:hover .cc__headermegamenu_item {

                    opacity: 1;

                    height: auto;

                    visibility: visible
                }





                #shopify-section-cc-header .cc__headermegamenu_item [aria-disabled="true"] {

                    opacity: 40%;

                }



                #shopify-section-cc-header #mobile__drawermenu {

                    transform: translateX(-100%);

                    transition: transform 0.3s ease-in-out, visibility 0.3s ease-in-out;

                    visibility: hidden;

                    position: fixed;

                    top: var(--header-height);

                    left: 0;

                    height: calc(100vh - var(--header-height));

                }



                #shopify-section-cc-header #mobile__drawermenu.mm_draweropen {

                    transform: translateX(0);

                    visibility: visible;



                    position: relative;

                    top: 0;

                    left: 0;

                }



                #shopify-section-cc-header .mm__drawerholder {

                    background-color: #fff;

                }



                #shopify-section-cc-header .mm__drawerholder .cc__headerlogo img {

                    filter: invert(1);

                }



                #shopify-section-cc-header .mm__drawerholder #cart-count svg {

                    color: #000 !important;

                }



                #shopify-section-cc-header .mm__drawerholder .hamburger__line {

                    background-color: #000 !important;

                }



                #shopify-section-cc-header .cc__megamenudraweritems,

                #shopify-section-cc-header .cc__megamenucolitems {

                    transform: translateX(100%);

                    transition: transform 0.3s ease-in-out;

                }



                #shopify-section-cc-header .cc__megamenudraweritems.cc__hasmegamenuactive,

                #shopify-section-cc-header .cc__megamenucolitems.cc__megamenucolitemsactive {

                    transform: translateX(0);

                }



                #shopify-section-cc-header .search-page-form {

                    width: 0;

                    height: 0;

                    transform: translateY(100%);

                    transition: all 0.3s ease-in-out;

                }



                #shopify-section-cc-header .cc__opensearchfield .search-page-form {

                    width: auto;

                    height: auto;

                    transform: translateY(0);

                }



                #shopify-section-cc-header .cc__opensearchfield a {

                    display: none;

                }
            </style>



            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const headerElement = document.getElementById('shopify-section-cc-header');
                    if (headerElement) {
                        document.documentElement.style.setProperty('--header-height', 
                            Math.round(headerElement.clientHeight) + 'px');
                    } else {
                        document.documentElement.style.setProperty('--header-height', '100px');
                    }
                });
                
                window.addEventListener('resize', () => {
                    const headerElement = document.getElementById('shopify-section-cc-header');
                    if (headerElement) {
                        document.documentElement.style.setProperty('--header-height', 
                            Math.round(headerElement.clientHeight) + 'px');
                    }
                });
            </script>



        </ul>

    </nav>

</div>

<div id="shop-menu-content" style="margin: 0 100px;">

    

    <style>
        .cc-items-center {

            display: flex;

            align-items: center;

            margin: 15px 0;

        }



        .cc-img {

            width: 30px;

            height: 30px;

            margin-right: 10px;

        }



        #shop-menu-content {

            /* position: absolute;

            top: 0px;

            width: 100%;

            height: 600px; */

        }
    </style>







    <div style="display: flex; justify-content: space-between">

        <div style="display: flex;  flex-direction: column;">

            <h3> Occasions</h3>

            <div>









                <?php $__currentLoopData = $everydayEvents->groupBy('event_group'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $everydayEvents->where('event_group', $event_group->value('event_group')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="/collections/event/<?php echo e(str_replace(' ', '-', strtolower($event->name))); ?>"
                            class="cc-items-center">
                            <img style="border-radius: 50%;" class="cc-img" src="/storage/events/<?php echo e($event->image); ?>"
                                loading="lazy" />
                            <?php echo e($event->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




            </div>

        </div>









        <div>

            <h3 class="cc-text-[24px] cc-font-luxia cc-text-[#a84f65]">Product Type</h3>



            <div>

                <?php $__currentLoopData = $types->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/collections/type/<?php echo e(str_replace(' ', '-', strtolower($type))); ?>"
                        class="cc-text-[16px] lg:cc-text-[20px] cc-text-[#555555] cc-transition-all cc-duration-300 cc-ease-in-out hover:cc-underline hover:cc-text-[#000000] cc-flex cc-items-center cc-gap-[15px]">

                        

                        <?php echo e($type); ?>


                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







            </div>

        </div>



        <div class="cc-flex cc-flex-col cc-gap-[20px] md:cc-gap-[30px]">

            <h3 class="cc-text-[24px] cc-font-luxia cc-text-[#a84f65]">Size</h3>



            <div class="cc-flex cc-flex-col cc-gap-[10px] md:cc-gap-[20px]">



                <?php $__currentLoopData = $sizes->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/collections/size/<?php echo e(str_replace(' ', '-', strtolower($size))); ?>"
                        class="cc-text-[16px] lg:cc-text-[20px] cc-text-[#555555] cc-transition-all cc-duration-300 cc-ease-in-out hover:cc-underline hover:cc-text-[#000000] cc-flex cc-items-center cc-gap-[15px]">

                        

                        <?php echo e($size); ?>


                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            </div>

        </div>



        <div style="margin-bottom: 100px;">

            <h3 class="cc-text-[24px] cc-font-luxia cc-text-[#a84f65]">Shape</h3>





            <div class="cc-flex cc-flex-col cc-gap-[10px] md:cc-gap-[20px]">



                <?php $__currentLoopData = $shapes->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/collections/shape/<?php echo e(str_replace(' ', '-', strtolower($shape))); ?>"
                        class="cc-text-[16px] lg:cc-text-[20px] cc-text-[#555555] cc-transition-all cc-duration-300 cc-ease-in-out hover:cc-underline hover:cc-text-[#000000] cc-flex cc-items-center cc-gap-[15px]">

                        

                        <?php echo e($shape); ?>


                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>











            </div>

        </div>



        <div>

            <h3 class="cc-text-[24px] cc-font-luxia cc-text-[#a84f65]">Material</h3>



            <div>

                <?php $__currentLoopData = $materials->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/collections/material/<?php echo e(str_replace(' ', '-', strtolower($material))); ?>"
                        class="cc-text-[16px] lg:cc-text-[20px] cc-text-[#555555] cc-transition-all cc-duration-300 cc-ease-in-out hover:cc-underline hover:cc-text-[#000000] cc-flex cc-items-center cc-gap-[15px]">

                        

                        <?php echo e($material); ?>


                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>













            </div>



        </div>

    </div>



</div>



<script>
    const button = document.getElementById("shop-menu");

    const menuContent = document.getElementById("shop-menu-content");



    menuContent.style.display = "none";



    // button.addEventListener("mouseover", () => {

    //     menuContent.style.display = "block";

    // });



    // button.addEventListener("mouseover", () => {



    //     menuContent.style.display = "block";



    // });



    window.addEventListener('click', function(e) {

        if (menuContent.contains(e.target) || button.contains(e.target)) {

            menuContent.style.display = "block";

        }

    });



    window.addEventListener('click', function(e) {

        if (!menuContent.contains(e.target) && !button.contains(e.target)) {

            menuContent.style.display = "none";

        }

    });



    const cartDrawer = $('#CartDrawer');

    $('.icon--cart').click(function() {


        //  contentArea.innerHTML = DOMPurify.sanitize( cartContent );

        $(document.body).addClass('cart-drawer--opened');

    });
</script>
<?php /**PATH /var/www/resources/views//components/menu.blade.php ENDPATH**/ ?>
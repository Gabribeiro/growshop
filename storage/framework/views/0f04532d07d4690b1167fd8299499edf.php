<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div style="margin-top: 100px; align-items: center;  text-align: center;">
        <h1 class="rte-h1">Please verify your email address!</h1>
        <div class="rte">

            <span data-sheets-root="1"
                data-sheets-value='{"1":2,"2":" Expressive Roses, Emotional Connections: \n\nOur mission at Potiguara Grow is to facilitate expressive and emotional connections by harnessing the unparalleled beauty of roses. We dedicate ourselves to perfecting the art of communication with this iconic symbol, making every gesture a heartfelt expression."}'
                data-sheets-userformat='{"2":521,"3":{"1":0},"6":{"1":[{"1":2,"2":0,"5":{"1":2,"2":0}},{"1":0,"2":0,"3":3},{"1":1,"2":0,"4":1}]},"12":0}'
                data-sheets-textstyleruns='{"1":0,"2":{"5":1}}?{"1":41}' data-mce-fragment="1"><strong>
                    A verification email has been sent to your mailbox to confirm


                </strong>
                <br>
                <a href="/collections/all">Continue Shopping</a>

        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>
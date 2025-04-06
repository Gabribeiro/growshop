<?php $__env->startSection('title', 'Monte seu Grow - Potiguar Grow'); ?>

<?php $__env->startSection('extra_css'); ?>
<style>
    .page-banner {
        background-color: #000;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }

    .page-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
        z-index: 0;
    }

    .page-banner .container {
        position: relative;
        z-index: 2;
    }

    .page-banner h1 {
        font-size: 3rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 20px;
        color: #fff;
        font-family: 'Permanent Marker', cursive;
        position: relative;
        display: inline-block;
        letter-spacing: 2px;
    }
    
    .page-banner h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 80px;
        height: 3px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .diagonal-line {
        position: absolute;
        top: 20px;
        right: 40px;
        width: 100px;
        height: 2px;
        background-color: var(--primary-color);
        transform: rotate(-30deg);
        opacity: 0.2;
    }
    
    .diagonal-line2 {
        position: absolute;
        top: 70px;
        right: 60px;
        width: 60px;
        height: 2px;
        background-color: var(--primary-color);
        transform: rotate(-30deg);
        opacity: 0.2;
    }
    
    .builder-summary {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        clip-path: polygon(0 0, 100% 0, 100% 95%, 95% 100%, 0 100%);
        position: sticky;
        top: 20px;
    }
    
    .builder-summary-header {
        background-color: rgba(0, 177, 64, 0.1);
        border-bottom: 1px solid var(--card-border);
        padding: 15px 20px;
        position: relative;
        overflow: hidden;
    }
    
    .builder-summary-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 30px;
        height: 3px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .builder-summary-item {
        padding: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s;
    }
    
    .builder-summary-item:hover {
        background-color: rgba(0, 177, 64, 0.05);
    }
    
    .builder-summary-item.selected {
        border-left: 3px solid var(--green-neon);
    }
    
    .component-card {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        transition: all 0.3s;
        height: 100%;
        overflow: hidden;
        position: relative;
    }
    
    .component-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3), 0 0 10px rgba(0, 177, 64, 0.2);
        border-color: rgba(0, 177, 64, 0.3);
    }
    
    .component-card.selected {
        border: 1px solid var(--green-neon);
        box-shadow: 0 0 15px rgba(0, 177, 64, 0.3);
    }
    
    .component-card-header {
        background-color: rgba(0, 0, 0, 0.4);
        padding: 12px 15px;
        border-bottom: 1px solid var(--card-border);
        position: relative;
    }
    
    .component-card.selected .component-card-header {
        background-color: rgba(0, 177, 64, 0.15);
    }
    
    .component-card.selected .component-card-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .component-img-container {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.3);
        padding: 20px;
    }
    
    .component-img {
        max-height: 120px;
        max-width: 100%;
        transition: all 0.3s;
    }
    
    .component-card:hover .component-img {
        transform: scale(1.05);
    }
    
    .component-price {
        color: var(--green-neon);
        font-weight: 700;
        font-size: 1.1rem;
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
    }
    
    .component-description {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }
    
    .category-header {
        background-color: rgba(0, 0, 0, 0.5);
        border: 1px solid var(--card-border);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .category-header:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }
    
    .category-header.active {
        border-left: 3px solid var(--green-neon);
    }
    
    .category-toggle-btn {
        padding: 18px 20px;
        position: relative;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .category-status {
        position: relative;
        padding: 5px 10px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
    }
    
    .category-status.pending {
        background-color: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.7);
    }
    
    .category-status.selected {
        background-color: rgba(0, 177, 64, 0.15);
        color: var(--green-neon);
    }
    
    .selected-component-container {
        background-color: rgba(0, 177, 64, 0.05);
        border: 1px solid rgba(0, 177, 64, 0.15);
        border-radius: 4px;
        padding: 10px;
        margin-top: 10px;
    }
    
    .selected-component-img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        background-color: rgba(0, 0, 0, 0.3);
        padding: 3px;
        border-radius: 4px;
    }
    
    .btn-select {
        background-color: rgba(0, 177, 64, 0.15);
        color: var(--green-neon);
        border: 1px solid rgba(0, 177, 64, 0.3);
        padding: 6px 12px;
        transition: all 0.3s;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
    }
    
    .btn-select:hover, .btn-select:focus {
        background-color: rgba(0, 177, 64, 0.3);
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 177, 64, 0.3);
    }
    
    .btn-select.selected {
        background-color: var(--primary-color);
        color: #fff;
    }
    
    .total-price-display {
        background-color: rgba(0, 177, 64, 0.1);
        border-top: 1px solid var(--card-border);
        padding: 15px;
        margin-top: 15px;
    }
    
    .total-price-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--green-neon);
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.3);
    }
    
    .grow-illustration {
        position: absolute;
        top: 20%;
        right: 5%;
        font-size: 10rem;
        opacity: 0.03;
        transform: rotate(15deg);
        color: var(--primary-color);
        z-index: -1;
    }
    
    .btn-add-to-cart {
        background-color: var(--primary-color);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 25px;
        transition: all 0.3s;
        clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
        box-shadow: 0 4px 15px rgba(0, 177, 64, 0.3);
    }
    
    .btn-add-to-cart:hover {
        background-color: var(--primary-color-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 177, 64, 0.4);
    }
    
    .btn-clear {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.7);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 10px 20px;
        transition: all 0.3s;
    }
    
    .btn-clear:hover {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }
    
    .btn-remove {
        background-color: rgba(255, 59, 48, 0.1);
        border: 1px solid rgba(255, 59, 48, 0.3);
        color: rgba(255, 59, 48, 0.8);
        padding: 4px 8px;
        border-radius: 2px;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .btn-remove:hover {
        background-color: rgba(255, 59, 48, 0.2);
        color: rgb(255, 59, 48);
    }
    
    .alert-custom-success {
        background-color: rgba(0, 177, 64, 0.15);
        border-left: 4px solid var(--primary-color);
        color: white;
    }
    
    .alert-custom-danger {
        background-color: rgba(255, 59, 48, 0.15);
        border-left: 4px solid rgb(255, 59, 48);
        color: white;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <i class="bi bi-flower3 grow-illustration"></i>
    <div class="container">
        <h1 class="mb-0">Monte seu Grow</h1>
        <p class="mt-4 col-md-8">Selecione os componentes ideais para montar seu grow personalizado. Nós cuidamos da compatibilidade para garantir o melhor desempenho.</p>
    </div>
</div>

<div class="container mb-5">
    <?php if(session('success')): ?>
    <div class="alert alert-custom-success mb-4">
        <i class="bi bi-check-circle me-2"></i> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
    <div class="alert alert-custom-danger mb-4">
        <i class="bi bi-exclamation-triangle me-2"></i> <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>
    
    <div class="row">
        <!-- Resumo da montagem atual -->
        <div class="col-lg-4 order-lg-2 mb-4">
            <div class="builder-summary">
                <div class="builder-summary-header">
                    <h5 class="mb-0"><i class="bi bi-kanban me-2"></i> Sua Montagem</h5>
                </div>
                <div class="p-3">
                    <?php
                    $totalPrice = 0;
                    $isEmpty = true;
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="builder-summary-item <?php if(isset($selectedComponents[$category->id])): ?> selected <?php endif; ?>">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0"><?php echo e($category->name); ?></h6>
                                
                                <?php if(isset($selectedComponents[$category->id])): ?>
                                    <?php
                                        $isEmpty = false;
                                        $component = $selectedComponents[$category->id];
                                        $totalPrice += $component['price'] * $component['quantity'];
                                    ?>
                                    <span class="category-status selected">Selecionado</span>
                                <?php else: ?>
                                    <span class="category-status pending">Pendente</span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if(isset($selectedComponents[$category->id])): ?>
                                <div class="selected-component-container">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <?php if($component['image']): ?>
                                                <img src="<?php echo e(asset('storage/' . $component['image'])); ?>" alt="<?php echo e($component['name']); ?>" class="selected-component-img me-2">
                                            <?php else: ?>
                                                <div class="selected-component-img me-2 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="text-truncate" style="max-width: 150px;"><?php echo e($component['name']); ?></div>
                                                <div class="component-price">R$ <?php echo e(number_format($component['price'], 2, ',', '.')); ?></div>
                                            </div>
                                        </div>
                                        <form action="<?php echo e(route('grow.builder.remove')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">
                                            <button type="submit" class="btn-remove" title="Remover">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p class="text-muted small">Nenhum componente selecionado</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>Nenhuma categoria disponível</p>
                    <?php endif; ?>
                    
                    <div class="total-price-display">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-uppercase fw-bold">Total:</span>
                            <span class="total-price-value">R$ <?php echo e(number_format($totalPrice, 2, ',', '.')); ?></span>
                        </div>
                        
                        <form action="<?php echo e(route('grow.builder.add-to-cart')); ?>" method="POST" class="mb-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-add-to-cart w-100" <?php echo e($isEmpty ? 'disabled' : ''); ?>>
                                <i class="bi bi-cart-plus me-2"></i> Adicionar ao Carrinho
                            </button>
                        </form>
                        
                        <a href="<?php echo e(route('grow.builder.clear')); ?>" class="btn btn-clear w-100">
                            <i class="bi bi-trash me-2"></i> Limpar Montagem
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lista de categorias e componentes -->
        <div class="col-lg-8 order-lg-1">
            <div class="accordion mb-4" id="accordionComponents">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mb-3">
                        <div class="category-header <?php if($index === 0 || (isset($selectedComponents) && !isset($selectedComponents[$category->id]))): ?> active <?php endif; ?>" id="heading<?php echo e($category->id); ?>">
                            <button class="category-toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($category->id); ?>" aria-expanded="<?php echo e($index === 0 ? 'true' : 'false'); ?>" aria-controls="collapse<?php echo e($category->id); ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-chevron-right me-2"></i> <?php echo e($category->name); ?></span>
                                    <?php if(isset($selectedComponents[$category->id])): ?>
                                        <span class="category-status selected">Selecionado</span>
                                    <?php else: ?>
                                        <span class="category-status pending">Pendente</span>
                                    <?php endif; ?>
                                </div>
                            </button>
                        </div>

                        <div id="collapse<?php echo e($category->id); ?>" class="collapse <?php if($index === 0 || (isset($selectedComponents) && !isset($selectedComponents[$category->id]))): ?> show <?php endif; ?>" aria-labelledby="heading<?php echo e($category->id); ?>" data-bs-parent="#accordionComponents">
                            <div class="p-3">
                                <div class="row g-3">
                                    <?php $__empty_2 = true; $__currentLoopData = $category->components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                        <div class="col-md-6 col-xl-4">
                                            <div class="component-card <?php if(isset($selectedComponents[$category->id]) && $selectedComponents[$category->id]['id'] == $component->id): ?> selected <?php endif; ?>">
                                                <div class="component-card-header">
                                                    <h6 class="mb-0 text-truncate"><?php echo e($component->name); ?></h6>
                                                </div>
                                                <div class="component-img-container">
                                                    <?php if($component->image): ?>
                                                        <img src="<?php echo e(asset('storage/' . $component->image)); ?>" alt="<?php echo e($component->name); ?>" class="component-img">
                                                    <?php else: ?>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-image text-muted fs-1"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="p-3">
                                                    <div class="component-description mb-3"><?php echo e($component->description); ?></div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="component-price">R$ <?php echo e(number_format($component->price, 2, ',', '.')); ?></div>
                                                        <form action="<?php echo e(route('grow.builder.select')); ?>" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">
                                                            <input type="hidden" name="component_id" value="<?php echo e($component->id); ?>">
                                                            <button type="submit" class="btn btn-select <?php if(isset($selectedComponents[$category->id]) && $selectedComponents[$category->id]['id'] == $component->id): ?> selected <?php endif; ?>">
                                                                <?php if(isset($selectedComponents[$category->id]) && $selectedComponents[$category->id]['id'] == $component->id): ?>
                                                                    <i class="bi bi-check-circle me-1"></i> Selecionado
                                                                <?php else: ?>
                                                                    <i class="bi bi-plus-circle me-1"></i> Selecionar
                                                                <?php endif; ?>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                        <div class="col-12">
                                            <div class="p-4 text-center">
                                                <i class="bi bi-exclamation-circle text-muted fs-3 mb-3"></i>
                                                <p class="text-muted">Nenhum componente disponível nesta categoria.</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center p-5">
                        <i class="bi bi-emoji-frown fs-1 text-muted mb-3"></i>
                        <p class="text-muted">Nenhuma categoria disponível no momento.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_js'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Animar itens selecionados
        const selectedItems = document.querySelectorAll('.component-card.selected');
        selectedItems.forEach(item => {
            // Adicionar efeito visual sutil para destacar os itens selecionados
            setTimeout(() => {
                item.style.transition = 'all 0.5s ease';
            }, 100);
        });
        
        // Para dispositivos móveis: expansão automática de categorias
        if (window.innerWidth < 992) {
            const firstNotSelected = document.querySelector('.category-header.active');
            if (firstNotSelected) {
                firstNotSelected.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/builder/index.blade.php ENDPATH**/ ?>
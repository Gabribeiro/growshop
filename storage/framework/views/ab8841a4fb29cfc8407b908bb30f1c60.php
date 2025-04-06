<?php $__env->startSection('title', 'Meus Pedidos - Potiguara Grow Shop'); ?>

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
    
    .order-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .order-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .order-title {
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-color);
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
        text-transform: uppercase;
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    
    .order-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .order-card {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .order-card:hover {
        background-color: rgba(0, 177, 64, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    
    .order-id {
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .order-date {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .order-status {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-paid {
        background-color: rgba(0, 177, 64, 0.2);
        color: var(--green-neon);
        border: 1px solid rgba(0, 177, 64, 0.4);
    }
    
    .status-pending {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.4);
    }
    
    .status-canceled {
        background-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.4);
    }
    
    .order-total {
        font-weight: 700;
        color: var(--text-color);
        font-size: 1.2rem;
    }
    
    .order-items {
        margin-top: 10px;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .no-orders {
        text-align: center;
        padding: 40px 20px;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .no-orders i {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Meus Pedidos</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="order-section">
                <h2 class="order-title">Histórico de Pedidos</h2>
                
                <?php if(count($orders) > 0): ?>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('grow.order.detail', ['order' => $order->id])); ?>" class="text-decoration-none">
                            <div class="order-card">
                                <div class="order-header">
                                    <div class="order-id">
                                        <?php
                                            // Extrair o número do pedido do campo status (formato: 'Pendente | GRW-xxxxxxxx')
                                            $orderParts = explode('|', $order->status);
                                            $orderNumber = isset($orderParts[1]) ? trim($orderParts[1]) : $order->id;
                                        ?>
                                        Pedido #<?php echo e($orderNumber); ?>

                                    </div>
                                    <div class="order-date"><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <span class="order-status 
                                            <?php if(str_contains(strtolower($order->status), 'pago') || str_contains(strtolower($order->status), 'paid')): ?>
                                                status-paid
                                            <?php elseif(str_contains(strtolower($order->status), 'cancelado') || str_contains(strtolower($order->status), 'canceled')): ?>
                                                status-canceled
                                            <?php else: ?>
                                                status-pending
                                            <?php endif; ?>">
                                            <?php echo e($orderParts[0] ?? $order->status); ?>

                                        </span>
                                    </div>
                                    <div class="order-total">R$ <?php echo e(number_format($order->total_price, 2, ',', '.')); ?></div>
                                </div>
                                
                                <div class="order-items">
                                    <?php if(isset($order->items)): ?>
                                        <?php echo e(count($order->items)); ?> item(s)
                                    <?php else: ?>
                                        <?php echo e($order->products->count()); ?> item(s)
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="no-orders">
                        <i class="bi bi-bag-x"></i>
                        <h5>Nenhum pedido encontrado</h5>
                        <p>Você ainda não realizou nenhum pedido.</p>
                        <a href="<?php echo e(route('grow.products')); ?>" class="btn btn-success mt-3">Explorar Produtos</a>
                    </div>
                <?php endif; ?>
                
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('grow.home')); ?>" class="btn btn-success">
                        <i class="bi bi-house me-2"></i> Voltar para a Loja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/orders.blade.php ENDPATH**/ ?>
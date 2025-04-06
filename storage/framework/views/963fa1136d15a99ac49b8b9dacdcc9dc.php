<?php $__env->startSection('title', 'Minha Conta - Potiguara Grow Shop'); ?>

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
    
    .profile-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .profile-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .profile-title {
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
    
    .profile-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .info-card {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .info-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .info-label {
        font-weight: 600;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 5px;
    }
    
    .info-value {
        font-size: 1.1rem;
        color: var(--text-color);
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
    
    .edit-btn {
        color: var(--primary-color);
        background-color: transparent;
        border: 1px solid var(--primary-color);
        padding: 5px 15px;
        border-radius: 4px;
        transition: all 0.3s;
        font-size: 0.9rem;
    }
    
    .edit-btn:hover {
        background-color: var(--primary-color);
        color: #000;
    }
    
    .address-card {
        background-color: rgba(0, 0, 0, 0.2);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        position: relative;
    }
    
    .address-card-default {
        border-color: var(--primary-color);
    }
    
    .default-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--primary-color);
        color: #000;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
        text-transform: uppercase;
    }
    
    .address-actions {
        margin-top: 15px;
        display: flex;
        gap: 10px;
    }
    
    .nav-tabs {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 30px;
    }
    
    .nav-tabs .nav-link {
        color: rgba(255, 255, 255, 0.7);
        border: none;
        border-bottom: 3px solid transparent;
        background-color: transparent;
        padding: 12px 20px;
        font-weight: 600;
        border-radius: 0;
        transition: all 0.3s;
    }
    
    .nav-tabs .nav-link:hover {
        color: var(--text-color);
        border-color: rgba(0, 177, 64, 0.3);
    }
    
    .nav-tabs .nav-link.active {
        color: var(--green-neon);
        background-color: transparent;
        border-color: var(--green-neon);
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
        <h1 class="mb-0">Minha Conta</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">
                        <i class="bi bi-person me-2"></i>Perfil
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">
                        <i class="bi bi-bag me-2"></i>Pedidos
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="addresses-tab" data-bs-toggle="tab" data-bs-target="#addresses-tab-pane" type="button" role="tab" aria-controls="addresses-tab-pane" aria-selected="false">
                        <i class="bi bi-geo-alt me-2"></i>Endereços
                    </button>
                </li>
            </ul>
            
            <div class="tab-content">
                <!-- Aba de Perfil -->
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <div class="profile-section">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-8">
                                <h2 class="profile-title">Informações Pessoais</h2>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button class="btn edit-btn">
                                    <i class="bi bi-pencil me-2"></i>Editar
                                </button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-label">Nome Completo</div>
                                    <div class="info-value"><?php echo e(auth()->user()->firstName); ?> <?php echo e(auth()->user()->lastName); ?></div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-label">Email</div>
                                    <div class="info-value"><?php echo e(auth()->user()->email); ?></div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-label">Telefone</div>
                                    <div class="info-value">Não informado</div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="info-card">
                                    <div class="info-label">Data de Cadastro</div>
                                    <div class="info-value"><?php echo e(auth()->user()->created_at->format('d/m/Y')); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row align-items-center mt-4">
                            <div class="col-md-8">
                                <h2 class="profile-title">Senha e Segurança</h2>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button class="btn edit-btn">
                                    <i class="bi bi-shield-lock me-2"></i>Alterar Senha
                                </button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="info-card">
                                    <div class="info-label">Senha</div>
                                    <div class="info-value">••••••••</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aba de Pedidos -->
                <div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">
                    <div class="profile-section">
                        <h2 class="profile-title">Meus Pedidos</h2>
                        
                        <?php if(isset($orders) && count($orders) > 0): ?>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="order-card">
                                    <div class="order-header">
                                        <div class="order-id">Pedido #<?php echo e($order->id); ?></div>
                                        <div class="order-date"><?php echo e(\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')); ?></div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <span class="order-status status-<?php echo e($order->status == 'paid' ? 'paid' : ($order->status == 'canceled' ? 'canceled' : 'pending')); ?>">
                                                <?php echo e($order->status == 'paid' ? 'Pago' : ($order->status == 'canceled' ? 'Cancelado' : 'Pendente')); ?>

                                            </span>
                                        </div>
                                        <div class="order-total">R$ <?php echo e(number_format($order->total_price, 2, ',', '.')); ?></div>
                                    </div>
                                    
                                    <div class="order-items">
                                        <?php echo e($order->products->count()); ?> item(s)
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="no-orders">
                                <i class="bi bi-bag-x"></i>
                                <h5>Nenhum pedido encontrado</h5>
                                <p>Você ainda não realizou nenhum pedido.</p>
                                <a href="<?php echo e(route('grow.products')); ?>" class="btn btn-custom-primary mt-3">Explorar Produtos</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Aba de Endereços -->
                <div class="tab-pane fade" id="addresses-tab-pane" role="tabpanel" aria-labelledby="addresses-tab" tabindex="0">
                    <div class="profile-section">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-8">
                                <h2 class="profile-title">Meus Endereços</h2>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button type="button" class="btn btn-custom-primary" id="btnAddAddress">
                                    <i class="bi bi-plus me-2"></i>Adicionar Endereço
                                </button>
                            </div>
                        </div>
                        
                        <!-- Formulário de adicionar endereço (inicialmente oculto) -->
                        <div id="addAddressForm" class="mb-4" style="display: none;">
                            <div class="card bg-dark border-secondary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Adicionar Novo Endereço</h5>
                                    <button type="button" class="btn-close btn-close-white" id="btnCloseAddForm"></button>
                                </div>
                                <div class="card-body">
                                    <form action="/conta/enderecos/<?php echo e(auth()->user()->id); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="company" class="form-label">Nome/Empresa*</label>
                                                <input type="text" class="form-control" id="company" name="company" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Telefone*</label>
                                                <input type="text" class="form-control" id="phone" name="phone" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="address1" class="form-label">Endereço*</label>
                                                <input type="text" class="form-control" id="address1" name="address1" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="address2" class="form-label">Complemento</label>
                                                <input type="text" class="form-control" id="address2" name="address2" value="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="city" class="form-label">Cidade*</label>
                                                <input type="text" class="form-control" id="city" name="city" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="country" class="form-label">Estado*</label>
                                                <input type="text" class="form-control" id="country" name="country" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="postal" class="form-label">CEP</label>
                                                <input type="text" class="form-control" id="postal" name="postal" value="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" name="default" id="default">
                                                    <label class="form-check-label" for="default">
                                                        Definir como endereço padrão
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-custom-primary">Salvar Endereço</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Formulário de editar endereço (inicialmente oculto) -->
                        <div id="editAddressForm" class="mb-4" style="display: none;">
                            <div class="card bg-dark border-secondary">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Editar Endereço</h5>
                                    <button type="button" class="btn-close btn-close-white" id="btnCloseEditForm"></button>
                                </div>
                                <div class="card-body">
                                    <form id="formEditAddress" action="" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_company" class="form-label">Nome/Empresa*</label>
                                                <input type="text" class="form-control" id="edit_company" name="company" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_phone" class="form-label">Telefone*</label>
                                                <input type="text" class="form-control" id="edit_phone" name="phone" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="edit_address1" class="form-label">Endereço*</label>
                                                <input type="text" class="form-control" id="edit_address1" name="address1" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="edit_address2" class="form-label">Complemento</label>
                                                <input type="text" class="form-control" id="edit_address2" name="address2" value="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_city" class="form-label">Cidade*</label>
                                                <input type="text" class="form-control" id="edit_city" name="city" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_country" class="form-label">Estado*</label>
                                                <input type="text" class="form-control" id="edit_country" name="country" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_postal" class="form-label">CEP</label>
                                                <input type="text" class="form-control" id="edit_postal" name="postal" value="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check mt-4">
                                                    <input class="form-check-input" type="checkbox" name="default" id="edit_default">
                                                    <label class="form-check-label" for="edit_default">
                                                        Definir como endereço padrão
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-custom-primary">Atualizar Endereço</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(auth()->user()->addresses && count(auth()->user()->addresses) > 0): ?>
                            <div class="row">
                                <?php $__currentLoopData = auth()->user()->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="address-card <?php echo e($address->default ? 'address-card-default' : ''); ?>">
                                            <?php if($address->default): ?>
                                                <div class="default-badge">Padrão</div>
                                            <?php endif; ?>
                                            
                                            <h5><?php echo e($address->company); ?></h5>
                                            <p class="mb-1"><?php echo e($address->address1); ?></p>
                                            <?php if($address->address2): ?>
                                                <p class="mb-1"><?php echo e($address->address2); ?></p>
                                            <?php endif; ?>
                                            <p class="mb-1"><?php echo e($address->city); ?>, <?php echo e($address->country); ?></p>
                                            <?php if($address->postal): ?>
                                                <p class="mb-1">CEP: <?php echo e($address->postal); ?></p>
                                            <?php endif; ?>
                                            <p class="mb-1">Tel: <?php echo e($address->phone); ?></p>
                                            
                                            <div class="address-actions">
                                                <button class="btn edit-btn btn-edit-address" 
                                                       data-id="<?php echo e($address->id); ?>"
                                                       data-company="<?php echo e($address->company); ?>"
                                                       data-phone="<?php echo e($address->phone); ?>"
                                                       data-address1="<?php echo e($address->address1); ?>"
                                                       data-address2="<?php echo e($address->address2 ?? ''); ?>"
                                                       data-city="<?php echo e($address->city); ?>"
                                                       data-country="<?php echo e($address->country); ?>"
                                                       data-postal="<?php echo e($address->postal ?? ''); ?>"
                                                       data-default="<?php echo e($address->default); ?>">
                                                    <i class="bi bi-pencil me-1"></i>Editar
                                                </button>
                                                
                                                <?php if(!$address->default): ?>
                                                    <form action="/conta/enderecos/<?php echo e(auth()->user()->id); ?>/<?php echo e($address->id); ?>" method="POST" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn edit-btn">
                                                            <i class="bi bi-trash me-1"></i>Remover
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="no-orders">
                                <i class="bi bi-geo-alt"></i>
                                <h5>Nenhum endereço cadastrado</h5>
                                <p>Adicione seu primeiro endereço para facilitar suas compras.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_js'); ?>
<script>
    // Código JavaScript existente (se houver)
    
    // Script para gerenciar endereços na página de perfil
    document.addEventListener('DOMContentLoaded', function() {
        // Botões para mostrar/esconder formulários
        const btnAddAddress = document.getElementById('btnAddAddress');
        const btnCloseAddForm = document.getElementById('btnCloseAddForm');
        const btnCloseEditForm = document.getElementById('btnCloseEditForm');
        const addAddressForm = document.getElementById('addAddressForm');
        const editAddressForm = document.getElementById('editAddressForm');
        
        // Botões de editar endereço
        const btnEditAddress = document.querySelectorAll('.btn-edit-address');
        
        // Mostrar formulário de adicionar
        if (btnAddAddress) {
            btnAddAddress.addEventListener('click', function() {
                addAddressForm.style.display = 'block';
                editAddressForm.style.display = 'none';
            });
        }
        
        // Fechar formulário de adicionar
        if (btnCloseAddForm) {
            btnCloseAddForm.addEventListener('click', function() {
                addAddressForm.style.display = 'none';
            });
        }
        
        // Fechar formulário de editar
        if (btnCloseEditForm) {
            btnCloseEditForm.addEventListener('click', function() {
                editAddressForm.style.display = 'none';
            });
        }
        
        // Configurar botões de editar
        btnEditAddress.forEach(btn => {
            btn.addEventListener('click', function() {
                // Esconder formulário de adicionar
                addAddressForm.style.display = 'none';
                
                // Obter dados do endereço
                const addressId = this.dataset.id;
                const company = this.dataset.company;
                const phone = this.dataset.phone;
                const address1 = this.dataset.address1;
                const address2 = this.dataset.address2 || '';
                const city = this.dataset.city;
                const country = this.dataset.country;
                const postal = this.dataset.postal || '';
                const isDefault = this.dataset.default === '1';
                
                // Preencher formulário de edição
                document.getElementById('edit_company').value = company;
                document.getElementById('edit_phone').value = phone;
                document.getElementById('edit_address1').value = address1;
                document.getElementById('edit_address2').value = address2;
                document.getElementById('edit_city').value = city;
                document.getElementById('edit_country').value = country;
                document.getElementById('edit_postal').value = postal;
                document.getElementById('edit_default').checked = isDefault;
                
                // Configurar URL do formulário
                const userId = <?php echo e(auth()->id()); ?>;
                const formEdit = document.getElementById('formEditAddress');
                formEdit.action = `/conta/enderecos/${userId}/${addressId}`;
                
                // Monitorar o envio do formulário para debug
                formEdit.addEventListener('submit', function(e) {
                    console.log('Formulário enviado para:', this.action);
                });
                
                // Mostrar formulário de edição
                editAddressForm.style.display = 'block';
            });
        });
    });
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/profile.blade.php ENDPATH**/ ?>
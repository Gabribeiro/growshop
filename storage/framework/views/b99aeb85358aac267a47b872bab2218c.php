<?php $__env->startSection('title', 'Gerenciar Endereços - Potiguara Grow Shop'); ?>

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
    
    .address-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .address-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .address-title {
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
    
    .address-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .form-control {
        background-color: rgba(0, 0, 0, 0.1);
        border: 1px solid var(--card-border);
        color: var(--text-color);
        padding: 0.75rem 1rem;
        border-radius: 4px;
    }
    
    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.2);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 177, 64, 0.25);
        color: var(--text-color);
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    
    .checkbox-default {
        margin-top: 1rem;
    }
    
    .breadcrumbs {
        padding: 15px 0;
        margin-bottom: 30px;
    }
    
    .breadcrumbs__list {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .breadcrumbs__item {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    .breadcrumbs__item:not(:last-child)::after {
        content: '/';
        margin: 0 10px;
        color: var(--text-light);
    }
    
    .breadcrumbs__item a {
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .breadcrumbs__item a:hover {
        color: var(--primary-color);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Gerenciar Endereços</h1>
    </div>
</div>

<div class="container py-4">
    <div class="breadcrumbs">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item"><a href="<?php echo e(route('grow.home')); ?>">Home</a></li>
            <li class="breadcrumbs__item"><a href="/conta">Minha Conta</a></li>
            <li class="breadcrumbs__item">Gerenciar Endereços</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="address-section">
                <h2 class="address-title"><?php echo e($firstName . ' ' . $lastName); ?></h2>
                
                <?php if(isset($address) && $address): ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-dark border-secondary mb-4">
                                <div class="card-body">
                                    <?php if($address->default): ?>
                                        <span class="badge bg-success float-end">Endereço Padrão</span>
                                    <?php endif; ?>
                                    
                                    <h5 class="card-title"><?php echo e($address->company); ?></h5>
                                    <p class="card-text mb-1"><?php echo e($address->address1); ?></p>
                                    <?php if($address->address2): ?>
                                        <p class="card-text mb-1"><?php echo e($address->address2); ?></p>
                                    <?php endif; ?>
                                    <p class="card-text mb-1"><?php echo e($address->city); ?>, <?php echo e($address->country); ?></p>
                                    <?php if($address->postal): ?>
                                        <p class="card-text mb-1">CEP: <?php echo e($address->postal); ?></p>
                                    <?php endif; ?>
                                    <p class="card-text">Telefone: <?php echo e($address->phone); ?></p>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-outline-primary" onclick="toggleEditForm()">
                                            <i class="bi bi-pencil-square me-2"></i>Editar
                                        </button>
                                        
                                        <?php if(!$address->default): ?>
                                            <form action="/conta/enderecos/<?php echo e(auth()->user()->id); ?>/<?php echo e($address->id); ?>" method="POST" class="d-inline ms-2">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="bi bi-trash me-2"></i>Excluir
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="edit-form" style="display: none;">
                                <form action="/conta/enderecos/<?php echo e(auth()->user()->id); ?>/<?php echo e($address->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="company" class="form-label">Nome/Empresa</label>
                                            <input type="text" name="company" id="company" class="form-control" value="<?php echo e($address->company); ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="phone" class="form-label">Telefone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="<?php echo e($address->phone); ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="address1" class="form-label">Endereço</label>
                                            <input type="text" name="address1" id="address1" class="form-control" value="<?php echo e($address->address1); ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="address2" class="form-label">Complemento</label>
                                            <input type="text" name="address2" id="address2" class="form-control" value="<?php echo e($address->address2); ?>">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="city" class="form-label">Cidade</label>
                                            <input type="text" name="city" id="city" class="form-control" value="<?php echo e($address->city); ?>" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="country" class="form-label">País</label>
                                            <input type="text" name="country" id="country" class="form-control" value="<?php echo e($address->country); ?>" required>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="postal" class="form-label">CEP</label>
                                            <input type="text" name="postal" id="postal" class="form-control" value="<?php echo e($address->postal); ?>">
                                        </div>
                                        
                                        <div class="col-12 checkbox-default">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="default" id="default" value="1" <?php echo e($address->default ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="default">
                                                    Definir como endereço padrão
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-custom-primary">
                                                <i class="bi bi-check-circle me-2"></i>Atualizar
                                            </button>
                                            <button type="button" class="btn btn-secondary ms-2" onclick="toggleEditForm()">
                                                <i class="bi bi-x-circle me-2"></i>Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div id="new-address-form" <?php echo e(isset($address) && $address ? 'style=display:none;' : ''); ?>>
                    <h3 class="mb-4">Adicionar Novo Endereço</h3>
                    
                    <form action="/conta/enderecos/<?php echo e(auth()->user()->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="new-company" class="form-label">Nome/Empresa</label>
                                <input type="text" name="company" id="new-company" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="new-phone" class="form-label">Telefone</label>
                                <input type="text" name="phone" id="new-phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="new-address1" class="form-label">Endereço</label>
                                <input type="text" name="address1" id="new-address1" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="new-address2" class="form-label">Complemento</label>
                                <input type="text" name="address2" id="new-address2" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="new-city" class="form-label">Cidade</label>
                                <input type="text" name="city" id="new-city" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="new-country" class="form-label">País</label>
                                <input type="text" name="country" id="new-country" class="form-control" value="Brasil" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="new-postal" class="form-label">CEP</label>
                                <input type="text" name="postal" id="new-postal" class="form-control">
                            </div>
                            
                            <div class="col-12 checkbox-default">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="default" id="new-default" value="1">
                                    <label class="form-check-label" for="new-default">
                                        Definir como endereço padrão
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-custom-primary">
                                    <i class="bi bi-plus-circle me-2"></i>Adicionar Endereço
                                </button>
                                
                                <?php if(isset($address) && $address): ?>
                                    <button type="button" class="btn btn-secondary ms-2" onclick="toggleNewForm()">
                                        <i class="bi bi-x-circle me-2"></i>Cancelar
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php if(isset($address) && $address): ?>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-light" onclick="toggleNewForm()" id="add-new-btn">
                            <i class="bi bi-plus-circle me-2"></i>Adicionar Novo Endereço
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('extra_js'); ?>
<script>
    function toggleEditForm() {
        const editForm = document.getElementById('edit-form');
        if (editForm.style.display === 'none') {
            editForm.style.display = 'block';
        } else {
            editForm.style.display = 'none';
        }
    }
    
    function toggleNewForm() {
        const newForm = document.getElementById('new-address-form');
        const addBtn = document.getElementById('add-new-btn');
        
        if (newForm.style.display === 'none') {
            newForm.style.display = 'block';
            if (addBtn) addBtn.style.display = 'none';
        } else {
            newForm.style.display = 'none';
            if (addBtn) addBtn.style.display = 'inline-block';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/endereco.blade.php ENDPATH**/ ?>
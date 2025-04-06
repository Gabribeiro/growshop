<?php $__env->startSection('title', 'Login'); ?>

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
    
    .login-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .login-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .login-title {
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
    
    .login-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--card-border);
        color: #fff;
        padding: 12px;
        margin-bottom: 20px;
    }
    
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 177, 64, 0.25);
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
        opacity: 1;
    }
    
    .form-label {
        color: var(--text-color);
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .login-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .login-links a {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    
    .login-links a:hover {
        color: var(--green-neon);
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
    }
    
    .login-divider {
        display: flex;
        align-items: center;
        margin: 30px 0;
        color: rgba(255, 255, 255, 0.5);
    }
    
    .login-divider::before,
    .login-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .login-divider::before {
        margin-right: 15px;
    }
    
    .login-divider::after {
        margin-left: 15px;
    }
    
    .register-link {
        text-align: center;
        margin-top: 20px;
        color: rgba(255, 255, 255, 0.7);
    }
    
    .register-link a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .register-link a:hover {
        color: var(--green-neon);
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
    }
    
    .login-benefits {
        margin-top: 30px;
    }
    
    .login-benefits h4 {
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--text-color);
        font-size: 1.1rem;
    }
    
    .benefit-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .benefit-icon {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-right: 15px;
    }
    
    .alert {
        border-radius: 0;
        margin-bottom: 20px;
        padding: 12px 15px;
    }
    
    .alert-danger {
        background-color: rgba(220, 53, 69, 0.2);
        border: 1px solid rgba(220, 53, 69, 0.3);
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Acesso à Conta</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="login-section">
                <h2 class="login-title">Login</h2>
                
                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <form action="<?php echo e(route('post-login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="loginemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginemail" name="loginemail" placeholder="Digite seu email" autofocus required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="Digite sua senha" required>
                    </div>
                    
                    <div class="login-links">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Lembrar-me</label>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>">Esqueceu a senha?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-custom-primary w-100">Entrar</button>
                </form>
                
                <div class="login-divider">ou</div>
                
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="bi bi-google me-2"></i> Continuar com Google
                    </a>
                </div>
                
                <div class="register-link">
                    Não tem uma conta? <a href="<?php echo e(route('grow.register')); ?>">Cadastre-se</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="login-section">
                <h2 class="login-title">Vantagens da conta</h2>
                
                <div class="login-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Histórico de pedidos</h5>
                            <p class="mb-0">Acompanhe todos os seus pedidos e compras anteriores</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Endereços salvos</h5>
                            <p class="mb-0">Salve seus endereços para uma finalização de compra mais rápida</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Lista de desejos</h5>
                            <p class="mb-0">Salve produtos que você deseja comprar no futuro</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="bi bi-tag"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Ofertas exclusivas</h5>
                            <p class="mb-0">Receba ofertas exclusivas para clientes cadastrados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/login.blade.php ENDPATH**/ ?>
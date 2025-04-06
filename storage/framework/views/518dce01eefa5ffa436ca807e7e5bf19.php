<?php $__env->startSection('title', 'Recuperação de Senha - Potiguara Grow Shop'); ?>

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
    
    .recovery-card {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .recovery-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .recovery-card .card-body {
        padding: 0;
    }
    
    .recovery-title {
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
    
    .recovery-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .recovery-icon {
        font-size: 4rem;
        color: var(--green-neon);
        text-shadow: var(--green-glow);
        margin-bottom: 20px;
    }
    
    .btn-reset {
        background-color: var(--primary-color);
        border: none;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 25px;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 177, 64, 0.3);
        clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
    }
    
    .btn-reset:hover {
        background-color: var(--primary-color-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 177, 64, 0.4);
        color: white;
    }
    
    .image-side {
        position: relative;
        background-color: rgba(0, 177, 64, 0.05);
        overflow: hidden;
    }
    
    .image-side::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle at center, rgba(0, 177, 64, 0.1) 0%, transparent 70%);
        z-index: 1;
        animation: pulse 6s infinite linear;
    }
    
    @keyframes pulse {
        0% {
            opacity: 0.3;
        }
        50% {
            opacity: 0.8;
        }
        100% {
            opacity: 0.3;
        }
    }
    
    .form-control {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--card-border);
        color: var(--text-color);
        padding: 12px 15px;
        height: auto;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.1);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 177, 64, 0.25);
        color: var(--text-color);
    }
    
    .form-label {
        color: var(--text-color);
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .form-text {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .back-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: var(--green-neon);
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Recuperação de Senha</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="recovery-card">
                <div class="row g-0">
                    <!-- Coluna de imagem decorativa -->
                    <div class="col-lg-5 image-side d-flex flex-column justify-content-center align-items-center py-5">
                        <div class="text-center px-4">
                            <i class="bi bi-key recovery-icon"></i>
                            <h2 class="mt-4 fw-bold">Esqueceu a senha?</h2>
                            <p class="text-muted">
                                Sem problemas! Informe seu e-mail e enviaremos um link para criar uma nova senha.
                            </p>
                            <div class="mt-4">
                                <img src="<?php echo e(asset('img/plants-illustration.svg')); ?>" alt="Ilustração" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coluna do formulário -->
                    <div class="col-lg-7">
                        <div class="card-body p-5">
                            <h4 class="recovery-title">Recupere sua senha</h4>
                            
                            <?php if(session('status')): ?>
                                <div class="alert alert-success mb-4">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" action="<?php echo e(route('password.email')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <div class="mb-4">
                                    <label for="email" class="form-label">Endereço de E-mail</label>
                                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" placeholder="Digite seu e-mail">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-text mt-2">
                                        Enviaremos um link de recuperação para este e-mail.
                                    </div>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-reset">
                                        Enviar Link de Recuperação
                                    </button>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <a href="<?php echo e(route('grow.login')); ?>" class="back-link">
                                        <i class="bi bi-arrow-left-short"></i> Voltar para o Login
                                    </a>
                                </div>
                            </form>
                            
                            <div class="mt-5">
                                <p class="text-muted small">
                                    Se você não receber o e-mail em alguns minutos, verifique sua pasta de spam ou tente novamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/forgot-password.blade.php ENDPATH**/ ?>
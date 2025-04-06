<?php $__env->startSection('title', 'Verificar E-mail - Potiguara Grow Shop'); ?>

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
    
    .verify-card {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }
    
    .verify-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background-color: rgba(0, 177, 64, 0.1);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .verify-card .card-body {
        padding: 0;
    }
    
    .verify-title {
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
    
    .verify-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .verify-icon {
        font-size: 4rem;
        color: var(--green-neon);
        text-shadow: var(--green-glow);
        margin-bottom: 20px;
    }
    
    .btn-resend {
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
    
    .btn-resend:hover {
        background-color: var(--primary-color-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 177, 64, 0.4);
        color: white;
    }
    
    .benefit-icon {
        color: var(--green-neon);
        font-size: 1.5rem;
        margin-right: 15px;
        text-shadow: var(--green-glow);
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
    
    .alert-verify {
        background-color: rgba(0, 177, 64, 0.1);
        border: 1px solid rgba(0, 177, 64, 0.2);
        color: #f5f5f5;
        padding: 15px;
        border-radius: 4px;
        position: relative;
        overflow: hidden;
    }
    
    .alert-verify::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 30px;
        height: 30px;
        background-color: rgba(0, 177, 64, 0.2);
        clip-path: polygon(100% 0, 0% 100%, 100% 100%);
    }
    
    .home-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .home-link:hover {
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
        <h1 class="mb-0">Verificação de E-mail</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="verify-card">
                <div class="row g-0">
                    <!-- Coluna de imagem decorativa -->
                    <div class="col-lg-5 image-side d-flex flex-column justify-content-center align-items-center py-5">
                        <div class="text-center px-4">
                            <i class="bi bi-envelope-check verify-icon"></i>
                            <h2 class="mt-4 fw-bold">Verifique seu E-mail</h2>
                            <p class="text-muted">
                                Enviamos um link de verificação para o seu e-mail. Verifique sua caixa de entrada.
                            </p>
                            <div class="mt-4">
                                <img src="<?php echo e(asset('img/plants-illustration.svg')); ?>" alt="Ilustração" class="img-fluid" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coluna de conteúdo -->
                    <div class="col-lg-7 p-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="verify-title mb-0">Confirmação Pendente</h3>
                            <a href="/" class="home-link">
                                <i class="bi bi-house"></i> Início
                            </a>
                        </div>
                        
                        <div class="alert-verify mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Antes de continuar, verifique seu e-mail para um link de verificação.
                        </div>
                        
                        <p>Se você não recebeu o e-mail, clique no botão abaixo para solicitar outro.</p>
                        
                        <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="mt-4">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-resend w-100 mb-3">
                                Reenviar E-mail de Verificação
                            </button>
                        </form>
                        
                        <div class="border-top mt-4 pt-4">
                            <h5 class="fw-bold mb-3">Por que verificar seu e-mail?</h5>
                            <div class="d-flex mb-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Segurança</h6>
                                    <p class="text-muted small">Proteja sua conta contra acessos não autorizados</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-3">
                                <div class="benefit-icon">
                                    <i class="bi bi-bag-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Compras Seguras</h6>
                                    <p class="text-muted small">Faça compras com maior segurança em nossa loja</p>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="benefit-icon">
                                    <i class="bi bi-bell"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Notificações</h6>
                                    <p class="text-muted small">Receba atualizações sobre promoções e novidades</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/verify-email.blade.php ENDPATH**/ ?>
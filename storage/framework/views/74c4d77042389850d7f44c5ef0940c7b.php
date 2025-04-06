<?php $__env->startSection('title', 'Contato'); ?>

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
    
    .page-banner-content {
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
    
    .page-banner p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        max-width: 700px;
    }
    
    .contact-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    
    .contact-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-right: 15px;
        min-width: 30px;
        text-align: center;
    }
    
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--card-border);
        color: #fff;
        padding: 12px;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 177, 64, 0.25);
    }
    
    .form-label {
        color: var(--text-color);
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .section-title {
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-color);
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
        text-transform: uppercase;
        font-size: 1.2rem;
        letter-spacing: 1px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .map-container {
        height: 300px;
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .social-links {
        display: flex;
        gap: 15px;
    }
    
    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        background-color: var(--primary-color);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 177, 64, 0.3);
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
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container page-banner-content">
        <h1 class="mb-2">Contato</h1>
        <p class="lead mb-0">Entre em contato conosco</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="contact-section">
                <h2 class="section-title">Envie sua mensagem</h2>
                
                <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <form action="<?php echo e(route('grow.contact.submit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" name="phone" value="<?php echo e(old('phone')); ?>">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="subject" class="form-label">Assunto</label>
                            <select class="form-select <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="subject" name="subject">
                                <option value="Dúvida sobre produtos" <?php echo e(old('subject') == 'Dúvida sobre produtos' ? 'selected' : ''); ?>>Dúvida sobre produtos</option>
                                <option value="Suporte técnico" <?php echo e(old('subject') == 'Suporte técnico' ? 'selected' : ''); ?>>Suporte técnico</option>
                                <option value="Informações de compra" <?php echo e(old('subject') == 'Informações de compra' ? 'selected' : ''); ?>>Informações de compra</option>
                                <option value="Outro" <?php echo e(old('subject') == 'Outro' ? 'selected' : ''); ?>>Outro</option>
                            </select>
                            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-12">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="message" name="message" rows="5" required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-custom-primary">Enviar Mensagem</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="contact-section">
                <h3 class="section-title">Informações de Contato</h3>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Endereço</h5>
                        <p class="mb-0">Rua Exemplo, 123<br>Bairro Centro, São Paulo/SP<br>CEP: 01234-567</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Telefone</h5>
                        <p class="mb-0">(11) 1234-5678<br>(11) 98765-4321</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0">contato@potiguaragrow.com.br<br>vendas@potiguaragrow.com.br</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Horário de Atendimento</h5>
                        <p class="mb-0">Segunda a Sexta: 8h às 18h<br>Sábado: 9h às 13h</p>
                    </div>
                </div>
                
                <div class="map-container">
                    <div class="text-center">
                        <i class="bi bi-map text-muted" style="font-size: 3rem;"></i>
                        <p class="mt-2 mb-0">Mapa será carregado aqui</p>
                    </div>
                </div>
                
                <h5 class="mb-3">Siga-nos</h5>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/contact.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.name')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Permanent+Marker&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #00b140;
            --primary-color-dark: #009933;
            --primary-color-light: #00e64d;
            --secondary-color: #00e676;
            --accent-color: #00ff55;
            --text-color: #f5f5f5;
            --dark-bg: #0f0f0f;
            --card-bg: #1a1a1a;
            --card-border: #252525;
            --card-highlight: #333333;
            --green-neon: #00ff4c;
            --green-glow: 0 0 5px rgba(0, 255, 76, 0.5), 0 0 20px rgba(0, 255, 76, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: var(--dark-bg);
            overflow-x: hidden;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(0, 177, 64, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 80% 70%, rgba(0, 177, 64, 0.05) 0%, transparent 20%);
            pointer-events: none;
            z-index: -1;
        }
        
        .navbar {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 100;
            border-bottom: 1px solid rgba(0, 177, 64, 0.3);
        }
        
        .navbar-brand {
            font-family: 'Permanent Marker', cursive;
            font-size: 1.8rem;
            color: white !important;
            position: relative;
        }
        
        .navbar-brand img {
            max-height: 50px;
        }
        
        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 80%;
            height: 2px;
            background-color: var(--green-neon);
            box-shadow: var(--green-glow);
        }
        
        .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s, text-shadow 0.3s;
            position: relative;
            color: #ffffff !important;
        }
        
        .nav-link:hover {
            color: var(--green-neon) !important;
            text-shadow: 0 0 3px rgba(0, 255, 76, 0.5);
        }
        
        .nav-link.active {
            color: var(--green-neon) !important;
            text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: var(--green-neon);
            box-shadow: var(--green-glow);
        }
        
        .btn-custom-primary {
            background-color: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 0;
            padding: 12px 25px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 177, 64, 0.3);
            clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
        }
        
        .btn-custom-primary:hover {
            background-color: var(--primary-color-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 177, 64, 0.4);
        }
        
        .btn-custom-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 0;
            padding: 10px 25px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 177, 64, 0.2);
            clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);
        }
        
        .btn-custom-outline:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(0, 177, 64, 0.3);
        }
        
        .page-banner {
            background-color: var(--dark-bg);
            color: white;
            padding: 80px 0;
            margin-bottom: 60px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.5);
        }
        
        .page-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.8) 100%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2300b140' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 1;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
            font-weight: 800;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        .section-title.text-center::after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .text-accent {
            color: var(--primary-color);
        }
        
        .card {
            border: none;
            border-radius: 0;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 25px;
            background-color: var(--card-bg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--card-border);
            clip-path: polygon(0 0, 100% 0, 100% 95%, 95% 100%, 0 100%);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 10px rgba(0, 177, 64, 0.2);
            border-color: rgba(0, 177, 64, 0.3);
        }
        
        .footer {
            background-color: #000;
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
            border-top: 1px solid rgba(0, 177, 64, 0.3);
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.95) 100%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2300b140' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 1;
            z-index: -1;
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .footer a {
            color: #cccccc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer a:hover {
            color: var(--primary-color);
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 0;
            background-color: rgba(255, 255, 255, 0.05);
            margin-right: 10px;
            transition: all 0.3s;
            color: var(--primary-color);
            border: 1px solid rgba(0, 177, 64, 0.3);
        }
        
        .social-links a:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px) rotate(5deg);
            box-shadow: 0 5px 15px rgba(0, 177, 64, 0.3);
        }
        
        .product-badge {
            display: inline-block;
            padding: 5px 12px;
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }
        
        .leaf-1 {
            top: 10%;
            left: 5%;
            transform: rotate(20deg);
            font-size: 5rem;
            color: var(--primary-color);
        }
        
        .leaf-2 {
            bottom: 10%;
            right: 5%;
            transform: rotate(-20deg);
            font-size: 8rem;
            color: var(--primary-color-dark);
        }
        
        .geometric {
            position: absolute;
            z-index: -1;
            opacity: 0.1;
            border: 2px solid var(--primary-color);
        }
        
        .triangle {
            width: 60px;
            height: 60px;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            background-color: var(--primary-color);
        }
        
        .circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--primary-color);
            background-color: transparent;
        }
        
        .line {
            width: 100px;
            height: 2px;
            background-color: var(--primary-color);
            transform: rotate(45deg);
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
        
        .diagonal-line3 {
            position: absolute;
            bottom: 30px;
            left: 40px;
            width: 80px;
            height: 2px;
            background-color: var(--primary-color);
            transform: rotate(30deg);
            opacity: 0.2;
        }
        
        .section-divider {
            height: 5px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            opacity: 0.3;
            margin: 40px 0;
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(0, 177, 64, 0.2);
            border-radius: 0;
            color: white;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.12);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 177, 64, 0.25);
            color: white;
        }
        
        input::placeholder, textarea::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        @media (max-width: 991px) {
            .section-title {
                font-size: 1.8rem;
            }
            
            .page-banner {
                padding: 60px 0;
                margin-bottom: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.6rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
        }
    </style>
    <?php echo $__env->yieldContent('extra_css'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('grow.home')); ?>">
                <img src="/img/potiguara-logo.png" alt="<?php echo e(config('app.name')); ?>" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%2250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%2050%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1894e23cbc1%20text%20%7B%20fill%3A%2300b140%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1894e23cbc1%22%3E%3Crect%20width%3D%22200%22%20height%3D%2250%22%20fill%3D%22%23000000%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.4453125%22%20y%3D%2229.4%22%3EPotiguara%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E';">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('grow.home')): ?> active <?php endif; ?>" href="<?php echo e(route('grow.home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('grow.products')): ?> active <?php endif; ?>" href="<?php echo e(route('grow.products')); ?>">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('grow.about')): ?> active <?php endif; ?>" href="<?php echo e(route('grow.about')); ?>">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->routeIs('grow.contact')): ?> active <?php endif; ?>" href="<?php echo e(route('grow.contact')); ?>">Contato</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="<?php echo e(route('grow.cart')); ?>" class="btn btn-custom-outline me-2">
                        <i class="bi bi-cart"></i> Carrinho
                        <?php if(session()->has('cart') && count(session()->get('cart')) > 0): ?>
                            <span class="badge bg-primary text-white ms-1"><?php echo e(count(session()->get('cart'))); ?></span>
                        <?php endif; ?>
                    </a>
                    <?php if(auth()->check()): ?>
                        <a href="/account" class="btn btn-custom-primary">Minha Conta</a>
                    <?php else: ?>
                        <a href="/account/login" class="btn btn-custom-primary">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="diagonal-line"></div>
        <div class="diagonal-line2"></div>
        <div class="diagonal-line3"></div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="/img/potiguara-logo.png" alt="<?php echo e(config('app.name')); ?>" class="mb-4" style="max-height: 60px;" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%2250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%2050%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1894e23cbc1%20text%20%7B%20fill%3A%2300b140%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1894e23cbc1%22%3E%3Crect%20width%3D%22200%22%20height%3D%2250%22%20fill%3D%22%23000000%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.4453125%22%20y%3D%2229.4%22%3EPotiguara%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E';">
                    <p>Soluções discretas e funcionais para o seu espaço de cultivo. Qualidade, inovação e discrição.</p>
                    <div class="social-links mt-3">
                        <a href="#" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="#" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(route('grow.about')); ?>"><i class="bi bi-chevron-right me-2"></i> Sobre nós</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('grow.contact')); ?>"><i class="bi bi-chevron-right me-2"></i> Contato</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('grow.products')); ?>"><i class="bi bi-chevron-right me-2"></i> Produtos</a></li>
                        <li class="mb-2"><a href="#"><i class="bi bi-chevron-right me-2"></i> Termos de Uso</a></li>
                        <li class="mb-2"><a href="#"><i class="bi bi-chevron-right me-2"></i> Política de Privacidade</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contato</h5>
                    <address>
                        <p><i class="bi bi-geo-alt me-2"></i> Rua Exemplo, 123, Natal/RN</p>
                        <p><i class="bi bi-telephone me-2"></i> (84) 1234-5678</p>
                        <p><i class="bi bi-envelope me-2"></i> contato@potiguaragrow.com</p>
                    </address>
                    <h5 class="mt-4">Newsletter</h5>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Seu email">
                            <button class="btn btn-custom-primary" type="submit">Inscrever</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4" style="background-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('extra_js'); ?>
</body>
</html> <?php /**PATH /var/www/resources/views/grow/layouts/app.blade.php ENDPATH**/ ?>
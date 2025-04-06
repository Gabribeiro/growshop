@extends('grow.layouts.app')

@section('title', 'Home')

@section('extra_css')
<style>
    .hero-section {
        position: relative;
        background-color: #000;
        overflow: hidden;
        padding: 0;
        margin-bottom: 60px;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 120px 0;
    }
    
    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 20px;
        line-height: 1.1;
        color: #fff;
        font-family: 'Permanent Marker', cursive;
        letter-spacing: 1px;
        text-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
    }
    
    .hero-content .accent {
        color: var(--green-neon);
        text-shadow: 0 0 10px rgba(0, 255, 76, 0.5);
    }
    
    .hero-content p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0.3) 100%);
        z-index: 1;
    }
    
    .hero-decoration {
        position: absolute;
        z-index: 0;
    }
    
    .hero-circle {
        width: 300px;
        height: 300px;
        border: 4px solid var(--primary-color);
        border-radius: 50%;
        top: -100px;
        right: -50px;
        opacity: 0.1;
    }
    
    .hero-triangle {
        width: 200px;
        height: 200px;
        bottom: -50px;
        left: 10%;
        opacity: 0.1;
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        background-color: var(--primary-color);
    }
    
    .hero-line1 {
        width: 150px;
        height: 3px;
        background-color: var(--primary-color);
        transform: rotate(-30deg);
        top: 30%;
        right: 20%;
        opacity: 0.2;
    }
    
    .hero-line2 {
        width: 100px;
        height: 3px;
        background-color: var(--primary-color);
        transform: rotate(45deg);
        bottom: 30%;
        left: 40%;
        opacity: 0.2;
    }
    
    .featured-card {
        border: none;
        background-color: var(--card-bg);
        border-radius: 0;
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s;
        position: relative;
        clip-path: polygon(0 0, 100% 0, 100% 95%, 95% 100%, 0 100%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border: 1px solid var(--card-border);
    }
    
    .featured-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 10px rgba(0, 177, 64, 0.2);
        border-color: rgba(0, 177, 64, 0.3);
    }
    
    .featured-card .card-body {
        padding: 25px;
        background-color: var(--card-bg);
    }
    
    .featured-card .card-title {
        color: #fff;
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 15px;
    }
    
    .featured-card .card-text {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 20px;
    }
    
    .featured-card .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .featured-badge {
        position: absolute;
        top: 15px;
        left: 0;
        background-color: var(--primary-color);
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%);
        letter-spacing: 1px;
    }
    
    .promo-section {
        background-color: #080808;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        margin: 60px 0;
        border-top: 1px solid rgba(0, 177, 64, 0.2);
        border-bottom: 1px solid rgba(0, 177, 64, 0.2);
    }
    
    .promo-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(0, 177, 64, 0.1) 0%, transparent 30%),
            radial-gradient(circle at 80% 70%, rgba(0, 177, 64, 0.1) 0%, transparent 30%);
        z-index: 0;
    }
    
    .promo-content {
        position: relative;
        z-index: 1;
    }
    
    .promo-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'Permanent Marker', cursive;
    }
    
    .promo-title .text-accent {
        color: var(--green-neon);
        text-shadow: 0 0 10px rgba(0, 255, 76, 0.5);
    }
    
    .countdown-container {
        display: flex;
        margin: 30px 0;
    }
    
    .countdown-item {
        background-color: rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(0, 177, 64, 0.3);
        padding: 15px 20px;
        margin-right: 15px;
        min-width: 80px;
        position: relative;
        clip-path: polygon(10% 0, 100% 0, 90% 100%, 0% 100%);
    }
    
    .countdown-item:last-child {
        margin-right: 0;
    }
    
    .countdown-number {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        line-height: 1;
        text-align: center;
    }
    
    .countdown-label {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: center;
    }
    
    .categories-section {
        padding: 60px 0;
    }
    
    .category-card {
        position: relative;
        height: 200px;
        overflow: hidden;
        margin-bottom: 30px;
        clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);
    }
    
    .category-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--card-bg);
        transition: all 0.5s;
    }
    
    .category-card:hover .category-image {
        transform: scale(1.1);
    }
    
    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 100%);
        display: flex;
        align-items: center;
        padding: 20px;
        transition: all 0.3s;
    }
    
    .category-card:hover .category-overlay {
        background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 100%);
    }
    
    .category-title {
        color: white;
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 10px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .category-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--primary-color);
    }
    
    .category-text {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
    
    @media (max-width: 991px) {
        .hero-content h1 {
            font-size: 2.8rem;
        }
        
        .promo-title {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .hero-content {
            padding: 80px 0;
        }
        
        .hero-content h1 {
            font-size: 2.2rem;
        }
        
        .promo-title {
            font-size: 1.8rem;
        }
        
        .countdown-item {
            min-width: 60px;
            padding: 10px;
        }
        
        .countdown-number {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-content {
            padding: 60px 0;
        }
        
        .hero-content h1 {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

@section('content')
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-decoration hero-circle"></div>
    <div class="hero-decoration hero-triangle"></div>
    <div class="hero-decoration hero-line1"></div>
    <div class="hero-decoration hero-line2"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 hero-content">
                <h1>POTIGUARA <span class="accent">GROW</span></h1>
                <p>Soluções completas para cultivadores exigentes. Produtos de qualidade para seu espaço de cultivo, com discrição e eficiência.</p>
                <a href="{{ route('grow.products') }}" class="btn btn-custom-primary">VER PRODUTOS</a>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-center" style="padding: 50px 0;">
                        <div class="bg-black p-4 rounded" style="border: 2px solid rgba(0,177,64,0.3);">
                            <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 300px; width: 300px;">
                                <span class="text-accent" style="font-size: 24px; font-weight: 600;">POTIGUARA GROW</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-products py-5">
    <div class="container">
        <h2 class="section-title text-center">Produtos em Destaque</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-md-4">
                <div class="featured-card">
                    @if($product->is_popular)
                    <div class="featured-badge">Popular</div>
                    @endif
                    
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 200px;">
                        <span class="text-secondary">Sem Imagem</span>
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-accent fw-bold">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            <a href="{{ route('grow.product', $product->id) }}" class="btn btn-custom-outline btn-sm">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('grow.products') }}" class="btn btn-custom-primary">VER TODOS OS PRODUTOS</a>
        </div>
    </div>
</section>

<section class="promo-section">
    <div class="container promo-content">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="promo-title"><span class="text-accent">GREEN</span> FRIDAY</h2>
                <p class="text-white">Escolha entre duas supervantagens exclusivas para o seu cultivo. Aproveite nossa promoção por tempo limitado!</p>
                
                <div class="d-flex mt-4">
                    <div class="me-5">
                        <h4 class="text-white">FRETE GRÁTIS</h4>
                        <p class="text-white-50">Em compras acima de R$ 300,00</p>
                    </div>
                    <div>
                        <h4 class="text-white">KIT CULTIVO</h4>
                        <p class="text-white-50">Substrato, vasos e fertilizante</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <p class="text-white-50 small">Promoção limitada a 20 clientes. Valor do frete limitado a 10% do valor da compra.</p>
                </div>
                
                <h5 class="text-white mt-4">OFERTA TERMINA EM:</h5>
                <div class="countdown-container">
                    <div class="countdown-item">
                        <div class="countdown-number">03</div>
                        <div class="countdown-label">Dias</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number">12</div>
                        <div class="countdown-label">Horas</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number">45</div>
                        <div class="countdown-label">Min</div>
                    </div>
                    <div class="countdown-item">
                        <div class="countdown-number">22</div>
                        <div class="countdown-label">Seg</div>
                    </div>
                </div>
                
                <a href="{{ route('grow.products') }}" class="btn btn-custom-primary mt-3">APROVEITAR AGORA</a>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="text-center">
                    <div class="bg-black p-4 rounded position-relative" style="border: 2px solid rgba(0,177,64,0.3);">
                        <div class="position-absolute" style="top: -10px; right: -10px; width: 70px; height: 70px; clip-path: polygon(50% 0%, 0% 100%, 100% 100%); background-color: var(--primary-color); transform: rotate(45deg);"></div>
                        <div class="position-absolute" style="bottom: -10px; left: -10px; width: 50px; height: 50px; clip-path: polygon(50% 0%, 0% 100%, 100% 100%); background-color: var(--primary-color); transform: rotate(-135deg);"></div>
                        <div class="text-center" style="padding: 50px 20px; position: relative; z-index: 1;">
                            <h3 class="text-white text-uppercase mb-4" style="font-family: 'Permanent Marker', cursive;">Promoção Especial</h3>
                            <p class="text-white-50">Aproveite descontos exclusivos em produtos selecionados e ganhe brindes especiais!</p>
                            <div class="mt-4 d-inline-block position-relative">
                                <span class="bg-dark text-white p-3 d-inline-block" style="font-size: 2rem; font-weight: 700; clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%);">50% OFF</span>
                                <div class="position-absolute" style="top: -5px; right: -5px; bottom: -5px; left: -5px; border: 2px solid var(--primary-color); clip-path: polygon(5% 0%, 100% 0%, 95% 100%, 0% 100%); z-index: -1;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="categories-section">
    <div class="container">
        <h2 class="section-title text-center">Categorias</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4">
                <div class="category-card">
                    <div class="category-image bg-dark"></div>
                    <div class="category-overlay">
                        <div>
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-text">{{ Str::limit($category->description, 80) }}</p>
                            <a href="{{ route('grow.products', ['category' => $category->id]) }}" class="btn btn-custom-outline btn-sm">Ver Produtos</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="testimonials py-5 bg-dark">
    <div class="container">
        <h2 class="section-title text-center">O Que Nossos Clientes Dizem</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-secondary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                        <span class="text-white">JM</span>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 text-white">João Marcelo</h5>
                                        <div class="text-primary">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Os produtos da Potiguara são de excelente qualidade. O kit completo me ajudou muito nos meus primeiros cultivos, e o atendimento foi excepcional.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-secondary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                        <span class="text-white">RL</span>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 text-white">Roberta Lima</h5>
                                        <div class="text-primary">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Entrega rápida e embalagem discreta, como prometido. Os produtos são superiores aos que encontrei em outras lojas. Recomendo fortemente!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_js')
<script>
    // Apenas um exemplo simples de contagem regressiva
    document.addEventListener('DOMContentLoaded', function() {
        // Poderia ser implementado uma contagem regressiva real aqui
    });
</script>
@endsection 
@extends('grow.layouts.app')

@section('title', 'Produtos')

@section('extra_css')
<style>
    .products-banner {
        background-color: #000;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 60px;
    }
    
    .products-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
        z-index: 0;
    }
    
    .products-banner-content {
        position: relative;
        z-index: 2;
    }
    
    .products-banner h1 {
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
    
    .products-banner h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 80px;
        height: 3px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .products-banner p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        max-width: 700px;
    }
    
    .product-card {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 30px;
        overflow: hidden;
        position: relative;
        clip-path: polygon(0 0, 100% 0, 100% 95%, 95% 100%, 0 100%);
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        border-color: rgba(0, 177, 64, 0.3);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 0 10px rgba(0, 177, 64, 0.2);
    }
    
    .product-image {
        height: 220px;
        overflow: hidden;
        position: relative;
        background-color: #0a0a0a;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .product-badge {
        position: absolute;
        top: 15px;
        left: 0;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 15px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%);
        z-index: 1;
    }
    
    .product-discount {
        position: absolute;
        top: 15px;
        right: 0;
        background-color: #ff3b30;
        color: white;
        padding: 5px 15px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
        z-index: 1;
    }
    
    .product-info {
        padding: 20px;
    }
    
    .product-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .product-description {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin-bottom: 15px;
        min-height: 60px;
    }
    
    .product-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--green-neon);
        margin-bottom: 15px;
        display: block;
    }
    
    .product-old-price {
        text-decoration: line-through;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
        margin-right: 10px;
    }
    
    .product-rating {
        color: var(--primary-color);
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
    
    .filter-section {
        background-color: rgba(0, 0, 0, 0.4);
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid var(--card-border);
        position: relative;
        overflow: hidden;
    }
    
    .filter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 177, 64, 0.05) 0%, transparent 100%);
        z-index: -1;
    }
    
    .filter-title {
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
        text-transform: uppercase;
        font-size: 1rem;
        letter-spacing: 1px;
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
    }
    
    .filter-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--primary-color);
    }
    
    .filter-section .form-control, 
    .filter-section .form-select {
        background-color: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(0, 177, 64, 0.2);
        color: #fff;
        border-radius: 0;
        padding: 10px 15px;
    }
    
    .filter-section .form-control:focus, 
    .filter-section .form-select:focus {
        background-color: rgba(255, 255, 255, 0.12);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 177, 64, 0.25);
    }
    
    .pagination {
        margin-top: 30px;
    }
    
    .page-item .page-link {
        background-color: var(--card-bg);
        border-color: var(--card-border);
        color: #fff;
        margin: 0 5px;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }
    
    .page-item .page-link:hover {
        background-color: rgba(0, 177, 64, 0.2);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .category-tabs {
        margin-bottom: 30px;
        border-bottom: 1px solid rgba(0, 177, 64, 0.2);
    }
    
    .category-tabs .nav-link {
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        padding: 0.8rem 1.5rem;
        border: none;
        border-bottom: 3px solid transparent;
        border-radius: 0;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        transition: all 0.3s;
    }
    
    .category-tabs .nav-link:hover {
        color: #fff;
        border-bottom-color: rgba(0, 177, 64, 0.3);
    }
    
    .category-tabs .nav-link.active {
        color: var(--green-neon);
        background-color: transparent;
        border-bottom-color: var(--green-neon);
        text-shadow: 0 0 5px rgba(0, 255, 76, 0.5);
    }
    
    .diagonal-line {
        position: absolute;
        width: 150px;
        height: 2px;
        background-color: var(--primary-color);
        transform: rotate(-45deg);
        opacity: 0.3;
    }
    
    .diagonal-1 {
        top: 50px;
        right: 100px;
    }
    
    .diagonal-2 {
        bottom: 30px;
        left: 50px;
    }
    
    .triangle-decoration {
        position: absolute;
        width: 50px;
        height: 50px;
        background-color: var(--primary-color);
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        opacity: 0.1;
        z-index: 0;
    }
    
    .triangle-1 {
        top: 20px;
        right: 40px;
        transform: rotate(30deg);
    }
    
    .triangle-2 {
        bottom: 20px;
        left: 60px;
        transform: rotate(-30deg);
    }
    
    .circle-decoration {
        position: absolute;
        width: 100px;
        height: 100px;
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        opacity: 0.1;
    }
    
    .circle-1 {
        top: -30px;
        left: 30%;
    }
    
    .circle-2 {
        bottom: -40px;
        right: 20%;
    }
</style>
@endsection

@section('content')
<section class="products-banner">
    <div class="diagonal-line diagonal-1"></div>
    <div class="diagonal-line diagonal-2"></div>
    <div class="triangle-decoration triangle-1"></div>
    <div class="triangle-decoration triangle-2"></div>
    <div class="circle-decoration circle-1"></div>
    <div class="circle-decoration circle-2"></div>
    
    <div class="container products-banner-content">
        <h1>NOSSOS PRODUTOS</h1>
        <p>Descubra nossa linha completa de produtos para cultivo. Qualidade, inovação e discrição para o seu espaço de grow.</p>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="filter-section sticky-top" style="top: 100px; z-index: 10;">
                <h4 class="filter-title">Filtros</h4>
                
                <form action="{{ route('grow.products') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="form-label text-white">Buscar</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request()->search }}" placeholder="Nome do produto...">
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label text-white">Categoria</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">Todas as categorias</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="priceRange" class="form-label text-white">Faixa de Preço</label>
                        <select class="form-select" id="priceRange" name="price_range">
                            <option value="">Todos os preços</option>
                            <option value="0-100" {{ request()->price_range == '0-100' ? 'selected' : '' }}>Até R$ 100</option>
                            <option value="100-300" {{ request()->price_range == '100-300' ? 'selected' : '' }}>R$ 100 - R$ 300</option>
                            <option value="300-500" {{ request()->price_range == '300-500' ? 'selected' : '' }}>R$ 300 - R$ 500</option>
                            <option value="500-1000" {{ request()->price_range == '500-1000' ? 'selected' : '' }}>R$ 500 - R$ 1000</option>
                            <option value="1000+" {{ request()->price_range == '1000+' ? 'selected' : '' }}>Acima de R$ 1000</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sort" class="form-label text-white">Ordenar por</label>
                        <select class="form-select" id="sort" name="sort">
                            <option value="">Mais relevantes</option>
                            <option value="price_asc" {{ request()->sort == 'price_asc' ? 'selected' : '' }}>Menor preço</option>
                            <option value="price_desc" {{ request()->sort == 'price_desc' ? 'selected' : '' }}>Maior preço</option>
                            <option value="newest" {{ request()->sort == 'newest' ? 'selected' : '' }}>Mais recentes</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-custom-primary w-100">Aplicar Filtros</button>
                    
                    @if(request()->has('search') || request()->has('category') || request()->has('price_range') || request()->has('sort'))
                        <a href="{{ route('grow.products') }}" class="btn btn-custom-outline w-100 mt-2">Limpar Filtros</a>
                    @endif
                </form>
            </div>
        </div>
        
        <div class="col-lg-9">
            @if(isset($categoryName))
                <h2 class="section-title mb-4">{{ $categoryName }}</h2>
            @endif
            
            <ul class="nav category-tabs" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ !request()->has('category') ? 'active' : '' }}" href="{{ route('grow.products') }}">Todos</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ request()->category == $category->id ? 'active' : '' }}" href="{{ route('grow.products', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            
            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="product-card">
                                @if($product->is_popular)
                                    <div class="product-badge">Popular</div>
                                @endif
                                
                                @if($product->discount > 0)
                                    <div class="product-discount">-{{ $product->discount }}%</div>
                                @endif
                                
                                <div class="product-image">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                    @else
                                        <div class="d-flex justify-content-center align-items-center w-100 h-100">
                                            <span class="text-secondary">Sem Imagem</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="product-info">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                                    
                                    @if($product->discount > 0)
                                        <div>
                                            <span class="product-old-price">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                            <span class="product-price">R$ {{ number_format($product->price * (1 - $product->discount/100), 2, ',', '.') }}</span>
                                        </div>
                                    @else
                                        <span class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                    @endif
                                    
                                    <div class="product-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $product->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @elseif($i - 0.5 <= $product->rating)
                                                <i class="bi bi-star-half"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1 text-white-50">({{ $product->reviews_count ?? 0 }})</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('grow.product.detail', $product->id) }}" class="btn btn-custom-outline btn-sm">Ver Detalhes</a>
                                        <form action="{{ route('grow.cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-custom-primary btn-sm">
                                                <i class="bi bi-cart-plus"></i> Adicionar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-dark">
                            Nenhum produto encontrado com os filtros selecionados.
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 
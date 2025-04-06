@extends('grow.layouts.app')

@section('title', $product->name)

@section('extra_css')
<style>
    .product-image-container {
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--card-bg);
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--card-border);
    }
    
    .product-details {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--card-border);
    }
    
    .product-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .product-features {
        list-style: none;
        padding-left: 0;
    }
    
    .product-features li {
        padding: 8px 0;
        border-bottom: 1px solid var(--card-border);
    }
    
    .product-features li:last-child {
        border-bottom: none;
    }
    
    .product-features i {
        color: var(--primary-color);
        margin-right: 10px;
    }
    
    .quantity-selector {
        width: 120px;
        background-color: var(--card-highlight);
        border: 1px solid var(--card-border);
        color: var(--text-color);
    }
    
    .product-tab-content {
        padding: 30px;
        background-color: var(--card-bg);
        border-radius: 0 0 8px 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--card-border);
        border-top: none;
    }
    
    .nav-tabs {
        border-bottom: 1px solid var(--card-border);
    }
    
    .nav-tabs .nav-link {
        color: var(--text-color);
        border: none;
        padding: 15px 20px;
        font-weight: 500;
        background-color: transparent;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom: 3px solid var(--primary-color);
        background-color: transparent;
    }
    
    .card-img-container {
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--card-border);
    }
    
    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: var(--primary-color);
    }
    
    .breadcrumb-item.active {
        color: var(--text-color);
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
    
    .page-banner {
        position: relative;
        overflow: hidden;
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
@endsection

@section('content')
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('grow.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grow.products') }}">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        <h1 class="mb-0">{{ $product->name }}</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="product-image-container">
                @if($product->image)
                    <img src="{{ '/storage/'.$product->image }}" class="img-fluid" alt="{{ $product->name }}">
                @else
                    <div class="d-flex justify-content-center align-items-center w-100 h-100">
                        <span class="text-secondary" style="font-size: 24px;">Sem Imagem</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="product-details">
                <h2 class="mb-3">{{ $product->name }}</h2>
                <p class="product-price mb-3">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <div class="mb-4">
                    <p class="mb-3">{{ $product->description }}</p>
                    
                    <ul class="product-features mt-4">
                        @if(isset($product->type) && $product->type && is_object($product->type))
                            <li><i class="bi bi-check-circle"></i> <strong>Categoria:</strong> {{ $product->type->name }}</li>
                        @elseif(isset($product->type) && $product->type)
                            <li><i class="bi bi-check-circle"></i> <strong>Categoria:</strong> {{ $product->type }}</li>
                        @endif
                        <li><i class="bi bi-check-circle"></i> <strong>Tamanho:</strong> Customizável conforme espaço disponível</li>
                        <li><i class="bi bi-check-circle"></i> <strong>Material:</strong> MDF de alta qualidade com acabamento premium</li>
                        <li><i class="bi bi-check-circle"></i> <strong>Isolamento:</strong> Térmico e acústico integrado</li>
                        <li><i class="bi bi-check-circle"></i> <strong>Sistema elétrico:</strong> Instalação segura e discreta</li>
                    </ul>
                </div>
                
                <form action="{{ route('grow.cart.add') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row g-3 align-items-center mb-4">
                        <div class="col-auto">
                            <label for="quantity" class="col-form-label">Quantidade:</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" id="quantity" name="quantity" class="form-control quantity-selector" value="1" min="1">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom-primary">Adicionar ao Carrinho</button>
                    </div>
                </form>
                
                <div class="mt-4 pt-3 border-top" style="border-color: var(--card-border) !important;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-shield-check fs-5 me-2 text-success"></i>
                        <span>Garantia de 1 ano</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-truck fs-5 me-2 text-success"></i>
                        <span>Entrega discreta em todo o Brasil</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-credit-card fs-5 me-2 text-success"></i>
                        <span>Pagamento seguro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Detalhes Técnicos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="installation-tab" data-bs-toggle="tab" data-bs-target="#installation" type="button" role="tab" aria-controls="installation" aria-selected="false">Instalação</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="maintenance-tab" data-bs-toggle="tab" data-bs-target="#maintenance" type="button" role="tab" aria-controls="maintenance" aria-selected="false">Manutenção</button>
                </li>
            </ul>
            <div class="tab-content product-tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h4 class="mb-3">Especificações Técnicas</h4>
                    <p>Nosso {{ strtolower($product->name) }} é projetado com os mais altos padrões de qualidade e discrição, oferecendo uma solução ideal para cultivadores que valorizam tanto a funcionalidade quanto a estética.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Características do Exterior</h5>
                            <ul>
                                <li>Aparência de móvel convencional</li>
                                <li>Material: MDF de alta densidade com acabamento premium</li>
                                <li>Sistema de vedação e isolamento otimizado</li>
                                <li>Hardware discreto e abertura silenciosa</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Características do Interior</h5>
                            <ul>
                                <li>Revestimento reflexivo para maximizar a iluminação</li>
                                <li>Sistema de ventilação silencioso e eficiente</li>
                                <li>Pré-instalação para sistema elétrico e irrigação</li>
                                <li>Otimização do espaço interno para máximo rendimento</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <i class="bi bi-info-circle me-2"></i> Todas as especificações podem ser personalizadas conforme necessidades específicas. Entre em contato para discutir opções adicionais.
                    </div>
                </div>
                <div class="tab-pane fade" id="installation" role="tabpanel" aria-labelledby="installation-tab">
                    <h4 class="mb-3">Guia de Instalação</h4>
                    <p>A instalação do seu {{ strtolower($product->name) }} é simples e pode ser realizada seguindo as etapas abaixo:</p>
                    
                    <ol class="mt-3">
                        <li class="mb-2">Escolha um local adequado em sua residência, preferencialmente com bom acesso ao circuito elétrico.</li>
                        <li class="mb-2">Posicione o móvel na posição desejada, garantindo que haja pelo menos 5cm de espaço em todos os lados para ventilação.</li>
                        <li class="mb-2">Conecte o sistema elétrico à tomada mais próxima, utilizando o protetor de surto incluído.</li>
                        <li class="mb-2">Ajuste os componentes internos conforme suas necessidades específicas de cultivo.</li>
                        <li class="mb-2">Faça um teste completo de funcionamento antes de iniciar o uso.</li>
                    </ol>
                    
                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle me-2"></i> Recomendamos que a instalação elétrica seja realizada por um profissional qualificado para garantir segurança.
                    </div>
                </div>
                <div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">
                    <h4 class="mb-3">Manutenção e Cuidados</h4>
                    <p>Para garantir o funcionamento ideal e a longevidade do seu {{ strtolower($product->name) }}, recomendamos seguir estas diretrizes de manutenção:</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Manutenção Mensal</h5>
                            <ul>
                                <li>Limpe os filtros de ar</li>
                                <li>Verifique o sistema de ventilação</li>
                                <li>Inspecione as conexões elétricas</li>
                                <li>Limpe superfícies internas com produto adequado</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Manutenção Semestral</h5>
                            <ul>
                                <li>Verifique a vedação das portas e janelas</li>
                                <li>Limpe profundamente o interior</li>
                                <li>Substitua filtros de ar se necessário</li>
                                <li>Revise todas as conexões e componentes</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-success mt-4">
                        <i class="bi bi-lightbulb me-2"></i> Dica: Manter um ambiente limpo e organizado não apenas prolonga a vida útil do seu equipamento, mas também contribui para resultados melhores no cultivo.
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($relatedProducts) > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="section-title">Produtos Relacionados</h3>
            </div>
            @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3">
                    <div class="card product-card h-100">
                        <div class="card-img-container">
                            @if($relatedProduct->image)
                                <img src="{{ '/storage/'.$relatedProduct->image }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                            @else
                                <div class="d-flex justify-content-center align-items-center w-100 h-100">
                                    <span class="text-secondary" style="font-size: 18px;">Sem Imagem</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-muted mb-3">{{ \Str::limit($relatedProduct->description, 60) }}</p>
                            <div class="mt-auto">
                                <p class="card-text fw-bold">R$ {{ number_format($relatedProduct->price, 2, ',', '.') }}</p>
                                <a href="{{ route('grow.product.detail', $relatedProduct->id) }}" class="btn btn-custom-primary w-100">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 
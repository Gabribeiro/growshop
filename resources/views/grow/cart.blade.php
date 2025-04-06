@extends('grow.layouts.app')

@section('title', 'Carrinho de Compras')

@section('extra_css')
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
    
    .cart-table {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
    }
    
    .cart-table th {
        background-color: rgba(0, 177, 64, 0.1);
        color: #fff;
        border-bottom: 1px solid var(--card-border);
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }
    
    .cart-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid var(--card-border);
        color: #fff;
        font-weight: 500;
    }
    
    .cart-product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        background-color: var(--card-highlight);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .cart-summary {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 25px;
    }
    
    .cart-summary-title {
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
    
    .cart-summary-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .cart-item-remove {
        color: #ff3b30;
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .cart-item-remove:hover {
        color: #ff6b6b;
        transform: scale(1.1);
    }
    
    .btn-update-cart {
        background-color: var(--card-highlight);
        color: #fff;
        border: 1px solid var(--primary-color);
        transition: all 0.3s;
    }
    
    .btn-update-cart:hover {
        background-color: var(--primary-color);
        color: white;
    }
    
    .quantity-selector {
        width: 80px;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--card-border);
        color: #fff;
        padding: 8px;
    }
    
    .empty-cart {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 50px 30px;
        text-align: center;
    }
    
    .empty-cart i {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Carrinho de Compras</h1>
    </div>
</div>

<div class="container py-5">
    @if(isset($cart) && $cart && count($cart) > 0)
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $item)
                                @php 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="cart-product-img me-3">
                                                @if(isset($item['image']) && $item['image'])
                                                    <img src="{{ '/storage/'.$item['image'] }}" alt="{{ $item['name'] }}" class="img-fluid">
                                                @else
                                                    <span class="text-secondary">Sem Imagem</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('grow.cart.update') }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control quantity-selector me-2">
                                            <button type="submit" class="btn btn-sm btn-update-cart"><i class="bi bi-arrow-repeat"></i></button>
                                        </form>
                                    </td>
                                    <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('grow.cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <button type="submit" class="cart-item-remove"><i class="bi bi-x-circle"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="cart-summary-title">Resumo do Pedido</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Frete</span>
                        <span>Calculado no checkout</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pt-3 border-top" style="border-color: var(--card-border) !important;">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-success">R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('grow.checkout') }}" class="btn btn-custom-primary">Finalizar Compra</a>
                        <a href="{{ route('grow.products') }}" class="btn btn-outline-secondary">Continuar Comprando</a>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-shield-check fs-5 me-2 text-success"></i>
                            <span>Pagamento 100% seguro</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-truck fs-5 me-2 text-success"></i>
                            <span>Entrega discreta garantida</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <h3 class="mb-3">Seu carrinho está vazio</h3>
            <p class="mb-4">Adicione produtos para começar suas compras</p>
            <a href="{{ route('grow.products') }}" class="btn btn-custom-primary">Ver Produtos</a>
        </div>
    @endif
</div>
@endsection 
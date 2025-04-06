@extends('grow.layouts.app')

@section('title', 'Pedido Confirmado')

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
    
    .order-confirmation-container {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 40px;
    }
    
    .order-confirmation-icon {
        font-size: 4rem;
        color: var(--green-neon);
        margin-bottom: 20px;
        text-shadow: var(--green-glow);
    }
    
    .order-number {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 30px;
        background-color: rgba(0, 177, 64, 0.1);
        padding: 10px 20px;
        border-radius: 5px;
        display: inline-block;
    }
    
    .order-section {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid var(--card-border);
    }
    
    .order-section-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-color);
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    
    .order-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .order-product {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--card-border);
    }
    
    .order-product:last-child {
        border-bottom: none;
    }
    
    .order-product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 20px;
    }
    
    .order-product-details {
        flex-grow: 1;
    }
    
    .order-product-price {
        font-weight: 600;
        color: var(--text-color);
        text-align: right;
    }
    
    .order-summary-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
    }
    
    .order-total {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-color);
    }
    
    .note-box {
        background-color: rgba(0, 177, 64, 0.1);
        border: 1px solid var(--primary-color);
        padding: 20px;
        border-radius: 5px;
        margin-top: 30px;
    }
    
    .shipping-address {
        background-color: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }
    
    .action-buttons {
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
</style>
@endsection

@section('content')
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Pedido Confirmado</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="order-confirmation-container">
                <div class="row align-items-center mb-4">
                    <div class="col-md-auto text-center text-md-start mb-3 mb-md-0">
                        <i class="bi bi-check-circle-fill order-confirmation-icon"></i>
                    </div>
                    <div class="col text-center text-md-start">
                        <h2 class="mb-1">Obrigado pela sua compra!</h2>
                        <p class="lead mb-0">Seu pedido foi recebido e está sendo processado.</p>
                    </div>
                    <div class="col-md-auto mt-3 mt-md-0 text-center text-md-end">
                        <div class="order-number">
                            <i class="bi bi-receipt me-2"></i> Pedido: <strong>
                                @php
                                    // Extrair o número do pedido do campo status (formato: 'Pendente | GRW-xxxxxxxx')
                                    $orderParts = explode('|', $order->status);
                                    $orderNumber = isset($orderParts[1]) ? trim($orderParts[1]) : $order->id;
                                @endphp
                                {{ $orderNumber }}
                            </strong>
                        </div>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
                @endif
                
                <div class="row">
                    <!-- Informações de Envio e Pagamento -->
                    <div class="col-lg-4 order-lg-2 mb-4">
                        <div class="card bg-dark border-secondary mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Total do Pedido</h5>
                                
                                <div class="order-summary-item">
                                    <span>Subtotal:</span>
                                    <span>R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
                                </div>
                                
                                <div class="order-summary-item">
                                    <span>Frete:</span>
                                    <span>R$ 0,00</span>
                                </div>
                                
                                <div class="order-summary-item order-total">
                                    <span>Total:</span>
                                    <span>R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="shipping-address mb-4">
                            <h5 class="mb-3"><i class="bi bi-geo-alt me-2"></i>Endereço de Entrega</h5>
                            @php
                                $address = json_decode($order->shipping_address, true);
                            @endphp
                            
                            <p class="mb-1">{{ $address['name'] }}</p>
                            <p class="mb-1">{{ $address['address'] }}</p>
                            @if(isset($address['complement']) && $address['complement'])
                                <p class="mb-1">{{ $address['complement'] }}</p>
                            @endif
                            <p class="mb-1">
                                {{ $address['city'] }} - {{ $address['state'] }}
                            </p>
                            <p class="mb-0">CEP: {{ $address['postalCode'] }}</p>
                        </div>
                        
                        <div class="note-box">
                            <h5 class="mb-3"><i class="bi bi-credit-card me-2"></i>Pagamento</h5>
                            <p class="mb-0">
                                @if($order->payment_method == 'stripe')
                                    <span class="badge bg-success me-2">Confirmado</span> Pagamento com cartão de crédito processado com sucesso via Stripe.
                                @elseif($order->payment_method == 'pix')
                                    <span class="badge bg-warning text-dark me-2">Pendente</span> Aguardando confirmação do pagamento via PIX.
                                @elseif($order->payment_method == 'boleto')
                                    <span class="badge bg-warning text-dark me-2">Pendente</span> Aguardando confirmação do pagamento via Boleto Bancário.
                                @else
                                    Forma de pagamento: {{ $order->payment_method }}
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Lista de Produtos -->
                    <div class="col-lg-8 order-lg-1">
                        <div class="order-section">
                            <h3 class="order-section-title mb-4">Itens do Pedido</h3>
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-dark">
                                    <thead>
                                        <tr class="border-bottom border-secondary">
                                            <th scope="col" style="width: 80px"></th>
                                            <th scope="col" class="text-white">Produto</th>
                                            <th scope="col" class="text-center text-white">Qtd</th>
                                            <th scope="col" class="text-end text-white">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $product)
                                            @php 
                                                $subtotal = $product->pivot->price * $product->pivot->quantity;
                                                // Se o preço for zero, tenta recuperar o preço atual do produto
                                                if ($subtotal == 0 && $product->price > 0) {
                                                    $subtotal = $product->price * $product->pivot->quantity;
                                                }
                                            @endphp
                                            <tr class="border-bottom border-secondary">
                                                <td>
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-black rounded d-flex justify-content-center text-center align-items-center" style="width: 60px; height: 60px;">
                                                            <span class="text-light" style="font-size: 10px;">Sem Imagem</span>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-white">
                                                    <h6 class="mb-1 text-white">{{ $product->name }}</h6>
                                                    @if($product->pivot->color)
                                                        <small class="text-light">Cor: {{ $product->pivot->color }}</small>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle text-white">{{ $product->pivot->quantity }}</td>
                                                <td class="text-end align-middle fw-bold text-white">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-5">
                    <div class="action-buttons justify-content-center">
                        <a href="{{ route('grow.home') }}" class="btn btn-success">
                            <i class="bi bi-house me-2"></i> Voltar para a Loja
                        </a>
                        
                        @if(Auth::check())
                        <a href="{{ route('grow.orders') }}" class="btn btn-outline-success">
                            <i class="bi bi-list-ul me-2"></i> Meus Pedidos
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
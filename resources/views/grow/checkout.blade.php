@extends('grow.layouts.app')

@section('title', 'Finalizar Compra')

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
    
    .checkout-section {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .checkout-section-title {
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
    
    .checkout-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .order-summary {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 25px;
    }
    
    .order-summary-title {
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
    
    .order-summary-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background-color: var(--green-neon);
        box-shadow: var(--green-glow);
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--card-border);
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--card-border);
        color: #fff;
        padding: 12px;
    }
    
    .form-label {
        color: var(--text-color);
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .payment-method {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid var(--card-border);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .payment-method:hover, .payment-method.active {
        background-color: rgba(0, 177, 64, 0.1);
        border-color: var(--primary-color);
    }
    
    .payment-method-radio {
        margin-right: 15px;
    }
    
    .payment-method-icon {
        font-size: 1.5rem;
        margin-right: 15px;
        color: var(--primary-color);
    }
    
    .payment-description {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .text-muted {
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>
@endsection

@section('content')
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Finalizar Compra</h1>
    </div>
</div>

<div class="container py-5">
    <form action="{{ route('grow.cart') }}" method="POST" id="checkout-form">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-section mb-4">
                    <h4 class="checkout-section-title">Informações Pessoais</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                </div>
                
                <div class="checkout-section mb-4">
                    <h4 class="checkout-section-title">Endereço de Entrega</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" required>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col-md-4">
                            <label for="number" class="form-label">Número</label>
                            <input type="text" class="form-control" id="number" name="number" required>
                        </div>
                        <div class="col-md-8">
                            <label for="complement" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complement" name="complement">
                        </div>
                        <div class="col-md-4">
                            <label for="neighborhood" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">Estado</label>
                            <select class="form-select" id="state" name="state" required>
                                <option value="">Selecione...</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="checkout-section">
                    <h4 class="checkout-section-title">Método de Pagamento</h4>
                    <div class="payment-methods">
                        <div class="payment-method active">
                            <input type="radio" name="payment_method" id="payment_pix" value="pix" class="payment-method-radio" checked>
                            <i class="bi bi-qr-code payment-method-icon"></i>
                            <div>
                                <h6 class="mb-1">PIX</h6>
                                <p class="mb-0 payment-description">Pagamento instantâneo</p>
                            </div>
                        </div>
                        
                        <div class="payment-method">
                            <input type="radio" name="payment_method" id="payment_credit" value="credit" class="payment-method-radio">
                            <i class="bi bi-credit-card payment-method-icon"></i>
                            <div>
                                <h6 class="mb-1">Cartão de Crédito</h6>
                                <p class="mb-0 payment-description">Visa, Mastercard, Elo, American Express</p>
                            </div>
                        </div>
                        
                        <div class="payment-method">
                            <input type="radio" name="payment_method" id="payment_boleto" value="boleto" class="payment-method-radio">
                            <i class="bi bi-upc payment-method-icon"></i>
                            <div>
                                <h6 class="mb-1">Boleto Bancário</h6>
                                <p class="mb-0 payment-description">O pedido será enviado após confirmação do pagamento</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="order-summary">
                    <h4 class="order-summary-title">Resumo do Pedido</h4>
                    
                    @php $total = 0; @endphp
                    
                    @foreach($cart as $item)
                        @php 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <div class="order-item">
                            <div>
                                <span>{{ $item['name'] }}</span>
                                <small class="d-block text-muted">Quantidade: {{ $item['quantity'] }}</small>
                            </div>
                            <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                        </div>
                    @endforeach
                    
                    <div class="order-item">
                        <span>Subtotal</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    
                    <div class="order-item">
                        <span>Frete</span>
                        <span>R$ 0,00</span>
                    </div>
                    
                    <div class="order-item">
                        <strong>Total</strong>
                        <strong class="text-success">R$ {{ number_format($total, 2, ',', '.') }}</strong>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-custom-primary">Finalizar Pedido</button>
                        <a href="{{ route('grow.cart') }}" class="btn btn-outline-secondary">Voltar ao Carrinho</a>
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
    </form>
</div>
@endsection

@section('extra_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecionar métodos de pagamento
        const paymentMethods = document.querySelectorAll('.payment-method');
        
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                // Remover classe active de todos
                paymentMethods.forEach(m => m.classList.remove('active'));
                
                // Adicionar classe active ao selecionado
                this.classList.add('active');
                
                // Selecionar o radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });
    });
</script>
@endsection 
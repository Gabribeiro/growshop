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
    
    /* Estilos para o seletor de endereços */
    .address-select-card {
        background-color: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        cursor: pointer;
    }
    
    .address-select-card:hover {
        background-color: rgba(0, 177, 64, 0.1);
    }
    
    .address-select-card .form-check-input {
        margin-top: 0.2rem;
    }
    
    .address-select-card .form-check-label {
        cursor: pointer;
    }
    
    .address-select-card.border-success {
        border-width: 2px !important;
        background-color: rgba(0, 177, 64, 0.05);
    }
    
    .address-select-card input:checked + label {
        font-weight: 500;
        color: var(--primary-color);
    }
    
    #manual-address-section {
        padding-top: 20px;
        border-top: 1px dashed var(--card-border);
        margin-top: 20px;
    }
    
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
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
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $userData['first_name'] ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $userData['last_name'] ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $userData['email'] ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $userAddress->phone ?? '' }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="checkout-section mb-4">
                    <h4 class="checkout-section-title">Endereço de Entrega</h4>
                    
                    @if(Auth::check() && isset($userAddresses) && count($userAddresses) > 0)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label mb-0">Selecione um endereço cadastrado</label>
                                <a href="/conta/enderecos/{{ Auth::user()->id }}" class="text-success">
                                    <i class="bi bi-pencil-square me-1"></i>Gerenciar endereços
                                </a>
                            </div>
                            
                            <div class="row">
                                @foreach($userAddresses as $address)
                                <div class="col-md-6 mb-3">
                                    <div class="form-check address-select-card p-3 border rounded {{ $address->default ? 'border-success' : 'border-secondary' }}">
                                        <input class="form-check-input address-selector" 
                                               type="radio" 
                                               name="address_id" 
                                               id="address_{{ $address->id }}" 
                                               value="{{ $address->id }}"
                                               data-phone="{{ $address->phone }}"
                                               data-postal="{{ $address->postal }}"
                                               data-address1="{{ $address->address1 }}"
                                               data-address2="{{ $address->address2 }}"
                                               data-city="{{ $address->city }}"
                                               data-country="{{ $address->country }}"
                                               {{ $address->default ? 'checked' : '' }}>
                                        <label class="form-check-label d-block ms-2" for="address_{{ $address->id }}">
                                            <strong>{{ $address->company }}</strong>
                                            <span class="d-block text-truncate">{{ $address->address1 }}</span>
                                            <span class="d-block text-truncate">{{ $address->city }}, {{ $address->country }}</span>
                                            <span class="d-block text-truncate">CEP: {{ $address->postal }}</span>
                                            @if($address->default)
                                                <span class="badge bg-success mt-1">Endereço Padrão</span>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="use_new_address" name="use_new_address">
                                <label class="form-check-label" for="use_new_address">
                                    Usar outro endereço
                                </label>
                            </div>
                        </div>
                        
                        <div id="manual-address-section" class="manual-address" style="display: none;">
                    @endif
                    
                    <div class="row g-3 {{ Auth::check() && isset($userAddresses) && count($userAddresses) > 0 ? 'manual-address' : '' }}" id="address-fields">
                        <div class="col-md-6">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" value="{{ $userAddress->postal ?? '' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $userAddress->address1 ?? '' }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="number" class="form-label">Número</label>
                            <input type="text" class="form-control" id="number" name="number" required>
                        </div>
                        <div class="col-md-8">
                            <label for="complement" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complement" name="complement" value="{{ $userAddress->address2 ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="neighborhood" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $userAddress->city ?? '' }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">Estado</label>
                            <select class="form-select" id="state" name="state" required>
                                <option value="">Selecione...</option>
                                <option value="AC" {{ isset($userAddress->country) && $userAddress->country == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ isset($userAddress->country) && $userAddress->country == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ isset($userAddress->country) && $userAddress->country == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ isset($userAddress->country) && $userAddress->country == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ isset($userAddress->country) && $userAddress->country == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ isset($userAddress->country) && $userAddress->country == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ isset($userAddress->country) && $userAddress->country == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ isset($userAddress->country) && $userAddress->country == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ isset($userAddress->country) && $userAddress->country == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ isset($userAddress->country) && $userAddress->country == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ isset($userAddress->country) && $userAddress->country == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ isset($userAddress->country) && $userAddress->country == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ isset($userAddress->country) && $userAddress->country == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ isset($userAddress->country) && $userAddress->country == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ isset($userAddress->country) && $userAddress->country == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ isset($userAddress->country) && $userAddress->country == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ isset($userAddress->country) && $userAddress->country == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ isset($userAddress->country) && $userAddress->country == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ isset($userAddress->country) && $userAddress->country == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ isset($userAddress->country) && $userAddress->country == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ isset($userAddress->country) && $userAddress->country == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ isset($userAddress->country) && $userAddress->country == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ isset($userAddress->country) && $userAddress->country == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ isset($userAddress->country) && $userAddress->country == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ isset($userAddress->country) && $userAddress->country == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ isset($userAddress->country) && $userAddress->country == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ isset($userAddress->country) && $userAddress->country == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>
                    </div>
                    
                    @if(Auth::check() && isset($userAddresses) && count($userAddresses) > 0)
                        </div>
                    @endif
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
        
        // Gerenciamento de endereços
        const useNewAddressCheckbox = document.getElementById('use_new_address');
        const manualAddressSection = document.getElementById('manual-address-section');
        const addressSelectors = document.querySelectorAll('.address-selector');
        
        // Função para preencher os campos com os dados do endereço selecionado
        function fillAddressFields(addressData) {
            document.getElementById('phone').value = addressData.phone;
            document.getElementById('cep').value = addressData.postal;
            document.getElementById('address').value = addressData.address1;
            document.getElementById('complement').value = addressData.address2 || '';
            document.getElementById('city').value = addressData.city;
            
            // Selecionar o estado no dropdown
            const stateSelect = document.getElementById('state');
            for (let i = 0; i < stateSelect.options.length; i++) {
                if (stateSelect.options[i].value === addressData.country) {
                    stateSelect.selectedIndex = i;
                    break;
                }
            }
        }
        
        // Inicializar com o endereço padrão selecionado
        if (addressSelectors.length > 0) {
            const defaultAddress = Array.from(addressSelectors).find(selector => selector.checked);
            if (defaultAddress) {
                const addressData = {
                    phone: defaultAddress.dataset.phone,
                    postal: defaultAddress.dataset.postal,
                    address1: defaultAddress.dataset.address1,
                    address2: defaultAddress.dataset.address2,
                    city: defaultAddress.dataset.city,
                    country: defaultAddress.dataset.country
                };
                fillAddressFields(addressData);
            }
        }
        
        // Alternar visibilidade da seção de endereço manual
        if (useNewAddressCheckbox) {
            useNewAddressCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    manualAddressSection.style.display = 'block';
                    
                    // Limpar os campos quando optar por usar outro endereço
                    document.getElementById('cep').value = '';
                    document.getElementById('address').value = '';
                    document.getElementById('complement').value = '';
                    document.getElementById('city').value = '';
                    document.getElementById('state').selectedIndex = 0;
                    document.getElementById('number').value = '';
                    document.getElementById('neighborhood').value = '';
                } else {
                    manualAddressSection.style.display = 'none';
                    
                    // Reselecionar o endereço padrão
                    const defaultAddress = Array.from(addressSelectors).find(selector => selector.hasAttribute('checked'));
                    if (defaultAddress) {
                        defaultAddress.checked = true;
                        const addressData = {
                            phone: defaultAddress.dataset.phone,
                            postal: defaultAddress.dataset.postal,
                            address1: defaultAddress.dataset.address1,
                            address2: defaultAddress.dataset.address2,
                            city: defaultAddress.dataset.city,
                            country: defaultAddress.dataset.country
                        };
                        fillAddressFields(addressData);
                    }
                }
            });
        }
        
        // Atualizar campos quando um endereço é selecionado
        addressSelectors.forEach(selector => {
            selector.addEventListener('change', function() {
                if (this.checked) {
                    const addressData = {
                        phone: this.dataset.phone,
                        postal: this.dataset.postal,
                        address1: this.dataset.address1,
                        address2: this.dataset.address2,
                        city: this.dataset.city,
                        country: this.dataset.country
                    };
                    fillAddressFields(addressData);
                    
                    // Desmarcar a opção de usar outro endereço
                    if (useNewAddressCheckbox) {
                        useNewAddressCheckbox.checked = false;
                        manualAddressSection.style.display = 'none';
                    }
                }
            });
        });
    });
</script>
@endsection 
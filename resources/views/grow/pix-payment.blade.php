@extends('grow.layouts.app')

@section('title', 'Pagamento via PIX')

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
    
    .payment-container {
        background-color: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 40px;
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
    
    .pix-qrcode {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 30px;
        border-radius: 10px;
        max-width: 300px;
        margin: 0 auto 30px;
    }
    
    .pix-code {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 5px;
        font-family: monospace;
        margin-top: 20px;
        border: 1px dashed var(--card-border);
        position: relative;
    }
    
    .copy-btn {
        position: absolute;
        top: 8px;
        right: 10px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 3px;
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        cursor: pointer;
    }
    
    .instructions {
        margin-top: 40px;
        background-color: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: 5px;
        text-align: left;
    }
    
    .instructions ol {
        padding-left: 1.5rem;
    }
    
    .instructions li {
        margin-bottom: 10px;
    }
    
    .action-buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center;
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
        <h1 class="mb-0">Pagamento via PIX</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="payment-container text-center">
                <h2 class="mb-4">Finalize seu pagamento com PIX</h2>
                <p class="lead mb-4">Seu pedido foi registrado com sucesso! Para concluir, efetue o pagamento através do QR Code ou código PIX abaixo.</p>
                
                <div class="order-number">
                    <i class="bi bi-receipt me-2"></i> Número do Pedido: <strong>
                        @php
                            // Extrair o número do pedido do campo status (formato: 'Pendente | GRW-xxxxxxxx')
                            $orderParts = explode('|', $order->status);
                            $orderNumber = isset($orderParts[1]) ? trim($orderParts[1]) : $order->id;
                        @endphp
                        {{ $orderNumber }}
                    </strong>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="pix-qrcode">
                            <img src="{{ asset('img/qrcode-placeholder.png') }}" alt="QR Code PIX" class="img-fluid">
                        </div>
                        
                        <p>Escaneie o QR Code acima com o app do seu banco</p>
                    </div>
                    
                    <div class="col-lg-6">
                        <h4 class="mb-3">Ou copie o código PIX</h4>
                        <div class="pix-code">
                            <code>{{ $pixCode }}</code>
                            <button class="copy-btn" onclick="copyPixCode()">Copiar</button>
                        </div>
                        
                        <div class="instructions">
                            <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i> Como pagar com PIX:</h5>
                            <ol>
                                <li>Abra o aplicativo do seu banco</li>
                                <li>Acesse a área PIX ou pagamentos</li>
                                <li>Escolha a opção de pagar com QR Code ou colar código</li>
                                <li>Escaneie o QR Code ou cole o código PIX</li>
                                <li>Confirme os dados e finalize o pagamento</li>
                            </ol>
                            <p class="mt-3 mb-0">Após o pagamento, seu pedido será processado em até 15 minutos.</p>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="bi bi-clock-history me-2"></i> O QR Code é válido por 30 minutos. Após este período, será necessário gerar um novo código.
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('grow.order-confirmation', ['order' => $order->id]) }}" class="btn btn-custom-primary">
                        <i class="bi bi-receipt me-2"></i> Ver Detalhes do Pedido
                    </a>
                    
                    <a href="{{ route('grow.home') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-house me-2"></i> Voltar para a Loja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    function copyPixCode() {
        const pixCode = '{{ $pixCode }}';
        navigator.clipboard.writeText(pixCode).then(() => {
            const btn = document.querySelector('.copy-btn');
            btn.textContent = 'Copiado!';
            setTimeout(() => {
                btn.textContent = 'Copiar';
            }, 2000);
        }).catch(err => {
            console.error('Erro ao copiar: ', err);
        });
    }
</script>
@endsection 
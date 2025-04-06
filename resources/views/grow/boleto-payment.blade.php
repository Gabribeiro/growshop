@extends('grow.layouts.app')

@section('title', 'Pagamento via Boleto')

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
    
    .boleto-container {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .barcode-img {
        background-color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .boleto-code {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 5px;
        font-family: monospace;
        font-size: 18px;
        letter-spacing: 1px;
        word-break: break-all;
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
    
    .boleto-info {
        margin-top: 30px;
        background-color: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: 5px;
        text-align: left;
    }
    
    .boleto-info dl {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: 10px 20px;
    }
    
    .boleto-info dt {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .boleto-info dd {
        font-weight: 500;
        margin-bottom: 10px;
    }
    
    .action-buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .print-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid var(--card-border);
        color: white;
        border-radius: 5px;
        padding: 8px 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .print-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
@endsection

@section('content')
<div class="page-banner">
    <div class="diagonal-line"></div>
    <div class="diagonal-line2"></div>
    <div class="container">
        <h1 class="mb-0">Pagamento via Boleto</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="payment-container text-center">
                <h2 class="mb-4">Finalize seu pagamento com Boleto Bancário</h2>
                <p class="lead mb-4">Seu pedido foi registrado com sucesso! Para concluir, efetue o pagamento usando o boleto abaixo.</p>
                
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
                
                <div class="boleto-container position-relative">
                    <button class="print-btn" onclick="printBoleto()">
                        <i class="bi bi-printer"></i> Imprimir
                    </button>
                    
                    <div class="barcode-img">
                        <img src="{{ asset('img/barcode-placeholder.png') }}" alt="Código de Barras do Boleto" class="img-fluid">
                    </div>
                    
                    <h4 class="mb-3">Código do Boleto</h4>
                    <div class="boleto-code">
                        <code>{{ $boletoCode }}</code>
                        <button class="copy-btn" onclick="copyBoletoCode()">Copiar</button>
                    </div>
                    
                    <div class="boleto-info">
                        <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i> Informações do Boleto:</h5>
                        <dl>
                            <dt>Beneficiário:</dt>
                            <dd>Potiguara Grow Ltda</dd>
                            
                            <dt>CNPJ:</dt>
                            <dd>12.345.678/0001-90</dd>
                            
                            <dt>Valor:</dt>
                            <dd>R$ {{ number_format($order->total_price, 2, ',', '.') }}</dd>
                            
                            <dt>Vencimento:</dt>
                            <dd>{{ \Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}</dd>
                        </dl>
                    </div>
                </div>
                
                <div class="alert alert-warning mt-4">
                    <i class="bi bi-exclamation-triangle me-2"></i> O boleto tem vencimento de 3 dias úteis. Após o vencimento, será necessário gerar um novo boleto.
                </div>
                
                <div class="alert alert-info mt-3">
                    <i class="bi bi-clock-history me-2"></i> Após o pagamento, a compensação bancária pode levar até 3 dias úteis.
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
    function copyBoletoCode() {
        const boletoCode = '{{ $boletoCode }}';
        navigator.clipboard.writeText(boletoCode).then(() => {
            const btn = document.querySelector('.copy-btn');
            btn.textContent = 'Copiado!';
            setTimeout(() => {
                btn.textContent = 'Copiar';
            }, 2000);
        }).catch(err => {
            console.error('Erro ao copiar: ', err);
        });
    }
    
    function printBoleto() {
        window.print();
    }
</script>
@endsection 
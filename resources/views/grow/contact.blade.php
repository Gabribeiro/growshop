@extends('grow.layouts.app')

@section('title', 'Contato')

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
    
    .page-banner-content {
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
    
    .page-banner p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        max-width: 700px;
    }
    
    .contact-section {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    
    .contact-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-right: 15px;
        min-width: 30px;
        text-align: center;
    }
    
    .form-control {
        background-color: var(--input-bg);
        border: 1px solid var(--input-border);
        color: var(--text-color);
    }
    
    .form-control:focus {
        background-color: var(--input-bg-focus);
        color: var(--text-color);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }
    
    .section-title {
        position: relative;
        margin-bottom: 30px;
        padding-bottom: 15px;
        color: var(--text-color);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
    }
    
    .map-container {
        height: 300px;
        background-color: var(--secondary-bg);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .social-links {
        display: flex;
        gap: 15px;
    }
    
    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    
    .social-links a:hover {
        background-color: var(--primary-color);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 177, 64, 0.3);
    }
</style>
@endsection

@section('content')
<div class="page-banner">
    <div class="container page-banner-content">
        <h1 class="mb-2">Contato</h1>
        <p class="lead mb-0">Entre em contato conosco</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="contact-section">
                <h2 class="section-title">Envie sua mensagem</h2>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <form action="{{ route('grow.contact.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Assunto</label>
                            <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject">
                                <option value="Dúvida sobre produtos" {{ old('subject') == 'Dúvida sobre produtos' ? 'selected' : '' }}>Dúvida sobre produtos</option>
                                <option value="Suporte técnico" {{ old('subject') == 'Suporte técnico' ? 'selected' : '' }}>Suporte técnico</option>
                                <option value="Informações de compra" {{ old('subject') == 'Informações de compra' ? 'selected' : '' }}>Informações de compra</option>
                                <option value="Outro" {{ old('subject') == 'Outro' ? 'selected' : '' }}>Outro</option>
                            </select>
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="message" class="form-label">Mensagem</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-custom-primary">Enviar Mensagem</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="contact-section">
                <h3 class="section-title">Informações de Contato</h3>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Endereço</h5>
                        <p class="mb-0">Rua Exemplo, 123<br>Bairro Centro, São Paulo/SP<br>CEP: 01234-567</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Telefone</h5>
                        <p class="mb-0">(11) 1234-5678<br>(11) 98765-4321</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0">contato@potiguaragrow.com<br>suporte@potiguaragrow.com</p>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Horário de Atendimento</h5>
                        <p class="mb-0">Segunda a Sexta: 9h às 18h<br>Sábado: 9h às 13h</p>
                    </div>
                </div>
                
                <h3 class="section-title mt-4">Redes Sociais</h3>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="contact-section">
                <h2 class="section-title">Localização</h2>
                <div class="map-container">
                    <span class="text-secondary">Mapa com Localização</span>
                </div>
                <p class="text-center">
                    Estamos localizados em uma região central e de fácil acesso. Venha nos visitar!
                </p>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="contact-section">
                <h2 class="section-title">Perguntas Frequentes</h2>
                
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                Vocês oferecem entrega em todo o Brasil?
                            </button>
                        </h2>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sim, realizamos entregas para todo o Brasil. O prazo de entrega varia de acordo com a região e é calculado no momento da finalização da compra. Todos os nossos produtos são enviados em embalagens discretas, sem qualquer identificação do conteúdo.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                Qual a garantia dos produtos?
                            </button>
                        </h2>
                        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Todos os nossos produtos possuem garantia mínima de 6 meses contra defeitos de fabricação. Alguns itens específicos podem ter garantia estendida conforme informado na página do produto. Em caso de problemas, entre em contato com nosso suporte técnico.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                Oferecem serviço de montagem?
                            </button>
                        </h2>
                        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sim, oferecemos serviço de montagem para clientes da região metropolitana de São Paulo mediante agendamento prévio. Para outras regiões, fornecemos manual detalhado de montagem e suporte técnico online para auxiliar durante o processo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
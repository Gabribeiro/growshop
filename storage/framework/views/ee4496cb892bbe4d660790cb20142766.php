<?php $__env->startSection('title', 'Sobre Nós'); ?>

<?php $__env->startSection('extra_css'); ?>
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
    
    .about-section {
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .timeline {
        position: relative;
        padding-left: 50px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 15px;
        height: 100%;
        width: 3px;
        background-color: var(--primary-color);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 1px dashed #ddd;
    }
    
    .timeline-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .timeline-dot {
        position: absolute;
        left: -50px;
        top: 5px;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .team-card {
        text-align: center;
        background-color: var(--card-bg);
        border-radius: 8px;
        padding: 30px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        height: 100%;
    }
    
    .team-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 0 auto 20px;
        overflow: hidden;
        background-color: var(--secondary-bg);
        display: flex;
        align-items: center;
        justify-content: center;
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
    
    .value-card {
        background-color: var(--card-bg);
        border-left: 4px solid var(--primary-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .value-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 15px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-banner">
    <div class="container page-banner-content">
        <h1 class="mb-2">Sobre Nós</h1>
        <p class="lead mb-0">Conheça nossa história e valores</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="about-section">
                <h2 class="section-title">Nossa História</h2>
                <p>Fundada em 2020, a <?php echo e(config('app.name')); ?> nasceu da visão de redesenhar móveis funcionais que integrassem perfeitamente tecnologia e discrição. Nossa equipe de designers e engenheiros especializados criou soluções que combinam estética sofisticada e funcionalidade prática.</p>
                
                <p>Acreditamos que o cultivo indoor deve ser acessível, discreto e eficiente. Por isso, desenvolvemos móveis que se integram harmoniosamente a qualquer ambiente residencial, sem comprometer a eficácia ou a qualidade dos equipamentos integrados.</p>
                
                <div class="timeline mt-5">
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h5>2020: O Início</h5>
                        <p>Fundação da empresa com foco em pesquisa e desenvolvimento de protótipos iniciais. Testes de materiais e tecnologias para garantir isolamento térmico e acústico ideal.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="bi bi-box"></i>
                        </div>
                        <h5>2021: Primeiros Produtos</h5>
                        <p>Lançamento da nossa primeira linha de móveis modulares. Desenvolvimento de sistemas integrados de cultivo com tecnologia de ponta e controle de ambiente.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>2022: Expansão</h5>
                        <p>Ampliação do catálogo de produtos e início das vendas online. Implementação do sistema "Monte Seu Grow" para atender às necessidades específicas de cada cliente.</p>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="bi bi-award"></i>
                        </div>
                        <h5>Hoje</h5>
                        <p>Referência no mercado de móveis funcionais, com milhares de clientes satisfeitos em todo o Brasil. Compromisso contínuo com inovação, qualidade e discrição.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="about-section">
                <h3 class="section-title">Nossa Missão</h3>
                <p>Proporcionar soluções de cultivo indoor que aliem discrição, funcionalidade e tecnologia, transformando a experiência dos cultivadores e promovendo práticas sustentáveis.</p>
                
                <h3 class="section-title mt-4">Nossa Visão</h3>
                <p>Ser reconhecida como a empresa líder em soluções inovadoras para cultivo indoor, estabelecendo novos padrões de qualidade e discrição no mercado brasileiro.</p>
                
                <div class="text-center mt-4">
                    <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo <?php echo e(config('app.name')); ?>" class="img-fluid" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="about-section">
                <h2 class="section-title">Nossos Valores</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4>Qualidade</h4>
                            <p>Compromisso com a excelência em todos os nossos produtos e serviços, utilizando materiais premium e tecnologias avançadas.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <h4>Inovação</h4>
                            <p>Busca constante por soluções criativas e eficientes, antecipando tendências e necessidades do mercado.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="bi bi-lock"></i>
                            </div>
                            <h4>Discrição</h4>
                            <p>Garantia de privacidade e segurança para nossos clientes, com produtos que se integram naturalmente aos ambientes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="about-section">
                <h2 class="section-title">Nossa Equipe</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="bi bi-person" style="font-size: 3rem;"></i>
                            </div>
                            <h4>Carlos Silva</h4>
                            <p class="text-muted">Fundador & CEO</p>
                            <p>Engenheiro com mais de 15 anos de experiência em desenvolvimento de produtos.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="bi bi-person" style="font-size: 3rem;"></i>
                            </div>
                            <h4>Marina Costa</h4>
                            <p class="text-muted">Diretora de Design</p>
                            <p>Designer de produto premiada, especialista em soluções funcionais e estéticas.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="bi bi-person" style="font-size: 3rem;"></i>
                            </div>
                            <h4>Pedro Alves</h4>
                            <p class="text-muted">Especialista em Cultivo</p>
                            <p>Biólogo com foco em cultivo indoor e otimização de ambientes controlados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('grow.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/grow/about.blade.php ENDPATH**/ ?>
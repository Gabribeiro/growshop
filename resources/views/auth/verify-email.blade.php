<x-layout>
    <div class="container py-5" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Verificação de Email</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="bi bi-envelope-check text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h4 class="text-center mb-3">Verifique seu endereço de email</h4>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Um email de verificação foi enviado para sua caixa de entrada. Por favor, verifique.
                        </div>
                        
                        <p class="text-center">
                            Se você não recebeu o email, clique no botão abaixo para solicitar outro.
                        </p>
                        
                        <form method="POST" action="{{ route('verification.send') }}" class="d-flex justify-content-center mb-4">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Reenviar Email de Verificação
                            </button>
                        </form>
                        
                        <div class="text-center">
                            <a href="/" class="btn btn-outline-secondary">Continuar Navegando</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

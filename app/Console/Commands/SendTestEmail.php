<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email : O endereço de e-mail para enviar o teste}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia um e-mail de teste para verificar a configuração SMTP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('Enviando e-mail de teste para: ' . $email);
        
        try {
            Mail::to($email)->send(new TestEmail());
            $this->info('E-mail enviado com sucesso!');
            $this->info('Verifique sua caixa de entrada para confirmar o recebimento.');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Erro ao enviar e-mail: ' . $e->getMessage());
            $this->line('');
            $this->line('Dicas para solução de problemas:');
            $this->line('1. Verifique se as configurações SMTP no arquivo .env estão corretas');
            $this->line('2. Se estiver usando Gmail, habilite o acesso a app menos seguros ou use senha de app');
            $this->line('3. Verifique se o firewall não está bloqueando a porta SMTP');
            
            return Command::FAILURE;
        }
    }
}

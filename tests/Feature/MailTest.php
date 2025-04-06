<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceivedNotification;

class MailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Teste para verificar se as configurações de e-mail estão corretas.
     */
    public function test_email_configuration(): void
    {
        // Verifica se o driver de e-mail está configurado corretamente
        $this->assertEquals('smtp', config('mail.default'));
        
        // Verifica se o host SMTP está configurado
        $this->assertEquals('smtp.gmail.com', config('mail.mailers.smtp.host'));
        
        // Verifica se a porta SMTP está configurada
        $this->assertEquals(587, config('mail.mailers.smtp.port'));
        
        // Verifica se a criptografia SMTP está configurada
        $this->assertEquals('tls', config('mail.mailers.smtp.encryption'));
    }
    
    /**
     * Teste para verificar o envio de e-mail.
     */
    public function test_email_sending(): void
    {
        // Intercepta o envio de e-mail
        Mail::fake();
        
        // Tenta enviar um e-mail
        Mail::to('teste@example.com')->send(new ContactReceivedNotification());
        
        // Verifica se o e-mail foi enviado
        Mail::assertSent(ContactReceivedNotification::class, function ($mail) {
            return $mail->hasTo('teste@example.com');
        });
    }
}

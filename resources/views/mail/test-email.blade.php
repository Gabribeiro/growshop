<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-mail de Teste</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Potiguara Grow</h1>
            <p>Teste de Configuração SMTP</p>
        </div>
        
        <div class="content">
            <p>Olá!</p>
            <p>Este é um e-mail de teste para verificar se a configuração SMTP está funcionando corretamente.</p>
            <p>Se você está recebendo este e-mail, significa que a configuração do servidor de e-mail foi realizada com sucesso!</p>
            <p>Agora você pode enviar e-mails através do seu aplicativo Laravel.</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Potiguara Grow. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html> 
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Bem-vindo(a)!</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background: #f5f6f8; color:#111827; margin:0; padding:24px; }
        .container { max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .hero { background: #0a2cff; color: #ffffff; text-align: center; padding: 24px 16px; font-weight: 800; font-size: 22px; }
        .content { padding: 28px; }
        .title { font-weight: 700; margin: 0 0 12px; font-size: 16px; }
        .p { margin: 0 0 12px; line-height: 1.6; font-size: 14px; color:#374151; }
        .footer { text-align: center; color:#9ca3af; font-size: 12px; padding: 14px; background: #f1f5f9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">Bem-vindo(a)!</div>
        <div class="content">
            <p class="title">Olá, {{ $employee->name }} 👋</p>
            <p class="p">Seja muito bem-vindo(a) à <strong>{{ $company->name }}</strong>!</p>
            <p class="p">Estamos muito felizes em ter você no time e esperamos que essa nova jornada seja incrível.</p>
            <p class="p">Conte conosco para o que precisar. 🚀</p>
        </div>
        <div class="footer">© {{ date('Y') }} {{ $company->name }} - Todos os direitos reservados.</div>
    </div>
</body>
</html>

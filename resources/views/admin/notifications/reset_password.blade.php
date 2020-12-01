@component('mail::message')
  Olá,

  Recebemos uma solicitação para redefinir a senha do seu painel administrativo {{ config('app.name') }}, que está associada a este endereço de e-mail. Clique no link abaixo para redefinir a senha usando nosso servidor seguro:

  @component('mail::button', ['url' => $url, 'color' => 'green'])
    Confirmação de nova senha
  @endcomponent

  Atenciosamente,<br>
  {{ config('app.name') }}
@endcomponent

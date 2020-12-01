@component('mail::message')
  # Olá, {{ $user->full_name }}

  Em nome de toda a equipe da {{ config('app.name') }} gostaríamos de te dar as boas-vindas!

  Acesse o painel administrativo e finalize o seu acesso.

  @component('mail::button', ['url' => $autologin, 'color' => 'green'])
    Painel Administrativo
  @endcomponent

  Atenciosamente,<br>
  {{ config('app.name') }}
@endcomponent

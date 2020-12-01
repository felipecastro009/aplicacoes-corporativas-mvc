<?php

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($token, $user)
  {
    $this->token = $token;
    $this->user = $user;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    $url = route('admin.password.reset', ['token' => $this->token, 'email' => $this->user->email]);

    return (new MailMessage)
      ->from(config('qualitare.email.default'), config('app.name'))
      ->subject(config('app.name') . ' | Cadastrar nova senha')
      ->markdown('admin.notifications.reset_password', ['token' => $this->token, 'user' => $this->user, 'url' => $url]);
  }
}

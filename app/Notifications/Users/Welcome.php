<?php

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Watson\Autologin\Facades\Autologin;

class Welcome extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($user)
  {
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
    $autologin = Autologin::route($this->user, 'admin.dashboard.index');

    return (new MailMessage)
            ->from(config('qualitare.email.default'), config('app.name'))
            ->subject(config('app.name') . ' | Bem Vindo')
            ->markdown('admin.notifications.welcome', ['user' => $this->user, 'autologin' => $autologin]);
  }
}

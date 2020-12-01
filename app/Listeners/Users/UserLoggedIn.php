<?php

namespace App\Listeners\Users;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class UserLoggedIn
{
  /**
   * Handle the event.
   *
   * @param  Login  $event
   * @return void
   */
  public function handle(Login $event)
  {
    $event->user->latest_login = Carbon::now();

    if (!$event->user->active) {
      $event->user->active = true;
    }

    $event->user->save();
  }
}

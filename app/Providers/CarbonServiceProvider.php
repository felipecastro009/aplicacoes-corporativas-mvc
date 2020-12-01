<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class CarbonServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    setlocale(LC_TIME, 'pt_BR.UTF-8');
    Carbon::setLocale($this->app->getLocale());
  }
}

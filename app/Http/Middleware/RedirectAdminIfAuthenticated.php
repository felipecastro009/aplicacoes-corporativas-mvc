<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectAdminIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Auth::guard('dashboard')->check()):
      return redirect()->route('admin.dashboard.index');
    endif;

    return $next($request);
  }
}

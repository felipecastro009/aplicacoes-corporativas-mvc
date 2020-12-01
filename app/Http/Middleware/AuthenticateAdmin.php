<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Auth;

class AuthenticateAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (! Auth::guard('dashboard')->check()):
      return redirect()->route('admin.session.login');
    endif;

    return $next($request);
  }
}

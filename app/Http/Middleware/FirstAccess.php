<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Hash;

class FirstAccess
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
    if (Hash::check('bemvindoaopostolivre', Auth::guard('dashboard')->user()->password)):
      return redirect()->route('admin.activation.create');
    endif;

    return $next($request);
  }
}

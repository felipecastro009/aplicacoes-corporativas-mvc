<?php

namespace App\Http\Controllers\Admin\Session;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Auth;
use Socialite;

class SocialController extends BaseController
{
  /**
   * Redirect the user to authentication page
   * @return Response
   */
  public function redirectToProvider(Request $request, $provider = null)
  {
    $providerKey = config("services.{$provider}");

    if (empty($providerKey)):
      abort(404);
    endif;

    return Socialite::driver($provider)->redirect();
  }

  /**
   * Redirect the user to authentication page
   * @return Response
   */
  public function handleProviderCallback(Request $request, $provider = null)
  {
    if (!$request->filled('denied')):
      // Error message
      flash('Ops, você não compartilhou seus dados de perfil com o qualitare.')->error();

      // Redirect to login page
      return redirect()->guest(route('admin.session.login'));
    endif;

    $providerKey = config("services.{$provider}");

    // If provider dont exists
    if (empty($providerKey)):
      abort(404);
    endif;

    // Fetch social user
    $user = Socialite::driver($provider)->user();

    // If user exists in brz
    if (Auth::guard('dashboard')->attempt(['email' => $user->email, 'active' => true])):
      // Redirect to dashboard
      return redirect()->route('admin.dashboard.index');
    else:
      // Error message
      flash('Usuário não encontrado em nosso sistema.')->error();

      // Redirect to login page
      return redirect()->guest(route('admin.session.login'));
    endif;
  }
}

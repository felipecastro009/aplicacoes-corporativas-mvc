<?php

namespace App\Http\Controllers\Admin\Sessions;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends BaseController
{
  use ResetsPasswords;

  protected $redirectTo = '/admin';

  public function guard()
  {
    return Auth::guard('dashboard');
  }

  public function showResetForm(Request $request, $token = null)
  {
    return view('admin.session.resetPassword')->with(
      ['token' => $token, 'email' => $request->email]
    );
  }

  public function reset(Request $request)
  {
    // Validate
    $validate = validator($request->all(), [
      'password' => 'required|min:8|confirmed',
      'password_confirmation' => 'required_with:password'
    ]);

    // If fails validate
    if($validate->fails()):

      // Warning message
      toast()->error('Falha ao adicionar nova senha', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Reset user
    $response = $this->broker()->reset(
      $this->credentials($request), function ($user, $password) {
      $this->resetPassword($user, $password);
    }
    );

    // Response
    $response == Password::PASSWORD_RESET
      ? $this->sendResetResponse($request, $response)
      : $this->sendResetFailedResponse($request, $response);

    // Success message
    toast()->success('Senha modificada com sucesso!', 'Successo');

    // Redirect to profile
    return redirect()->route('admin.dashboard.index');
  }
}

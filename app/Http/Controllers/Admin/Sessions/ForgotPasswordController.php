<?php

namespace App\Http\Controllers\Admin\Sessions;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Models\Auth\User;

class ForgotPasswordController extends BaseController
{
  use SendsPasswordResetEmails;

  public function broker()
  {
    return Password::broker();
  }

  public function showLinkRequestForm()
  {
    return view('admin.session.newPassword');
  }

  public function sendResetLinkEmail(Request $request)
  {
    // Validate
    $validate = validator($request->all(),[
      'email' => 'required|max:255|email',
    ]);

    // If fails validate
    if($validate->fails()):

      // Warning message
      toast()->error('Falha ao recuperar senha', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Check if email exists
    if ( ! User::whereEmail($request->get('email'))->first() ) {

      // Warning message
      toast()->warning('E-mail não existe em nosso banco de dados.', 'Atenção');

      // Redirect same page with errors messages
      return redirect()->back();
    }

    // Check if email active
    if ( ! User::whereEmail($request->get('email'))->active()->first() ) {

      // Warning message
      toast()->warning('Usuário desativado, por favor entre em contato com os administradores.', 'Atenção');

      // Redirect same page with errors messages
      return redirect()->back();
    }

    // Response broker
    $response = $this->broker()->sendResetLink($request->only('email'));

    // Success
    toast()->success('E-mail enviado com sucesso, por favor verifique sua caixa de e-mail.', 'Sucesso');

    // Return response
    $response == Password::RESET_LINK_SENT
      ? $this->sendResetLinkResponse($request, $response)
      : $this->sendResetLinkFailedResponse($request, $response);

    // Redirect to profile
    return redirect()->route('admin.session.login');
  }
}

<?php

namespace App\Http\Controllers\Admin\Sessions;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class SessionController extends BaseController
{
  protected $redirectTo = '/admin';

  use AuthenticatesUsers;

  protected function credentials(Request $request)
  {
    $credentials = $request->only($this->username(), 'password');

    return array_add($credentials, 'active', true);
  }

  public function showLoginForm()
  {
    return view('admin.session.login');
  }

  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->invalidate();

    return redirect()->route('admin.session.login');
  }
}

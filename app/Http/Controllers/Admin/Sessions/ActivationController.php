<?php

namespace App\Http\Controllers\Admin\Sessions;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Auth;

class ActivationController extends BaseController
{
  public function showActivationForm()
  {
    return view('admin.session.activation');
  }

  public function store(Request $request)
  {
    // Fetch current user
    $user = Auth::guard('dashboard')->user();

    $this->validate($request, [
      'password' => 'required|min:8|confirmed',
      'password_confirmation' => 'required_with:password'
    ]);

    // Fill data
    $user->fill($request->except('password', 'password_confirmation'));

    // Check password is present
    if($request->filled('password')):
      $user->password = bcrypt($request->get('password'));
    endif;

    // Save user
    $user->save();

    // Success message
    flash('Senha criada com sucesso.')->success();

    // Redirect to profile
    return redirect()->route('admin.dashboard.index');
  }
}

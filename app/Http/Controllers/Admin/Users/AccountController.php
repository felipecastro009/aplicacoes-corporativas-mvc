<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use App\Models\Core\Audit;

class AccountController extends BaseController
{
  use SEOToolsTrait;

  private $audits;

  public function __construct(Audit $audits)
  {
    // Dependency Injection
    $this->audits = $audits;
  }

  /**
   * Show the specified resource.
   * @return Response
   */
  public function show()
  {
    // Get current user
    $result = Auth::guard('dashboard')->user();

    // Audits
    $results = $this->audits->where('user_id', $result->id)->paginate(5);

    // Set meta tags
    $this->seo()->setTitle('Perfil');

    // Return view
    return view('admin.accounts.show', compact('result', 'results'));
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit()
  {
    // Get current user
    $result = Auth::guard('dashboard')->user();

    // Set meta tags
    $this->seo()->setTitle('Editar Perfil');

    // Return view
    return view('admin.accounts.edit', compact('result'));
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request)
  {
    // Fetch current user
    $user = Auth::guard('dashboard')->user();

    $this->validate($request, [
      'first_name' => 'required|max:255',
      'last_name' => 'nullable|max:255',
      'email' => "required|email|unique:users,email,{$user->id}",
      'phone' => 'nullable|phone:BR',
      'password' => 'nullable|min:8|confirmed',
      'password_confirmation' => 'required_with:password',
      'photo' => 'nullable|image|max:1000'
    ]);

    // Fill data
    $user->fill($request->except('password', 'password_confirmation', 'photo'));

    // Check password is present
    if($request->filled('password')):
      $user->password = bcrypt($request->get('password'));
    endif;

    // Request photo
    $photo = $request->file('photo');

    // Upload photo if send
    if ($photo):
      $user->clearMediaCollection('user');
      $filename = md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
      $user->addMedia($photo)->usingName($user->first_name)->usingFileName($filename)->toMediaCollection('user');
    endif;

    // Save user
    $user->save();

    // Success message
    flash('Perfil atualizado com sucesso.')->success();

    // Redirect to profile
    return redirect()->route('admin.accounts.show');
  }
}

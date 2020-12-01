<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use App\Models\Auth\User;
use App\Models\Auth\Role;

class UserController extends BaseController
{
  use SEOToolsTrait;

  private $users;
  private $roles;

  /**
   * Constructor
   */
  public function __construct(User $users, Role $roles)
  {
    // Middlewares
    $this->middleware('permission:view_users', ['only' => ['index']]);
    $this->middleware('permission:add_users', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_users', ['only' => ['edit', 'update', 'activate']]);
    $this->middleware('permission:delete_users', ['only' => ['deactivate']]);

    // Dependency Injection
    $this->users = $users;
    $this->roles = $roles;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // Fetch all roles
    $roles = $this->roles->byUser(Auth::user())->get()->pluck('details', 'name');

    // Start query
    $query = $this->users->isRoot(Auth::user())->orderBy('first_name', 'DESC');

    // Filter by nome param
    if ($request->filled('nome')):
      $name = $request->get('nome');
      $query->where('first_name', 'LIKE', "%{$name}%");
      $query->orWhere('last_name', 'LIKE', "%{$name}%");
      $query->orWhere('email', '=', $name);
    endif;

    // If filled status
    if ($request->filled('status')) {
      $query->where('active', '=', $request->get('status'));
    }

    // Fetch all results
    $results = $query->paginate(10)->appends($request->except('page'));

    // Set meta tags
    $this->seo()->setTitle('Usuários');

    // Return view
    return view('admin.users.index', compact('roles', 'results'));
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    // Fetch all roles
    $roles = $this->roles->byUser(Auth::user())->get()->pluck('details', 'name');

    // Set meta tags
    $this->seo()->setTitle('Novo Usuário');

    // Return view
    return view('admin.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => "required|email|unique:users,email",
      'phone' => 'nullable',
      'role' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):
      // Warning message
      flash('Falha ao adicionar usuário.')->error();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Hash password
    $request->merge(['password' => bcrypt('bemvindoaopainel')]);

    // Create result
    if($result = $this->users->create($request->except('roles'))):
      // Assign role
      $result->assignRole($request->get('role'));

      // Send Welcome Notification
      $result->sendWelcomeNotification($result);

      // Success message
      flash('Usuário criado com sucesso.')->success();
    else:
      // Error message
      flash('Ops, ocorreu um erro ao adicionar o usuário.')->error();
    endif;

    // Redirect to list
    return redirect()->route('admin.users.index');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit($id)
  {
    // Fetch result by id
    $result = $this->users->isRoot(Auth::user())->findOrFail($id);

    // Fetch all roles
    $roles = $this->roles->byUser(Auth::user())->get()->pluck('details', 'name');

    // Fetch user role
    $userRole = $result->roles->first()->name;

    // Set meta tags
    $this->seo()->setTitle('Editar Usuário');

    // Return view
    return view('admin.users.edit', compact('result', 'roles', 'userRole'));
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $validate = validator($request->all(),[
      'first_name' => 'required|max:255',
      'last_name' => 'nullable|max:255',
      'email' => "required|email|unique:users,email,{$id}",
      'phone' => 'nullable',
      'role' => 'required',
      'password' => 'nullable|min:8|confirmed',
      'password_confirmation' => 'required_with:password'
    ]);

    // If fails validate
    if($validate->fails()):

      // Warning message
      flash('Falha ao atualizar usuário.')->warning();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Fetch result
    $result = $this->users->isRoot(Auth::user())->findOrFail($id);

    // Fill data
    $result->fill($request->except('roles', 'password'));

    // Check password is present
    if($request->filled('password')):
      $result->password = bcrypt($request->get('password'));
    endif;

    // Assign role
    if ($request->filled('role')):
      $result->roles()->detach();
      $result->assignRole($request->get('role'));
    endif;

    // Save result
    $result->save();

    // Success message
    flash('Usuário atualizado com sucesso.')->success();

    // Redirect to list
    return redirect()->route('admin.users.index');
  }

  /**
   * Activate the specified resource from storage.
   * @return Response
   */
  public function activate($id)
  {
    // Fetch result by id
    $result = $this->users->isRoot(Auth::user())
                          ->findOrFail($id);

    // Change status
    if ($result->active === false):
      $result->active = true;
      $result->save();

      // Success message
      flash('Usuário ativado com sucesso.')->success();
    else:
      // Warning message
      flash('Usuário já está ativo.')->warning();
    endif;

    // Redirect back
    return redirect()->back();
  }

  /**
   * Deactivate the specified resource from storage.
   * @return Response
   */
  public function deactivate($id)
  {
    // Fetch result by id
    $result = $this->users->isRoot(Auth::user())
                          ->findOrFail($id);

    if($result->id !== Auth::user()->id):
      // Change status
      if ($result->active === true):
        $result->active = false;
        $result->save();

        // Success message
        toast()->success('Usuário desativado com sucesso.', 'Sucesso');
      else:
        // Warning message
        toast()->error('Usuário já está desativado.', 'Error');
      endif;
    else:
      toast()->warning('Você não pode desativar seu próprio usuário.', 'Error');
    endif;

    // Redirect back
    return redirect()->back();
  }

  public function sendEmail($id)
  {
      // Fetch result by id
      $result = $this->users->findOrFail($id);

      if($result):
          // Send Welcome Notification
           $result->sendWelcomeNotification($result);
          // Success message
          toast()->success('E-mail enviado com sucesso.', 'Sucesso');
      else:
          // Error message
          toast()->error('Ops, o usuário não foi encontrado.', 'Error');
      endif;

      // Redirect back
      return redirect()->back();
  }
}

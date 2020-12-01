<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;

class RoleController extends BaseController
{
  use SEOToolsTrait;

  private $roles;
  private $permissions;

  /**
   * Constructor
   */
  public function __construct(Role $roles, Permission $permissions)
  {
    // Middlewares
    $this->middleware('permission:view_roles', ['only' => ['index']]);
    $this->middleware('permission:add_roles', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_roles', ['only' => ['edit', 'update']]);

    // Dependency Injection
    $this->roles = $roles;
    $this->permissions = $permissions;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // Fetch all results
    $results = $this->roles->byUser(Auth::user())->orderBy('details', 'ASC')->paginate(10);

    // Set meta tags
    $this->seo()->setTitle('Grupos');

    // Return view
    return view('admin.roles.index', compact('results'));
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    // Fetch all permissions
    $permissions = $this->permissions->pluck('details', 'id');

    // Set meta tags
    $this->seo()->setTitle('Novo Grupo');

    // Return view
    return view('admin.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'name' => 'required|max:60|unique:roles,name',
      'details' => 'required|max:60',
      'permissions' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):
      // Warning message
      flash('Falha ao adicionar grupo.')->warning();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Create result
    $result = $this->roles->create($request->only('name', 'details'));

    // Assign permissions to role
    $result->syncPermissions($request->get('permissions', []));

    // Success message
    flash('Grupo criado com sucesso.')->success();

    // Redirect to list
    return redirect()->route('admin.roles.index');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit($id)
  {
    // Fetch result by id
    $result = $this->roles->byUser(Auth::user())->findOrFail($id);

    // Fetch all permissions
    $permissions = $this->permissions->pluck('details', 'id');

    // Set meta tags
    $this->seo()->setTitle('Editar Grupo');

    // Return view
    return view('admin.roles.edit', compact('result', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $validate = validator($request->all(),[
      'details' => 'required|max:60',
      'permissions' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):
      // Warning message
      flash('Falha ao atualizar grupo.')->warning();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Fetch result
    $result = $this->roles->byUser(Auth::user())->findOrFail($id);

    // Fill data
    $result->fill($request->only('details'))->save();

    // Assign permissions to role
    $result->syncPermissions($request->get('permissions', []));

    // Success message
    flash('Grupo atualizado com sucesso.')->success();

    // Redirect to list
    return redirect()->route('admin.roles.index');
  }
}

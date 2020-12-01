<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;

class PermissionController extends BaseController
{
  use SEOToolsTrait;

  private $permissions;
  private $roles;

  /**
   * Constructor
   */
  public function __construct(Permission $permissions, Role $roles)
  {
    // Middlewares
    $this->middleware('permission:view_permissions', ['only' => ['index']]);
    $this->middleware('permission:add_permissions', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_permissions', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete_permissions', ['only' => ['destroy']]);

    // Dependency Injection
    $this->permissions = $permissions;
    $this->roles = $roles;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // query
    $query = $this->permissions->select('id', 'details', 'name', 'guard_name')->orderBy('id', 'DESC');

    // Filter by nome param
    if ($request->filled('nome')):
      $name = $request->get('nome');
      $query->where('name', 'like', "%{$name}%");
    endif;

    // Filter by nome param
    if ($request->filled('guard')):
      $name = $request->get('guard');
      $query->where('guard_name', 'like', "%{$name}%");
    endif;

    // Fetch all results
    $results = $query->paginate(5);


    // Set meta tags
    $this->seo()->setTitle('Permissões');

    // Return view
    return view('admin.permissions.index', compact('results'));
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    // Fetch all roles
    $roles = $this->roles->byUser(Auth::user())->pluck('details', 'id');

    // Set meta tags
    $this->seo()->setTitle('Nova Permissão');

    // Return view
    return view('admin.permissions.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $validate = validator($request->all(),[
      'name' => 'required|max:60|unique:permissions,name',
      'details' => 'required|max:60',
      'roles' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):
      // Warning message
      flash('Falha ao adicionar permissão.')->error();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Create result
    $result = $this->permissions->create($request->only('name', 'details'));

    // Get roles
    $roles = $request->get('roles', []);

    // Assign permission to roles
    foreach($roles as $role):
      $roleName = $this->roles->find($role);
      if(!$roleName->hasPermissionTo($result->name)):
        $result->assignRole($role);
      endif;
    endforeach;

    // Success message
    flash('Permissão criada com sucesso.')->success();

    // Redirect to list
    return redirect()->route('admin.permissions.index');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit($id)
  {
    // Fetch result by id
    $result = $this->permissions->findOrFail($id);

    // Fetch all roles
    $roles = $this->roles->byUser(Auth::user())->pluck('details', 'id');

    // Set meta tags
    $this->seo()->setTitle('Editar Permissão');

    // Return view
    return view('admin.permissions.edit', compact('result', 'roles'));
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
      'roles' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):
      // Warning message
      flash('Falha ao atualizar permissão.')->warning();

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Fetch result
    $result = $this->permissions->findOrFail($id);

    // Fill data
    $result->fill($request->only('details'));

    // Get roles
    $roles = $request->get('roles', []);

    // Fetch all user roles
    $userRoles = $this->roles->byUser(Auth::user())->get();

    // Assign permission to roles
    foreach($userRoles as $role):
      if(in_array($role->id, $roles)):
        if(!$role->hasPermissionTo($result->name)):
          $result->assignRole($role);
        endif;
      else:
        $result->removeRole($role);
      endif;
    endforeach;

    // Save result
    $result->save();

    // Success message
    flash('Permissão atualizada com sucesso.')->success();

    // Redirect to list
    return redirect()->route('admin.permissions.index');
  }

  /**
   * Remove the specified resource from storage.
   * @param  Request $request
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    if ($request->ajax()):

      // Fetch result
      $result = $this->permissions->find($id);

      // If result exist
      if($result):

        // Fetch all roles
        $roles = $this->roles->get();

        // Remove permission from roles
        foreach($roles as $role):
          $role->revokePermissionTo($result);
        endforeach;

        // Remove result
        $result->delete();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Permissão removida com sucesso.'], 200);

      else:

        // Return error response
        return response()->json(['success' => false, 'message' => 'Permissão não encontrada.'], 400);

      endif;

    endif;

    // Error message
    flash('Falha ao remover permissão.')->error();

    // Redirect to back page
    return redirect()->back();
  }
}

<?php

namespace App\Http\Controllers\Admin\Audits;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Crumbs;
use Auth;
use App\Models\Core\Audit;
use App\Models\Auth\User;
use Carbon\Carbon;

class AuditController extends BaseController
{
  use SEOToolsTrait;

  private $audits;
  private $users;

  public function __construct(Audit $audits, User $users)
  {
    // Middlewares
    $this->middleware('permission:view_audits', ['only' => ['index', 'show']]);

    // Dependency Injection
    $this->audits = $audits;
    $this->users = $users;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // Fetch all users
    $users = $this->users->select('id', 'first_name', 'last_name')->byRole(['atendimento', 'gestor', 'root'])->get()->pluck('full_name', 'id');

    // Start query
    $query = $this->audits->latest();

    // Get types
    $types = config('qualitare.audit.types');

    // Get actions
    $actions = config('qualitare.audit.actions');

    // Filter by data param
    if ($request->filled('data')):
      $date = Carbon::createFromFormat('d-m-Y', $request->get('data'))->format('Y-m-d');
      $query->whereDate('created_at', $date);
    endif;

    // Filter by usuario param
    if ($request->filled('usuario')):
      $query->where('user_id', $request->get('usuario'));
    endif;

    // Filter by tipo param
    if ($request->filled('tipo')):
      $query->where('type_name', $request->get('tipo'));
    endif;

    // Filter by acao param
    if ($request->filled('acao')):
      $query->where('event', $request->get('acao'));
    endif;

    // Fetch all results
    $results = $query->paginate(5)->appends($request->except('page'));

    // Set meta tags
    $this->seo()->setTitle('Auditoria');

    // Return view
    return view('admin.audits.index', compact('results', 'users', 'types', 'actions'));
  }

  /**
   * Show the specified resource.
   * @return Response
   */
  public function show($id)
  {
    // Fetch result by id
    $result = $this->audits->findOrFail($id);

    // Set meta tags
    $this->seo()->setTitle('Auditoria - Log');

    // Return view
    return view('admin.audits.show', compact('result'));
  }
}

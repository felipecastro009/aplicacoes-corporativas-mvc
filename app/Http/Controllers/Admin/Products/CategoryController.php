<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Product\Category;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
{
  use SEOToolsTrait;

  private $categories;

  /**
   * Constructor
   */
  public function __construct(Category $categories)
  {
    // Middlewares
    $this->middleware('permission:view_products_submodules', ['only' => ['index']]);
    $this->middleware('permission:add_products_submodules', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_products_submodules', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete_products_submodules', ['only' => ['destroy']]);

    // Dependency Injectiond
    $this->categories = $categories;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // Query filter
    $query = $this->categories->select('id', 'slug', 'name', 'description', 'user_id', 'active')->orderBy('id', 'DESC');

    // Fetch all results
    $results = $query->paginate(5)->appends($request->except('page'));

    // Set meta tags
    $this->seo()->setTitle('Categorias');

    // Return view
    return view('admin.products_categories.index', compact('results'));
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    // Set meta tags
    $this->seo()->setTitle('Nova Categoria');

    // Return view
    return view('admin.products_categories.create');
  }

  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    // Validate
    $validate = validator($request->all(),[
      'name' => 'required|max:255|unique:categories',
      'description' => 'required',
    ]);

    // If fails validate
    if($validate->fails()):

      // Warning message
      toast()->error('Falha ao adicionar Categoria.', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Merge with author_id
    $request->merge(['user_id' => Auth::user()->id]);

    // Create result
    $result = $this->categories->create($request->all());

    // Success message
    toast()->success('Categoria criada com sucesso.', 'Sucesso');

    // Redirect to list
    return redirect()->route('admin.products_categories.index');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit($id)
  {
    // Fetch result by id
    $result = $this->categories->findOrFail($id);

    // Set meta tags
    $this->seo()->setTitle('Editar Categoria');

    // Return view
    return view('admin.products_categories.edit', compact('result'));
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request, $id)
  {
    // Validate
    $validate = validator($request->all(),[
      'name' => 'required|max:255|unique:categories,id,'.$id,
      'description' => 'required',
    ]);

    // If fails validate
    if($validate->fails()):

      // Error message
      toast()->error('Falha ao atualizar Categoria.', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Fetch result
    $result = $this->categories->findOrFail($id);

    // Fill data and save
    $result->fill($request->all())->save();

    // Success message
    toast()->success('Categoria atualizada com sucesso.', 'Sucesso');

    // Redirect to list
    return redirect()->route('admin.products_categories.index');
  }

  /**
   * Remove the specified resource from storage.
   * @param  Request $request
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    // If ajax
    if ($request->ajax()):

      // Fetch result
      $result = $this->categories->find($id);

      // If result exist
      if($result):

        // Remove result
        $result->delete();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Categoria removida com sucesso.'], 200);

      else:

        // Return error response
        return response()->json(['success' => false, 'message' => 'Categoria não encontrada.'], 400);

      endif;

    endif;

    // Error message
    flash('Falha ao remover Categoria.')->error();

    // Redirect to back page
    return redirect()->back();
  }
}

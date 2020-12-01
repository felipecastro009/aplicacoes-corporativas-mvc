<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;

class ProductController extends Controller
{
  use SEOToolsTrait;

  private $products;
  private $categories;

  /**
   * Constructor
   */
  public function __construct(Product $products, Category $categories)
  {
    // Middlewares
    $this->middleware('permission:view_products', ['only' => ['index']]);
    $this->middleware('permission:add_products', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_products', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete_products', ['only' => ['destroy']]);

    // Dependency Injectiond
    $this->products = $products;
    $this->categories = $categories;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index(Request $request)
  {
    // Query filter
    $query = $this->products->select('id', 'slug', 'name', 'price', 'category_id', 'active')->orderBy('id', 'DESC');

    // Fetch all results
    $results = $query->paginate(5)->appends($request->except('page'));

    // Set meta tags
    $this->seo()->setTitle('Produtos');

    // Return view
    return view('admin.products.index', compact('results'));
  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
    // Fetch categories
    $categories = $this->categories->select('id', 'slug', 'name')->active()->asc()->pluck('name', 'id');

    // Set meta tags
    $this->seo()->setTitle('Produtos - Novo Produto');

    // Return view
    return view('admin.products.create', compact('categories'));
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
      'name' => 'required|max:255|unique:products',
      'price' => 'required',
      'description' => 'required',
      'category_id' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):

      // Warning message
      toast()->error('Falha ao adicionar Produto.', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Merge with author_id
    $request->merge(['user_id' => Auth::user()->id]);

    // Create result
    $result = $this->products->create($request->all());

    // Success message
    toast()->success('Produto criado com sucesso.', 'Sucesso');

    // Redirect to list
    return redirect()->route('admin.products.index');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit($id)
  {
    // Fetch categories
    $categories = $this->categories->select('id', 'slug', 'name')->active()->asc()->pluck('name', 'id');

    // Fetch result by id
    $result = $this->products->findOrFail($id);

    // Set meta tags
    $this->seo()->setTitle('Produto - Editar Produto');

    // Return view
    return view('admin.products.edit', compact('result', 'categories'));
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
      'name' => 'required|max:255|unique:products,id,'.$id,
      'price' => 'required',
      'description' => 'required',
      'category_id' => 'required'
    ]);

    // If fails validate
    if($validate->fails()):

      // Error message
      toast()->error('Falha ao atualizar Produto.', 'Error');

      // Redirect same page with errors messages
      return redirect()->back()->withInput()->withErrors($validate->getMessageBag());
    endif;

    // Fetch result
    $result = $this->products->findOrFail($id);

    // Fill data and save
    $result->fill($request->all())->save();

    // Success message
    toast()->success('Produto atualizado com sucesso.', 'Sucesso');

    // Redirect to list
    return redirect()->route('admin.products.index');
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
      $result = $this->products->find($id);

      // If result exist
      if($result):

        // Remove result
        $result->delete();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Produto removido com sucesso.'], 200);

      else:

        // Return error response
        return response()->json(['success' => false, 'message' => 'Produto não encontrado.'], 400);

      endif;

    endif;

    // Error message
    flash('Falha ao remover Produto.')->error();

    // Redirect to back page
    return redirect()->back();
  }
}

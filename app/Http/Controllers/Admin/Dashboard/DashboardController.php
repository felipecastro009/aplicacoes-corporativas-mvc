<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Budget\Budget;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Models\Message\Message;

class DashboardController extends BaseController
{
  use SEOToolsTrait;

  private $products;
  private $categories;

  /**
   * Constructor
   */
  public function __construct(Product $products, Category $categories)
  {
    // Dependency Injection
    $this->products = $products;
    $this->categories = $categories;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
   //fetch categories
    $categories = $this->categories->active()->latest()->limit(4)->get();

      //fetch categories
      $products = $this->products->active()->latest()->limit(4)->get();

    // Set meta tags
    $this->seo()->setTitle('Dashboard');

    // Return view
    return view('admin.dashboard.index', compact('categories', 'products'));
  }

}

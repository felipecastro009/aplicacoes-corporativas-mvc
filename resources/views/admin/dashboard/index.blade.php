@extends('admin.layouts.default')

@section('content')

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
</section>

<div class="section-body">
  <div class="row">
    <div class="col-lg-3">
      <div class="card">
        <div class="card-header -warning">
          <h4>
            <i class="far fa-edit"></i>
            Últimas Categorias
          </h4>
        </div>
        <div class="card-body">
          @foreach($categories as $category)
          <h5>{{ $category->name }}</h5>
          <div class="text-time">
            {{ $category->created_at->format('d-M-Y  H:m') }}
          </div>
          <hr>
          @endforeach
        </div>
        <div class="card-footer bg-whitesmoke">
          <a href="{{ route('admin.products_categories.index') }}" class="text-center" style="display: flex; justify-content: center">Ver todas</a>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="card-header -warning">
          <h4>
            <i class="far fa-edit"></i>
            Últimos Produtos
          </h4>
        </div>
        <div class="card-body">
          @foreach($products as $product)
            <h5>{{ $product->name }}</h5>
            <div class="text-time">
              {{ $product->created_at->format('d-M-Y  H:m') }}
            </div>
            <hr>
          @endforeach
        </div>
        <div class="card-footer bg-whitesmoke">
          <a href="{{ route('admin.products.index') }}" class="text-center" style="display: flex; justify-content: center">Ver todas</a>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header -info">
          <h4>
            <i class="far fa-star"></i>
           Acesso Rápido
          </h4>
        </div>
        <div class="card-body" style="display: flex; justify-content: space-around">
          <a href="{{ route('admin.products.create') }}">
            <div class="empty-state">
              <h5>Novo Produto</h5>
            </div>
          </a>
          <a href="{{ route('admin.products_categories.create') }}">
          <div class="empty-state">
            <h5>Nova Categoria</h5>
          </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

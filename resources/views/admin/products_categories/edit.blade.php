@extends('admin.layouts.default')

@section('content')

  {!! Form::model($result, ['method' => 'PUT', 'novalidate', 'role' => 'form', 'class' => 'form', 'route' => ['admin.products_categories.update', 'id' => $result->id, 'files' => true]]) !!}
  <section class="section">
    <div class="section-header mb-0">
      <div class="section-header-back">
        <a href="{{ route('admin.products_categories.index') }}" class="btn btn-icon" title="Voltar">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
      <h1>Editar Categoria</h1>
      {!! Breadcrumbs::render('products_categories.edit', $result) !!}
    </div>

    <div class="section-options">
      <div class="text-right mb-2">
        <a href="{{ route('admin.products_categories.index') }}" class="btn btn-danger btn-lg btn-icon mr-1" title="Voltar"><i class="fas fa-angle-left"></i> Voltar</a>
        <button type="submit" class="btn btn-icon icon-left btn-success btn-lg"><i class="fas fa-save"></i> Atualizar</button>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header -warning">
              <h4><i class="far fa-edit"></i> Informações</h4>
            </div>
            <div class="card-body">
              <div class="row">
                @include('admin.products_categories._form')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  {!! Form::close() !!}

@endsection

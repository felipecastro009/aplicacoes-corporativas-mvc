@extends('admin.layouts.default')

@section('content')

  <section class="section">
    <div class="section-header">
      <h1>Categorias</h1>

      @can('add_products_submodules')
        <div class="section-header-button mr-2">
          <a href="{{ route('admin.products_categories.create') }}" class="btn btn-success btn-icon btn-lg" title="Adicionar"> <i class="fas fa-plus"></i> Adicionar</a>
        </div>
      @endcan

      {!! Breadcrumbs::render('products_categories.index') !!}
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-0">
          <div class="card-body">
            {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.products_categories.index', 'method' => 'GET']) !!}
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 mb-0 form-group">
                {!! Form::text('nome', Request::get('nome'), ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 mb-0 form-group">
                {!! Form::text('guard', Request::get('guard'), ['class' => 'form-control', 'placeholder' => 'Acesso']) !!}
              </div>
              <div class="col-lg-1 col-md-1 col-sm-12 mb-0 form-group">
                <a href="#" class="btn btn-icon btn-block btn-danger">
                  <i class="fas fa-ban lg-icon"></i>
                </a>
              </div>
              <div class="col-lg-1 col-md-1 col-sm-12 mb-0 form-group">
                <button type="submit" class="btn btn-icon btn-block btn-success">
                  <i class="fas fa-search lg-icon"></i>
                </button>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>
                <i class="fas fa-star"></i>
                Listagem de Categorias <br>
                <small>{{ $results->total() }} resultados.</small>
              </h4>
            </div>
            <div class="card-body -table">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody>
                  <tr>
                    <th>Referencia</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                  @foreach($results as $result)
                    <tr>
                      <td>{{ $result->reference }}</td>
                      <td>{{ $result->name }}</td>
                      <td>{!! isActive($result->active) !!}</td>
                      <td class="no-wrap">

                        @can('add_products_submodules')
                          <a href="{{ route('admin.products_categories.edit', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"> <i class="icon far fa-edit lg"></i></a>
                        @endcan

                        @can('add_products_submodules')
                          <a  href="#" class="js-confirm-delete" data-link="{{ route('admin.products_categories.destroy', ['id' => $result->id]) }}" data-title="{{ $result->name }}"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir"> <i class="icon far fa-trash-alt lg"></i></a>
                        @endcan

                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <div class="float-right">
                <nav>
                  {!! $results->render() !!}
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@extends('admin.layouts.default')

@section('content')

<section class="section">
  <div class="section-header">
    <h1>Usuários</h1>

    @can('add_users')
      <div class="section-header-button mr-2">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-icon btn-lg btn-success" title="Adicionar"> <i class="fas fa-plus"></i> Adicionar</a>
      </div>
    @endcan

    {!! Breadcrumbs::render('users.index') !!}
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-0">
        <div class="card-body">
          {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.users.index', 'method' => 'GET']) !!}
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 mb-0 form-group">
              {!! Form::text('nome', Request::get('nome'), ['class' => 'form-control', 'placeholder' => 'Nome ou E-mail']) !!}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 mb-0 form-group">
              {!! Form::select('status', [0 => 'Desativado', 1 => 'Ativo'], Request::get('status'), ['class' => 'form-control', 'placeholder' => 'Status ']) !!}
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12 mb-0 form-group">
              <button type="button" class="btn btn-icon btn-block btn-danger js-clear">
                <i class="fas fa-ban lg-icon"></i>
              </button>
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
              <i class="far fa-user lga"></i>
              Listagem de Usuarios <br>
              <small>{{ $results->total() }} resultados.</small>
            </h4>
          </div>
          <div class="card-body -table">
            <div class="table-responsive">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Último acesso</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                  @foreach($results as $result)
                    <tr>
                      <td> <img src="{{ $result->photo }}" alt="{{ $result->full_name }}" width="25">
                      {{ $result->full_name }}</td>
                      <td>{{ $result->email }}</td>
                      <td>{{ $result->last_login }}</td>
                      <td>{!! isActive($result->active) !!}</td>
                      <td class="no-wrap">

                      @can('view_users')
                        <a href="{{ route('admin.users.sendEmail', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reenviar e-mail"> <i class="icon fas fa-undo lg"></i></a>
                      @endcan

                      @if($result->active)
                        @can('edit_users')
                          <a href="{{ route('admin.users.deactivate', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Desativar"> <i class="icon fas fa-ban lg"></i></a>
                        @endcan
                      @else
                        @can('edit_users')
                          <a href="{{ route('admin.users.activate', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ativar"> <i class="icon fas  fa-check lg"></i></a>
                        @endcan
                      @endif

                      @can('edit_users')
                        <a href="{{ route('admin.users.edit', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"> <i class="icon far fa-edit lg"></i></a>
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

@extends('admin.layouts.default')

@section('content')

<section class="section">
  <div class="section-header">
    <h1>Grupos</h1>

    @can('add_users')
      <div class="section-header-button mr-2">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-icon btn-lg" title="Adicionar"> <i class="fas fa-plus"></i> Adicionar</a>
      </div>
    @endcan

    {!! Breadcrumbs::render('roles.index') !!}
  </div>
  <div class="section-body">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>
              <i class="fas fa-users lga"></i>
              Listagem de grupos <br>
              <small>{{ $results->total() }} resultados.</small>
            </h4>
          </div>
          <div class="card-body -table">
            <div class="table-responsive">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Nome</th>
                    <th>Detalhes</th>
                    <th>Acesso</th>
                    <th>Ações</th>
                  </tr>
                  @foreach($results as $result)
                    <tr>
                      <td>{{ $result->name }}</td>
                      <td>{{ $result->details }}</td>
                      <td>{{ $result->guard_name }}</td>
                      <td class="no-wrap">

                      @can('edit_roles')
                        <a href="{{ route('admin.roles.edit', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"> <i class="icon far fa-edit lg"></i></a>
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

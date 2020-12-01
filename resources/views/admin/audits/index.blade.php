@extends('admin.layouts.default')

@section('content')

  <section class="section">
    <div class="section-header">
      <h1>Auditoria</h1>
      {!! Breadcrumbs::render('audits.index') !!}
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-0">
          <div class="card-body">
            {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.audits.index', 'method' => 'GET']) !!}
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 mb-0 form-group">
                  {!! Form::text('data', Request::get('data'), ['class' => 'form-control js-datepicker', 'placeholder' => 'Data']) !!}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 mb-0 form-group">
                  {!! Form::select('usuario', $users, Request::get('usuario'), ['class' => 'form-control', 'placeholder' => 'Usuário']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 mb-0 form-group">
                  {!! Form::select('tipo', $types, Request::get('tipo'), ['class' => 'form-control', 'placeholder' => 'Tipo']) !!}
                </div>

                <div class="col-lg-2 col-md-2 col-sm-12 mb-0 form-group">
                  {!! Form::select('acao', $actions, Request::get('acao'), ['class' => 'form-control', 'placeholder' => 'Ação ']) !!}
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
                <i class="fas fa-redo"></i>
                Listagem de Auditoria <br>
                <small>{{ $results->total() }} resultados.</small>
              </h4>
            </div>
            <div class="card-body -table">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody>
                  <tr>
                    <th>Usuário</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                    <th>Horário</th>
                    <th>Ações</th>
                  </tr>
                  @foreach($results as $result)
                    <tr>
                      <td>
                       <img src="{{ $result->user->photo }}" alt="{{ $result->user->full_name }}" width="25">
                       {{ $result->user->full_name }}
                     </td>
                      <td>{{ $result->type_name }}</td>
                      <td>{{ $result->action_name }}</td>
                      <td>{{ $result->created_at->format('d/m/Y H:i') }}</td>
                      <td class="no-wrap">
                        @can('view_audits')
                          <p>Recurso temporariamente indisponível</p>
                          {{--<a href="{{ route('admin.audits.show', ['id' => $result->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar"> <i class="icon far fa-eye lg"></i></a>--}}
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

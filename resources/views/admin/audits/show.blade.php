@extends('admin.layouts.default')

@section('content')

{!! Form::open(['method' => 'put', 'novalidate', 'role' => 'form', 'class' => 'form', 'route' => ['admin.budgets_attendances.update', 'code' => $result->code], 'files' => true]) !!}
  <section class="section">
    <div class="section-header mb-0">
      <h1>Visualizar Auditoria {{ $result->reference }}</h1>
      {!! Breadcrumbs::render('audits.show', $result) !!}
    </div>
    <div class="section-options">
      @can('view_budgets')
        <div class="text-right mb-2">
          <a href="{{ route('admin.audits.index') }}" class="btn btn-lg btn-danger btn-icon mr-1" title="Voltar"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      @endcan
    </div>
    <div class="clearfix"></div>
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-4">
          <div class="card">
            <div class="card-header -warning">
              <h4><i class="far fa-user"></i> Responsável</h4>
            </div>
            <div class="card-body p-tb0">
              <div class="row">

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h4><i class=" far fa-settings"></i> Log</h4>
            </div>
            <div class="card-body p-tb0">
              <div class="row">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
{!! Form::close() !!}
@endsection

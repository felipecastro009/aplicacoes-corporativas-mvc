@extends('admin.layouts.default')

@section('content')

{!! Form::open(['method' => 'POST', 'novalidate', 'role' => 'form', 'class' => 'form', 'route' => 'admin.roles.store', 'files' => true]) !!}
<section class="section">
  <div class="section-header mb-0">
    <h1>Novo Grupo</h1>
    {!! Breadcrumbs::render('roles.create') !!}
  </div>

  <div class="section-options">
    <div class="text-right mb-2">
      <a href="{{ route('admin.roles.index') }}" class="btn btn-danger btn-lg btn-icon mr-1" title="Voltar"><i class="fas fa-angle-left"></i> Voltar</a>
      <button type="submit" class="btn btn-icon icon-left btn-success btn-lg"><i class="fas fa-check"></i> Salvar</button>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="section-body">
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header -info">
            <h4>
              <i class="fas fa-key lga"></i>
              Permissões
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group mb-4">
                  {!! Form::label('permissions[]', 'Permissões', ['class' => '']) !!}
                  {!! Form::select('permissions[]', $permissions, old('permissions'), ['class' => 'form-control js-box', 'multiple']) !!}
                  @if($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header -warning">
            <h4>
              <i class="fas fa-edit lga"></i>
              Detalhes
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              @include('admin.roles._form')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{!! Form::close() !!}

@endsection

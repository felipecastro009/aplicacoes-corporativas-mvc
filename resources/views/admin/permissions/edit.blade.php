@extends('admin.layouts.default')

@section('content')

{!! Form::model($result, ['method' => 'PUT', 'novalidate', 'role' => 'form', 'class' => 'form', 'route' => ['admin.permissions.update', 'id' => $result->id], 'files' => true]) !!}
<section class="section">
  <div class="section-header mb-0">
    <div class="section-header-back">
      <a href="{{ route('admin.permissions.index') }}" class="btn btn-icon" title="Voltar">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
    <h1>Editar Permissão</h1>
    {!! Breadcrumbs::render('permissions.edit', $result) !!}
  </div>

  <div class="section-options">
    <div class="text-right mb-2">
      <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger btn-lg btn-icon mr-1" title="Voltar"><i class="fas fa-angle-left"></i> Voltar</a>
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
              <i class="fas fa-key"></i>
              Grupo
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group mb-4">
                  {!! Form::label('roles[]', 'Grupos', ['class' => '']) !!}
                  {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control js-box', 'multiple']) !!}
                  @if($errors->has('roles'))
                    <span class="text-danger">{{ $errors->first('roles') }}</span>
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
              <i class="fas fa-edit"></i>
              Detalhes
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              @include('admin.permissions._form')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{!! Form::close() !!}

@endsection

@extends('admin.layouts.default')

@section('content')

{!! Form::model($result, ['method' => 'PUT', 'novalidate', 'role' => 'form', 'class' => 'form', 'route' => ['admin.users.update', 'id' => $result->id], 'files' => true]) !!}
<section class="section">
  <div class="section-header mb-0">
    <h1>Editar Usuário</h1>
    {!! Breadcrumbs::render('users.edit', $result) !!}
  </div>

  <div class="section-options">
    <div class="text-right mb-2">
      <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-lg btn-icon mr-1" title="Voltar"><i class="fas fa-angle-left"></i> Voltar</a>
      <button type="submit" class="btn btn-icon icon-left btn-success btn-lg"><i class="fas fa-save"></i> Atualizar</button>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="section-body">
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-header -info">
            <h4>
              <i class="fas fa-key lga"></i>
              Acesso
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="form-group mb-4">
                  {!! Form::label('role', 'Grupo', ['class' => '']) !!}
                  {!! Form::select('role', $roles, isset($userRole) ? $userRole : old('role'), ['class' => 'form-control', 'placeholder' => 'Selecione']) !!}
                  @if($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-header -warning">
            <h4>
              <i class="fas fa-info-circle lga"></i>
              Dados pessoais
            </h4>
          </div>
          <div class="card-body">
            <div class="row">
              @include('admin.users._form')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{!! Form::close() !!}

@endsection

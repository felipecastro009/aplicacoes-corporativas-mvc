{!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.session.login', 'method' => 'POST']) !!}

<div class="row">
  <div class=" col-lg-12 form-group">
    {!! Form::label('email', 'E-mail', []) !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control', 'autofocus']) !!}
    @if($errors->has('email'))
      <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
  </div>

  <div class="col-lg-6 form-group mb-0">
    <a href="{{ route('admin.session.login') }}" class="btn btn-danger btn-lg btn-block btn-icon" title=""><i class="fas fa-arrow-left"></i> Voltar</a>
  </div>

  <div class="col-lg-6 form-group mb-0 ">
    <button class="btn btn-success btn-lg btn-block" type="submit"><i class="fas fa-save"></i> Recuperar</button>
  </div>

</div>
{!! Form::close() !!}

{!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.session.login', 'method' => 'POST']) !!}

  <div class="form-group">
    {!! Form::label('email', 'E-mail', []) !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control', 'autofocus']) !!}
    @if($errors->has('email'))
      <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
  </div>

  <div class="form-group">
    <div class="d-block">
      {!! Form::label('password', 'Senha', []) !!}
      <div class="float-right">
        <a href="{{ route('admin.password.forgot') }}" class="text-small" title="Esqueceu a senha?">
          Esqueceu a senha?
        </a>
      </div>
    </div>
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @if($errors->has('password'))
      <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif
  </div>

  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
      <label class="custom-control-label" for="remember-me">Lembrar de mim?</label>
    </div>
  </div>

  <div class="form-group">
    {!! Form::button('Acessar', ['class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit']) !!}
  </div>

{!! Form::close() !!}

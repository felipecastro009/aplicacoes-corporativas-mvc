@extends('admin.layouts.public')

@section('content')

  <div class="container">
    <div class="box">
      <h2>Iniciar Sessão</h2>
      {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.session.login', 'method' => 'POST']) !!}
      <div class="group-form">
        {!! Form::label('email', 'E-mail', []) !!}
        {!! Form::text('email', old('email'), ['class' => '', 'autofocus']) !!}
        @if($errors->has('email'))
          <span class="span text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="group-form">
        <div class="d-flex">
          <label>Senha</label>
          <a href="{{ route('admin.password.forgot') }}">Esqueceu a senha?</a>
        </div>
        {!! Form::password('password', ['class' => '']) !!}
        @if($errors->has('password'))
          <span class="span text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <div class="group-form">
        <label class="checkbox-inline">
          <input type="checkbox" value="">
          <span class="text">Lembrar de mim?</span>
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="group-form">
        <button type="submit">Entrar</button>
      </div>
      {!! Form::close() !!}
    </div>
    <div class="box-footer">
      <p>{{ config('app.name') }}</p>
      <p>Produzido e mantido por {{ config('app.name') }} © 2019</p>
    </div>
  </div>
@endsection

@extends('admin.layouts.public')

@section('content')

<div class="container">
  <div class="box">
    <h2>Cadastrar <br>  nova senha</h2>
    {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.password.processReset', 'method' => 'POST']) !!}
      {!! Form::hidden('token', $token) !!}
      {!! Form::hidden('email', $email) !!}
      <div class="group-form">
        {!! Form::label('password', 'Nova senha', ['class' => 'label-required']) !!}
        {!! Form::password('password', ['class' => '', 'autofocus']) !!}
        @if($errors->has('password'))
          <span class="span text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>
      <div class="group-form">
        {!! Form::label('password_confirmation', 'Confirmar senha', []) !!}
        {!! Form::password('password_confirmation', ['class' => '', 'autofocus']) !!}
        @if($errors->has('password_confirmation'))
          <span class="span text-danger">{{ $errors->first('password_confirmation') }}</span>
        @endif
      </div>
      <div class="group-form">
        <button type="submit">Confirmar</button>
      </div>
    {!! Form::close() !!}
  </div>
  <div class="box-footer">
    <p>{{ config('app.name') }}</p>
    <p>Produzido e mantido pela {{ config('app.name') }} © 2019</p>
  </div>
</div>

@endsection

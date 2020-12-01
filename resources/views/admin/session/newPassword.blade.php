@extends('admin.layouts.public')

@section('content')

<div class="container">
  <div class="box">
    <h2>Nova Senha</h2>
    {!! Form::open(['class' => 'form', 'novalidate', 'route' => 'admin.password.processForgot', 'method' => 'POST']) !!}
      <div class="group-form">
        {!! Form::label('email', 'E-mail', []) !!}
        {!! Form::text('email', old('email'), ['class' => '', 'autofocus']) !!}
        @if($errors->has('email'))
          <span class="span text-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="group-form">
        <button type="submit">Enviar</button>
      </div>
    {!! Form::close() !!}
  </div>
  <div class="box-footer">
    <p>{{ config('app.name') }}</p>
    <p>Produzido e mantido pela {{ config('app.name') }} © 2019</p>
  </div>
</div>

@endsection

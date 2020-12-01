<div class="col-sm-12 col-md-4">
  <div class="form-group mb-4">
    {!! Form::label('first_name', 'Nome', ['class' => '']) !!}
    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
    @if($errors->has('first_name'))
      <span class="text-danger">{{ $errors->first('first_name') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-4">
  <div class="form-group mb-4">
    {!! Form::label('last_name', 'Sobrenome', ['class' => '']) !!}
    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
    @if($errors->has('last_name'))
      <span class="text-danger">{{ $errors->first('last_name') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-4">
  <div class="form-group mb-4">
    {!! Form::label('email', 'E-mail', ['class' => '']) !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control']) !!}
    @if($errors->has('email'))
      <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-3">
  <div class="form-group mb-4">
    {!! Form::label('phone', 'Telefone', ['class' => '']) !!}
    {!! Form::text('phone', old('phone'), ['class' => 'form-control js-mask-phone']) !!}
    @if($errors->has('phone'))
        <span class="text-danger">{{ $errors->first('phone') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-12">
  <div class="form-group mb-0">
    <label class="mt-2">
      {!! Form::hidden('receive_messages', 0) !!}
      {!! Form::checkbox('receive_messages', true, isset($result) ? $result->receive_messages : false, ['class' => 'custom-switch-input', 'id' => 'receive_messages']) !!}
      <span class="custom-switch-indicator"></span>
      <span class="custom-switch-description">Receber mensagem?</span>
    </label>
  </div>
</div>

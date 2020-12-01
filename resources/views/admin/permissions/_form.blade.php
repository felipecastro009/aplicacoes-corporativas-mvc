<div class="col-sm-12 col-md-12">
  <div class="form-group mb-4">
    {!! Form::label('details', 'Permissão', ['class' => '']) !!}
    {!! Form::text('details', old('details'), ['class' => 'form-control']) !!}
    @if($errors->has('details'))
      <span class="text-danger">{{ $errors->first('details') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-12">
  <div class="form-group mb-4">
    {!! Form::label('name', 'Chave', ['class' => '']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    @if($errors->has('name'))
      <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
  </div>
</div>



<div class="col-sm-12 col-md-4">
  <div class="form-group mb-4">
    {!! Form::label('name', 'Nome', ['class' => '']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    @if($errors->has('name'))
      <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-4">
  <div class="form-group mb-4">
    {!! Form::label('price', 'Preço', ['class' => '']) !!}
    {!! Form::text('price', old('price'), ['class' => 'form-control js-mask-money']) !!}
    @if($errors->has('price'))
      <span class="text-danger">{{ $errors->first('price') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-4">
  <div class="form-group mb-2">
    {!! Form::label('category_id', 'Categoria', ['class' => '']) !!}
    {!! Form::select('category_id', $categories ,old('category_id'), ['class' => 'form-control', 'placeholder' => 'Selecione a categoria']) !!}
    @if($errors->has('category_id'))
      <span class="text-danger">{{ $errors->first('category_id') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-12">
  <div class="form-group mb-4">
    {!! Form::label('description', 'Conteúdo', ['class' => '']) !!}
    {!! Form::textarea('description', old('description'), ['class' => 'form-control js-redactor']) !!}
    @if($errors->has('description'))
      <span class="text-danger">{{ $errors->first('phone') }}</span>
    @endif
  </div>
</div>

<div class="col-sm-12 col-md-12">
  <div class="form-group mb-2">
    <label class="custom-switch mt-2">
      {!! Form::hidden('active', 0) !!}
      {!! Form::checkbox('active', true, isset($result) ? $result->active : false, ['class' => 'custom-switch-input ', 'id' => 'active']) !!}
      <span class="custom-switch-indicator"></span>
      <span class="custom-switch-description">Ativo?</span>
    </label>
  </div>
</div>
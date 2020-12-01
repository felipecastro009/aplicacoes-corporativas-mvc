<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Endereço</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12 col-md-3">
            <div class="form-group mb-4">
              {!! Form::hidden('address[id]', isset($result->placeable) ? $result->placeable->id : null) !!}
              {!! Form::label('address[cep]', 'CEP', ['class' => '']) !!}
              {!! Form::text('address[cep]', isset($result->placeable) ? $result->placeable->cep : old('address[cep]'), ['class' => 'form-control js-mask-cep', 'id' => 'cep']) !!}
              @if($errors->has('address.cep'))
                <span class="text-danger">{{ $errors->first('address.cep') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-9">
            <div class="form-group mb-4">
              {!! Form::label('address[street]', 'Rua', ['class' => '']) !!}
              {!! Form::text('address[street]', isset($result->placeable) ? $result->placeable->street : old('address[street]'), ['class' => 'form-control', 'id' => 'rua']) !!}
              @if($errors->has('address.street'))
                <span class="text-danger">{{ $errors->first('address.street') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-5">
            <div class="form-group mb-4">
              {!! Form::label('address[neighborhood]', 'Bairro', ['class' => '']) !!}
              {!! Form::text('address[neighborhood]', isset($result->placeable) ? $result->placeable->neighborhood : old('address[neighborhood]'), ['class' => 'form-control', 'id' => 'bairro']) !!}
              @if($errors->has('address.neighborhood'))
                <span class="text-danger">{{ $errors->first('address.neighborhood') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-5">
            <div class="form-group mb-4">
              {!! Form::label('address[complement]', 'Complemento', ['class' => '']) !!}
              {!! Form::text('address[complement]', isset($result->placeable) ? $result->placeable->complement : old('address[complement]'), ['class' => 'form-control']) !!}
              @if($errors->has('address.complement'))
                <span class="text-danger">{{ $errors->first('address.complement') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group mb-4">
              {!! Form::label('address[number]', 'Número', ['class' => '']) !!}
              {!! Form::text('address[number]', isset($result->placeable) ? $result->placeable->number : old('address[number]'), ['class' => 'form-control']) !!}
              @if($errors->has('address.number'))
                <span class="text-danger">{{ $errors->first('address.number') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="form-group mb-4">
              {!! Form::label('address[city]', 'Cidade', ['class' => '']) !!}
              {!! Form::text('address[city]', isset($result->placeable) ? $result->placeable->city : old('address[city]'), ['class' => 'form-control', 'id' => 'localidade']) !!}
              @if($errors->has('address.city'))
                <span class="text-danger">{{ $errors->first('address.city') }}</span>
              @endif
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <div class="form-group mb-4">
              {!! Form::label('address[state]', 'Estado', ['class' => '']) !!}
              {!! Form::text('address[state]', isset($result->placeable) ? $result->placeable->state : old('address[state]'), ['class' => 'form-control', 'id' => 'uf']) !!}
              @if($errors->has('address.state'))
                <span class="text-danger">{{ $errors->first('address.state') }}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

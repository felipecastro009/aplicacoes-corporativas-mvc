@extends('admin.layouts.errors')

@section('content')

<section class="section">
  <div class="container mt-5">
    <div class="page-error">
      <div class="page-inner">
        <h1>403</h1>
        <div class="page-description">
          Desculpe, o seu usuário não possui acesso ao conteúdo.
        </div>
        <div class="page-search">
          <div class="mt-3">
            <a href="{{ route('admin.dashboard.index') }}" title="Retornar aqui">Retornar aqui</a>
          </div>
        </div>
      </div>
    </div>
    <div class="simple-footer mt-5">
      Copyright © Qualitare 2019
    </div>
  </div>
</section>

@stop
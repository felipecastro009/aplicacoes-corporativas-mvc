@extends('admin.layouts.errors')

@section('content')

<section class="section">
  <div class="container mt-5">
    <div class="page-error">
      <div class="page-inner">
        <h1>500</h1>
        <div class="page-description">
          Ops, desculpe! Os nossos técnicos já foram avisados, por favor aguarde e tente novamente em breve.
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
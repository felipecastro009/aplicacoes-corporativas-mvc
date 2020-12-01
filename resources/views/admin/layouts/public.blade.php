<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#2c4e87">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! SEO::generate() !!}
  <link rel="stylesheet" href="{{ asset('/assets/css/login.css') }}">
  @include('admin.partials.favicons')
</head>
<body>
  <div id="app">
    @yield('content')
  </div>
</body>
</html>

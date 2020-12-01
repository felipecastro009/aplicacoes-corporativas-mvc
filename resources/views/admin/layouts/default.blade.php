<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#2c4e87">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! SEO::generate() !!}
  @include('admin.partials.styles')
  @include('admin.partials.favicons')
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      @include('toast::messages-jquery')
      @include('admin.partials.nav')
      @include('admin.partials.sidebar')
      <div class="main-content">
        @yield('content')
      </div>
      @include('admin.partials.footer')
    </div>
    @include('admin.partials.scripts')
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>@yield('title', 'LaraBBS') - {{ setting('site_name', 'LaraBBS 论坛') }}</title>
  <meta name="description" content="@yield('description', setting('seo_description', 'LaraBBS 论坛'))" />
  <meta name="keywords" content="@yield('keyword', setting('seo_keyword', 'LaraBBS,技术,论坛,工作站'))">

  <!-- Style -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @yield('styles')

</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')

    <div class="container">
      @include('shared._messages')
      @yield('content')
    </div>

    @include('layouts._footer')
  </div>

  @if (app()->isLocal())
    @include('sudosu::user-selector')
  @endif

  <!-- Script -->
  <script src="{{ mix('js/app.js') }}"></script>
  @yield('scripts')
</body>
</html>

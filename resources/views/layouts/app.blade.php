<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head')
    <meta property="og:site_name" content="code.co.ua - Безкоштовні курси сучасного веб програмування">
    <meta property="og:url" content="{{ url()->current() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>
    <script>Turbolinks.start()</script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-white">
        @include('components.nav')
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @include('components.footer')

    <script src="{{ asset('js/app.js') }}" defer></script>
</div>
<!-- Scripts -->
@yield('scripts')
</body>
</html>

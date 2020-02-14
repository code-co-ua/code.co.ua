<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts._head')
<body class="d-flex flex-column h-100">
    <div id="app" class="flex-shrink-0">
        <nav class="navbar pt-0 py-0 navbar-expand-md navbar-light navbar-white">
            @include('components.nav')
        </nav>

        <main class="py-4 @yield('main-class')">
            @yield('content')
        </main>
    </div>
    @include('components.footer')
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site title -->
    <title>{{ config('app.name', 'Events Calendar') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts (deferred) -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    @auth
        <script defer>
            window.sessionLifetime = parseInt('{{ config('session.lifetime', "120") }}');
        </script>
        <script type="text/javascript" src="{{ asset('js/session-timeout.js') }}" defer></script>
    @endauth
    @stack('scripts')
</head>

<body data-bs-theme="light">
    <div id="app" class="themed-app-bg d-flex flex-column">
        <header>
            @include('modules.main_nav')
        </header>
        <main>
            <div id="mainContent" class="py-5">
                @yield('content')
            </div>
            @auth
                @include('modules.timeout_modal')
            @endauth
        </main>
        <footer class="mt-auto">
            @include('modules.footer')
        </footer>
    </div>
</body>

</html>

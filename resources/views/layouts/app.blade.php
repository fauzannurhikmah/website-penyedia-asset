<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(auth()->check()) <meta name="user-id" content="{{ auth()->user()->id }}"> @endif

    <title>{{ "My Assets | ".$title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles from stisla -->
    <link href="{{ asset('css/stisla.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">
    

    @yield('style')
</head>
<body class="layout-3">
    <div id="app">
        <x-front.navbar/>
        <main style="padding-top:100px;">
            @yield('content')
        </main>
    </div>
    @yield('script')
    @stack('script')

</body>
</html>

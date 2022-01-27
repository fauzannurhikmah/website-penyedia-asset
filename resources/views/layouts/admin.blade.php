<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ "My Assets | ".$title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/stisla.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <x-back.navbar/>
        <x-back.sidebar/>
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    
    <script src="{{asset('vendor/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('js/stisla.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    @stack('script')
</body>
</html>

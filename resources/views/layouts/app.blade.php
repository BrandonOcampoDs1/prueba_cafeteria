<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app_style.css') }}" />
    {{-- ICONOS --}}
    <script src="https://kit.fontawesome.com/1e30f8602f.js" crossorigin="anonymous"></script>
    {{-- ALERTAS --}}
    <link rel="stylesheet" href="{{ asset('css/ambiance.css') }}" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body >
    @yield('login_w')

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

        {{-- LIBRERÍA DATATABLES Y JQUERY PARA GENERAR LAS TABLAS --}}    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        {{-- TABLAS --}}
        <script src="{{ asset('js/k_home.js') }}"></script>
        <script src="{{ asset('js/ambiance.js') }}"></script>
</body>
</html>
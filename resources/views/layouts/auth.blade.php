<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title', 'Sign In') | Lobato Coiffeur</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet">

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body class="login-page {{ Request::is('login') ? 'bg-cyan' : 'bg-lime' }}">
    
    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>
    
    <!-- Custom Js -->
    {{-- <script src="{{ asset('js/admin.js') }}"></script> --}}


    @include('dashboard.includes.notification')

        
    @yield('scripts')

</body>

</html>
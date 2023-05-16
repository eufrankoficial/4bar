<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>{{ config('app.name') }} | {{ isset($title) ? $title : 'Login' }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/core/css/login.min.css') }}">

</head>
<body class="theme-cyan font-montserrat" >

<div id="vueApp">


<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<div class="pattern">
    <span class="red"></span>
    <span class="indigo"></span>
    <span class="blue"></span>
    <span class="green"></span>
    <span class="orange"></span>
</div>

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);">
                <img src="{{ asset('assets/core/images/logo_light.png ') }}" width="100" class="d-inline-block align-top mr-2" alt="">
            </a>
        </div>

        @yield('content')

    </div>
    <div id="particles-js"></div>
</div>
</div>
<!-- END WRAPPER -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('assets/core/js/bundle.js') }}"></script>
<script src="{{ asset('assets/core/js/login.js') }}"></script>

</body>
</html>

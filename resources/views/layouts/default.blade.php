<!doctype html>
<html lang="en">
<head>
    <title>{{ isset($pageTitle) ? $pageTitle . ' | ' . config('app.name') : config('app.name')  }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="keywords" content="admin template, Oculux admin template, dashboard template, flat admin template, responsive admin template, web app, Light Dark version">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/core/images/logo.ico') }}" type="image/x-icon">
    <!-- VENDOR CSS -->

    <!-- MAIN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/core/css/app.min.css') }}">
</head>
<body class="theme-cyan font-montserrat {{ theme() }}">
<div id="vueApp">
    <!-- Page Loader -->
    <div class="page-loader-wrapper" id="pageLoader">
        <div class="loader">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <div class="bar4"></div>
            <div class="bar5"></div>
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        @include('partials.nav_top')

        @include('partials.search_bar')

        @include('partials.mega_menu')

        @include('partials.right_bar')

        @include('partials.menu')

        <div id="main-content">
            <div class="container-fluid">
                @include('partials.page_title')

                @include('flash::message')

                @yield('content')

                @include('partials.modal')

            </div>
        </div>
    </div>
</div>

<!-- Javascript -->

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('assets/core/js/bundle.js') }}"></script>
<script src="{{ asset('assets/core/js/app.min.js') }}"></script>
</body>
</html>

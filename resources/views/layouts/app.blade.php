<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Messtechnik') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet" type="text/css">

    <!--<link href="{{ asset('css/vendor.bundle.addons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/feather.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/vendor.bundle.base.css') }}" rel="stylesheet" type="text/css">-->

</head>
<body>
<div class="container-scroller" id="app">
    @auth
        @include('partials._navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials._sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('partials._footer')
            </div>
        </div>
    @else
        @yield('content')
    @endauth
</div>

<script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/sweetalert2.all.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/alerts.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/teste.js') }}" type="text/javascript" defer></script>

<!--<script src="{{ asset('js/off-canvas.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/misc.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/dashboard.js') }}" type="text/javascript" defer></script>
<script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript" defer></script>
-->
<!--<script src="{{ asset('js/jquery-mask.js') }}" type="text/javascript" defer></script>-->

</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AOE | @yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
    <link rel='stylesheet' id='bootstrap-rtl-css' href='{{asset('css/bootstrap-rtl/bootstrap-rtl.min.css')}}' type='text/css' />
</head>
<body>

    @include('layouts.nav.main_nav')
	<div class="col-md-6 col-md-offset-3">
		@include('flash::message')
	</div>
    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('js_footer')
</body>
</html>

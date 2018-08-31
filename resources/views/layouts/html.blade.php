<!DOCTYPE html>
<html class="@yield('htmlClass')">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', (isset($title)?$title:'')) | {!! Context::meta('siteTitle') !!}</title>

    <meta name="description" content="@yield('description')">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="<?= csrf_token() ?>"/>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#3598db">
    <meta name="msapplication-config" content="{{ asset('img/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- Styelsheets --}}
    {!! Context::stylesheets() !!}

    <script>
        window.debugPrint = function () {
            console.log.apply(console, arguments);
        }
    </script>

	{{-- Head Scripts --}}
	@if (config('app.env') === 'production' || config('app.env') === 'development')
		@include('partials.portal.head_scripts')
	@endif

    @yield('head')
</head>
<body class="@yield('bodyClass')">
@yield('body')

@if (Auth::check())
    @include('partials.preloader')
@endif

{{-- Localizaton --}}
{!! Context::localization() !!}

{{-- Footer Scripts --}}
@if (config('app.env') === 'production' || config('app.env') === 'development')
    @include('partials.portal.foot_scripts')
@endif
{!! Context::scripts() !!}

</body>
</html>

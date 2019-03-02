<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="Codesahper - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Dashmix">
        <meta property="og:description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('admin-assets/media/favicons/favicon.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('admin-assets/media/favicons/favicon-192x192.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin-assets/media/favicons/apple-touch-icon-180x180.png')}}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Codesahper framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('admin-assets/css/codeshaper.min.css')}}">
        <link rel="stylesheet" id="css-main" href="{{asset('admin-assets/css/codeshaperNew.css')}}">
        @yield('styles')
        <!-- END Stylesheets -->
    </head>
    <body>

        <!-- Page Container -->
        @yield('page-content')
        <!-- END Page Container -->

        <!--
            Codeshaper JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/js.cookie.min.js
        -->
        <script src="{{asset('admin-assets/js/codeshaper.core.min.js')}}"></script>

        <!--
            codesahper JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{asset('admin-assets/js/codeshaper.app.min.js')}}"></script>

        <!-- Page JS Plugins -->
        <script src="{{asset('admin-assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('admin-assets/js/plugins/chart.js/Chart.bundle.min.j')}}s"></script>

        <!-- Page JS Code -->
        <script src="{{asset('admin-assets/js/pages/be_pages_dashboard.min.js')}}"></script>

        <!-- external js  -->
        @yield('scripts');


        <!-- Page JS Helpers (jQuery Sparkline plugin) -->
        <script>jQuery(function(){ Dashmix.helpers('sparkline'); });</script>
    </body>
</html>
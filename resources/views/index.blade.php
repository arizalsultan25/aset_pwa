<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Keperluan PWA --}}
    <link rel="icon" href="{{ asset('icon/Logo.png') }}" type="image/png">
    <link rel="manifest" href="{{ asset('manifest.json?v2') }}">
    <!-- Add to home screen untuk Safari iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Template PWA" />
    <link rel="apple-touch-icon" href="{{ asset('icon/logo192.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('icon/logo192.png') }}" />
    <meta name="msapplication-TileColor" content="#20c997" />
    <meta name="theme-color" content="#20c997" />
    <meta name="description" content="Sistem Manajemen Aset dengan Progressive Web Application.">

    <link rel="canonical" href="https://localhost:8080/" />

    {{-- Preload --}}
    
    {{-- <link rel="preload" href="{{ asset('js/app.js') }}" as="script"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    <title>Aset Tree</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">


    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
</head>

<body class="layout-navbar-fixed layout-fixed">

    <div class="wrapper">
        <div id="dw">
            <app></app>
        </div>
    </div>

{{-- App Js --}}
<script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- ChartJS -->
    {{-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>



    <script>
        if ('serviceWorker' in navigator) {
            // Register service worker
            navigator.serviceWorker.register('sw.js').then(function (reg) {
                console.log("SW registration succeeded. Scope is " + reg.scope);
            }).catch(function (err) {
                console.error("SW registration failed with error " + err);
            });
        }

    </script>
    <script src="{{ asset('A2HS.js') }}"></script>

</body>

</html>

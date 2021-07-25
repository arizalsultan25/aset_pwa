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

    <link rel="canonical" href="https://google.com/" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">


    <title>Aset Tree</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">


    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro --
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}} -->

    <!-- Fonts and icons -->
	<script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/atlantis.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    
</head>

<body class="layout-navbar-fixed layout-fixed" data-background-color="bg3">

    <div class="wrapper">
        <div id="dw">
            <app></app>
        </div>
    </div>

    <!-- App Js -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- jQuery --
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 --
    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- ChartJS --
    {{-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script> --}}
    <!-- AdminLTE App --
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes --
    <script src="{{ asset('dist/js/demo.js') }}"></script> -->

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/core/popper.min.js') }}"></script>
	<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('js/atlantis.min.js') }}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('js/setting-demo.js') }}"></script>
	<script src="{{ asset('js/demo.js') }}"></script>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset("/img/apple-icon.png") }}">
    <link rel="icon" type="image/png" href="{{ asset("/img/favicon.png") }}">
    <title>
        @yield('title')
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Fonts and icons End -->
    <!-- Nucleo Icons -->
    <link href="{{ asset("/css/nucleo-icons.css") }}" rel="stylesheet" />
    <link href="{{ asset("/css/nucleo-svg.css") }}" rel="stylesheet" />
    <!-- Nucleo Icons End-->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset("/css/nucleo-svg.css") }}" rel="stylesheet" />
    <!-- Font Awesome Icons End-->
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset("/css/soft-ui-dashboard.css") }}" rel="stylesheet" />
    <!-- CSS Files End-->
    @yield('custom-style')
</head>

<body>
    @yield('content')
    <!-- Core JS Files -->
    <script src="{{ asset("/js/core/popper.min.js") }}"></script>
    <script src="{{ asset("/js/core/bootstrap.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/perfect-scrollbar.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/smooth-scrollbar.min.js") }}"></script>
    <!-- End Core JS Files -->
    <!-- Kanban scripts -->
    <script src="{{ asset("/js/plugins/dragula/dragula.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/jkanban/jkanban.js") }}"></script>
    <script src="{{ asset("/js/plugins/chartjs.min.js") }}"></script>
    <script src="{{ asset("/js/plugins/threejs.js") }}"></script>
    <script src="{{ asset("/js/plugins/orbit-controls.js") }}"></script>
    <!-- End Kanban scripts -->
    <!-- Additional Scripts -->
    <script src="{{ asset("/js/jquery-3.6.1.js") }}"></script>
    <!-- End Additional Scripts -->
    @yield('javascript')
</body>
</html>

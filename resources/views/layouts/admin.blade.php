<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'On Call Title Service') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}">
    <!-- Full calendar -->
    <link href='{{ asset('admin/fullcalendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('admin/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('admin/fullcalendar/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('admin/fullcalendar/list/main.css') }}' rel='stylesheet' />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <style>
        .fal, .far, .fas {
            font-family: "Font Awesome 5 Pro"!important;
        }
    </style>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes

</head>
<body>
<div id="loading">
    <div id="loading-center">
    </div>
</div>
@inertia

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<!-- Appear JavaScript -->
<script src="{{ asset('admin/js/jquery.appear.js') }}"></script>
<!-- Countdown JavaScript -->
<script src="{{ asset('admin/js/countdown.min.js') }}"></script>
<!-- Counterup JavaScript -->
<script src="{{ asset('admin/js/waypoints.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.counterup.min.js') }}"></script>
<!-- Wow JavaScript -->
<script src="{{ asset('admin/js/wow.min.js') }}"></script>
<!-- Apexcharts JavaScript -->
<script src="{{ asset('admin/js/apexcharts.js') }}"></script>
<!-- Slick JavaScript -->
<script src="{{ asset('admin/js/slick.min.js') }}"></script>
<!-- Select2 JavaScript -->
<script src="{{ asset('admin/js/select2.min.js') }}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{ asset('admin/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{ asset('admin/js/smooth-scrollbar.js') }}"></script>
<!-- lottie JavaScript -->
<script src="{{ asset('admin/js/lottie.js') }}"></script>
<!-- am core JavaScript -->
<script src="{{ asset('admin/js/core.js') }}"></script>
<!-- am charts JavaScript -->
<script src="{{ asset('admin/js/charts.js') }}"></script>
<!-- am animated JavaScript -->
<script src="{{ asset('admin/js/animated.js') }}"></script>
<!-- am kelly JavaScript -->
<script src="{{ asset('admin/js/kelly.js') }}"></script>
<!-- Flatpicker Js -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('admin/js/chart-custom.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('admin/js/custom.js') }}"></script>

<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>

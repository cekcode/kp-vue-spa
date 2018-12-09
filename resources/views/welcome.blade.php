<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Welcome Page</title>
         <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/colors/blue.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>

       
    </head>
    <body class="gray">>
    <!-- Wrapper -->
    <div id="wrapper">
        <div id="app">
            <main-app/>
        </div>
    </div>

        <!-- Scripts
        ================================================== -->
        <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-migrate-3.0.0.min.js') }}"></script>
        <script src="{{ asset('frontend/js/mmenu.min.js') }}"></script>
        <script src="{{ asset('frontend/js/tippy.all.min.js') }}"></script>
        <script src="{{ asset('frontend/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap-slider.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('frontend/js/snackbar.js') }}"></script>
        <script src="{{ asset('frontend/js/clipboard.min.js') }}"></script>
        <script src="{{ asset('frontend/js/counterup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
        <script src="{{ asset('frontend/js/custom.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>

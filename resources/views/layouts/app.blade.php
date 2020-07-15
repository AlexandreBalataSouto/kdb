<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--MATERIALIZE CSS Compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Compiled icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--END MATERIALIZE-->

</head>
<body>
    <div id="app" class="container section">
        <div class="row" id="main">
            @yield('content')
        </div>
        <div class="row">
            <div class="footerCopyright">
                <div class="container">
                    © {{\Carbon\Carbon::today()->isoFormat('Y')}} Copyright Alexandre Manuel Balata Souto
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tooltips = document.querySelectorAll('.tooltipped');
        instances = M.Tooltip.init(tooltips);

        $(".boxGifLoading").css("display","none");

        $("button[type='submit']").click(function(){ //Mostrar spinner para evitar duplicar insercion de datos
            $(".boxGifLoading").css("display","flex");
        });
    });
</script>
</html>
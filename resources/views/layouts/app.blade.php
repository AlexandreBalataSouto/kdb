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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Compiled icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--END MATERIALIZE-->

</head>
<style>
    #app {
        width: 100%;
    }

    .card-action > .row > .col.s12.m12.l8 > button,a{
        margin-top: 2%;
    }

    .boxGifLoading {
        position: absolute;
        top: 0%;
        bottom: 0%;
        right: 0%;
        left: 0%;
        z-index: 1;
        display: none;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .input-field label {
        /*Para los caracteres de los formularios sean negros*/
        color: black;
    }

    strong {
        color: red;
    }

    .btn.waves-effect.waves-light.red {
        float: right;
    }

    .footerCopyright {
        text-align: center;
        left: 0%;
        bottom: 0%;
        width: 100%;
    }
</style>

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
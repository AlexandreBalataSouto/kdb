<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--MATERIALIZE CSS Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!--END MATERIALIZE-->
    <title>KDB</title>

</head>

<style>
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .full-height {
        height: 100vh;
    }
    .position-ref {
        position: relative;
    }
    .content {
        width: 100%;
        text-align: center;
    }
    .title {
        font-size: 84px;
        color: #26A69A;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .footerCopyright{
        text-align: center;
        left: 0%;
        bottom: 0%;
        width: 100%;
    }
</style>

<body>
    <div class="container section flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                KDB
            </div>
            <div>
                @if (Route::has('login'))
                <div class="welcomeButtons">
                    @auth
                    <a class="btn waves-effect waves-light" href="{{ route('karatecas.index') }}">{{ __('Access to KDB') }}</a>
                    @else
                    <a class="btn waves-effect waves-light" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if ($user == null)
                    <a class="btn waves-effect waves-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
            <br>
            <div class="footerCopyright">
                <div class="container">
                    © {{\Carbon\Carbon::today()->isoFormat('Y')}} Copyright Alexandre Manuel Balata Souto
                </div>
            </div>
        </div>
    </div>
</body>

</html>
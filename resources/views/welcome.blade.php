<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <!--MATERIALIZE CSS Compiled and minified CSS -->
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <!--END MATERIALIZE-->
    <title>KDB</title>

</head>
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
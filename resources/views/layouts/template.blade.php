<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KDB</title>
</head>

<link rel="stylesheet" href="{{ asset('css/template.css') }}">
<link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

<!--MATERIALIZE-->
<!-- Compiled icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--END MATERIALIZE-->

<!--DROPZONE-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"
    integrity="sha256-OG/103wXh6XINV06JTPspzNgKNa/jnP1LjPP5Y3XQDY=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css" rel="stylesheet">
<!--END DROPZONE-->

<!--MOMENT JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
    integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<!--END MOMENT JS-->
<body>
    <div class="container">
        <div class="row">
            <!--Menu Navbar-->
            <nav class="menu">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li>
                            @if (\App\Monitor::first()!=null && \App\Monitor::first()->fotosMonitor()->first()!=null)
                            <a href="#">
                                <img src="{{Storage::url(\App\Monitor::first()->fotosMonitor()->orderBy('id_foto_monitor','DESC')->first()->path)}}"
                                    class="circle imagenPerfil">
                            </a>
                            @else
                            <img src="{{URL::asset('img/fotoDefault.jpg')}}" alt="foto por defecto"
                                class="circle imagenPerfil">
                            @endif
                        </li>
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdownLogOut">
                                <span class="name white-text">
                                    {{ Auth::user()->name }}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdownFichasKaratecas">
                                Fichas Karatecas
                                <i class="material-icons left">folder_shared</i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('faltas.index')}}">
                                Asistencias
                                <i class="material-icons left">playlist_add_check</i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('eventos.index')}}">
                                Eventos
                                <i class="material-icons left">event</i>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdownBajas">
                                Bajas
                                <i class="material-icons left">delete</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul id="dropdownLogOut" class="dropdown-content">
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <ul id="dropdownFichasKaratecas" class="dropdown-content">
                    <li>
                        <a href="{{route('karatecas.index')}}"><i class="material-icons left">people</i><br> Fichas
                            Alumnos</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{route('monitores.index')}}"><i class="material-icons left">school</i><br> Fichas
                            Monitores</a>
                    </li>
                </ul>
                <ul id="dropdownBajas" class="dropdown-content">
                    <li>
                        <a href="{{route('viewTrashKarateca')}}"><i class="material-icons left">people</i><br> Bajas
                            Alumnos</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{route('viewTrashMonitor')}}"><i class="material-icons left">school</i><br> Bajas
                            Monitores</a>
                    </li>
                </ul>

            </nav>
            <!--END Menu Navbar-->

            <!--Menu Hamburger-->
            <div class="menuBurger">
                <a href="#" class="sidenav-trigger" data-target="menu-side">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="sidenav" id="menu-side">
                    <li>
                        <div class="user-view">
                            <div class="background"></div>
                            <a href="#">
                                @if (\App\Monitor::first()!=null &&
                                \App\Monitor::first()->fotosMonitor()->first()!=null)
                                <a href="#">
                                    <img src="{{Storage::url(\App\Monitor::first()->fotosMonitor()->orderBy('id_foto_monitor','DESC')->first()->path)}}"
                                        class="circle">
                                </a>
                                @else
                                <img src="{{URL::asset('img/fotoDefault.jpg')}}" alt="foto por defecto" class="circle">
                                @endif
                            </a>

                            <a class='dropdown-trigger' href='#' data-target='dropdownUserName'>
                                <span class="name white-text">{{ Auth::user()->name }}
                                    <i class="tiny material-icons">arrow_drop_down</i>
                                </span>
                            </a>
                            <ul id='dropdownUserName' class='dropdown-content teal lighten-2'>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Log out') }}
                                    </a>

                                    <form class="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                            <span class="email white-text">{{ Auth::user()->email }}</span>
                        </div>
                    </li>
                    <li>
                        <a class='dropdown-trigger' href='#' data-target='dropdown1'>
                            <i class="material-icons">folder_shared</i>
                            Fichas Karatecas
                        </a>
                        <ul id='dropdown1' class='dropdown-content teal lighten-2'>
                            <li>
                                <a href="{{route('karatecas.index')}}">
                                    <i class="material-icons">people</i>Fichas Alumnos
                                </a>
                            </li>
                            <li>
                                <a href="{{route('monitores.index')}}">
                                    <i class="material-icons">school</i>Fichas Monitores
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li>
                        <a href="{{route('faltas.index')}}">
                            <i class="material-icons">playlist_add_check</i>
                            Asistencias
                        </a>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li>
                        <a href="{{route('eventos.index')}}">
                            <i class="material-icons">event</i>
                            Eventos
                        </a>
                    </li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li>
                        <a class='dropdown-trigger' href='#' data-target='dropdown2'>
                            <i class="material-icons">delete</i>
                            Bajas
                        </a>
                        <ul id='dropdown2' class='dropdown-content teal lighten-2'>
                            <li>
                                <a href="{{route('viewTrashKarateca')}}"><i class="material-icons">people</i>
                                    Bajas Alumnos
                                </a>
                            </li>
                            <li>
                                <a href="{{route('viewTrashMonitor')}}"><i class="material-icons">school</i>
                                    BajasMonitores
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--END Menu Hamburger-->
            @yield('contenido')
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

<script src="{{ asset('js/template.js') }}"></script>
<script>
    @if(Session::has('message'))
     var type = "{{ Session::get('alert-type', 'info') }}";
     switch(type){
         case 'info':
             toastr.info("{{ Session::get('message') }}");
             break;

         case 'warning':
             toastr.warning("{{ Session::get('message') }}");
             break;

         case 'success':
             toastr.success("{{ Session::get('message') }}");
             break;

         case 'error':
             toastr.error("{{ Session::get('message') }}");
             break;
         }
 @endif
 
</script>
</html>
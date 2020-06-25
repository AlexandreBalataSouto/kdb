<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KDB</title>
</head>

<!--JQUERY-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--END JQUERY-->

<!--DATATABLE-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
</script>

<!--responsive-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<!--END DATATABLE-->

<!--MATERIALIZE CSS Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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

<!--FULLCALENDAR-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"
    integrity="sha256-GBryZPfVv8G3K1Lu2QwcqQXAO4Szv4xlY4B/ftvyoMI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"
    integrity="sha256-FT1eN+60LmWX0J8P25UuTjEEE0ZYvpC07nnU6oFKFuI=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css"
    integrity="sha256-Lfe6+s5LEek8iiZ31nXhcSez0nmOxP+3ssquHMR3Alo=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css"
    integrity="sha256-AVsv7CEpB2Y1F7ZjQf0WI8SaEDCycSk4vnDRt0L2MNQ=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"
    integrity="sha256-MUHmW5oHmLLsvmMWBO8gVtKYrjVwUSFau6pRXu8dtnA=" crossorigin="anonymous"></script>
<!--END FULLCALENDAR-->

<!--TOASTR-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!--END TOASTR-->

<style>
    body,
    html {
        width: 100%;
    }

    #calendar { /*Asistencias / Eventos*/
        width: 100%;
    }

    .menuBurger {
        /*Oculto*/
        display: none;
        background-color: #26A69A;
    }

    .sidenav-trigger>i { /*Color del icono menu*/
        color: white;
        margin-left: 4%;
        font-size: 3rem;
    }

    .menu {
        background-color: #26A69A;
    }

    .background { /*Color de fondo del Menu*/
        background: #26A69A;
    }

    .responsive-img { /*Img de los listados y fichas*/
        width: 6rem;
    }

    .imagenPerfil{ /*Img del menu*/
        width: 2.4rem;
    }

    .card-image .documento{ /*Documentos*/
        width: 100%;
        height: 20em;
    }
    .card-image img { /*Fotos*/
        width: 100%;
        height: 32em;
    }
    .card-image{ /*grid de fotos y documentos*/
        display: flex;
        flex-wrap: wrap;
    }

    .borderGreyImg { /*Border gris para las fotos y documentos*/
        border: 3px solid #9e9e9e;
    }

    #firstImg { /*Fotos karateca y monitores*/
        border: 3px solid #26A69A;
    }

    .floatRight { /*Botones a la derecha*/
        float: right;
    }

    .floatLeft {/*Botones a la izquierda*/
        float: left;
    }

    .browser-default { /*Color del select por defecto*/
        border-bottom: 1px solid #9e9e9e;
    }

    th,
    td {
        text-align: center;
    }

    .input-field label,
    input::placeholder,
    textarea::placeholder { /*Para los caracteres de los formularios sean negros*/
        color: black;
    }

    .requiredInput { /*Colorea el asterisco de los campos obligatorios*/
        color: red;
    }

    .errorValidation {
        color: red;
    }

    .closeModal {
        color: gray;
    }

    .boxGifLoading {
        position: fixed;
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

    .footerCopyright {
        text-align: center;
        left: 0;
        bottom: 0;
        width: 100%;
    }

    @media (max-width: 1295px) {
        .menuBurger {
            display: block;
        }

        .menu {
            display: none;
        }
    }
</style>

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

<script>
    $(".boxGifLoading").css("display","none");

    $("button[type='submit']").click(function(e){
        $(".boxGifLoading").css("display","flex");
    });

    //Para iniciar las funciones de materialize
    document.addEventListener('DOMContentLoaded', function() {
        let modals = document.querySelectorAll('.modal');
        var instances = M.Modal.init(modals,{
            dismissible: false,
        });
        
        let sidenav = document.querySelectorAll('.sidenav');
        instances = M.Sidenav.init(sidenav);

        let dropdowns = document.querySelectorAll('.dropdown-trigger');
        instances = M.Dropdown.init(dropdowns);

        let tooltips = document.querySelectorAll('.tooltipped');
        instances = M.Tooltip.init(tooltips);
    });

    //Configuracion de dropzone
    Dropzone.options.dropzoneForm = {
            maxFiles:4,
            acceptedFiles: "image/jpeg,image/png,image/jpg",
            dictDefaultMessage:"Suba sus archivos aqui",
            dictMaxFilesExceeded :"Ha excedido el numero de archivos",
            dictInvalidFileType :"No puedes subir este tipo de imagen. Solo .jpeg/.png/.jpg",

            init: function(){
                myDropzone = this;
                var submitButton = document.querySelector("#botonSubirArchivo");
                submitButton.addEventListener("click",function(){//Limpiar dropzone
                    if(myDropzone.getQueuedFiles().length == 0 && myDropzone.getUploadingFiles().length == 0){
                        myDropzone.removeAllFiles();
                        $("#botonSubirArchivo").hide();
                        $(".closeModal").show();
                    }
                });
                this.on("addedfiles",function(){ //Funcion para cuando se suben archivos
                    $(".closeModal").hide();
                });
                this.on("complete",function(){//Funcion para cuando se terminan de subir los archivos
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        $("#botonSubirArchivo").show();
                    }
                });
            },
        };

    function fotoPreVisual(input){ //Previsualizar foto en creacion de fichas
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#fotoFormCreate").attr("src",e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    M.updateTextFields(); //Actualizar text fields

    toastr.options = {
     "closeButton": false,
     "debug": false,
     "newestOnTop": false,
     "progressBar": false,
     "positionClass": "toast-top-right",
     "preventDuplicates": false,
     "onclick": null,
     "showDuration": "300",
     "hideDuration": "1000",
     "timeOut": "4000",
     "extendedTimeOut": "1000",
     "showEasing": "swing",
     "hideEasing": "linear",
     "showMethod": "fadeIn",
     "hideMethod": "fadeOut"
    }

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
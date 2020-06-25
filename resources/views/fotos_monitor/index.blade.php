@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s9 m9 l9">
                <span class="card-title">Fotos de {{$monitor->nombre}} {{$monitor->apellidos}}</span>
            </div>
            <div class="col s3 m3 l3">
                <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                    href="{{route('monitores.show', $monitor->id_monitor)}}" data-position="left"
                    data-tooltip="Volver a la ficha">
                    <i class="material-icons">undo</i>
                </a>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
                <a href="#modalAlbum" class="waves-effect waves-light btn modal-trigger">Subir foto</a>
            </div>
        </div>

        <div class="cajaAlbum col s12 m12 l12" data-id={{$monitor->id_monitor}}>
            @include('fotos_monitor.album_monitor')
        </div>

        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>
    </div>
</div>


<div id="modalAlbum" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s11 m11 l11">
                <h4>Subir foto de {{$monitor->nombre}} {{$monitor->apellidos}}</h4>
            </div>
            <div class="col s1 m1 l1">
                <a href="#" class="closeModal"><i class="material-icons">close</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <form action="{{route('fotosMonitorStore', $monitor->id_monitor) }}" class="dropzone" method="post"
                    enctype="multipart/form-data" id="dropzoneForm">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn modal-close" id="botonSubirArchivo">Subir Foto</a>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#botonSubirArchivo").hide();

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault(); 
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });

        function fetch_data(page){
            let id_monitor = $(".cajaAlbum").data("id");

            $.ajax({
                url:"/pagination_monitor/fetch_data?page="+page,
                data:{
                    id_monitor:id_monitor
                },
                success:function(data){
                    $(".cajaAlbum").html(data);
                }
            });
        }
        
        $("#botonSubirArchivo").click(function(){
            refreshAlbum();
        })

        function refreshAlbum(){
            let id_monitor = $(".cajaAlbum").data("id");
            let route = "{{route('refreshAjaxFotoMonitor','id_monitor')}}"
            route = route.replace('id_monitor',id_monitor);

            $.ajax({
                url:route,
                success:function(data){
                    $(".cajaAlbum").html(data);
                }
            });
        }

        $(".cajaAlbum").on("click","#botonBorrarFoto",function(){
            let id_foto_monitor = $(this).closest(".col.s12.m6.l4").data("id");

            $.ajax({
                type:"POST",
                url:"{{route('deleteAjaxFotoMonitor')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    id_foto_monitor: id_foto_monitor,
                },
                success: function(){
                    toastr.success('Foto eliminada');
                    refreshAlbum();
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
        });

        $(".closeModal").click(function(){
            $('.modal').modal('close', modalAlbum);
        });
    });

</script>
@endsection
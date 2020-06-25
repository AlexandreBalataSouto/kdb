@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s9 m9 l9">
                <span class="card-title">Documentos de {{$karateca->nombre}} {{$karateca->apellidos}}</span>
            </div>
            <div class="col s3 m3 l3">
                <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                    href="{{route('karatecas.show', $karateca->id_karateca)}}" data-position="left"
                    data-tooltip="Volver a la ficha">
                    <i class="material-icons">undo</i>
                </a>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
                <a href="#modalFichero" class="waves-effect waves-light btn modal-trigger">Subir documento</a>
            </div>
        </div>

        <div class="cajaFichero col s12 m12 l12" data-id={{$karateca->id_karateca}}>
            @include('documentos.fichero')
        </div>
        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>
    </div>
</div>

<div id="modalFichero" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s11 m11 l11">
                <h4>Subir documento de {{$karateca->nombre}} {{$karateca->apellidos}}</h4>
            </div>
            <div class="col s1 m1 l1">
                <a href="#" class="closeModal"><i class="material-icons">close</i></a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <form action="{{route('documentosStore', $karateca->id_karateca) }}" class="dropzone" method="post"
                    enctype="multipart/form-data" id="dropzoneForm">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn modal-close" id="botonSubirArchivo">Subir Documento</a>
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
            let id_karateca = $(".cajaFichero").data("id");

            $.ajax({
                url:"/pagination_documento/fetch_data?page="+page,
                data:{
                    id_karateca:id_karateca
                },
                success:function(data){
                    $(".cajaFichero").html(data);
                }
            });
        }

        $("#botonSubirArchivo").click(function(){
            refreshAlbum();
        })

        function refreshAlbum(){
            let id_karateca = $(".cajaFichero").data("id");
            let route = "{{route('refreshAjaxDocumento','id_karateca')}}"
            route = route.replace('id_karateca',id_karateca);

            $.ajax({
                url:route,
                success:function(data){
                    $(".cajaFichero").html(data);
                }
            });
        }

        $(".cajaFichero").on("click","#botonBorrarDocumento",function(){
            let id_documento = $(this).closest(".col.s12.m6.l4").data("id");
            let div =  $("div[data-id="+id_documento+"]");

            $.ajax({
                type:"POST",
                url:"{{route('deleteAjaxDocumento')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    id_documento: id_documento,
                },
                success: function($){
                    toastr.success('Documento eliminado');
                    refreshAlbum();
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
        });

        $(".closeModal").click(function(){
            $('.modal').modal('close', modalFichero);
        });
    });

</script>
@endsection
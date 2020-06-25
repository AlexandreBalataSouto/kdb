@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s12 m12 l12">
                <span class="card-title">Listado de karatecas</span>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <a href="{{ route('karatecas.create') }}" class="waves-effect waves-light btn">
                    <i class="material-icons right">add</i>
                    {{__('New karateca')}}
                </a>
            </div>
            <div class="input-field col s12 m12 l12">
                <div>
                    <i class="material-icons">people</i><strong>Numero de karatecas:</strong>
                    <span class="numAlumnos">{{$numeroKaratecas}}<span>
                </div>
            </div>
            <div class="input-field col s12 m12 l12">
                <table id="tablaDataTable" class="table display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{__('Photo')}}</th>
                            <th>Karateca</th>
                            <th>Categoría</th>
                            <th>Ficha</th>
                            <th>{{__('Delete')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karatecas as $karateca)
                        <tr data-karateca={{$karateca->id_karateca}}>

                            @if($karateca->fotosKarateca()->first()!=null)
                            <td><img src="{{Storage::url($karateca->fotosKarateca()->orderBy('id_foto_karateca','DESC')->first()->path)}}"
                                    class="responsive-img"></td>
                            @else
                            <td><img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img"></td>
                            @endif
                            <td class="nombreCompleto">{{ $karateca->nombre_completo}}</td>
                            <td>{{ $karateca->categoria->nombre_categoria}}</td>

                            <td>
                                <a href="{{route('karatecas.show', $karateca->id_karateca)}}"
                                    class="btn btn-floating btn-medium waves-effect waves-light blue">
                                    <i class="material-icons">search</i>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-floating btn-medium waves-effect waves-light red"
                                    id="botonBorrarKarateca" data-id={{$karateca->id_karateca}}>
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        $('#tablaDataTable').DataTable({
            responsive: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                { "targets": [0,2,3,4], "searchable": false },
                { "orderable": false, "targets": [0,1,2,3,4] }
            ],
        language: {
				"decimal": "",
				"emptyTable": "No hay informacion",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
        });

        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });

        $("#tablaDataTable").on("click","#botonBorrarKarateca",function(){
            let id_karateca = $(this).data("id");

            let tr = $("tr[data-karateca="+id_karateca+"]");
            let tdChild = $(tr).next(".child");

            $.ajax({
                type:"POST",
                url:"{{route('deleteAjaxKarateca')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    id_karateca: id_karateca,
                },
                success: function($numeroKaratecas){
                    toastr.success('Karateca eliminado');
                    tr.fadeOut();
                    if(tdChild != null){
                            tdChild.fadeOut();
                        }
                    $(".numAlumnos").text($numeroKaratecas);
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
        });
    });
</script>

@endsection
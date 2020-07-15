@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s9 m9 l9">
                <span class="card-title">Competidores de {{$competicion->title}}</span>
                <input type="hidden" value="{{$competicion->id_competicion}}" id="id_competicion">
            </div>
            <div class="col s3 m3 l3">
                <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                    href="{{route('eventos.index')}}" data-position="left"
                    data-tooltip="Volver al calendario de eventos">
                    <i class="material-icons">undo</i>
                </a>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="input-field col s12 m12 l12">
                <button class="btn waves-effect waves-light" id="botonModalCompetidores">
                    <i class="material-icons right">add</i>
                    Añadir Competidores
                </button>
            </div>
            <div id="cajaDataTableCompetidores">
                @include("competiciones.competicion_competidores")
            </div>
        </div>
        <div class="boxGifLoading">
            <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
        </div>
    </div>
</div>
<!--Modal Competidores-->
<div class="modal" id="modalCompetidores">
    <div class="modal-content">
        <div class="row">
            <div class="col s11 m11 l11">
                <h5>Selecionar competidores</h5>
            </div>
            <div class="col s1 m1 l1">
                <a href="#" class="closeModal"><i class="material-icons">close</i></a>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <table id="tablaDataTable" class="table display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{__('Selection')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>Karateca</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karatecas as $karateca)
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox" class="karateca" value="{{$karateca->id_karateca}}" />
                                    <span></span>
                                </label>
                            </td>

                            @if($karateca->fotosKarateca()->first()!=null)
                            <td><img src="{{Storage::url($karateca->fotosKarateca()->orderBy('id_foto_karateca','DESC')->first()->path)}}"
                                    class="responsive-img"></td>
                            @else
                            <td><img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img"></td>
                            @endif

                            <td class="nombreCompleto">{{ $karateca->nombre_completo}}</td>
                            <td>{{ $karateca->categoria->nombre_categoria}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn waves-effect waves-light" id="botonAñadirCompetidor">Añadir Participantes</button>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = $('#tablaDataTable').DataTable({
            responsive: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                { "targets": [0,1,3], "searchable": false },
                { "orderable": false, "targets": [0,1,2,3] }
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

        let id_competicion = $("#id_competicion").val();
        let karatecas = [];
        let competidores = [];
        let index;

        table.on("click",".karateca",function(){ //Checks de la tabla karatecas en el MODAL
            if($(this).is(":checked")){
                karatecas.push($(this).val());
            }else{
                index = karatecas.indexOf($(this).val());
                karatecas.splice(index,1);
            }
        });

        $("#cajaDataTableCompetidores").on("click",".competidor",function(){ //Checks de la tabla competidores
            if($(this).is(":checked")){
                competidores.push($(this).val());
            }else{
                index = competidores.indexOf($(this).val());
                competidores.splice(index,1);
            }
        });

        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });

        $("#botonAñadirCompetidor").click(function(){ // Boton del MODAL que añade los karatecas
            $('.modal').modal('close', modalCompetidores);

            if(karatecas.length > 0){
                $.ajax({
                type:"POST",
                url:"{{route('addAjaxCompetidoresCompeticion')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    karatecas: karatecas,
                    id_competicion: id_competicion
                },
                success: function(){
                    toastr.success('Competidores añadidos');
                    resetAllCheckbox();
                    karatecas = [];
                    refreshTable();
                   
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
            }else{
                toastr.error('¡No has seleccionado ningun karateca!');
            }
        });

        $("#cajaDataTableCompetidores").on("click","#botonBorrarCompetidores",function(){ //Boton de la vista que elimina competidores
            if(competidores.length > 0){
                $.ajax({
                type:"POST",
                url:"{{route('deleteAjaxCompetidoresCompeticion')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    competidores: competidores,
                    id_competicion: id_competicion
                },
                success: function(){
                    toastr.success('Competidores eliminados');
                    resetAllCheckbox();
                    competidores = [];
                    refreshTable();
                   
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
            }else{
                toastr.error('¡No has seleccionado ningun competidor!');
            }
        });

        $("#cajaDataTableCompetidores").on("change","#puesto",function(){
            let id_competicion = $("#id_competicion").val();
            let id_karateca =  $(this).data("competidor");
            let puesto = $(this).val();
            
            $.ajax({
                type:"POST",
                url:"{{route('updateAjaxPuestoCompetidor')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    id_competicion: id_competicion,
                    id_karateca: id_karateca,
                    puesto: puesto
                    
                },
                success:function(){
                    toastr.success('Puesto editado');
                    $(`tr[data-id=${id_karateca}] #puesto option`).removeAttr("selected");
                    $(`tr[data-id=${id_karateca}] #puesto option[value=${puesto}]`).attr("selected",true);
                }
            }).fail(function(){
                toastr.error('ERROR UPDATE PUESTO');
            });
        });

        function refreshTable(){ //Refrescar tabla
            let id_competicion = $("#id_competicion").val();
            let route = "{{route('refreshAjaxCompetidoresCompeticion','id_competicion')}}"
            route = route.replace('id_competicion',id_competicion);
            
            $.ajax({
                url:route,
                success:function(data){
                    $("#cajaDataTableCompetidores").html(data);
                }
            });
        }

        function resetAllCheckbox(){ //Reiniciamos todos los checkbox en todas las paginas
           var cells = table.cells().nodes();
           $(cells).find(".karateca").prop("checked", false);
        }
        
        $("#botonModalCompetidores").click(function(){ //Abrir modal
            $('.modal').modal('open', modalCompetidores);
            table.responsive.recalc(); //Recalculamos el datatable dentro del modal
        });
        $(".closeModal").click(function(){ //Cerrar modal al hacer click sobre la X
            $('.modal').modal('close', modalCompetidores);
        });
    });
</script>
@endsection
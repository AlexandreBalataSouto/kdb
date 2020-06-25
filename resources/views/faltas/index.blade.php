@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s12 m12 l12">
                <span class="card-title">Listado de faltas</span>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <a href="#" class="waves-effect waves-light btn" id="botonAñadirFalta">
                    <i class="material-icons right">add</i>
                    {{__('Add non-attendance')}}
                </a>
            </div>
            <div class="input-field col s7 m4 l3">
                <input type="date" name="fechaFalta" class="fechaFalta" value="{{date('Y-m-d')}}" />
                <label for="fechaFalta">Fecha de alta</label>
            </div>

            <div class="input-field col s12 m12 l12">
                <table id="tablaDataTable" class="table display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{__('Selection')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>Karateca</th>
                            <th>Categoría</th>
                            <th>{{__('Non-attendance')}}</th>
                            <th>{{__('Show')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karatecas as $karateca)
                        <tr data-id={{$karateca->id_karateca}}>
                            <td>
                                <label>
                                    <input type="checkbox" class="faltaAlumnos" value="{{$karateca->id_karateca}}" />
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

                            <td class="faltasCount">{{$karateca->faltas()->count()}}</td>

                            <td>
                                <a href="{{route('faltas.show', $karateca->id_karateca)}}"
                                    class="btn btn-floating btn-large waves-effect waves-light blue">
                                    <i class="material-icons">search</i>
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

       let table = $('#tablaDataTable').DataTable({
            responsive: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                { "targets": [0,1,3,4,5], "searchable": false },
                { "orderable": false, "targets": [0,1,2,3,4,5] }
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

        let faltaAlumnosId = [];
        let fechaFalta;
        let faltasCount;
        let index;

        table.on("click",".faltaAlumnos",function(){
            if($(this).is(":checked")){
                faltaAlumnosId.push($(this).val());
                index = faltaAlumnosId.indexOf($(this).val());

                faltasCount =  $(`tr[data-id=${faltaAlumnosId[index]}]`).find(".faltasCount").text();
                faltasCount = parseInt(faltasCount);
                faltasCount++;

                $(`tr[data-id=${faltaAlumnosId[index]}]`).find(".faltasCount").text(faltasCount);
                
                 //Mobile version
                $(`tr[data-id=${faltaAlumnosId[index]}]`).next(".child").find("li[data-dtr-index='4'] .dtr-data").text(faltasCount);
                
            }else{
                index = faltaAlumnosId.indexOf($(this).val());

                faltasCount = $(`tr[data-id=${faltaAlumnosId[index]}]`).find(".faltasCount").text();
            
                faltasCount = parseInt(faltasCount);
                faltasCount--;

                $(`tr[data-id=${faltaAlumnosId[index]}]`).find(".faltasCount").text(faltasCount);

                 //Mobile version
                $(`tr[data-id=${faltaAlumnosId[index]}]`).next(".child").find("li[data-dtr-index='4'] .dtr-data").text(faltasCount);

                faltaAlumnosId.splice(index,1);  
                
            }
        });

        table.on('responsive-display', function (e, datatable, row, showHide, update) {
            let trId= $(row.node()).data("id");
            faltasCount = $(`tr[data-id=${trId}]`).find(".faltasCount").text();
           
            if(showHide){
                //Mobile version
                $(`tr[data-id=${trId}]`).next(".child").find("li[data-dtr-index='4'] .dtr-data").text(faltasCount);
            }
        });
       
        $(document).ajaxStart(function(){
           $(".boxGifLoading").css("display","flex");
        });

        $(document).ajaxStop(function(){
            $(".boxGifLoading").css("display","none");
        });

        $("#botonAñadirFalta").click(function(){
            fechaFalta = $(".fechaFalta").val();

            if(faltaAlumnosId.length > 0){
                $.ajax({
                type:"POST",
                url:"{{route('addAjaxFalta')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    faltaAlumnosId: faltaAlumnosId,
                    fechaFalta: fechaFalta
                },
                success: function(){
                    toastr.success('Faltas añadidas');
                    resetAllCheckbox();
                    faltaAlumnosId = [];
                    faltasCount = 0;
                   
                }
            }).fail(function(){
                toastr.error('ERROR');
            });
            }else{
                toastr.error('¡No has seleccionado ningun alumno!');
            } 
        });

        function resetAllCheckbox(){ //Reiniciamos todos los checkbox en todas las paginas
           var cells = table.cells().nodes();
           $(cells).find(".faltaAlumnos").prop("checked", false);
        }
        
    });
</script>
@endsection
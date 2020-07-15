@extends('layouts/template')
@section('contenido')

<div class="card">
    <div class="row card-content">
        <div class="row">
            <div class="col s12 m12 l12">
                <span class="card-title">Listado de bajas Monitor</span>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <label>
                    <i class="material-icons">people</i>{{__('Number of instructors')}}:
                    <span class="numMonitores">{{$numeroMonitores}}<span>
                </label>
            </div>
            <div class="input-field col s12 m12 l12">
                <table id="tablaDataTable" class="table display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{__('Photo')}}</th>
                            <th>{{__('Instructor')}}</th>
                            <th>Recuperar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitores as $monitor)
                        <tr data-monitor={{$monitor->id_monitor}}>

                            @if($monitor->fotosMonitor()->onlyTrashed()->first()!=null)
                            <td><img src="{{Storage::url($monitor->fotosMonitor()->onlyTrashed()->orderBy('id_foto_monitor','DESC')->first()->path)}}"
                                    class="responsive-img"></td>
                            @else
                            <td><img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img"></td>
                            @endif
                            <td class="nombreCompleto">
                                {{ $monitor->nombre_completo}}
                            </td>
                            <td>
                                <a href="#" class="btn btn-floating btn-medium waves-effect waves-light"
                                    id="botonRecuperarMonitor" data-id={{$monitor->id_monitor}}>
                                    <i class="material-icons">refresh</i>
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
    document.addEventListener('DOMContentLoaded', function() {
        $('#tablaDataTable').DataTable({
            responsive: true,
            pageLength: 5,
            bLengthChange: false,
            columnDefs: [
                { "targets": [0,2], "searchable": false },
                { "orderable": false, "targets": [0,1,2] }
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
        
        $("#tablaDataTable").on("click","#botonRecuperarMonitor",function(){
            let id_monitor = $(this).data("id");
            
            let tr = $("tr[data-monitor="+id_monitor+"]");
            let tdChild = $(tr).next(".child");

            $.ajax({
                    type:"POST",
                    url:"{{route('restoreAjaxMonitor')}}",
                    data:{
                        _token: "{{csrf_token()}}",
                        id_monitor: id_monitor,
                    },
                    success: function($numeroMonitores){
                        toastr.success('Monitor recuperado');
                        tr.fadeOut();
                        if(tdChild != null){
                            tdChild.fadeOut();
                        }
                        $(".numMonitores").text($numeroMonitores);
                    }
                }).fail(function(){
                    toastr.error('ERROR');
                });
        });
    });
</script>

@endsection
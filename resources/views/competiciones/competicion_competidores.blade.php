@if(sizeof($competidores)!=0)
<div class="input-field col s12 m12 l12">
    <button class="btn waves-effect waves-light red" id="botonBorrarCompetidores">
        <i class="material-icons right">delete</i>
        Borrar Competidores
    </button>
</div>

<div class="input-field col s12 m12 l12">
    <table id="tablaDataTableCompetidores" class="table display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{__('Selection')}}</th>
                <th>{{__('Photo')}}</th>
                <th>Karateca</th>
                <th>{{__('Category')}}</th>
                <th>Puesto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competidores as $competidor)
            <tr data-id={{$competidor->id_karateca}}>
                <td>
                    <label>
                        <input type="checkbox" class="competidor" value="{{$competidor->id_karateca}}" />
                        <span></span>
                    </label>
                </td>

                @if($competidor->fotosKarateca()->first()!=null)
                <td><img src="{{Storage::url($competidor->fotosKarateca()->orderBy('id_foto_karateca','DESC')->first()->path)}}"
                        class="responsive-img"></td>
                @else
                <td><img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img"></td>
                @endif

                <td class="nombreCompleto">{{ $competidor->nombre_completo}}</td>
                <td>{{ $competidor->categoria->nombre_categoria}}</td>
                <td>
                    <select id="puesto" name="puesto" class="browser-default"
                        data-competidor={{$competidor->id_karateca}}>
                        @foreach ($puestos as $puesto)
                        @if($competicion->karatecas()->find($competidor->id_karateca)->pivot->puesto == $puesto)
                        <option value="{{$puesto}}" selected>{{$puesto}}</option>
                        @else
                        <option value="{{$puesto}}">{{$puesto}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="input-field col s12 m12 l12">
    ¡No hay competidores!
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tableCompetidores = $('#tablaDataTableCompetidores').DataTable({
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

        tableCompetidores.on('responsive-display',function(e,datatable,row,showHide,update){
            let trId = $(row.node()).data("id");
            let puesto = $(`tr[data-id=${trId}]`).find("#puesto").val();

            if(showHide){
                $(`tr[data-id=${trId}]`).next(".child").find("#puesto option").removeAttr("selected");
                $(`tr[data-id=${trId}]`).next(".child").find(`#puesto option[value=${puesto}]`).attr("selected",true);
            }
        });
    });
</script>
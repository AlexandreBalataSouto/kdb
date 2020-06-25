@if(sizeof($participantes)!=0)
<div class="input-field col s12 m12 l12">
    <button class="btn waves-effect waves-light red" id="botonBorrarParticipantes">
        <i class="material-icons right">delete</i>
        Borrar Participantes
    </button>
</div>

<div class="input-field col s12 m12 l12">
    <table id="tablaDataTableParticipantes" class="table display nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{__('Selection')}}</th>
                <th>{{__('Photo')}}</th>
                <th>Karateca</th>
                <th>{{__('Category')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantes as $participante)
            <tr data-id={{$curso->id_curso}}>
                <td>
                    <label>
                        <input type="checkbox" class="participante" value="{{$participante->id_karateca}}" />
                        <span></span>
                    </label>
                </td>

                @if($participante->fotosKarateca()->first()!=null)
                <td><img src="{{Storage::url($participante->fotosKarateca()->orderBy('id_foto_karateca','DESC')->first()->path)}}"
                        class="responsive-img"></td>
                @else
                <td><img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img"></td>
                @endif

                <td class="nombreCompleto">{{ $participante->nombre_completo}}</td>
                <td>{{ $participante->categoria->nombre_categoria}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="input-field col s12 m12 l12">
    ¡No hay participantes!
</div>
@endif


<script>
    $(document).ready(function(){
        $('#tablaDataTableParticipantes').DataTable({
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
    });
</script>
<div class="contenedorAjax">
    @if(sizeof($documentos)==0)

    <div class="row">
        <div class="input-field col s12 m12 l12">
            ¡No hay documentos!
        </div>
    </div>
    @else
    <div class="row">
        <div class="input-field col s12 m12 l12">
            {{ $documentos->links('vendor.pagination.materialize-pagination') }}
        </div>
        @foreach($documentos as $documento)
        <div class="col s12 m6 l4" data-id={{$documento->id_documento}}>
            <div class="card borderGreyImg">
                <div class="card-image">
                    <img src="{{Storage::url($documento->path)}}" class="responsive-img documento">
                </div>
                <div class="card-content">
                    <label for="">Fecha documento:
                        {{\Carbon\Carbon::parse($documento->created_at)->format('d-m-Y')}}</label>
                </div>
                <div class="card-action">
                    <a href="{{route('documentosdownload',$documento->id_documento)}}"
                        class="btn waves-effect waves-light">
                        <i class="material-icons">file_download</i>
                    </a>
                    <a href="#" class="btn waves-effect waves-light red" id="botonBorrarDocumento">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @endif
</div>
<div class="contenedorAjax">
    
    @if(sizeof($fotos)==0)

    <div class="row">
        <div class="input-field col s12 m12 l12">
            ¡No hay fotos!
        </div>
    </div>
    @else
    <div class="row">
        <div class="input-field col s12 m12 l12">
            {{ $fotos->links('vendor.pagination.materialize-pagination') }}
        </div>
        @foreach($fotos as $key => $foto)
        @if($foto->id_foto_monitor == $firstFoto->id_foto_monitor)
        <div class="col s12 m6 l4" data-id={{$foto->id_foto_monitor}}>
            <div class="card" id="firstImg">
                <div class="card-image">
                    <img src="{{Storage::url($foto->path)}}" class="responsive-img">
                </div>
                <div class="card-content">
                    <label for="">Fecha foto:
                        {{\Carbon\Carbon::parse($foto->created_at)->format('d-m-Y')}}</label>
                </div>
                <div class="card-action">
                    <a href="{{route('fotosMonitordownload',$foto->id_foto_monitor)}}" class="btn waves-effect waves-light">
                        <i class="material-icons">file_download</i>
                    </a>
                    <a href="#" class="btn waves-effect waves-light red" id="botonBorrarFoto">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="col s12 m6 l4" data-id={{$foto->id_foto_monitor}}>
            <div class="card borderGreyImg">
                <div class="card-image">
                    <img src="{{Storage::url($foto->path)}}" class="responsive-img">
                </div>
                <div class="card-content">
                    <label for="">Fecha foto:
                        {{\Carbon\Carbon::parse($foto->created_at)->format('d-m-Y')}}</label>
                </div>
                <div class="card-action">
                    <a href="{{route('fotosMonitordownload',$foto->id_foto_monitor)}}" class="btn waves-effect waves-light">
                        <i class="material-icons">file_download</i>
                    </a>
                    <a href="#" class="btn waves-effect waves-light red" id="botonBorrarFoto">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    @endif
</div>
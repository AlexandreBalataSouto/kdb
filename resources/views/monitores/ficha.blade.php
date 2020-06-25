@extends('layouts.template')
@section('contenido')

<form method="POST" action="{{ route('monitores.update', $monitor->id_monitor) }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="row card-content">

            <div class="row">
                <div class="col s9 m9 l9">
                    <span class="card-title">Ficha de {{$monitor->nombre}} {{$monitor->apellidos}}</span>
                </div>
                <div class="col s3 m3 l3">
                    <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                        href="{{ route('monitores.index') }}" data-position="left" data-tooltip="Volver al listado">
                        <i class="material-icons">undo</i>
                    </a>
                </div>
            </div>

            <div class="divider"></div>

            <div class="row">
                <div class="input-field col s12 m12 l12">
                    <a href="{{route('fotosMonitorIndex',$monitor->id_monitor)}}"
                        class="waves-effect waves-light btn">Fotos</a>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m12 l12">
                    @if($monitor->fotosMonitor()->first()!=null)
                    <img src="{{Storage::url($monitor->fotosMonitor()->orderBy('id_foto_monitor','DESC')->first()->path)}}"
                        class="responsive-img">
                    @else
                    <img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img">
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="file-field input-field col s12 m6 l6">
                    <input type="text" id="nombre" name="nombre" class="validate" value="{{$monitor->nombre}}">
                    <label for="nombre"><span class="requiredInput">*</span>Nombre</label>

                    @if ($errors->has('nombre'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="apellidos" class="validate" name="apellidos" value="{{$monitor->apellidos}}">
                    <label for="apellidos"><span class="requiredInput">*</span>Apellidos</label>

                    @if ($errors->has('apellidos'))
                    <small class="errorValidation">
                        {{ $errors->first('apellidos') }}
                    </small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="validate"
                        value="{{$monitor->fecha_nacimiento}}">
                    <label for="fecha_nacimiento"><span class="requiredInput">*</span>Fecha de nacimiento</label>

                    @if ($errors->has('fecha_nacimiento'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_nacimiento') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="direccion" name="direccion" value="{{$monitor->direccion}}">
                    <label for="direccion">Dirección</label>

                    @if ($errors->has('direccion'))
                    <small class="errorValidation">
                        {{ $errors->first('direccion') }}
                    </small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="telefono" name="telefono" value="{{$monitor->telefono}}">
                    <label for="telefono">Teléfono</label>

                    @if ($errors->has('telefono'))
                    <small class="errorValidation">
                        {{ $errors->first('telefono') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="email" name="email" value="{{$monitor->email}}">
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                    <small class="errorValidation">
                        {{ $errors->first('email') }}
                    </small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <label for="grado"></label>
                    <select name="grado" class="browser-default">
                        @if ($monitor->grado == '1º Dan')
                        <option value="1º Dan" selected>1º Dan</option>
                        <option value="2º Dan">2º Dan</option>
                        <option value="3º Dan">3º Dan</option>
                        @elseif($monitor->grado == '2º Dan')
                        <option value="1º Dan">1º Dan</option>
                        <option value="2º Dan" selected>2º Dan</option>
                        <option value="3º Dan">3º Dan</option>
                        @else
                        <option value="1º Dan">1º Dan</option>
                        <option value="2º Dan">2º Dan</option>
                        <option value="3º Dan" selected>3º Dan</option>
                        @endif
                    </select>

                    @if ($errors->has('grado'))
                    <small class="errorValidation">
                        {{ $errors->first('grado') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m6 l6">
                    {!! method_field('put') !!}
                    <button class="btn waves-effect waves-light" type="submit">Actualizar datos</button>
                </div>
                <div class="boxGifLoading">
                    <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
                </div>
            </div>
        </div>
    </div>
</form>
@if($errors->any())
<script>
    toastr.error('Hay errores en el formulario');
</script>
@endif
<script>
    $(document).ready(function(){
        $(".browser-default").change(function(){
            $(this).css("border-bottom", "2px solid #4CAF50");
        });
    });
</script>
@endsection
@extends('layouts.template')
@section('contenido')

<form action="{{route('monitores.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="row card-content">
            <div class="row">
                <div class="col s9 m9 l9">
                    <span class="card-title">Nuevo monitor</span>
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
                <div class="file-field input-field col s6 m6 l6">
                    <div class="btn waves-effect waves-light">
                        <span>File</span>
                        <input type="file" onchange="fotoPreVisual(this)" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" ontype="text">
                    </div>
                </div>
                <div class="input-field col s6 m6 l6">
                    <img id="fotoFormCreate" src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img">
                </div>
            </div>

            <div class="row">
                <div class="file-field input-field col s12 m6 l6">
                    @if ($monitor != null)
                    <input type="text" id="nombre" name="nombre" class="validate" value="{{old("nombre")}}">
                    <label for="nombre"><span class="requiredInput">*</span>Nombre</label>

                    @if ($errors->has('nombre'))
                    <small class="errorValidation">{{ $errors->first('nombre') }}</small>
                    @endif
                    @else
                    <input type="text" id="nombre" name="nombre" class="validate" value="{{$user->nombre_solo}}">
                    <label for="nombre"><span class="requiredInput">*</span>Nombre</label>

                    @if ($errors->has('nombre'))
                    <small class="errorValidation">{{ $errors->first('nombre') }}</small>
                    @endif
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    @if ($monitor != null)
                    <input type="text" id="apellidos" class="validate" name="apellidos" value="{{old("apellidos")}}">
                    <label for="apellidos"><span class="requiredInput">*</span>Apellidos</label>

                    @if ($errors->has('apellidos'))
                    <small class="errorValidation">
                        {{ $errors->first('apellidos') }}
                    </small>
                    @endif
                    @else
                    <input type="text" id="apellidos" class="validate" name="apellidos"
                        value="{{$user->apellidos_solo}}">
                    <label for="apellidos"><span class="requiredInput">*</span>Apellidos</label>

                    @if ($errors->has('apellidos'))
                    <small class="errorValidation">
                        {{ $errors->first('apellidos') }}
                    </small>
                    @endif
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="validate"
                        value="{{old("fecha_nacimiento")}}">
                    <label for="fecha_nacimiento"><span class="requiredInput">*</span>Fecha de nacimiento</label>

                    @if ($errors->has('fecha_nacimiento'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_nacimiento') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="direccion" name="direccion" value="{{old("direccion")}}">
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
                    <input type="text" id="telefono" name="telefono" value="{{old("telefono")}}">
                    <label for="telefono">Teléfono</label>

                    @if ($errors->has('telefono'))
                    <small class="errorValidation">
                        {{ $errors->first('telefono') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    @if ($monitor != null)
                    <input type="text" id="email" name="email" value="{{old("email")}}">
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                    <small class="errorValidation">
                        {{ $errors->first('email') }}
                    </small>
                    @endif
                    @else
                    <input type="text" id="email" name="email" value="{{$user->email}}">
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                    <small class="errorValidation">
                        {{ $errors->first('email') }}
                    </small>
                    @endif
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6 m6 l6">
                    <label for="grado"></label>
                    <select name="grado" class="browser-default">
                        <option value="" disabled selected>Grado</option>
                        <option value="1º Dan" {{ old('grado') == "1º Dan" ? 'selected' : '' }}>1º Dan</option>
                        <option value="2º Dan" {{ old('grado') == "2º Dan" ? 'selected' : '' }}>2º Dan</option>
                        <option value="3º Dan" {{ old('grado') == "3º Dan" ? 'selected' : '' }}>3º Dan</option>
                    </select>

                    @if ($errors->has('grado'))
                    <small class="errorValidation">
                        {{ $errors->first('grado') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m6 l6">
                    <button class="btn waves-effect waves-light" type="submit">Guardar datos</button>
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
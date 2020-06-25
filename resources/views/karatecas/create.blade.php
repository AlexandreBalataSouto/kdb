@extends('layouts.template')
@section('contenido')

<form action="{{route('karatecas.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="row card-content">
            <div class="row">
                <div class="col s9 m9 l9">
                    <span class="card-title">Nuevo karateca</span>
                </div>
                <div class="col s3 m3 l3">
                    <a class="btn tooltipped btn-floating btn-medium waves-effect waves-light red floatRight"
                        href="{{ route('karatecas.index') }}" data-position="left" data-tooltip="Volver al listado">
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
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="nombre" name="nombre" class="validate" value="{{old("nombre")}}">
                    <label for="nombre"><span class="requiredInput">*</span>Nombre</label>

                    @if ($errors->has('nombre'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="apellidos" class="validate" name="apellidos" value="{{old("apellidos")}}">
                    <label for="apellidos"><span class="requiredInput">*</span>Apellidos</label>

                    @if ($errors->has('apellidos'))
                    <small class="errorValidation">
                        {{ $errors->first('apellidos') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="validate"
                        value="{{old("fecha_nacimiento")}}">
                    <label for="fecha_nacimiento"><span class="requiredInput">*</span>Fecha de nacimiento</label>

                    @if ($errors->has('fecha_nacimiento'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_nacimiento') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_alta" name="fecha_alta" value="{{old("fecha_alta")}}">
                    <label for="fecha_alta"><span class="requiredInput">*</span>Fecha de alta</label>

                    @if ($errors->has('fecha_alta'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_alta') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m3 l3">
                    <label for="genero"><span class="requiredInput">*</span></label>
                    <select name="genero" class="browser-default">
                        <option value="" disabled selected>Genero</option>
                        <option value="Varon" {{ old('genero') == "Varon" ? 'selected' : '' }}>Varón</option>
                        <option value="Mujer" {{ old('genero') == "Mujer" ? 'selected' : '' }}>Mujer</option>
                    </select>

                    @if ($errors->has('genero'))
                    <small class="errorValidation">
                        {{ $errors->first('genero') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <input type="number" min="0" id="edad" class="validate" name="edad" value="{{old("edad")}}">
                    <label for="edad"><span class="requiredInput">*</span>Edad</label>

                    @if ($errors->has('edad'))
                    <small class="errorValidation">
                        {{ $errors->first('edad') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <label for="categoria_id"><span class="requiredInput">*</span></label>
                    <select name="categoria_id" id="categoria_id" class="browser-default">
                        <option value="" disabled selected>Categoría</option>
                        @foreach ($categorias as $categoria)
                        <option value={{$categoria->id_categoria}}
                            {{ old('categoria_id') == $categoria->id_categoria ? 'selected' : '' }}>
                            {{$categoria->nombre_categoria}}
                        </option>
                        @endforeach
                    </select>

                    @if ($errors->has('categoria_id'))
                    <small class="errorValidation">
                        {{ $errors->first('categoria_id') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <input type="text" id="dni" class="validate" name="dni" value="{{old("dni")}}">
                    <label for="dni"><span class="requiredInput">*</span>DNI</label>

                    @if ($errors->has('dni'))
                    <small class="errorValidation">
                        {{ $errors->first('dni') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <label for="municipio"><span class="requiredInput">*</span></label>
                    <select name="municipio" class="browser-default">
                        <option value="" disabled selected>Municipio</option>
                        <option value="Tias" {{ old('municipio') == "Tias" ? 'selected' : '' }}>Tias</option>
                        <option value="Tinajo" {{ old('municipio') == "Tinajo" ? 'selected' : '' }}>Tinajo</option>
                        <option value="San Bartolome" {{ old('municipio') == "San Bartolome" ? 'selected' : '' }}>San
                            Bartolome</option>
                        <option value="Yaiza" {{ old('municipio') == "Yaiza" ? 'selected' : '' }}>Yaiza</option>
                        <option value="Haria" {{ old('municipio') == "Haria" ? 'selected' : '' }}>Haría</option>
                        <option value="Arrecife" {{ old('municipio') == "Arrecife" ? 'selected' : '' }}>Arrecife
                        </option>
                        <option value="Teguise" {{ old('municipio') == "Teguise" ? 'selected' : '' }}>Teguise</option>
                    </select>

                    @if ($errors->has('municipio'))
                    <small class="errorValidation">
                        {{ $errors->first('municipio') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="direccion" class="validate" name="direccion" value="{{old("direccion")}}">
                    <label for="direccion"><span class="requiredInput">*</span>Dirección</label>

                    @if ($errors->has('direccion'))
                    <small class="errorValidation">
                        {{ $errors->first('direccion') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m3 l3">
                    <input type="text" id="codigo_postal" class="validate" name="codigo_postal"
                        value="{{old("codigo_postal")}}">
                    <label for="codigo_postal"><span class="requiredInput">*</span>Código Postal</label>

                    @if ($errors->has('codigo_postal'))
                    <small class="errorValidation">
                        {{ $errors->first('codigo_postal') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="email" name="email" value="{{old("email")}}">
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                    <small class="errorValidation">
                        {{ $errors->first('email') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="telefono_fijo" name="telefono_fijo" value="{{old("telefono_fijo")}}">
                    <label for="telefono_fijo">Teléfono fijo</label>

                    @if ($errors->has('telefono_fijo'))
                    <small class="errorValidation">
                        {{ $errors->first('telefono_fijo') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="movil_alumno" name="movil_alumno" value="{{old("movil_alumno")}}">
                    <label for="movil_alumno">Móvil Alumno:</label>

                    @if ($errors->has('movil_alumno'))
                    <small class="errorValidation">
                        {{ $errors->first('movil_alumno') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="nombre_madre_movil" name="nombre_madre_movil"
                        value="{{old("nombre_madre_movil")}}">
                    <label for="nombre_madre_movil">Madre móvil:</label>

                    @if ($errors->has('nombre_madre_movil'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre_madre_movil') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="nombre_padre_movil" name="nombre_padre_movil"
                        value="{{old("nombre_padre_movil")}}">
                    <label for="nombre_padre_movil">Padre Móvil:</label>

                    @if ($errors->has('nombre_padre_movil'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre_padre_movil') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m2 l2">
                    <input type="text" id="peso" name="peso" value="{{old("peso")}}">
                    <label for="peso">Peso</label>

                    @if ($errors->has('peso'))
                    <small class="errorValidation">
                        {{ $errors->first('peso') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m2 l2">
                    <input type="text" id="altura" name="altura" value="{{old("altura")}}">
                    <label for="altura">Altura</label>

                    @if ($errors->has('altura'))
                    <small class="errorValidation">
                        {{ $errors->first('altura') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m8 l8">
                    <textarea name="observaciones" class="materialize-textarea"></textarea>
                    <label for="textarea">Observaciones</label>
                </div>
            </div>
            <!--OCULTO EL MONITOR POR DEFECTO ES EL ADMIN-->
            @if($monitor != null)
            <input type="hidden" value="{{$monitor->id_monitor}}" name="monitor_id">
            @else
            <input type="hidden" value="" name="monitor_id">
            @endif
            <button class="btn waves-effect waves-light" type="submit">Guardar datos</button>

            <div class="boxGifLoading">
                <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
            </div>

        </div>
    </div>
</form>

@if($errors->has('monitor_id'))
<script>
    toastr.error("{{$errors->first('monitor_id')}}");
</script>
@endif
<script>
    $(document).ready(function(){
        $(".browser-default").change(function(){
            $(this).css("border-bottom", "2px solid #4CAF50");
        });

        $("#fecha_nacimiento").change(function(){
            let date = $(this).val();
            let years = moment().diff(date,'years');

            $('#categoria_id').prop('selectedIndex',0);
            $("#edad").val(years);

            if(years <= 8 || years == 9){
                $("#categoria_id option[value=1]").prop("selected","selected"); //Bejamin
            }else if(years == 10 || years == 11){
                $("#categoria_id option[value=2]").prop("selected","selected"); //Alevin
            }else if(years == 12 || years == 13){
                $("#categoria_id option[value=3]").prop("selected","selected"); //Infantil
            }else if(years == 14 || years == 15){
                $("#categoria_id option[value=5]").prop("selected","selected"); //Cadete
            }else if(years == 16 || years == 17){
                $("#categoria_id option[value=6]").prop("selected","selected"); //Junio
            }else if(years >= 18){
                $("#categoria_id option[value=8]").prop("selected","selected"); //Senior
            }


           M.updateTextFields();
        });
    });
</script>

@endsection
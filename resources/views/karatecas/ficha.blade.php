@extends('layouts.template')
@section('contenido')

<form method="POST" action="{{ route('karatecas.update', $karateca->id_karateca) }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="row card-content">

            <div class="row">
                <div class="col s9 m9 l9">
                    <span class="card-title">Ficha de {{$karateca->nombre}} {{$karateca->apellidos}}</span>
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
                <div class="input-field col s6 m6 l6" id="fotoDocuButtons">
                    <a href="{{route('documentosIndex',$karateca->id_karateca)}}"
                        class="waves-effect waves-light btn">Documentos</a>
                    <a href="{{route('fotosKaratecaIndex',$karateca->id_karateca)}}"
                        class="waves-effect waves-light btn">Fotos</a>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6 m6 l6">
                    @if($karateca->fotosKarateca()->first()!=null)
                    <img src="{{Storage::url($karateca->fotosKarateca()->orderBy('id_foto_karateca','DESC')->first()->path)}}"
                        class="responsive-img">
                    @else
                    <img src="{{URL::asset('img/fotoDefault.jpg')}}" class="responsive-img">
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="nombre" name="nombre" class="validate" value="{{$karateca->nombre}}">
                    <label for="nombre">Nombre</label>

                    @if ($errors->has('nombre'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="text" id="apellidos" class="validate" name="apellidos"
                        value="{{$karateca->apellidos}}">
                    <label for="apellidos">Apellidos</label>

                    @if ($errors->has('apellidos'))
                    <small class="errorValidation">
                        {{ $errors->first('apellidos') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="validate"
                        value="{{$karateca->fecha_nacimiento}}">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>

                    @if ($errors->has('fecha_nacimiento'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_nacimiento') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l3">
                    <input type="date" id="fecha_alta" name="fecha_alta" value="{{$karateca->fecha_alta}}">
                    <label for="fecha_alta">Fecha de alta</label>

                    @if ($errors->has('fecha_alta'))
                    <small class="errorValidation">
                        {{ $errors->first('fecha_alta') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m3 l3">
                    <select name="genero" class="browser-default" required>
                        @if($karateca->genero == 'Varon')

                        <option selected value="Varon">Varón</option>
                        <option value="Mujer">Mujer</option>

                        @elseif($karateca->genero == 'Mujer')
                        <option value="Varon">Varon</option>
                        <option selected value="Mujer">Mujer</option>

                        @endif
                    </select>

                    @if ($errors->has('genero'))
                    <small class="errorValidation">
                        {{ $errors->first('genero') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <input type="number" min="0" id="edad" class="validate" name="edad" value="{{$karateca->edad}}">
                    <label for="edad">Edad</label>

                    @if ($errors->has('edad'))
                    <small class="errorValidation">
                        {{ $errors->first('edad') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <label for="categoria_id"></label>
                    <select name="categoria_id" id="categoria_id" class="browser-default" required>
                        <option value="" disabled>Categoría</option>

                        @foreach ($categorias as $categoria)
                        @if($karateca->categoria_id==$categoria->id_categoria)
                        <option selected value={{ $karateca->categoria->id_categoria}}>
                            {{ $karateca->categoria->nombre_categoria}}
                        </option>
                        @else
                        <option value={{$categoria->id_categoria}}>{{$categoria->nombre_categoria}}</option>
                        @endif
                        @endforeach
                    </select>

                    @if ($errors->has('categoria_id'))
                    <small class="errorValidation">
                        {{ $errors->first('categoria_id') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m3 l3">
                    <input type="text" id="dni" class="validate" name="dni" value="{{$karateca->dni}}">
                    <label for="dni">DNI</label>

                    @if ($errors->has('dni'))
                    <small class="errorValidation">
                        {{ $errors->first('dni') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m3 l3">
                    <label for="municipio"></label>
                    <select name="municipio" class="browser-default" required>

                        @foreach ($municipios as $municipio)
                        @if($karateca->municipio == $municipio)
                        <option selected value="{{$karateca->municipio}}">{{$karateca->municipio}}</option>
                        @else
                        <option value="{{$municipio}}">{{$municipio}}</option>
                        @endif
                        @endforeach

                    </select>

                    @if ($errors->has('municipio'))
                    <small class="errorValidation">
                        {{ $errors->first('municipio') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="direccion" class="validate" name="direccion"
                        value="{{$karateca->direccion}}">
                    <label for="direccion">Dirección</label>

                    @if ($errors->has('direccion'))
                    <small class="errorValidation">
                        {{ $errors->first('direccion') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m3 l3">
                    <input type="text" id="codigo_postal" class="validate" name="codigo_postal"
                        value="{{$karateca->codigo_postal}}">
                    <label for="codigo_postal">Código Postal</label>

                    @if ($errors->has('codigo_postal'))
                    <small class="errorValidation">
                        {{ $errors->first('codigo_postal') }}
                    </small>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="email" name="email" value="{{$karateca->email}}">
                    <label for="email">Email</label>

                    @if ($errors->has('email'))
                    <small class="errorValidation">
                        {{ $errors->first('email') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="telefono_fijo" name="telefono_fijo" value="{{$karateca->telefono_fijo}}">
                    <label for="telefono_fijo">Teléfono fijo</label>

                    @if ($errors->has('telefono_fijo'))
                    <small class="errorValidation">
                        {{ $errors->first('telefono_fijo') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m4 l4">
                    <input type="text" id="movil_alumno" name="movil_alumno" value="{{$karateca->movil_alumno}}">
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
                        value="{{$karateca->nombre_madre_movil}}">
                    <label for="nombre_madre_movil">Madre móvil:</label>

                    @if ($errors->has('nombre_madre_movil'))
                    <small class="errorValidation">
                        {{ $errors->first('nombre_madre_movil') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m6 l6">
                    <input type="text" id="nombre_padre_movil" name="nombre_padre_movil"
                        value="{{$karateca->nombre_padre_movil}}">
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
                    <input type="text" id="peso" name="peso" value="{{$karateca->peso}}">
                    <label for="peso">Peso</label>

                    @if ($errors->has('peso'))
                    <small class="errorValidation">
                        {{ $errors->first('peso') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s6 m2 l2">
                    <input type="text" id="altura" name="altura" value="{{$karateca->altura}}">
                    <label for="altura">Altura</label>

                    @if ($errors->has('altura'))
                    <small class="errorValidation">
                        {{ $errors->first('altura') }}
                    </small>
                    @endif
                </div>
                <div class="input-field col s12 m8 l8">
                    <textarea id="observaciones" name="observaciones" class="materialize-textarea"></textarea>
                    <label for="observaciones">Observaciones</label>
                    {!! method_field('put') !!}
                </div>
            </div>
            <!--OCULTO-->
            <input type="hidden" value="1" name="monitor_id">
            <input type="hidden" class="observacionesValue" value="{{$karateca->observaciones}}">
            <button class="btn waves-effect waves-light" type="submit">Actualizar datos</button>

            <div class="boxGifLoading">
                <img src="{{URL::asset('img/loading.gif')}}" alt="loadingGif">
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
    document.addEventListener('DOMContentLoaded', function() {
        $(".browser-default").change(function(){
            $(this).css("border-bottom", "2px solid #4CAF50");
        });
        
        //Para ajustar el textarea observaciones
        let observacionesValue = $(".observacionesValue").val();
        $("#observaciones").text(observacionesValue);
        M.textareaAutoResize($("#observaciones"));
        M.updateTextFields();

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
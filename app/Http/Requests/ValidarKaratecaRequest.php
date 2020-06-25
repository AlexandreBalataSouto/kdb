<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DniValido;

class ValidarKaratecaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'                => ['required','min:3','max:50'],
            'apellidos'             => ['required','min:3','max:50'],
            'fecha_nacimiento'      => ['required','date'],
            'fecha_alta'            => ['required','date'],
            'genero'                => ['required'],
            'edad'                  => ['required'],
            'categoria_id'          => ['required'],
            'dni'                   => ['required',new DniValido],
            'municipio'             => ['required'],
            'direccion'             => ['required','min:5','max:100'],
            'codigo_postal'         => ['required','numeric'],

            //No obligatorios
            'telefono_fijo'         => ['nullable','digits_between:8,11'],
            'email'                 => ['nullable','email'],
            'movil_alumno'          => ['nullable','digits_between:8,11'],
            'nombre_madre_movil'    => ['nullable','max:50'],
            'nombre_padre_movil'    => ['nullable','max:50'],
            'peso'                  => ['nullable','regex:/^\d*(\.\d{2})?$/'],
            'altura'                => ['nullable','regex:/^\d*(\.\d{2})?$/'],

            //Campo oculto
            'monitor_id'            => ['required'],

        ];
    }

    public function messages()
    {
        return [
            'nombre.required'               =>'El :attribute es obligatorio',
            'nombre.min'                    =>'El :attribute debe contener mas de una letra',
            'nombre.max'                    =>'El :attribute debe conetener max 50 letras',

            'apellidos.required'            =>'Los :attribute son obligatorio',
            'apellidos.min'                 =>'Los :attribute deben contener mas de una letra',
            'apellidos.max'                 =>'Los :attribute deben conetener max 50 letras',

            'fecha_nacimiento.required'     =>'La :attribute es obligatoria',
            'fecha_alta.required'           =>'La :attribute es obligatoria',
            'genero.required'               =>'El :attribute es obligatorio',
            'edad.required'                 =>'La :attribute es obligatoria',
            'categoria_id.required'         =>'La :attribute es obligatoria',
            'dni.required'                  =>'El :attribute es obligatorio',
            'municipio.required'            =>'El :attribute es obligatorio',

            'direccion.required'            =>'La :attribute es obligatoria',
            'direccion.min'                 =>'La :attribute debe contener mas de una letra',
            'direccion.max'                 =>'La :attribute debe conetener max 100 letras',

            'codigo_postal.required'        =>'El :attribute es obligatorio',
            'codigo_postal.numeric'         =>'El :attribute debe ser numerico',

            //No obligatorios
            'telefono_fijo.digits_between'  =>'El :attribute debe tener entre 8 y 11 digitos y no contener espacios en blanco',
            'email.email'                   =>'El :attribute no es valido',
            'movil_alumno.digits_between'   =>'El :attribute debe tener entre 8 y 11 digitos y no contener espacios en blanco',
            'nombre_madre_movil.max'        =>'El campo :attribute debe contener max 100 caracters que incluyen nombre y el telefono',
            'nombre_padre_movil.max'        =>'El campo :attribute debe contener max 100 caracters que incluyen nombre y el telefono',
            'peso.regex'                    =>'El :attribute debe usar este formato ej: 80.10',
            'altura.regex'                  =>'La :attribute debe usar este formato ej: 1.80',

            //Campo oculto
            'monitor_id.required'           =>'Tiene que crear su ficha de monitor para poder crear la ficha del alumno'

        ];
    }
    public function attributes()
    {
        return [
            'nombre'                => 'Nombre',
            'apellidos'             => 'Apellidos',
            'fecha_nacimiento'      => 'Fecha de nacimiento',
            'fecha_alta'            => 'Fecha de alta',
            'genero'                => 'Genero',
            'edad'                  => 'Edad',
            'categoria_id'          => 'Categoria',
            'dni'                   => 'DNI',
            'municipio'             => 'Municipio',
            'direccion'             => 'Direccion',
            'codigo_postal'         => 'Codigo postal',
            'telefono_fijo'         => 'Telefono fijo',
            'email'                 => 'Email',
            'movil_alumno'          => 'Movil del alumno',
            'nombre_madre_movil'    => 'Nombre madre movil',
            'nombre_padre_movil'    => 'Nombre padre movil',
            'peso'                  => 'Peso',
            'altura'                => 'Altura'

        ];
    }
}

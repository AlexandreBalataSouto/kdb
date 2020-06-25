<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarMonitorRequest extends FormRequest
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

             //No obligatorios
            'direccion'             => ['nullable','min:5','max:100'],
            'telefono'              => ['nullable','digits_between:8,11'],
            'email'                 => ['nullable','email'],
            'grado'                 => ['nullable'],
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

            'fecha_nacimiento'              =>'La :attribute es obligatoria',

             //No obligatorios
            'direccion.min'                 =>'La :attribute debe contener mas de una letra',
            'direccion.max'                 =>'La :attribute debe conetener max 100 letras',
            'telefono.digits_between'       =>'El :attribute debe tener entre 8 y 11 digitos y no contener espacios en blanco',
            'email.email'                   =>'El :attribute no es valido',
            //'grado.min'                     =>'El :attribute debe contener mas de una letra',
            //'grado.max'                     =>'El :attribute debe conetener max 10 letras',
        ];
    }

    public function attributes()
    {
        return [
            'nombre'                => 'Nombre',
            'apellidos'             => 'Apellidos',
            'fecha_nacimiento'      => 'Fecha de nacimiento',
            'direccion'             => 'Direccion',
            'telefono'              => 'Telefono',
            'email'                 => 'Email',
            'grado'                 => 'Grado',
        ];
    }
}

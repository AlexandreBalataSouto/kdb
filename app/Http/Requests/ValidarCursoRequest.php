<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'evento.title'      =>  ['required'],
            'evento.start'      =>  ['required'],
            'evento.end'        =>  ['required'],
            'evento.hora'       =>  ['required'],
            'evento.monitor_id' =>  ['required'],
        ];
    }

    public function messages()
    {
        return[
            'evento.title.required'         => 'El :attribute es obligatorio',
            'evento.start.required'         => 'La :attribute es obligatoria',
            'evento.end.required'           => 'La :attribute es obligatoria',
            'evento.hora.required'          => 'La :attribute es obligatoria',
            'evento.monitor_id.required'    => 'El :attribute es obligatorio',
        ];
        
    }
    public function attributes()
    {
        return [
            'evento.title'      =>  'nombre del evento',
            'evento.start'      =>  'fecha de inicio',
            'evento.end'        =>  'fecha final',
            'evento.hora'       =>  'hora',
            'evento.monitor_id' =>  'monitor',
        ];
    }
}

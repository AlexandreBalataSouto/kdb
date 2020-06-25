<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Monitor;
use App\Curso;
use App\Competicion;

class EventoController extends Controller
{
    public function index(){
        $monitores = Monitor::all();
        return view('eventos.index',compact('monitores'));
    }

    public function getAjaxEvento(){
        $cursos = Curso::select('id_curso','numero','title', 'start', 'end', 
        'hora','descripcion','precio','color','text_color',
        'monitor_id')->get()->toArray();

        $competiciones= Competicion::select('id_competicion','numero','title', 'start', 
        'end','hora','descripcion','precio','color',
        'text_color')->get()->toArray();

        $eventos=array_merge($cursos,$competiciones);//unimos los arrays en un SUPER ARRAY

        return response()->json($eventos);
    }
}

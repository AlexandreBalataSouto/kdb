<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Curso;
use App\Karateca;
use App\Monitor;
use DateTime;

class CursoController extends Controller
{

    public function createAjaxCurso(Request $request)
    {
        $evento = $request->input('evento');

        //Comprobacion de fechas y se suma un dia
        if ($evento['end'] <= $evento['start']) {
            $end = new DateTime($evento['start']);
            $evento['end'] = $end->modify('+1 day');;
        }
        
        $validator = Validator::make($request->all(), [
            'evento.evento'     =>  'required',
            'evento.title'      =>  'required',
            'evento.start'      =>  'required',
            'evento.end'        =>  'required',
            'evento.hora'       =>  'required',
            'evento.precio'     =>  'gte:0',
            'evento.monitor_id' =>  'required'
        ],[
            'evento.evento.required' =>  'Hay que seleccionar un evento',
            'evento.title.required'      =>  'El nombre del curso es obligatorio',
            'evento.start.required'      =>  'La fecha de inicio es obligatoria',
            'evento.end.required'        =>  'La fecha final es obligatoria',
            'evento.hora.required'       =>  'La hora es obligatoria',
            'evento.precio.gte'          =>  'El precio no puede ser menor que 0',
            'evento.monitor_id.required' =>  'El monitor es obligatorio'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);

        }else{

            $ultimoCurso = Curso::orderBy('numero', 'DESC')->first();

            if ($ultimoCurso == null) {
                $ultimoCurso = 1;
            } else {
                $ultimoCurso = $ultimoCurso->numero;
                $ultimoCurso++;
            }

            $evento['id_curso'] = 'a'.$ultimoCurso;
            $evento['numero'] = $ultimoCurso;

            Curso::create($evento);

            return response()->json(['notification' => $evento['title'].' creado']);
        }
    }

    public function updateAjaxCurso(Request $request)
    {
        $evento = $request->input('evento');
        $id_evento = $request->input('id_evento');

        //Comprobacion de fechas y se suma un dia
        if ($evento['end'] <= $evento['start']) {
            $end = new DateTime($evento['start']);
            $evento['end'] = $end->modify('+1 day');;
        }

        $validator = Validator::make($request->all(), [
            'evento.title'      =>  'required',
            'evento.start'      =>  'required',
            'evento.end'        =>  'required',
            'evento.hora'       =>  'required',
            'evento.monitor_id' =>  'required'
        ],[
            'evento.title.required'      =>  'El nombre del curso es obligatorio',
            'evento.start.required'      =>  'La fecha de inicio es obligatoria',
            'evento.end.required'        =>  'La fecha final es obligatoria',
            'evento.hora.required'       =>  'La hora es obligatoria',
            'evento.monitor_id.required' =>  'El monitor es obligatorio'
        ]);

        if($validator->fails()){
            
            return response()->json(['error' => $validator->errors()->toArray()]);
            
        }else{
            
            Curso::find($id_evento)->update($evento);
            return response()->json(['notification' => $evento['title'].' editado']);
        }  
    }

    public function updateAjaxCursoDropResize(Request $request)
    {
        $id_evento = $request->input("id_evento");
        $evento = Curso::find($id_evento);
        $newStart = $request->input("newStart");
        $newEnd = $request->input("newEnd");

        $evento->start = $newStart;

        if($newEnd != null){
            $evento->end = $newEnd;
        }else{
            $newEnd = new DateTime($newStart);
            $newEnd->modify('+1 day');
            $evento->end = $newEnd;
        }

        $evento->save();
        return response()->json(['notification' => 'Fecha '.$evento['title'].' editado']);
    }

    public function deleteAjaxCurso(Request $request)
    {
        $id_evento = $request->input("id_evento");
        Curso::find($id_evento)->delete();
        return response()->json(['notification' => 'El curso se ha borrado']);
    }

    public function indexParticipantes($id_curso)
    {
        $curso = Curso::find($id_curso);
        $karatecas=Karateca::orderBy("apellidos")->get();
        $participantes = Curso::find($id_curso)->karatecas()->get();
        $monitor = Monitor::find($curso->monitor_id);
        return view("cursos.index",compact("curso","karatecas","participantes","monitor"));
    }

    public function addAjaxParticipantesCurso(Request $request)
    {
        $karatecas = $request->input("karatecas");
        $id_curso = $request->input("id_curso");

        $curso = Curso::find($id_curso);
        $curso->karatecas()->syncWithoutDetaching($karatecas);
    }

    public function refreshAjaxParticipantesCurso($id_curso)
    {
        $curso = Curso::find($id_curso);
        $karatecas = Karateca::all();
        $participantes = Curso::find($id_curso)->karatecas()->get();
        return view("cursos.curso_participantes",compact("curso","karatecas","participantes"));
    }

    public function deleteAjaxParticipantesCurso(Request $request)
    {
        $participantes = $request->input("participantes");
        $id_curso = $request->input("id_curso");

        $curso = Curso::find($id_curso);

        $curso->karatecas()->detach($participantes);
    }
}

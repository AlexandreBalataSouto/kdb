<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Competicion;
use App\Karateca;
use DateTime;

class CompeticionController extends Controller
{
    public function createAjaxCompeticion(Request $request){
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
        ],[
            'evento.evento.required'     =>  'Hay que seleccionar un evento',
            'evento.title.required'      =>  'El nombre de la competicion es obligatorio',
            'evento.start.required'      =>  'La fecha de inicio es obligatoria',
            'evento.end.required'        =>  'La fecha final es obligatoria',
            'evento.hora.required'       =>  'La hora es obligatoria'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);

        } else {

            $ultimaCompeticion = Competicion::orderBy('numero', 'DESC')->first();

            if ($ultimaCompeticion == null) {
                $ultimaCompeticion = 1;
            } else {
                $ultimaCompeticion = $ultimaCompeticion->numero;
                $ultimaCompeticion++;
            }

            $evento['id_competicion'] = 'b'.$ultimaCompeticion;
            $evento['numero'] = $ultimaCompeticion;

            Competicion::create($evento);

            return response()->json(['notification' => $evento['title'].' creado']);
        }
    }

    public function updateAjaxCompeticion(Request $request){
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
        ],[
            'evento.title.required'      =>  'El nombre de la competicion es obligatorio',
            'evento.start.required'      =>  'La fecha de inicio es obligatoria',
            'evento.end.required'        =>  'La fecha final es obligatoria',
            'evento.hora.required'       =>  'La hora es obligatoria'
        ]);

        if($validator->fails()){

            return response()->json(['error' => $validator->errors()->toArray()]);
            
        }else{
            Competicion::find($id_evento)->update($evento);
            return response()->json(['notification' => $evento['title'].' editado']);
        }  
    }

    public function updateAjaxCompeticionDropResize(Request $request){
        $id_evento = $request->input("id_evento");
        $evento = Competicion::find($id_evento);
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

    public function deleteAjaxCompeticion(Request $request){
        $id_evento = $request->input("id_evento");

        Competicion::find($id_evento)->delete();
        return response()->json(['notification' => 'La competicion se ha borrado']);
    }

    public function indexCompetidores($id_competicion)
    {
        $competicion = Competicion::find($id_competicion);
        $karatecas=Karateca::orderBy("apellidos")->get();
        $competidores = Competicion::find($id_competicion)->karatecas()->get();
        $puestos = ['NADA','1º','2º','3º'];
        return view("competiciones.index",compact("competicion","karatecas","competidores","puestos"));
    }

    public function addAjaxCompetidoresCompeticion(Request $request)
    {
        $karatecas = $request->input("karatecas");
        $id_competicion = $request->input("id_competicion");

        $competicion = Competicion::find($id_competicion);
        $competicion->karatecas()->syncWithoutDetaching($karatecas);
    }

    public function refreshAjaxCompetidoresCompeticion($id_competicion)
    {
        $competicion = Competicion::find($id_competicion);
        $karatecas = Karateca::all();
        $competidores = Competicion::find($id_competicion)->karatecas()->get();
        $puestos = ['NADA','1º','2º','3º'];
        return view("competiciones.competicion_competidores",compact("competicion","karatecas","competidores","puestos"));
    }

    public function updateAjaxPuestoCompetidor(Request $request){
        $id_competicion = $request->input('id_competicion');
        $id_karateca = $request->input('id_karateca');
        $puesto = $request->input('puesto');

        $competicion = Competicion::find($id_competicion);
        $competicion->karatecas()->updateExistingPivot($id_karateca,['puesto' => $puesto]);

    }

    public function deleteAjaxCompetidoresCompeticion(Request $request)
    {
        $competidores = $request->input("competidores");
        $id_competicion = $request->input("id_competicion");

        $competicion = Competicion::find($id_competicion);

        $competicion->karatecas()->detach($competidores);
    }
}

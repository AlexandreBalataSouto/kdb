<?php

namespace App\Http\Controllers;

use App\Falta;
use App\Karateca;
use App\Categoria;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaltaController extends Controller
{
    public function index()
    {
        $karatecas=Karateca::orderBy("apellidos")->get();
        $categorias=Categoria::all();
        return view('faltas.index',compact('karatecas','categorias'));
    }

    public function addAjaxFalta(Request $request)
    {
        $faltaAlumnosId = $request->input("faltaAlumnosId");
        $fechaFalta = $request->input("fechaFalta");

        foreach($faltaAlumnosId as $faltaAlumnoId){
            Falta::create([
                'title'=>'Falta',
                'start'=>$fechaFalta,
                'color'=>'#FF0000',
                'text_color'=>'#FFFFFF',
                'karateca_id'=>$faltaAlumnoId
            ]);
        }
    }

    public function show($id_karateca)
    {
        $karateca=Karateca::find($id_karateca);
        return view('faltas.show',compact('karateca'));
    }

   public function getAjaxFalta(Request $request){
        $id_karateca = $request->input("id_karateca");
        $faltas=Falta::where('karateca_id',$id_karateca)->get()->toArray();
        return response()->json($faltas);
        
   }

   public function updateAjaxFalta(Request $request){

        $id_falta = $request->input("id_falta");
        $newDate = $request->input("newDate");
        $newDate = Carbon::createFromFormat('d/m/Y',$newDate)->format('Y-m-d');
        $falta = Falta::find($id_falta);
        $falta->start = $newDate;
        $falta->save();
   }

   public function deleteAjaxFalta(Request $request){

        $id_falta = $request->input("id_falta");
        Falta::find($id_falta)->delete();
        return response()->json($id_falta);
   }
}

<?php

namespace App\Http\Controllers;

use App\Karateca;
use App\Monitor;
use App\FotoKarateca;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarKaratecaRequest;

class KaratecaController extends Controller
{
   
    public function index()
    {
        $karatecas=Karateca::orderBy("apellidos")->get();
        $numeroKaratecas=Karateca::all()->count();
        $categorias=Categoria::all();
        return view('karatecas.index',compact('karatecas','categorias','numeroKaratecas'));
    }

    public function create()
    {
        $monitor = Monitor::first();
        $categorias = Categoria::all();
        return view('karatecas.create',compact('categorias','monitor')); 
    }

    public function store(ValidarKaratecaRequest $request)
    {
        $foto=$request->file('file');
        $karateca=$request->except(['file']);    

        $karateca=Karateca::create($karateca);

        $notification = array(
            'message' => 'Ficha creada del alumno: '.$karateca->nombre.' '.$karateca->apellidos,
            'alert-type' => 'success'
        );

        if($foto != null){
            FotoKarateca::create([
                'titulo'=>$foto->getClientOriginalName(),
                'path'=>$foto->store('public/storeFotos'),
                'karateca_id'=>$karateca->id_karateca
            ]);
            return redirect('karatecas')->with($notification);
        }
        return redirect('karatecas')->with($notification);
    }
    /*
    public function show($id_karateca)
    {
        $karateca=Karateca::find($id_karateca); 
        return view('karatecas.show',compact('karateca'));
    }
    */

    public function show($id_karateca)
    {
        $karateca=Karateca::find($id_karateca);
        $municipios=["Tias","Tinajo","San Bartolome","Yaiza","Haria","Arrecife","Teguise"];
        $categorias=Categoria::all(); 
        return view('karatecas.ficha',compact('karateca','categorias','municipios'));
    }

    /*
    public function edit($id_karateca)
    {
        $karateca=Karateca::find($id_karateca);
        $municipios=["Tias","Tinajo","San Bartolome","Yaiza","Haria","Arrecife","Teguise"];
        $categorias=Categoria::all();
        return view('karatecas.edit',compact('karateca','categorias','municipios'));
    }
    */
    
    public function update(ValidarKaratecaRequest $request, $id_karateca)
    {
        $karateca=$request->all();
        Karateca::find($id_karateca)->update($karateca);
        $karateca=Karateca::find($id_karateca);
        $notification = array(
            'message' => 'Ficha actualizada del alumno: '.$karateca->nombre.' '.$karateca->apellidos,
            'alert-type' => 'success'
        );
        return redirect('karatecas')->with($notification); 
    }

    public function deleteAjaxKarateca(Request $request)
    {
        $id_karateca = $request->input("id_karateca");
        $karateca = Karateca::find($id_karateca);
        $karateca->delete();

        $numeroKaratecas=Karateca::all()->count();
        return $numeroKaratecas;
    }

    public function trashKarateca()
    {
        $karatecas=Karateca::orderBy("apellidos")->onlyTrashed()->get();
        $numeroKaratecas=Karateca::onlyTrashed()->count();
        $fotos=FotoKarateca::onlyTrashed()->get();
        $categorias=Categoria::all();
        return view('karatecas.trash',compact('karatecas','numeroKaratecas','fotos','categorias'));
    }

    public function restoreAjaxKarateca(Request $request)
    {
        $id_karateca = $request->input("id_karateca");
        $karateca = Karateca::onlyTrashed()->find($id_karateca);
        $karateca->restore();

        $numeroKaratecas=Karateca::onlyTrashed()->count();
        return $numeroKaratecas;
    }
}

<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Karateca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class DocumentoController extends Controller
{
    
    public function index($id_karateca)
    {
        $karateca=Karateca::find($id_karateca);
        $documentos=Documento::where('karateca_id',$id_karateca)
            ->orderBy('id_documento','DESC')
            ->paginate(6);
        return view('documentos.index',compact('documentos','karateca'));
    }

    public function refresh($id_karateca){
        $karateca=Karateca::find($id_karateca);
        $documentos=Documento::where('karateca_id',$id_karateca)
            ->orderBy('id_documento','DESC')
            ->paginate(6);
        return view('documentos.fichero',compact('documentos','karateca'));
    }

    function documentosPagination(Request $request)
    {
        if ($request->ajax()) {
            $id_karateca = $request->input("id_karateca");
            $karateca = Karateca::find($id_karateca);
            $documentos = Documento::where('karateca_id', $id_karateca)
                ->orderBy('id_documento', 'DESC')
                ->paginate(6);
            return view('documentos.fichero', compact('documentos','karateca'))->render();
        }
    }

    public function store(Request $request, $id_karateca)
    {
        $documento=$request->file('file');
        Documento::create([
            'titulo'=>$documento->getClientOriginalName(),
            'path'=>$documento->store('public/storeDocumentos'),
            'karateca_id'=>$id_karateca
           ]);

        $path=$documento->store('public/storeDocumentos');
        $fileName = collect(explode('/', $path))->last();
        $image = Image::make(Storage::get($path));
        
        $image->resize(2047, 1365, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
        });

        Storage::put($path, (string) $image->encode('jpg', 30));
    }

    public function download($id_karateca){
        $documento = Documento::find($id_karateca);
        return Storage::download($documento->path, $documento->titulo);
    }

    public function deleteAjaxDocumento(Request $request)
    {
        $id_documento = $request->input("id_documento");
        $documento =  Documento::find($id_documento);
        $karateca_id = $documento->karateca_id;
        Storage::delete($documento->path);
        $documento->forceDelete();
    }
}

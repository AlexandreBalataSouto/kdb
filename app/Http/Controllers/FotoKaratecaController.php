<?php

namespace App\Http\Controllers;

use App\FotoKarateca;
use App\Karateca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class FotoKaratecaController extends Controller
{

    public function index($id_karateca)
    {
        $karateca = Karateca::find($id_karateca);
        $fotos = FotoKarateca::where('karateca_id', $id_karateca)
            ->orderBy('id_foto_karateca', 'DESC')
            ->paginate(6);
        $firstFoto = FotoKarateca::where('karateca_id', $id_karateca)->orderBy('id_foto_karateca', 'DESC')->first();
        return view('fotos_karateca.index', compact('fotos','firstFoto','karateca'));
    }

    public function refresh($id_karateca)
    {
        $karateca = Karateca::find($id_karateca);
        $fotos = FotoKarateca::where('karateca_id', $id_karateca)
            ->orderBy('id_foto_karateca', 'DESC')
            ->paginate(6);
        $firstFoto = FotoKarateca::where('karateca_id', $id_karateca)->orderBy('id_foto_karateca', 'DESC')->first();
        return view('fotos_karateca.album_karateca', compact('fotos','firstFoto', 'karateca'));
    }

    function fotosKaratecaPagination(Request $request)
    {
        if ($request->ajax()) {
            $id_karateca = $request->input("id_karateca");
            $karateca = Karateca::find($id_karateca);
            $fotos = FotoKarateca::where('karateca_id', $id_karateca)
                ->orderBy('id_foto_karateca', 'DESC')
                ->paginate(6);
            $firstFoto = FotoKarateca::where('karateca_id', $id_karateca)->orderBy('id_foto_karateca', 'DESC')->first();
            return view('fotos_karateca.album_karateca', compact('fotos','firstFoto','karateca'))->render();
        }
    }

    public function store(Request $request, $id_karateca)
    {
        $fotoKarateca = $request->file('file');

        FotoKarateca::create([
            'titulo' => $fotoKarateca->getClientOriginalName(),
            'path' => $fotoKarateca->store('public/storeFotosKarateca'),
            'karateca_id' => $id_karateca
        ]);

        $image = Image::make($fotoKarateca->getRealPath());
        $image ->resize(800, null, function($constraint){//650x756
            $constraint->aspectRatio();
        });
        $image->orientate();

        $path=$fotoKarateca->store('public/storeFotosKarateca');

        Storage::put($path, (string) $image->encode('jpg', 30));
    }

    public function download($id_karateca)
    {
        $foto = FotoKarateca::find($id_karateca);
        return Storage::download($foto->path, $foto->titulo);
    }

    public function deleteAjaxFotoKarateca(Request $request)
    {
        $id_foto_karateca = $request->input("id_foto_karateca");
        $foto =  FotoKarateca::find($id_foto_karateca);
        $karateca_id = $foto->karateca_id;
        Storage::delete($foto->path);
        $foto->forceDelete();
    }
}

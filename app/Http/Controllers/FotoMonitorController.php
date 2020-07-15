<?php

namespace App\Http\Controllers;

use App\FotoMonitor;
use App\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class FotoMonitorController extends Controller
{
   
    public function index($id_monitor)
    {
        $monitor=Monitor::find($id_monitor);
        $fotos=FotoMonitor::where('monitor_id',$id_monitor)
            ->orderBy('id_foto_monitor','DESC')
            ->paginate(6);
        $firstFoto = FotoMonitor::where('monitor_id', $id_monitor)->orderBy('id_foto_monitor', 'DESC')->first();
        return view('fotos_monitor.index',compact('fotos','firstFoto','monitor'));
    }

    public function refresh($id_monitor)
    {
        $monitor=Monitor::find($id_monitor);
        $fotos=FotoMonitor::where('monitor_id',$id_monitor)
            ->orderBy('id_foto_monitor','DESC')
            ->paginate(6);
        $firstFoto = FotoMonitor::where('monitor_id', $id_monitor)->orderBy('id_foto_monitor', 'DESC')->first();
        return view('fotos_monitor.album_monitor',compact('fotos','firstFoto','monitor'));
    }

    function fotosMonitorPagination(Request $request)
    {
        if ($request->ajax()) {
            $id_monitor = $request->input("id_monitor");
            $monitor = Monitor::find($id_monitor);
            $fotos = FotoMonitor::where('monitor_id', $id_monitor)
                ->orderBy('id_foto_monitor', 'DESC')
                ->paginate(6);
            $firstFoto = FotoMonitor::where('monitor_id', $id_monitor)->orderBy('id_foto_monitor', 'DESC')->first();
            return view('fotos_monitor.album_monitor', compact('fotos','firstFoto', 'monitor'))->render();
        }
    }

    public function store(Request $request, $id_monitor)
    {
        $fotoMonitor=$request->file('file');

        FotoMonitor::create([
            'titulo'=>$fotoMonitor->getClientOriginalName(),
            'path'=>$fotoMonitor->store('public/storeFotosMonitor'),
            'monitor_id'=>$id_monitor
        ]);

        $image = Image::make($fotoMonitor->getRealPath());
        $image ->resize(800, null, function($constraint){
            $constraint->aspectRatio();
        });
        $image->orientate();

        $path=$fotoMonitor->store('public/storeFotosMonitor');
       
        Storage::put($path, (string) $image->encode('jpg', 30));

    }

    public function download($id_monitor){
        $foto = FotoMonitor::find($id_monitor);
        return Storage::download($foto->path, $foto->titulo);
    }

    public function deleteAjaxFotoMonitor(Request $request)
    {
        $id_foto_monitor = $request->input("id_foto_monitor");
        $foto =  FotoMonitor::find($id_foto_monitor);
        $monitor_id = $foto->monitor_id;
        Storage::delete($foto->path);
        $foto->forceDelete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\User;
use App\FotoMonitor;
use Illuminate\Http\Request;
use App\Http\Requests\ValidarMonitorRequest;
use Illuminate\Support\Facades\Storage;
use Image;

class MonitorController extends Controller
{
    public function index()
    {
        $monitores=Monitor::all();
        $numeroMonitores=Monitor::all()->count();
        return view('monitores.index',compact('monitores','numeroMonitores'));
    }

    public function create()
    {
        $monitor = Monitor::first();

        if($monitor != null){
            return view('monitores.create',compact('monitor'));
        }else{
            $user = User::first();
            return view('monitores.create',compact('user','monitor'));
        }
    }

    public function store(ValidarMonitorRequest $request)
    {
        $foto=$request->file('file');
        $monitor=$request->except(['file']);    

        $monitor=Monitor::create($monitor);

        $notification = array(
            'message' => 'Ficha creada del monitor: '.$monitor->nombre.' '.$monitor->apellidos,
            'alert-type' => 'success'
        );

        if($foto !== null){
            FotoMonitor::create([
                'titulo'=>$foto->getClientOriginalName(),
                'path'=>$foto->store('public/storeFotosMonitores'),
                'monitor_id'=>$monitor->id_monitor
            ]);

            $image = Image::make($foto->getRealPath());
            $image ->resize(800, null, function($constraint){//650x756
                $constraint->aspectRatio();
            });
            $image->orientate();

            $path=$foto->store('public/storeFotosMonitores');

            Storage::put($path, (string) $image->encode('jpg', 30));

            return redirect('monitores')->with($notification);
        }
        return redirect('monitores')->with($notification);
    }

    public function show($id_monitor)
    {
        $monitor=Monitor::find($id_monitor); 
        return view('monitores.ficha',compact('monitor'));
    }

    public function update(ValidarMonitorRequest $request, $id_monitor)
    {
        $monitor=$request->all();

        Monitor::find($id_monitor)->update($monitor);
        $monitor=Monitor::find($id_monitor);

        if($id_monitor == 1){
            $admin = User::find($id_monitor);
            $admin->name = $monitor->nombre.' '.$monitor->apellidos;
            $admin->email = $monitor->email; //CUIDADO que esto es lo que usamos para verficar al usuario, hay que tener cuidado
            $admin->save();
        }

        $notification = array(
            'message' => 'Ficha actualizada del monitor: '.$monitor->nombre.' '.$monitor->apellidos,
            'alert-type' => 'success'
        );
        return redirect('monitores')->with($notification); 
    }

    public function deleteAjaxMonitor(Request $request)
    {
        $id_monitor = $request->input("id_monitor");
        $monitor = Monitor::find($id_monitor);
        $monitor->delete();

        $numeroMonitores=Monitor::all()->count();
        return $numeroMonitores;
    }

    public function trashMonitor()
    {
        $monitores=Monitor::onlyTrashed()->get();
        $numeroMonitores=Monitor::onlyTrashed()->count();
        $fotos=FotoMonitor::onlyTrashed()->get();
        return view('monitores.trash',compact('monitores','numeroMonitores','fotos'));
    }

    public function restoreAjaxMonitor(Request $request)
    {
        $id_monitor = $request->input("id_monitor");
        $monitor = Monitor::onlyTrashed()->find($id_monitor);
        $monitor->restore();

        $numeroMonitores=Monitor::onlyTrashed()->count();
        return $numeroMonitores;
    }
}

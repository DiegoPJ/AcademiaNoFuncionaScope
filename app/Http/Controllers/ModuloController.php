<?php

namespace App\Http\Controllers;

use App\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::orderBy('id')->paginate(6);
        return view('modulos.index',compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $request->validate([
            'nombre' => ['required'],
            'horas' => ['required']
        ]);
        $modulo = new Modulo();
        $modulo->nombre=$request->nombre;
        $modulo->horas=$request->horas;
        if($request->has('logo')){
            $request->validate([
                'logo' =>['image']
            ]);
           
            $file = $request->file('logo');
            $nombre = 'modulos/'.time().' '.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre,\File::get($file));
            $modulo->logo = "img/$nombre";
        }
        $modulo->save();
        return redirect()->route('modulos.index')->with('mensaje','Modulo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function show(Modulo $modulo)
    {
        return view('modulos.detalles',compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modulo $modulo)
    {
        return view('modulos.edit',compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {
        
        $request->validate([
            'nombre' => ['required'],
            'horas' => ['required']
        ]);
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            $foto = $modulo->logo;
            if(basename($foto)!="default.jpg"){
                unlink($foto);
            }
            $file = $request->file('logo');
            $nombre = 'modulos/'.time().' '.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            $modulo->update($request->all());
            $modulo->update(['logo'=>"img/$nombre"]);

        }else{
            $modulo->update($request->all());

        }
        return redirect()->route('modulos.index')->with('mensaje','Ha sido editado correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulo  $modulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulo $modulo)
    {
        $foto=$modulo->logo;
        if(basename($foto)!="default.jpg"){
            unlink($foto);
        }
        $modulo->delete();
        return redirect()->route('modulos.index')->with("mensaje","Modulo borrado perfectamente");
    }
}

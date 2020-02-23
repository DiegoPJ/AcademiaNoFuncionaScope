<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;
use App\Modulo;
use Illuminate\Support\Facades\Storage;
class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //        $alumnos=Alumno::BuscarModulos($elModulo)

        $modulos = Modulo::all();
        $elModulo = $request->get('modulo_id');
        $alumnos=Alumno::orderBy('id')
        ->paginate(4);
        return view('alumnos.index', compact('alumnos','modulos'));
    }

    public function create()
    {
        //
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validaciones genericas
        $request->validate([
            'nombre'=>['required'],
            'apellido'=>['required'],
            'mail'=>['required', 'unique:alumnos,mail']
        ]);

        //cojo los datos por que voy a modificar el request
        //voy a poner nom y ape la primera letra en mayusculs
        $alumno=new Alumno();
        $alumno->nombre=ucwords($request->nombre);
        $alumno->apellido=ucwords($request->apellido);
        $alumno->mail=$request->mail;

         //compruebo si he subido archivo
         if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('logo');
            //creo un nombre
            $nombre='alumnos/'.time().' '.$file->getClientOriginalName();
            //guardo ek archivo imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //le damos a alumno un nombre que le hemos puesto al fichero
            $alumno->logo="img/$nombre";

        }
        $alumno->save();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
        return view('alumnos.detalles', compact('alumno'));
    }

    public function fmatricula(Alumno $alumno)
    {
        $modulos2=$alumno->modulosOut();
        //compruebo si ya los tiene todos
        if($modulos2->count()==0){
            return redirect()->route('alumnos.show', $alumno)
            ->with('mensaje', 'Este alumno ya está matriculado de todos los módulos');
        }
        //cargamos el formulario matricular alumno le mando el alumno y los modulos que le faltan
        return view('alumnos.fmatricula', compact('modulos2', 'alumno'));

    }
    public function matricular(Request $request){
        $id=$request->alumno_id;
        //me traigo el alumno de código id
        $alumno=Alumno::find($id);
        if(isset($request->modulo_id)){
            foreach($request->modulo_id as $item){
                $alumno->modulos()->attach($item);
            }
            return redirect()->route('alumnos.show', $alumno)->with('mensaje'. 'Alumno matriculado');
        }
        return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Ningun modulo seleccionado');
    }
    //--------------------------------------------------------------
    public function fcalificar(Alumno $alumno){
        $modulos=$alumno->modulos()->get();
        if($modulos->count()==0){
           return redirect()->route('alumnos.show', $alumno)->with('mensaje','este alumno no esta matriculado');
        }
        return view('alumnos.fcalificar', compact('alumno'));
    }
    public function calificar(Request $request){
        //dd($request->modu'los);
        $alumno=Alumno::find($request->alumno_id);
        //recorro el array asociativo con los ids modulos y las notas
        foreach($request->modulos as $k=>$v){
            $alumno->modulos()->updateExistingPivot($k, ['nota'=>$v]);

        }
        return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Calificaciones guardadas');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.editar', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $foto=$alumno->logo;
        $request->validate([
            'nombre'=>['required'],
            'apellido'=>['required'],
            'mail'=>['required', 'unique:alumnos,mail,'.$alumno->id]
        ]);
        //compruebo si he subido archivo
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);
            //compruebo que no sea la default
            
            if(basename($foto)!="default.jpg"){
                //la borro No es default.jpg
                unlink($foto);
            }
            //Todo bien hemos subido un archivo y es de imagen
            $file=$request->file('logo');
            //creo un nombre
            $nombre='alumnos/'.time().' '.$file->getClientOriginalName();
            //guardo ek archivo imagen
            Storage::disk('public')->put($nombre, \File::get($file));
            //guardo el coche pero la imagn estaria mal
            $alumno->update($request->all());
            //actualiza el registro foto del coche guardado
            $alumno->update(['logo'=>"img/$nombre"]);
        }
        else{
            $alumno->update($request->all());
            
        }

        return redirect()->route('alumnos.index')->with('mensaje','Alumno modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //Dos cosas borrar la imagen si no es defalt.jpg
        //y borrar registro
        $foto=$alumno->logo;
        if(basename($foto)!="default.jpg"){
            //la borro No es default.jpg
            unlink($foto);
        }
        //en cualquier caso borro el registro
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje','alumno borrado correctamente');
    }
}

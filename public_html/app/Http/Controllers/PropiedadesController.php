<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Propiedad;

class PropiedadesController extends Controller
{
    public function create(){
        return view('dashboard.propiedades.nueva');
    }
    public function index(){
        $propiedades = Propiedad::where('status','Activa')->get();
        return view('dashboard.propiedades.lista',compact('propiedades'));
    }

    public function guardar(Request $request){
       
            if( isset($request->imagen) ){
                $file = $request->imagen;
                $filename = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/propiedades',$filename);
                $foto = 'images/propiedades/'.$filename;
            }

            $propiedad = new Propiedad();
            $propiedad->nombre=$request->nombre;
            $propiedad->tipo=$request->tipo;
            $propiedad->colonia=$request->colonia;
            $propiedad->precio=$request->precio;
            $propiedad->construccion=$request->construccion;
            $propiedad->terreno=$request->terreno;
            $propiedad->imagen=$foto;
            $propiedad->url=$request->url;
            $propiedad->status=$request->status;

            if($propiedad->save()){
                return back()->with('success','Propiedad Creada');
            }else{
                return back()->with('Error','Ha ocurrido un error');
            }
            

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autores;

class AutorController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        $autores= Autores::orderBy('nombre','id_pais','asc')->get();
        return [
            'autores'=>$autores
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $autores= new Autores();
        $autores->nombre = $request->nombre;
        $autores->id_pais = $request->id_pais;
        $autores->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $autores= Autores::findOrfail($request->id);
        $autores->nombre = $request->nombre;
        $autores->id_pais = $request->id_pais;
        $autores->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $autores= Autores::findOrfail($request->id);
        $autores->delete();
    }
}

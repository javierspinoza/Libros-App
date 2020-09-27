<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;

class CategoriaController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
        
        $categorias= Categorias::orderBy('nombre','asc')->get();
        return [
            'categorias'=>$categorias
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $categorias= new Categorias();
        $categorias->nombre = $request->nombre;
        $categorias->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $categorias= Categorias::findOrfail($request->id);
        $categorias->nombre = $request->nombre;
        $categorias->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $categorias= Categorias::findOrfail($request->id);
        $categorias->delete();
    }
}

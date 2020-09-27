<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idiomas;

class IdiomaController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        $idiomas= Idiomas::orderBy('nombre','asc')->get();
        return [
            'idiomas'=>$idiomas
        ];
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $idiomas= new Idiomas();
        $idiomas->nombre = $request->nombre;
        $idiomas->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $idiomas= Idiomas::findOrfail($request->id);
        $idiomas->nombre = $request->nombre;
        $idiomas->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $idiomas= Idiomas::findOrfail($request->id);
        $idiomas->delete();
    }
}

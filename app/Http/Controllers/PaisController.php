<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paises;

class PaisController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        $paises= Paises::all();
        return $paises;
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $paises= new Paises();
        $paises->nombre = $request->nombre;
        $paises->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $paises= Paises::findOrfail($request->id);
        $paises->nombre = $request->nombre;
        $paises->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $paises= Paises::findOrfail($request->id);
        $paises->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editoriales;

class EditorialController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        $editoriales= Editoriales::all();
        return $editoriales;
    }

    //guardar datos en la bd
    public function store(Request $request)
    {
        $editoriales= new Editoriales();
        $editoriales->nombre = $request->nombre;
        $editoriales->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $editoriales= Editoriales::findOrfail($request->id);
        $editoriales->nombre = $request->nombre;
        $editoriales->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $editoriales= Editoriales::findOrfail($request->id);
        $editoriales->delete();
    }
}

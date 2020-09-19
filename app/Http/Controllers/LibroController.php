<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libros;

class LibroController extends Controller
{
    // //mostrar datos de la tabla
    // public function index()
    // {
    //     // GET para obtener
    //     // POST guardar en la bd
    //     // PUT actualizar o eliminar

    //     $libros= Libros::all();
    //     return $libros;
    // }

    // //guardar datos en la bd
    // public function store(Request $request)
    // {
    //     $libros= new Libros();
    //     $libros->nombre = $request->nombre;
    //     $libros->save();
    // }
    
    // //actualizar datos
    // public function update(Request $request)
    // {
    //     $libros= Libros::findOrfail($request->id);
    //     $libros->nombre = $request->nombre;
    //     $libros->save();
    // }

    // //eliminar datos
    // public function destroy(Request $request)
    // {
    //     $libros= Libros::findOrfail($request->id);
    //     $libros->delete();
    // }
}

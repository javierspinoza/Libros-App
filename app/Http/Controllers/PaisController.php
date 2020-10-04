<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paises;

class PaisController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->nombre;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $paises= Paises::orderBy('nombre','asc')->paginate(6);
        }else {
            $paises= Paises::where($criterio, 'like', '%'.$buscar. '%')-orderby('nombre','asc')->paginate(6);
        }
        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar

        return [
            'pagination'=>[
                'total'=> $paises -> total(),
                'current_page'=> $paises -> currentPage(),
                'per_page'=> $paises -> perPage(),
                'last_page'=> $paises -> lastPage(),
                'from'=> $paises -> firstItem(),
                'to'=> $paises -> lastItem(),
            ],
            'paises'=>$paises
        ];
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

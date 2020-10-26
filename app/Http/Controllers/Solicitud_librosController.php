<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud_libros;

class Solicitud_librosController extends Controller
{
    //
    public function index(Request $request)
    {

        $buscar1=$request->buscar1;

        if ($buscar1=='') {
            $solicitud= Solicitud_libros::orderBy('id_persona','asc')->paginate(1);   
        }else {
            $solicitud= Solicitud_libros::where('id_persona', 'like', '%'.$buscar1. '%')->orderBy('id_persona','asc')->paginate(1);
        }


        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar.
        
        
        return [

            'pagination'=>[
                'total'=> $solicitud -> total(),
                'current_page'=> $solicitud -> currentPage(),
                'per_page'=> $solicitud -> perPage(),
                'last_page'=> $solicitud -> lastPage(),
                'from'=> $solicitud -> firstItem(),
                'to'=> $solicitud -> lastItem(),
            ],

            'solicitud'=>$solicitud
        ];
    }
}

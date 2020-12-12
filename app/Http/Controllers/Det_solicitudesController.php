<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Det_solicitudes;

class Det_solicitudesController extends Controller
{
    public function index(Request $request)
    {

            $solicitud= Det_solicitudes::join('solicitud_libros', 'det_solicitudes.id_solicitud', '=', 'solicitud_libros.id')
            ->join('libros', 'det_solicitudes.id_libro', '=', 'libros.id')
            ->join('autores','libros.id_autor','=','autores.id')
            ->join('editoriales','libros.id_editorial','=','editoriales.id')
            ->select('libros.id as cod','libros.nombre as nomLibro', 'det_solicitudes.id_solicitud', 'det_solicitudes.cant',
            'autores.nombre as autor','editoriales.nombre as editorial')
            // ->where('det_solicitudes.id_solicitud', '=', $buscar)
            ->orderBy('libros.id','asc')->paginate(10);


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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud_libros;
use App\Det_solicitudes;

class Solicitud_librosController extends Controller
{
    //
    public function index(Request $request)
    {

            $solicitud= Solicitud_libros::join('personas', 'solicitud_libros.id_persona', '=', 'personas.id')
            ->select('solicitud_libros.id','solicitud_libros.fec_sol', 'solicitud_libros.fec_entrega', 'personas.nomComp',
            'personas.id as idPerso')
            ->orderBy('id','asc')->paginate(10);


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

    public function store(Request $request){

        try {
            DB::beginTransaction();

            $solicitud= new Solicitud_libros();
            $solicitud->fec_entrega = $request->fec_entrega;//primer campo bd y segundo campo como esta en la vista
            $solicitud->id_persona = $request->id_persona;
            $solicitud->save();

            $detalle=$request->datosDetalle;

            foreach ($detalle as $key => $det) {//aca es casi lo mismo que OBJETO IN ARRAY DATOS ... Y ENVIAMOS DET O COMO LO QUERAMOS LLAMAR
                $detalle = new Det_solicitudes();
                $detalle->id_solicitud = $solicitud->id;//aqui se llama solicitud del BEGIN porque solicitud contiene todo y el ID es el que guarda todo de solicitud
                $detalle->id_libro = $det['id'];//id_libro es la siguiente llave foranea y el id es el de arrayDatos
                $detalle->cant = $det['cant'];
                $detalle->save();
            }
            DB::commit();//para que guarde los datos

        } catch (Exception $e) {//el catch para que me muestre si hay algun error
            DB::rollback();//el rollback es para que me devuelva la transaccion si hay algun error
            console.log('Error', $e);
        }

    }
    // public function destroy(Request $request)
    // {
    //     $solicitud= Solicitud_libros::findOrfail($request->id);
    //     $solicitud->delete();
    // }
}

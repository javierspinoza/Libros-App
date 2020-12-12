<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{
    public function index(Request $request)
    {
        //
        if (!$request->ajax()) return redirect('/');//para seguridad de nuestra pag
        // $categorias = DB::table('categorias')->paginate(3);//paginacion opcion 1... se llama en el nombre de la tabla como la llamamos en la bd

        $buscar = $request->buscar;//estas dos lineas de codigo son para buscar
        $criterio = $request->criterio;

        if ($buscar==''){
            $roles =Rol::orderBy('id', 'desc')->paginate(3);
        }
        else {
            $roles =Rol::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }

        return [
            'pagination'=>[
                'total'=> $roles -> total(),
                'current_page'=> $roles -> currentPage(),
                'per_page'=> $roles -> perPage(),
                'last_page'=> $roles -> lastPage(),
                'from'=> $roles -> firstItem(),
                'to'=> $roles -> lastItem(),
            ],

            'roles'=>$roles
        ];
    }

    public function selectRol(Request $request){
        if (!$request->ajax()) return redirect('/');//para seguridad de nuestra pag

        $roles = Rol::where('condicion', '=', '1')//voy a obtener todas las roles que esten activas
        ->select('id', 'nombre')->orderBy('nombre','asc')->get();//obtenemos los datos con el get

        return ['roles' => $roles];
    }
}

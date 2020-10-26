<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libros;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        // $criterio=$request->criterio;
        $libros = Libros::orderBy('nombre', 'asc')->get();

        if($buscar == ''){
        $libros=Libros::join('editoriales','libros.id_editorial','=','editoriales.id')
            ->join('categorias','libros.id_categoria','=','categorias.id')
            ->join('autores','libros.id_autor','=','autores.id')
            ->join('idiomas','libros.id_idioma','=','idiomas.id')
            ->select('libros.id','libros.nombre','libros.codigo','libros.cant','libros.ano_publi',
            'libros.num_pag','libros.ubicacion','libros.edicion','editoriales.nombre as nomEditorial',
            'categorias.nombre as nomCategoria','autores.nombre as nomAutor','idiomas.nombre as nomIdioma')            
            ->orderBy('nombre','asc')->paginate(4);
        } else {$libros=Libros::join('editoriales','libros.id_editorial','=','editoriales.id')
            ->join('categorias','libros.id_categoria','=','categorias.id')
            ->join('autores','libros.id_autor','=','autores.id')
            ->join('idiomas','libros.id_idioma','=','idiomas.id')
            ->select('libros.id','libros.nombre','libros.codigo','libros.cant','libros.ano_publi',
            'libros.num_pag','libros.ubicacion','libros.edicion','editoriales.nombre as nomEditorial',
            'categorias.nombre as nomCategoria','autores.nombre as nomAutor','idiomas.nombre as nomIdioma')
            ->where('libros.nombre', 'like', '%'.$buscar. '%')//para buscar por nombre en la vista del maestro detalle
            ->orderBy('nombre','asc')->paginate(4);
        }
        return [

            'pagination'=>[
                'total'=> $libros -> total(),
                'current_page'=> $libros -> currentPage(),
                'per_page'=> $libros -> perPage(),
                'last_page'=> $libros -> lastPage(),
                'from'=> $libros -> firstItem(),
                'to'=> $libros -> lastItem(),
            ],

            'libros'=>$libros,
        ];
    }
    public function getLibros(Request $request)
    {
        $libros = Libros::select('id','nombre')
            ->orderBy('nombre', 'asc')->get();
        return [
            'libros' => $libros
        ];
    }
    

    //guardar datos en la bd
    public function store(Request $request)
    {
        $libros= new Libros();
        $libros->nombre = $request->nombre;
        $libros->codigo = $request->codigo;
        $libros->cant = $request->cant;
        $libros->ano_publi = $request->ano_publi;
        $libros->num_pag = $request->num_pag;
        $libros->ubicacion = $request->ubicacion;
        $libros->edicion = $request->edicion;
        $libros->id_editorial = $request->idEditorial;
        $libros->id_categoria = $request->idCategoria;
        $libros->id_autor = $request->idAutor;
        $libros->id_idioma = $request->idIdioma;
        $libros->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $libros= Libros::findOrfail($request->id);
        $libros->nombre = $request->nombre;
        $libros->codigo = $request->codigo;
        $libros->cant = $request->cant;
        $libros->ano_publi = $request->ano_publi;
        $libros->num_pag = $request->num_pag;
        $libros->ubicacion = $request->ubicacion;
        $libros->edicion = $request->edicion;
        $libros->id_editorial = $request->idEditorial;
        $libros->id_categoria = $request->idCategoria;
        $libros->id_autor = $request->idAutor;
        $libros->id_idioma = $request->idIdioma;
        $libros->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $libros= Libros::findOrfail($request->id);
        $libros->delete();
    }
}

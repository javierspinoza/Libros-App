<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_libros extends Model
{
    //
    protected $table = 'solicitud_libros'; //es el nombre de la tabla cuando no nos esta listando se hace esto
    protected $fillable=['id','fec_sol','fec_entrega','id_persona'];
    public $timestamps=false;
}

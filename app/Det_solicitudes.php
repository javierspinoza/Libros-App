<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Det_solicitudes extends Model
{
    //
    protected $table = 'Det_solicitudes'; //es el nombre de la tabla cuando no nos esta listando se hace esto
    protected $fillable=['id','cant','id_solicitud','id_libro'];
    public $timestamps=false;
}

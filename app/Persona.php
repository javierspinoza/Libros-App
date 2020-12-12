<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombres','apellidos','dir','tel','email'];

    

    public function user()
    {
        return $this->hasOne('App\User');
    }


}

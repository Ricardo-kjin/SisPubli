<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    //
    //una zona tiene muchos inmuebles

    public function inmuebles (){
        return $this->hasMany(Inmueble::class);
    }
}

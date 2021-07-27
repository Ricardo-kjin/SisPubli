<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //
    //muchos inmuebles tienen muchos servicios

    public function inmuebles (){
        return $this->belongsToMany(Inmueble::class);
    }

}

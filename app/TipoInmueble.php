<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInmueble extends Model
{
    //tipo de inmueble tiene muchos inmuebles

    public function inmuebles (){
        return $this->hasMany(Inmueble::class);
    }
}

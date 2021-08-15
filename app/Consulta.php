<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    //
    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }
}

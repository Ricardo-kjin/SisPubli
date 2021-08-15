<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    //
    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }
}

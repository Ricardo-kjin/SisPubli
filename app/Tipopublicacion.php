<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopublicacion extends Model
{
    public function publicacion(){
        return $this->hasMany(Publicacion::class);
    }
}

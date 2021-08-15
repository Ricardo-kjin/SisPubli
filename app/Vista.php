<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vista extends Model
{
    //
    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }
}

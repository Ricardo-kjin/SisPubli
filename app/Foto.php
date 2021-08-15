<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public function inmueble(){
        return $this->belongsTo(Inmueble::class);
    }

}

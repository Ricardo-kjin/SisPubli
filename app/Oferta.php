<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //
    protected $primaryKey = 'id_ofertas';

    public function plane (){
        return $this->belongsTo(Plane::class,'id_planes','id_planes');
    }

    public function notaventas (){
        return $this->hasMany(NotaVenta::class,'id_ofertas','id_ofertas');
    }
}

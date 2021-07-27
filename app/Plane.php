<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    //
    protected $primaryKey = 'id_planes';

    public function ofertas (){
        return $this->hasMany(Oferta::class,'id_planes','id_planes');
    }
}

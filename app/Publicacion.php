<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    public function inmueble(){
        return $this->belongsTo(Inmueble::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tipopublicacion(){
        return $this->belongsTo(Tipopublicacion::class);
    }
    public function notaventa(){
        return $this->belongsTo(NotaVenta::class,'nota_venta_id','id_nota_ventas');
    }
    public function vistas(){
        return $this->hasMany(Vista::class);
    }
    public function consultas(){
        return $this->hasMany(Consulta::class);
    }
    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    protected $primaryKey = 'id_nota_ventas';

    public function factura(){
        return $this->belongsTo(factura::class,'id_facturas','id_facturas');
    }
    public function user(){
        return $this->belongsTo(User::class,'id_usuarios');
    }
    public function oferta(){
        return $this->belongsTo(Oferta::class,'id_ofertas','id_ofertas');
    }
    public function publicacions(){
        return $this->hasMany(Publicacion::class,'nota_venta_id','id_nota_ventas');
    }
}

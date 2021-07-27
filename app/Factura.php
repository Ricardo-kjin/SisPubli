<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    protected $primaryKey = 'id_facturas';

    public function notaventa(){
        return $this->hasOne(NotaVenta::class,'id_facturas','id_facturas');
    }

    public function tipopago(){
        return $this->belongsTo(TipoPagos::class,'id_tipo_pagos','id_tipo_pagos');
    }
}

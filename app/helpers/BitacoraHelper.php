<?php

namespace App\Helpers;

use App\Bitacora;
use Illuminate\Support\Facades\Auth;

class BitacoraHelper
{
    public static function insertBitacora($accion){

        $maquinaIp =UserSystemInfoHelper::get_ip();
        $time = time();
        $fechas=date("d-m-Y (H:i:s)", $time);

        $bitacora=new Bitacora();
        $bitacora->fecha_hora=$fechas;
        $bitacora->accion=$accion;
        $bitacora->user_id=Auth::user()->id;
        $bitacora->maquina_ip=$maquinaIp;
        // dd($bitacora);
        $bitacora->save();

        return 1;
    }
}

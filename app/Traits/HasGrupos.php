<?php

namespace App\Traits;

use App\Bitacora;
use App\Grupo;
use App\NotaVenta;
use App\Publicacion;
use App\Seguimiento;
use App\TipoUsuario;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasGrupos
{
    /**
     * @return mixed
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class,'grupos_users','id_user','id_grupos');
    }

    /**
     * @return mixed
     */
    public function accesos()
    {
        //(la clase a asociada a este modelo,mencion de la tabla pivote,el id local,el id de la tabla asociada)
        return $this->belongsToMany(Acceso::class,'accesos_users','id_user','id_accesos');
    }
    public function tipousuarios()
    {
        //la clase padre--- el FK id que tiene el hijo---el id del padre
        return $this->belongsTo(TipoUsuario::class, 'id_tipo_usuarios');
    }
    public function notaventas()
    {
        //la clase padre--- el FK id que tiene el hijo---el id del padre
        return $this->hasMany(NotaVenta::class, 'id_usuarios');
    }

    //un usario tiene muchos inmuebles

    public function inmuebles(){
        return $this->hasMany(Inmueble::class);
    }

    public function publicacions(){
        return $this->hasMany(Publicacion::class);
    }

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }
    public function bitacoras(){
        return $this->hasMany(Bitacora::class);
    }

    // public function getIp(){
    //     foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    //         if (array_key_exists($key, $_SERVER) === true){
    //             foreach (explode(',', $_SERVER[$key]) as $ip){
    //                 $ip = trim($ip); // just to be safe
    //                 if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
    //                     return $ip;
    //                 }
    //             }
    //         }
    //     }
    // }

    // public static function obtenerIp(){

    //         $ipaddress = '';
    //         if (isset($_SERVER['HTTP_CLIENT_IP']))
    //             $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    //         else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    //             $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //         else if(isset($_SERVER['HTTP_X_FORWARDED']))
    //             $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    //         else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    //             $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    //         else if(isset($_SERVER['HTTP_FORWARDED']))
    //             $ipaddress = $_SERVER['HTTP_FORWARDED'];
    //         else if(isset($_SERVER['REMOTE_ADDR']))
    //             $ipaddress = $_SERVER['REMOTE_ADDR'];
    //         else
    //             $ipaddress = 'UNKNOWN';
    //         return $ipaddress;
    //      }

}

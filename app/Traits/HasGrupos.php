<?php

namespace App\Traits;

use App\Grupo;
use App\NotaVenta;
use App\TipoUsuario;

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

    public function inmuebles (){
        return $this->hasMany(Inmueble::class);
    }

    public function obtenerIp(){
        $ip=0;
        return  $ip;
    }
}

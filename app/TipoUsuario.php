<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoUsuario extends Model
{
    use Notifiable;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profesion', 'nit_agente', 'nombre_empresa','direccion_empresa',
         'registro_empresa', 'telefono_empresa','nit_empresa','estado',
    ];

    public function user()
    {
        //la clase que tiene el $id del padre--parametro del $id del padre que tiene el hijo --parametro $id de la tabla padre
        return $this->hasOne(User::class,'id_tipo_usuarios');
    }
}

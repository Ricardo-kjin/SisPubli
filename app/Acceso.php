<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $primaryKey = 'id_accesos';

    public function grupos()
    {
        return $this->BelongsToMany(Grupo::class,'accesos_grupos','id_accesos','id_grupos');
    }
}

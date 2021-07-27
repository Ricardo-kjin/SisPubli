<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Grupo extends Model
{
    protected $primaryKey = 'id_grupos';

    public function accesos()
    {
        //(la clase a asociada a este modelo,mencion de la tabla pivote,el id local,el id de la tabla asociada)
        return $this->BelongsToMany(Acceso::class,'accesos_grupos','id_grupos','id_accesos');
    }
    public function users()
    {
        //(la clase a asociada a este modelo,mencion de la tabla pivote,el id local,el id de la tabla asociada)
        return $this->BelongsToMany(User::class,'grupos_users','id_grupos','id_users');
    }
}

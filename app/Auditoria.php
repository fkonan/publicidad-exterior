<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';
    protected $primaryKey = 'id';

    protected $fillable=[
        "usuario",
        "proceso_afectado",
        "accion",
        "tramite",
        "radicado",
        "observacion"

    ];
}

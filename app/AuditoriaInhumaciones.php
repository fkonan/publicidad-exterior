<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaInhumaciones extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'auditoria_consulta';
    protected $primaryKey = 'id';

    protected $fillable=[
        "nom_solicitante",
        "ape_solicitante",
        "identificacion_solicitante",
        "email_solicitante",
        "numero_busqueda",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion"
    ];
}

    


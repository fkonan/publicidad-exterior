<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pot extends Model
{
    protected $table = 'opinion_pot';
    protected $primaryKey = 'id';

    protected $fillable=[
        "documento_usuario",
        "nombre_usuario",
        "apellido_usuario",
        "edad",
        "correo_electronico",
        "comuna",
        "barrio",
        "corregimiento",
        "vereda",
        "tema",
        "observacion",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion"
    ];

}

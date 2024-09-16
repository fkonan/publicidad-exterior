<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamiliaLactante extends Model
{
    protected $table = 'familia_lactante';
    protected $primaryKey = 'id';

    protected $fillable=[
        "nit",
        "razon_social",
        "direccion",
        "barrio",
        "telefono_empresa",
        "correo_electronico",
        "nom_representante",
        "ape_representante",
        "numero_mujeres_empresa",
        "numero_mujeres_gestantes",
        "numero_mujeres_lactantes",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion"

    ];

}

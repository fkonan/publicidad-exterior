<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model
{
    protected $table = 'categorizacion_parqueaderos';
    protected $primaryKey = 'id';

    protected $fillable=[
        "radicado",
        "nom_solicitante",
        "ape_solicitante",
        "tipo_documento",
        "identificacion_solicitante",
        "direccion_solicitante",
        "barrio_solicitante",
        "tel_solicitante",
        "email_responsable",
        "nombre_empresa",
        "direccion_empresa",
        "barrio_empresa",
        "tel_empresa",
        "adjunto_camara_rut",
        "adjunto_planos",
        "adjunto_licencia",
        "observaciones_solicitud",
        "fecha_actuacion",
        "fecha_pendiente",
        "fecha_pendiente_planeacion",
        "act_documentos",
        "adjunto_resPlaneacion",
        "adjunto_respuesta",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion"
 
    ];
}

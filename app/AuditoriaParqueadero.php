<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaParqueadero extends Model
{
    protected $table = 'auditoria_parqueaderos';
    protected $primaryKey = 'id';

    protected $fillable=[
        "parqueadero_id",
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
        "estado_solicitud",
        "observaciones_solicitud",
        "fecha_actuacion",        
        "act_documentos",
        "adjunto_resPlaneacion",
        
 
    ];
}

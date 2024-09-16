<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificacionDiscapacidad extends Model
{
    protected $table = 'certificacion_discapacidad';
    protected $primaryKey = 'id';

    protected $fillable=[
        "radicado",
      "nom_responsable",
      "ape_responsable",
      "ide_responsable",
      "email_responsable",
      "tel_responsable",
      "nom_solicitante",
      "ape_solicitante",
      "tipo_identificacion_sol",
      "ide_solicitante",
      "correo_solicitante",
      "tel_solicitante",
      "direccion_solicitante",
      "barrio_solicitante",
      "ciudad_id",
      "adj_recibo",
      "adj_documento",
      "adj_historia_clinica",
      "estado_solicitud",
      "observaciones_solicitud",
      "fecha_actuacion",
      "fecha_pendiente",
      "act_documentos",
      "adj_certificado",
      "tratamiento_datos",
      "acepto_terminos",
      "confirmo_mayorEdad",
      "compartir_informacion"
 
    ];
}

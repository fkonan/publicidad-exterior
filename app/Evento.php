<?php

namespace App;
use App\DocUpdate;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id';

    protected $fillable=[
        "tipo_evento",
        "radicado",      
        "tipo_persona",
        "razon_social",
        "nom_responsable",
        "ape_responsable",
        "tipo_documento",
        "ide_responsable",
        "nombre_empresa",
        "dir_responsable",
        "tel_responsable",
        "email_responsable",
        "fecha_evento",
        "hora_inicio",
        "hora_fin",
        "ubicacion_evento",
        "barrio_evento",
        "cant_personas",
        "pub_ext",
        "reproduccion_musica",
        "descripcion_evento",
        "adj_logisticaEvento",
        "adj_cedulaRes",
        "adj_autorizacionTra",
        "adj_contratoArr",
        "adj_conceptoCMGRD",
        "adj_conceptoTecAmb",
        "adj_certificadoPONAL",
        "adj_certificadoBomberos",
        "adj_hospitalaria",
        "adj_poliza",
        "adj_publicidad",
        "adj_certVigilancia",
        "adj_certificadoEMAB",
        "adj_derAutor",
        "estado_solicitud",
        "observaciones_solicitud",
        "fecha_actuacion",
        "fecha_pendiente",
        "adjunto_respuesta",
        "tratamiento_datos",
        "acepto_terminos",
        "confirmo_mayorEdad",
        "compartir_informacion"
    ];

    public function documentos(){     

        return $this->hasOne(DocUpdate::class); //relacion 1  a 1

    }
    
}

<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Rita extends Model
{
    

    protected $table = 'rita';
    protected $primaryKey = 'id';

    protected $fillable =[        
      
       "radicado",
       "tipo_solicitud",
       "tipo_persona",
       "tipo_doc",
       "identificacion",
       "nombres",
       "apellidos",
       "razon_social",
       "asunto",
       "telefono_movil",
       "telefono_fijo",
       "direccion",
       "barrio",
       "email_responsable",
       "pais",
       "departamento",
       "municipio",
       "medio_respuesta",
       "lugar_denuncia",
       "cuando_denuncia",
       "involucrados_denuncia",
       "descripcion_hechos",
       "adj_descripcion",
       "riesgo_denuncia",
       "proceso_seleccion",
       "tipo_contrato",
       "informacion_contrato",
       "adj_informacion",
       "fecha_aprox_proceso",
       "lugar_contrato",
       "entidad_contrato",
       "link_contrato",
       "tiene_evidencias",
       "ha_denunciado",
       "entidad_denuncia",
       "otra_entidad",
       "impacta_organizacion",
       "contacto_adicional",
       "disuadirlo",
       "quien_disuade",
       "fecha_limite",
       "estado_solicitud",
       "observaciones_solicitud",
       "fecha_actuacion",
       "tratamiento_datos",
       "acepto_terminos",
       "confirmo_mayorEdad",
       "compartir_informacion",
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadDetalle extends Model
{
   protected $table = 'publicidad_detalle';
   protected $primaryKey = 'id';

   protected $fillable=[
       "publicidad_id",
       "tipo_valla",
       "alto_publicidad",
       "ancho_publicidad",
       "observacion_medidas",
       "alto_fachada",
       "ancho_fachada", 
       "ubicacion_aviso",
       "barrio_aviso",
       "fecha_inicial_fijacion",
       "fecha_final_fijacion",
       "inferior_treintaDias",
       "propiedad_privada",
       "adj_certificado_lyt",
       "adj_camara_comercio",
       "adj_fotomontaje",
       "adj_autorizacion_propietarios",
       "adj_licencia_construccion",
       "adj_RUT",
       "adj_descripcion_solicitud",
       "req_poliza",
       "req_tarjeta_profesional",
       "numero_caras",
       "created_at",
       "updated_at"

   ];
}

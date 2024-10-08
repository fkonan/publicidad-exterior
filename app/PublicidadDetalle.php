<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadDetalle extends Model
{
   protected $table = 'publicidad_detalle';
   protected $primaryKey = 'id';

   protected $fillable = [
      "publicidad_id",
      "tipo_valla",
      "alto_elemento",
      "ancho_elemento",
      "numero_caras",
      "area_total_elemento",
      "ancho_fachada",
      "alto_fachada",
      "area_total_fachada",
      "descripcion_elemento",
      "direccion_elemento",
      "caracteristicas_vehiculo",
      "tipo_vehiculo",
      "placa_vehiculo",
      "created_at",
      "updated_at"
   ];
}

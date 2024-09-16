<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicidadLiquidacion extends Model
{
   protected $table = 'publicidad_liquidacion';
   protected $primaryKey = 'id';

   protected $fillable=[
       "publicidad_id",
       "tipo_liquidacion",
       "salario_minimo",
       "area_publicidad",
       "valor_m2",
       "valor_mensual",
       "meses_pautar", 
       "valor_total",
       "created_at",
       "fecha_limite",
   ];
}

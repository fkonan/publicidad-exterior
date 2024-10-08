<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
   protected $table = 'publicidad_exterior';
   protected $primaryKey = 'id';

   protected $fillable = [
      "radicado",
      "PersonaId",
      "modalidad",
      "tipo_publicidad",
      "fecha_renovacion",
      "fecha_vencimiento",
      "numero_elementos",
      "esquinero",
      "estado_solicitud",
      "novedad",
      "dependencia",
      "tratamiento_datos",
      "acepto_terminos",
      "confirmo_mayorEdad",
      "compartir_informacion",
      "created_at",
      "updated_at"
   ];


   public static function getRadicados($modalidad, $dependencia)
   {
      if ($modalidad == 'TODAS') {
         $sql = "SELECT
         pe.id,
         radicado,
         pe.PersonaId,
         per.PersonaTip,
         per.PersonaDoc,
         per.PersonaNombre,
         per.PersonaApe,
         per.PersonaRazon,
         tipo_publicidad,
         fecha_vencimiento,
         estado_solicitud,
         novedad,
         dependencia
         FROM publicidad_exterior AS pe
         INNER JOIN personas AS per ON pe.PersonaId=per.PersonaId
         WHERE dependencia='$dependencia' and estado_solicitud<>'finalizado'";
         return $sql;
      } else {

         $sql = "SELECT
         pe.id,
         radicado,
         pe.PersonaId,
         per.PersonaTip,
         per.PersonaDoc,
         per.PersonaNombre,
         per.PersonaApe,
         per.PersonaRazon,
         tipo_publicidad,
         fecha_vencimiento,
         estado_solicitud,
         novedad,
         dependencia
         FROM publicidad_exterior AS pe
         INNER JOIN personas AS per ON pe.PersonaId=per.PersonaId
         WHERE modalidad='$modalidad' AND dependencia='$dependencia' and estado_solicitud<>'finalizado'";
      }
      return $sql;
   }

   public static function SqlEstado($estado, $modalidad, $dep = "INTERIOR")
   {
      $sql = "SELECT pe.id,radicado,pe.PersonaId,modalidad,tipo_publicidad,estado_solicitud,dependencia,
      PersonaTip,PersonaTipDoc,PersonaDoc,PersonaNombre,PersonaApe,PersonaRazon,PersonaTel,PersonaMail
      FROM publicidad_exterior AS pe
      INNER JOIN personas ON pe.PersonaId=personas.PersonaId ";
      $sql .= "WHERE estado_solicitud = '$estado' ";
      $sql .= "AND modalidad LIKE '$modalidad' ";
      $sql .= "AND dependencia LIKE '$dep' ";

      return $sql;
   }

   public static function SqlXCerrar()
   {
      $fecha = date("Y-m-d");
      $sql = "SELECT count(id) as Cantidad FROM publicidad_exterior WHERE TIMESTAMPDIFF(DAY, created_at, '$fecha') > 30";
      return $sql;
   }
}

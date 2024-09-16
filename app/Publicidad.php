<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
   protected $table = 'publicidad_exterior';
   protected $primaryKey = 'id';
   
   
   

   protected $fillable=[
       "radicado",
       "modalidad",
       "sub_modalidad",
       "nombre_responsable",
       "apellido_responsable",
       "tipo_documento",
       "numero_documento",
       "email_responsable",
       "telefono_responsable",
       "tipo_publicidad",
       "publicidad_instalada",
       "fecha_instalacion",
       "numero_elementos",
       "estado_solicitud",
       "observacion_solicitud",
       "fecha_actuacion",
       "fecha_pendiente_planeacion",
       "fecha_pendiente_salud",
       "fecha_pendiente_transito",
       "fecha_pendiente_ciudadano",
       "act_documentos",
       "tratamiento_datos",
       "acepto_terminos",
       "confirmo_mayorEdad",
       "compartir_informacion",
       "created_at",
       "updated_at"

   ];
   
   
   public static function SqlEstado($estado, $modalidad, $dep = "INTERIOR"){
	
		$sql = "SELECT * FROM publicidad_exterior ";
		$sql.= "WHERE publicidad_exterior.estado_solicitud = '$estado' ";
		$sql.= "AND publicidad_exterior.modalidad LIKE '$modalidad' ";
		$sql.= "AND publicidad_exterior.dependencia LIKE '$dep' ";

		return $sql;

	}
	
	public static function SqlXCerrar()
	{
		$fecha = date("Y-m-d");
		$sql = "SELECT count(id) as Cantidad FROM publicidad_exterior WHERE TIMESTAMPDIFF(DAY, created_at, '$fecha') > 30";
		return $sql;
	}
}

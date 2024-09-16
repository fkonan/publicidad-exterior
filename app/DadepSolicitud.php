<?php

namespace App;
use App\DocUpdate;
use App\Persona;

use Illuminate\Database\Eloquent\Model;

class DadepSolicitud extends Model
{
	
    protected $table = 'dadep_cesion';
    protected $primaryKey = 'SolicitudId';

    protected $fillable=[
       
    ];
    
	public static function SqlEstado($estado, $tipo="A"){
	
		$sql = "SELECT * FROM dadep_cesion ";
		$sql.= "INNER JOIN personas ON dadep_cesion.PersonaId = personas.PersonaId ";
		$sql.= "WHERE dadep_cesion.SolicitudEstado = '$estado' AND dadep_cesion.Tipo = '$tipo'";
		
		return $sql;

	}
	
	public static function SqlXCerrar()
	{
		$fecha = date("Y-m-d");
		$sql = "SELECT count(SolicitudId) as Cantidad FROM dadep_cesion WHERE TIMESTAMPDIFF(DAY, created_at, '$fecha') > 30";
		return $sql;
	}
      
}

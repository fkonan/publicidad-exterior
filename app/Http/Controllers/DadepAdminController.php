<?php

namespace App\Http\Controllers;

use App\DadepSolicitud;
use App\DadepNovedad;
use App\Persona;
use App\Documento;

use App\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnvioNotificacion;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

include_once "DadepGeneral.php";

class myObject  
{
  public function __set($name, $value) {
    $this->{$name} = $value;
  }
}

class DadepAdminController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public function index()
    {
		
        return view('tramites.DadepAdmin.index');
    }

    public function Cesion(Request $r)
    {
		$tipo = $r->tipo;
		
		$sGrupos = array();
		$estados = array("ENVIADA","EN PROGRESO","PENDIENTE","APROBADA","RECHAZADA");
		$nombres = array("Enviadas","En Progreso","Pendientes","Aprobadas","Rechazadas");
		$i=0;
		foreach($estados as $estado){
			$objeto = new myObject;
			$objeto->datos = DB::select(DadepSolicitud::SqlEstado($estado,$tipo));
			$objeto->titulo = str_replace(" ","",$estado);
			$objeto->cantidad = count($objeto->datos);
			$objeto->nombre = $nombres[$i];
			$objeto->activo = "";
			$sGrupos[] = $objeto;
			$i++;
		}
		$sGrupos[0]->activo = "active";
		
		$porCerrar = DB::select(DadepSolicitud::SqlXCerrar());
		$PORCERRAR = 0;
		if (!empty($porCerrar)){ $PORCERRAR = $porCerrar[0]->Cantidad;}
		    
     
        return view('tramites.DadepAdmin.CesionA.index', compact('sGrupos','PORCERRAR','tipo'));
    }

    public function detalleSolicitud(Request $req, $id)
    {
		
        $solicitud = DadepSolicitud::findOrFail($id);
        $personas = Persona::findOrFail($solicitud->PersonaId);
        $documento = Documento::where("Radicado", $solicitud->Radicado)->get();
        $documentos = array();
        if ($documento->count() > 0) {
			
			$documentos = $documento->getDictionary();
		}
		
		$novedad = DadepNovedad::where("SolicitudId", $solicitud->SolicitudId)->get();
        $novedades = array();
        if ($novedad->count() > 0) {
			
			$novedades = $novedad->getDictionary();
		}
		if ($solicitud->Tipo == "A"){

			return view('tramites.DadepAdmin.CesionA.detalle', compact('solicitud', 'personas', 'documentos', 'novedades'));
		}else{
			return view('tramites.DadepAdmin.CesionA.detalleB', compact('solicitud', 'personas', 'documentos', 'novedades'));
		}
	}
    
    public function finalizar(Request $req){
		
		$solicitud = DadepSolicitud::Find($req->SolicitudId);
		
		if(!empty($solicitud)){
			$tipo = array("","Revision de documentos","Programacion de visita","Registro de visita","Registro de oficio");

			$novedad = new DadepNovedad();
			$novedad->NovedadComentario = $req->NovedadComentario;
			$novedad->NovedadEstado = $req->Novedad[$req->tiponovedad];
			$novedad->NovedadTipo = $tipo[$req->tiponovedad];
			$novedad->SolicitudId = $solicitud->SolicitudId;
			$novedad->FuncionarioId = 1;
			$solicitud->SolicitudEstado = $this->estado($req->tiponovedad, $novedad->NovedadEstado);
			
			$solicitud->save();
			
			$docs = array($novedad->NovedadTipo);
			
			$documentos = DadepGeneral::CargarDoc($req, $docs, $solicitud->Radicado);
			
			$user = DadepGeneral::GetUser();
			if($novedad->save()){
				
				$per = Persona::Find($solicitud->PersonaId);
				$solicitud->Comentario = $novedad->NovedadComentario ;
				$solicitud->NovedadTipo = $novedad->NovedadTipo ;
				$solicitud->NovedadEstado = $novedad->NovedadEstado;
				$solicitud->PerNombre = $per->PersonaNombre." ".$per->PersonaApe;
				
				DadepGeneral::sendMail($per,$solicitud,'tramites.DadepAdmin.CorreoSol',false,reset($documentos));

				
				$auditoria = Auditoria::create([
					'usuario' => $user,
					'proceso_afectado'=> 'Radicado-Dadep-'.$solicitud->Radicado,
					'tramite' =>'SECCION DE AREA TIPO A',
					'radicado' => $solicitud->Radicado,
					'accion'=>'update a estado '.$solicitud->SolicitudEstado . " ". $novedad->NovedadTipo . " " . $novedad->NovedadEstado,
					'observacion'=>$req->NovedadComentario

				]);
			}
		}
		
		return redirect('/tramites/DadepAdmin/Cesion/detalle/'.$solicitud->SolicitudId);	
		
	}
	
	private function estado($tipo,$estado)
	{
		$estados = array();
		$estados["COMPLETO1"] = "EN PROGRESO";
		$estados["INCOMPLETO1"] = "PENDIENTE";
		$estados["RECHAZADO1"] = "RECHAZADA";
		$estados["PROGRAMADO2"] = "EN PROGRESO";
		$estados["FAVORABLE3"] = "EN PROGRESO";
		$estados["NOFAVORABLE3"] = "RECHAZADA";
		$estados["CORRECCIONES3"] = "PENDIENTE";
		$estados["APROBADO4"] = "APROBADA";
		$estados["RECHAZADO4"] = "RECHAZADA";
		$estado = str_replace (" ", "", $estado).$tipo;
		return $estados[$estado];
		
	}
}

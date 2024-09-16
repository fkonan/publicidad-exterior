<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use App\Auditoria;
use App\Parametro;
use App\Barrio;
use App\Documento;
use App\Persona;
use App\DadepSolicitud;
use App\DadepNovedad;
use App\Mail\MailDadep;
include_once "DadepGeneral.php";


class DadepController extends Controller
{
    public function index(){
		
		$Datos = new Persona();
		$Datos->TituloApp = "Entregas de Areas de cesión";
					
        return view('tramites.Dadep.index', compact('Datos'));
    }
    
     public function solicitud(){
		 
		$Datos = new Persona();
		$Datos->TituloApp = "Entregas de Areas de cesión";
					
        return view('tramites.Dadep.inicio', compact('Datos'));
    }

	public function solicitar(Request $req){

       $Qs = Persona::where("PersonaDoc", $req->ide_responsable)->get();

        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Datos = reset($array);
			$Datos->PersonaTipDoc = $req->tipo_documento;
        } else {
			$Datos = new Persona();
			$Datos->PersonaTipDoc = $req->tipo_documento;
			$Datos->PersonaDoc = $req->ide_responsable;
        }
        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
		$Datos->TituloApp = "Entregas de Areas de cesión";

	   return view('tramites.Dadep.Solicitud', compact('Datos','Parametros1', 'Parametros2', 'Barrios'));

    }
    
    public function finalizar(Request $req){
		
		//Creando o actualizando datos de la persona-------------------
		
		$Datos = Persona::Find($req->PersonaId);
		//$Cs->PersonaId = $req->PersonaId;
		if(empty($Datos)){
			$Datos = new Persona();
		}
		if($req->TipoPersona == "Juridica"){
			$Datos->PersonaNombre = $req->razon_social;
			$Datos->PersonaApe ="";
		}else{
			$Datos->PersonaNombre = $req->nom_responsable;
			$Datos->PersonaApe = $req->ape_responsable;
		}
		$Datos->PersonaTip = $req->TipoPersona;
		$Datos->PersonaTipDoc = $req->tipo_documento;
		$Datos->PersonaDoc = $req->ide_responsable;
		$Datos->PersonaMail = $req->email_responsable;
		$Datos->PersonaTel = $req->tel_responsable;
		$Datos->PersonaDir = $req->dir_solicitante;
		$Datos->PersonaBarrio = $req->barrio_responsable_sol;
	
		$Datos->save();
		$Datos->TituloApp = "Entrega Areas de Cesión";
       
       // $cs::create($req->all());
       
       
       //Creando o actualizando solicitud-------------------
	
	    $Cs = new DadepSolicitud();
	    
	    if($req->TipoPersona == "Juridica"){
		
			$Cs->RepNombre = $req->RepNombre;
			$Cs->RepApellido = $req->RepApellido;
			$Cs->RepTipDoc = $req->RepTipDoc;
			$Cs->RepDoc = $req->RepDoc;
			$Cs->RepMail = $req->RepMail;
			$Cs->RepTel = $req->RepTel;
		
		}else{
			$Cs->RepNombre = $Datos->PersonaNombre;
			$Cs->RepApellido = $Datos->PersonaApe;
			$Cs->RepTipDoc = $Datos->PersonaTipDoc;
			$Cs->RepDoc = $Datos->PersonaDoc;
			$Cs->RepMail = $Datos->PersonaMail;
			$Cs->RepTel = $Datos->PersonaTel;
		}
		$Cs->PersonaId = $Datos->PersonaId;
		$Cs->PredioDir = $req->dir_responsable;
		$Cs->PredioBarrio = $req->barrio_responsable;
		$Cs->PredioLicencia = $req->PredioLicencia;
		$Cs->PredioMatricula = $req->PredioMatricula;
		$Cs->PredioEscritura = $req->PredioEscritura." De ".$req->Escritura." Notaria ".$req->Notaria.
		" De ".$req->Ciudad;
		$Cs->PredioAreaTotal = $req->PredioAreaTotal;
		$Cs->PredioAreaCesion = $req->PredioAreaCesion;
		$Cs->SolicitudEstado = "ENVIADA";
		$Cs->Tipo = "A";
		
		//creando radicado
		$y = date("Y");
		$sql = "select count(SolicitudId) as Cantidad from dadep_cesion Where ( YEAR(created_at)=$y)";
		$obj = DB::select($sql);
		$id = $obj[0]->Cantidad + 1;
		$id = 10000000 + $id;
		$id = "$id";
		$Cs->Radicado = $y . "-" . substr($id,-3);
	
		$Cs->save();
		
		$docs = array(
			"Documento Identificacion",
			"Escritura Publica",
			"Licencia Urbanizacion",
			"Cert tradicion y Libertad",
			"Estudio de titulos",
			"Planos",
			"Poder"
		);
		
		DadepGeneral::CargarDoc($req, $docs, $Cs->Radicado);
		$Cs->PerNombre = $Datos->PersonaNombre." ".$Datos->PersonaApe;
	
		DadepGeneral::sendMail($Datos,$Cs,'tramites.Dadep.CorreoSol','tramites.Dadep.CorreoFun');
		       
		return view('tramites.Dadep.ResSol', compact('Cs','Datos'));

	}
		
	 public function consulta(Request $request){
    
        $Qs = DadepSolicitud::where($request->tipo_parametro, $request->parametro)->get();

        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Solicitud = reset($array);
			$Persona = Persona::Find($Solicitud->PersonaId);
        
            return view('tramites.Dadep.Consulta', compact('Solicitud','Persona'));
        } else {
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
            return redirect()->route('Dadep.index');
        }
    }
    
   
	
	//----Documentos Pendientes-----//
	
	public function DocConsulta(){
		
		$Datos = new Persona();
		$Datos->TituloApp = "Entregas de Areas de cesión";
		$funcion = "DocPendientes";
		return view('tramites.Dadep.BusRadicado', compact('funcion','Datos'));
    }
    
    public function DocPendientes(Request $request){
    
        $Qs = DadepSolicitud::where("Radicado", $request->Radicado)->where("RepDoc",$request->identificacion)->get();
        
        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Solicitud = reset($array);
			if($Solicitud->SolicitudEstado == "PENDIENTE"){
				$Datos = Persona::Find($Solicitud->PersonaId);
				$Datos->TituloApp ="Entregas Areas de Cesión";
				if($Solicitud->Tipo == "A"){
					return view('tramites.Dadep.DocPendientes', compact('Solicitud','Datos'));
				}else{
					return view('tramites.Dadep.DocPendientesB', compact('Solicitud','Datos'));
				}
			
			}else{
				  Alert::warning('Lo sentimos', 'El Numero: .' . $request->Radicado . ' no tiene documentos pendientes');
				  return redirect()->route('Dadep.index');
			}
        }else{
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->Radicado . ' no tiene registros asociados');
            return redirect()->route('Dadep.index');
        }
    }
    
    public function Guardar(Request $req){
		
	$Qs = DadepSolicitud::where("Radicado", $req->Radicado)->get();

        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Solicitud = reset($array);
			$Solicitud->SolicitudEstado = "ENVIADA";
			$Solicitud->save();
			$Datos = Persona::Find($Solicitud->PersonaId);
        } 
		$docs = array(
			"Documento Identificacion",
			"Escritura Publica",
			"Licencia Urbanizacion",
			"Cert tradicion y Libertad",
			"Estudio de titulos",
			"Planos",
			"Poder"
		);
		if($Solicitud->Tipo == "B"){
			$docs = array(
			"Documento Identificación",
			"Solicitud escrituración",
			"Acto administrativo",
			"Minuta o escritura pública",
			"Cert tradición y Libertad",
			"Estudio de titulos",
			"Poder",
			"Planos"
		    );
		
		}
		$Datos->TituloApp = "Entregas de Areas de cesión";
		
		DadepGeneral::CargarDoc($req, $docs, $req->Radicado);
	
		DadepGeneral::sendMail($Datos,$Solicitud,'tramites.Dadep.CorreoSol','tramites.Dadep.CorreoFun');
		$req->tipo_parametro = "Radicado";
		$req->parametro = $req->Radicado;
		return view('tramites.Dadep.ResDocPendientes', compact('Solicitud', 'Datos'));

	}
	
	
	//------LEGALIZACION-----//
	
	public function solLegalizacion(){
		$Datos = new Persona();
		$Datos->TituloApp = "Entregas de Areas de cesión";
					
        return view('tramites.Dadep.inicioB', compact('Datos'));
		}
		
	public function solicitarB(Request $req){

       $Qs = Persona::where("PersonaDoc", $req->ide_responsable)->get();

        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Datos = reset($array);
			$Datos->PersonaTipDoc = $req->tipo_documento;
        } else {
			$Datos = new Persona();
			$Datos->PersonaTipDoc = $req->tipo_documento;
			$Datos->PersonaDoc = $req->ide_responsable;
        }
        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
        

	   return view('tramites.Dadep.SolicitudB', compact('Datos','Parametros1', 'Parametros2', 'Barrios'));

    }
    
     public function finalizarB(Request $req){
		
		//Creando o actualizando datos de la persona-------------------
		
		$Datos = Persona::Find($req->PersonaId);
		//$Cs->PersonaId = $req->PersonaId;
		if(empty($Datos)){
			$Datos = new Persona();
		}
		if($req->TipoPersona == "Juridica"){
			$Datos->PersonaNombre = $req->razon_social;
			$Datos->PersonaApe ="";
		}else{
			$Datos->PersonaNombre = $req->nom_responsable;
			$Datos->PersonaApe = $req->ape_responsable;
		}
		$Datos->PersonaTip = $req->TipoPersona;
		$Datos->PersonaTipDoc = $req->tipo_documento;
		$Datos->PersonaDoc = $req->ide_responsable;
		$Datos->PersonaMail = $req->email_responsable;
		$Datos->PersonaTel = $req->tel_responsable;
		$Datos->PersonaDir = $req->dir_solicitante;
		$Datos->PersonaBarrio = $req->barrio_responsable_sol;
	
		$Datos->save();
		$Datos->TituloApp = "Entregas de Areas de cesión";
      
       
       
       //Creando o actualizando solicitud-------------------
	
	    $Cs = new DadepSolicitud();
	    
	    if($req->TipoPersona == "Juridica"){
		
			$Cs->RepNombre = $req->RepNombre;
			$Cs->RepApellido = $req->RepApellido;
			$Cs->RepTipDoc = $req->RepTipDoc;
			$Cs->RepDoc = $req->RepDoc;
			$Cs->RepMail = $req->RepMail;
			$Cs->RepTel = $req->RepTel;
		
		}else{
			$Cs->RepNombre = $Datos->PersonaNombre;
			$Cs->RepApellido = $Datos->PersonaApe;
			$Cs->RepTipDoc = $Datos->PersonaTipDoc;
			$Cs->RepDoc = $Datos->PersonaDoc;
			$Cs->RepMail = $Datos->PersonaMail;
			$Cs->RepTel = $Datos->PersonaTel;
		}
		$Cs->PersonaId = $Datos->PersonaId;
		$Cs->PredioDir = $req->dir_responsable;
		$Cs->PredioBarrio = $req->barrio_responsable;
		$Cs->PredioLicencia = $req->PredioCatastral;
		$Cs->PredioMatricula = $req->PredioMatricula;
		$Cs->PredioEscritura = "";
		$Cs->PredioAreaTotal = 0;
		$Cs->PredioAreaCesion = 0;
		$Cs->SolicitudEstado = "ENVIADA";
		$Cs->Tipo = "B";
		
		//creando radicado
		$y = date("Y");
		$sql = "select count(SolicitudId) as Cantidad from dadep_cesion Where ( YEAR(created_at)=$y)";
		$obj = DB::select($sql);
		$id = $obj[0]->Cantidad + 1;
		$id = 10000000 + $id;
		$id = "$id";
		$Cs->Radicado = $y . "-" . substr($id,-3);
	
		$Cs->save();
		
		$docs = array(
			"Documento Identificación",
			"Solicitud escrituración",
			"Acto administrativo",
			"Minuta o escritura pública",
			"Cert tradición y Libertad",
			"Estudio de titulos",
			"Poder",
			"Planos"
			
		);
		
		DadepGeneral::CargarDoc($req, $docs, $Cs->Radicado);
		$Cs->PerNombre = $Datos->PersonaNombre." ".$Datos->PersonaApe;
	
		DadepGeneral::sendMail($Datos,$Cs,'tramites.Dadep.CorreoSol','tramites.Dadep.CorreoFun');
		       
		return view('tramites.Dadep.ResSol', compact('Cs', 'Datos'));

	}
    //////---------------CORRECCIONES----------------------///////
    
     public function Correcciones(){
		$Datos = new Persona();
		$Datos->TituloApp = "Entregas de Areas de cesión";
		$funcion = "updateCorrecciones";
		return view('tramites.Dadep.BusRadicado', compact('funcion', 'Datos'));
    }
    
    public function updateCorrecciones(Request $request){
		
		 $Qs = DadepSolicitud::where("Radicado", $request->Radicado)->where("RepDoc" , $request->identificacion)->get();
        
        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Solicitud = reset($array);
			if($Solicitud->SolicitudEstado == "PENDIENTE" and $Solicitud->Tipo == "B" ){
				$Datos = Persona::Find($Solicitud->PersonaId);
				$Datos->TituloApp = "Entregas de Areas de cesión";
					return view('tramites.Dadep.PendienteB', compact('Solicitud','Datos'));
				
			}else{
				  Alert::warning('Lo sentimos', 'El Numero: .' . $request->Radicado . ' no tiene actualizaciones pendientes');
				  return redirect()->route('Dadep.index');
			}
        }else{
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->Radicado . ' no tiene registros asociados');
            return redirect()->route('Dadep.index');
        }
    }
    public function GuardarB(Request $req){
		
		$Qs = DadepSolicitud::where("Radicado", $req->Radicado)->get();

        if ($Qs->count() > 0) {
			$array = $Qs->getDictionary();
			$Solicitud = reset($array);
			$Solicitud->SolicitudEstado = "EN PROGRESO";
			$Solicitud->save();
			$Persona = Persona::Find($Solicitud->PersonaId);
			
			$novedad = new DadepNovedad();
			$novedad->NovedadComentario = "Certifico que ".$req->estado_correccion." se realizaron las correcciones solicitadas";
			$novedad->NovedadEstado = $req->estado_correccion;
			$novedad->NovedadTipo = "Ejecución de correcciones";
			$novedad->SolicitudId = $Solicitud->SolicitudId;
			$novedad->FuncionarioId = 1;
			$novedad->save();
			
			$docs = array(
			"Documentos Adicionales"
		);
			
			DadepGeneral::CargarDoc($req, $docs, $Solicitud->Radicado);
			
			DadepGeneral::sendMail($Persona,$Solicitud,  'tramites.Dadep.CorreoSol','tramites.Dadep.CorreoFun');
			return view('tramites.Dadep.ResDocPendientes', compact('Solicitud'));
        }
		
	}
	
}
	
    /// ================== FIND MODIFICACION  =====================================  ///
    


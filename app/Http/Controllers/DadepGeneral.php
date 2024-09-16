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
use App\Mail\MailDadep;


class DadepGeneral extends Controller
{
   
    public static function CargarDoc(Request $req, $titulos, $radicado){
		
		$cant = count($titulos);
		$cargados = true;
		$utimos = array();
		for($i=0; $i<$cant; $i++){
			$campo = "documento" . $i;
			$titulo = str_replace(" ","",$titulos[$i]);
			$nombre = $radicado . "-" . $titulo . ".pdf";
			$folder = "documentos_dadep/" . $radicado ;
			$ruta = "storage/" . $folder . "/" . $nombre;
			if($req->$campo || $req->$campo != null){ 
				$g = $req->file($campo)->storeAs($folder, $nombre);
			}else{
				$g = false;
			}
			if($g){
				$docs = Documento::where("DocNombre", $nombre)->get();

				if ($docs->count() > 0) {
					$array = $docs->getDictionary();
					$doc = reset($array);
					$idx = substr ($doc->DocRuta, -1);
					if (is_numeric($idx)){
					$idx++;
					}else{ $idx = 1; }
				}else{
					$doc = new Documento();
					$idx = 1;
					
				}
				$doc->DocNombre = $nombre;
				$doc->DocTitulo = $titulos[$i];
				$doc->DocRuta = $ruta."?".$idx;
				$doc->Radicado = $radicado;
				$doc->save();
				$ultimos[] = $ruta;
			}else {
				$cargados = false;
				$ultimos[] = "NO";
			}
		}
		return $ultimos;
	
	}
	
	public static function sendMail($persona, $Cs, $vista1 = false, $vista2 = false, $doc = "NO"){
		
		 $detalleCorreo = [
                'nombres' => $persona->PersonaNombre,
                'radicado' => $Cs->Radicado,
                'Subject' => 'Solucitud entrega de area cesion',
                'documento'=> $doc,
                'fecha_pendiente' => null,            
                'estado' => null,
                'mensaje' => null,
                'Cs'=> $Cs
            ];

            $detalleCorreo_fun = [
                'nombres' => ' Funcionario Maria Margarita Jerez Arias',
                'radicado' => $Cs->Radicado,
                'Subject' => 'Solicitud pendiente para revision de documentos No'.$Cs->Radicado,
                'documento'=> 'NO',
                'fecha_pendiente' => null,            
                'estado' => 'FUNCIONARIO',
                'mensaje' => null,
                'Cs'=> $Cs
            ];
            $correo_funcionario = 'dadep@bucaramanga.gov.co';
            
            
			/* //auditoria
			$auditoria = Auditoria::create([
				'usuario' => $persona->PersonaDoc,
				'proceso_afectado'=> 'Radicado-'.$Cs->Radicado,
				'tramite'=> 'ENTREGA DE AREA DE CESION',
				'radicado'=> $Cs->Radicado,
				'accion'=>'update a estado ENVIADO',
				'observacion'=> 'El señor(es) '.$persona->PersonaNombre. 'realiza una solicitud para entregas de areas de cesion'

			]);*/

			// envio de correo                
			
						
		    if ($vista1 != false){
				Mail::to($persona->PersonaMail)->queue(new MailDadep($detalleCorreo,$vista1));
			}
			if ($vista2 != false){
				Mail::to($correo_funcionario)->queue(new MailDadep($detalleCorreo_fun,$vista2));
			}
	
	}
	
	public static function GetUser(){
		
			return auth()->user()->username;
		
	
	}
}
	

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Barrio;
use App\Evento;
use App\Auditoria;
use App\DocUpdate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionEventos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class EventosController extends Controller
{
    public function index(){       
     return view('tramites.eventos.index');
    }

    public function registro(){

        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
        return view('tramites.eventos.registro', compact('Parametros1', 'Parametros2', 'Barrios'));
 
     }

    public function confirmacion()
    {
        return view('tramites.eventos.confirmacion');
    }
    public function consultarTramite()
    {
        return view('tramites.eventos.consulta');
    }

    public function end()
    {
        Session::flush();
        return redirect("/eventos-publicos");
    }

    public function consulta(Request $request){
    

        $QuerySolicitud = Evento::where($request->tipo_parametro, $request->parametro)->get();

        if ($QuerySolicitud->count() > 0) {
            
            // return $QuerySolicitud;
            return view('tramites.eventos.resultado', compact('QuerySolicitud'));
        } else {
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
            return redirect()->route('eventos.index');
        }
    }

    public function detalle($id){

        $solicitud = Evento::FindOrFail(Crypt::decrypt($id));

        $date = Carbon::now();
        $date1 = Carbon::parse($solicitud->fecha_pendiente);
        $diff = $date1->diffInDays($date); 
        
        if($solicitud->tipo_persona == 1){
            $responsable = $solicitud->nom_responsable.' '.$solicitud->ape_responsable;
        }else if($solicitud->tipo_persona ==2){
            $responsable = $solicitud->razon_social;
        }
        
        return view('tramites.eventos.detalle', compact('solicitud', 'diff','responsable'));



    }

    public function store(Request $request){
        
        if($request->tipo_persona == 1){
            $this->validate($request, [
                "nom_responsable"=> "required",
                "ape_responsable"=> "required"]);
                $responsable = $request->nom_responsable.' '.$request->ape_responsable;

        }else if($request->tipo_persona ==2){
            $this->validate($request, [
                "razon_social"=> "required" ]);
            $responsable = $request->razon_social;

        }

        $this->validate($request, [
                    
            "tipo_persona" => "required",
            "tipo_documento" => "required",
            "ide_responsable" => "required",            
            "dir_responsable_sol" => "required",
            "barrio_responsable_sol"=> "required",
            "tel_responsable" => "required",
            "email_responsable" => "required",
            "fecha_evento" => "required",
            "hora_inicio" => "required",
            "hora_fin" => "required",
            "ubicacion_evento" => "required",       
            "barrio_evento" => "required",
            "cant_personas"=> "required",
            "pub_ext"=> "required",
            "reproduccion_musica"=> "required",
            "descripcion_evento" => "required",            
            "adj_cedulaRes_arch" => "required",          
            "adj_contratoArr_arch" => "required",
            "adj_conceptoTecAmb_arch"=> "required",
            "adj_certificadoPONAL_arch"=> "required",                     
            "adj_poliza_arch"=> "required",        
            "adj_certificadoEMAB_arch"=> "required",            
            "tratamiento_datos"=> "required",
            "acepto_terminos"=> "required",
            "confirmo_mayorEdad"=> "required",
            "compartir_informacion"=> "required"

        ],[
            "tratamiento_datos.required" =>'Aprobar el tratamiento de datos es obligatorio',
            "acepto_terminos.required"=>'Aceptar los terminos y condiciones es obligatorio',
            "confirmo_mayorEdad.required"=>'Confirmar que es mayor de edad es obligatorio',
            "compartir_informacion.required"=>'Responder si acepta compartir su informacion es obligatorio'
         ]);

       
        $ultimo_id = Evento::latest('id')->first();
        // return $ultimo_id;
        if (!$ultimo_id) {
            $idRadicado = 1;
        } else {
            $idRadicado = $ultimo_id->id + 1;
        }

        $radicado = date("Ymd") . $request->ide_responsable . $idRadicado; // numero radicado

        //documentos adjuntos

        if($request->adj_logisticaEvento_arch || $request->adj_logisticaEvento_arch != null){      
        $adjunto1 = $request->file('adj_logisticaEvento_arch')->storeAs('documentos_eventos/' . $radicado, 'Logistica-evento-' . $radicado . '.pdf');
        }else{
          $adjunto1 = false;
        }
      
        if($request->adj_autorizacionTra_arch || $request->adj_autorizacionTra_arch != null){ 
         $adjunto3 =  $request->file('adj_autorizacionTra_arch')->storeAs('documentos_eventos/' . $radicado, 'Autorizacion-transito-' . $radicado . '.pdf');
        }else{
            $adjunto3 = false;
        }

        if($request->adj_conceptoCMGRD_arch || $request->adj_conceptoCMGRD_arch != null){ 
            $adjunto5 =  $request->file('adj_conceptoCMGRD_arch')->storeAs('documentos_eventos/' . $radicado, 'Concepto-CMGRD-' . $radicado . '.pdf');
           }else{
               $adjunto5 = false;
           }

           if($request->adj_hospitalaria_arch || $request->adj_hospitalaria_arch != null){ 
            $adjunto9 = $request->file('adj_hospitalaria_arch')->storeAs('documentos_eventos/' . $radicado, 'Servicio-prehospitalario-' . $radicado . '.pdf');
           }else{
               $adjunto9 = false;
           }

           if($request->adj_certificadoBomberos_arch || $request->adj_certificadoBomberos_arch != null){ 
            $adjunto8 = $request->file('adj_certificadoBomberos_arch')->storeAs('documentos_eventos/' . $radicado, 'Concepto-BOMBEROS-' . $radicado . '.pdf');
           }else{
               $adjunto8 = false;
           }

           if($request->adj_publicidad_arch || $request->adj_publicidad_arch != null){ 
            $adjunto11 =  $request->file('adj_publicidad_arch')->storeAs('documentos_eventos/' . $radicado, 'Pago-publicidad-' . $radicado . '.pdf');
           }else{
               $adjunto11 = false;
           }

           if($request->adj_derAutor_arch || $request->adj_derAutor_arch != null){ 
            $adjunto14 =  $request->file('adj_derAutor_arch')->storeAs('documentos_eventos/' . $radicado, 'Certificado-derechos-autor-' . $radicado . '.pdf');
           }else{
               $adjunto14 = false;
           }
        
        
        $adjunto2 =  $request->file('adj_cedulaRes_arch')->storeAs('documentos_eventos/' . $radicado, 'Documento-identificacion-' . $radicado . '.pdf');

        $adjunto4 = $request->file('adj_contratoArr_arch')->storeAs('documentos_eventos/' . $radicado, 'Contrato-arrendamiento-' . $radicado . '.pdf');

        $adjunto6 = $request->file('adj_conceptoTecAmb_arch')->storeAs('documentos_eventos/' . $radicado, 'Concepto-Tecnico-ambiental-' . $radicado . '.pdf');

        $adjunto7 = $request->file('adj_certificadoPONAL_arch')->storeAs('documentos_eventos/' . $radicado, 'Concepto-PONAL-' . $radicado . '.pdf');      

        $adjunto10 =  $request->file('adj_poliza_arch')->storeAs('documentos_eventos/' . $radicado, 'Poliza-responsabilidad-civil-' . $radicado . '.pdf');
      
        $adjunto13 =  $request->file('adj_certificadoEMAB_arch')->storeAs('documentos_eventos/' . $radicado, 'Certificado-EMAB-' . $radicado . '.pdf');

       
       
        //rutas de documentos
        if ($adjunto2 && $adjunto4 && $adjunto6 && $adjunto7 && $adjunto10 && $adjunto13 || $adjunto14 || $adjunto1 || $adjunto3 || $adjunto5 || $adjunto9 || $adjunto8 || $adjunto11) {

           if($adjunto1){
            $adj_logisticaEvento = 'storage/documentos_eventos/' . $radicado . '/Logistica-evento-' . $radicado . '.pdf';
            }else{
            $adj_logisticaEvento = null;
            }

            if($adjunto3){
              $adj_autorizacionTra = 'storage/documentos_eventos/' . $radicado . '/Autorizacion-transito-' . $radicado . '.pdf';
                }else{
                $adj_autorizacionTra = null;
            }

            if($adjunto5){
                $adj_conceptoCMGRD = 'storage/documentos_eventos/' . $radicado . '/Concepto-CMGRD-' . $radicado . '.pdf';
                  }else{
                  $adj_conceptoCMGRD = null;
              }

              if($adjunto9){
                $adj_hospitalaria = 'storage/documentos_eventos/' . $radicado . '/Servicio-prehospitalario-' . $radicado . '.pdf';
                  }else{
                  $adj_hospitalaria = null;
              }

              if($adjunto8){
                $adj_certificadoBomberos = 'storage/documentos_eventos/' . $radicado . '/Concepto-BOMBEROS-' . $radicado . '.pdf';
                  }else{
                  $adj_certificadoBomberos = null;
              }

              if($adjunto11){
                $adj_publicidad = 'storage/documentos_eventos/' . $radicado . '/Pago-publicidad-' . $radicado . '.pdf';
                  }else{
                  $adj_publicidad = null;
              }

              if($adjunto14){
                $adj_derAutor = 'storage/documentos_eventos/' . $radicado . '/Certificado-derechos-autor-' . $radicado . '.pdf';
                  }else{
                  $adj_derAutor = null;
              }


            $adj_cedulaRes = 'storage/documentos_eventos/' . $radicado . '/Documento-identificacion-' . $radicado . '.pdf';

            $adj_contratoArr = 'storage/documentos_eventos/' . $radicado . '/Contrato-arrendamiento-' . $radicado . '.pdf';

            $adj_conceptoTecAmb = 'storage/documentos_eventos/' . $radicado . '/Concepto-Tecnico-ambiental-' . $radicado . '.pdf';

            $adj_certificadoPONAL = 'storage/documentos_eventos/' . $radicado . '/Concepto-PONAL-' . $radicado . '.pdf';
       

            $adj_poliza = 'storage/documentos_eventos/' . $radicado . '/Poliza-responsabilidad-civil-' . $radicado . '.pdf';            

            $adj_certificadoEMAB = 'storage/documentos_eventos/' . $radicado . '/Certificado-EMAB-' . $radicado . '.pdf';

            

            // add al requests

            $request->request->add([
                'tipo_evento'=>1,
                'radicado' => $radicado,
                'dir_responsable'=>$request->dir_responsable_sol.' '.$request->barrio_responsable_sol,
                'adj_logisticaEvento' => $adj_logisticaEvento,            
                'adj_autorizacionTra' => $adj_autorizacionTra,
                'adj_cedulaRes' => $adj_cedulaRes,
                'adj_contratoArr'=> $adj_contratoArr,
                'adj_conceptoCMGRD'=> $adj_conceptoCMGRD,
                'adj_conceptoTecAmb'=> $adj_conceptoTecAmb,
                'adj_certificadoPONAL'=> $adj_certificadoPONAL,
                'adj_certificadoBomberos'=> $adj_certificadoBomberos,
                'adj_hospitalaria'=> $adj_hospitalaria,
                'adj_poliza'=> $adj_poliza,
                'adj_publicidad'=>$adj_publicidad,                
                'adj_certificadoEMAB'=> $adj_certificadoEMAB,
                'adj_derAutor'=> $adj_derAutor,
                'estado_solicitud' => 'ENVIADA',
                
            ]);

            $detalleCorreo = [
                'nombres' => $responsable,
                'radicado' => $radicado,
                'Subject' => 'Envió de Solicitud Permisos para Espectaculos Públicos',
                'documento'=> 'NO',
                'fecha_pendiente' => null,            
                'estado' => null,
                'mensaje'=> null
            ];

            $detalleCorreo_fun = [
                'nombres' => ' Funcionario Carlos Fernando Calderon',
                'radicado' => $radicado,
                'Subject' => 'Solicitud pendiente de Permiso para espectáculos públicos No'.$radicado,
                'documento'=> 'NO',
                'fecha_pendiente' => null,            
                'estado' => 'FUNCIONARIO',
                'mensaje'=> 'Usted tiene una solicitud pendiente del tramite "Permiso para espectáculos públicos diferentes a las artes escénicas", por favor ingrese a la plataforma para revisarla. '
            ];
            $correo_funcionario = 'ccalderon@bucaramanga.gov.co';

            $solicitud = $request->all();
            // return $solicitud;
            $saveSolicitud = Evento::create($solicitud);

            if ($saveSolicitud) {

                //auditoria
                $auditoria = Auditoria::create([
                    'usuario' => $request->ide_responsable,
                    'proceso_afectado'=> 'Radicado-'.$radicado,
                    'tramite'=> 'PERMISOS PARA ESPECTACULOS PUBLICOS',
                    'radicado'=> $radicado,
                    'accion'=>'update a estado ENVIADO',
                    'observacion'=> 'El señor(es) '.$responsable. 'realiza una solicitud de permisos para espectaculos publicos'
    
                ]);
    
                // envio de correo                
                Mail::to($request->email_responsable)->queue(new NotificacionEventos($detalleCorreo));
                Mail::to($correo_funcionario)->queue(new NotificacionEventos($detalleCorreo_fun));
    
                $request->session()->flash('radicado_id', $radicado);
                return redirect()->route('eventos.confirmacion');
            } else {
                Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
                return redirect()->route('eventos.index');
            }


        }else{

            
            Alert::error('Ha Ocurrido un error', 'Los archivos no se han cargado correctamente vuelva intentarlo');
            return redirect()->route('eventos.index');


        }

    }
    
    public function updateDocs(Request $request){     

        $solicitud = Evento::FindOrFail($request->id);
        $contadorDocs = DocUpdate::where('evento_id', $request->id);
        if($contadorDocs == null || $contadorDocs->count() == 0){
            $docUpdate = new DocUpdate;
            $docUpdate->evento_id  = $request->id;
        }else{
            $docUpdate = DocUpdate::FindOrFail($request->id);
        }
       
        $contador = 0;
        


        if($solicitud->tipo_persona == 1){            
            $responsable = $solicitud->nom_responsable.' '.$solicitud->ape_responsable;
            }else if($solicitud->tipo_persona ==2){           
                $responsable = $solicitud->razon_social;
            }

        if($request->adj_cedulaRes_arch){
            $adjunto1 =  $request->file('adj_cedulaRes_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Documento-identificacion-update-' . $solicitud->radicado . '.pdf');
            $adj_cedulaRes = 'storage/documentos_eventos/' . $solicitud->radicado . '/Documento-identificacion-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_cedulaRes = $adj_cedulaRes;
            $contador++;
        }else{
            $adjunto1 = false;
        }   

        if($request->adj_logisticaEvento_arch){
            $adjunto2 =  $request->file('adj_logisticaEvento_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Logistica-evento-update-' . $solicitud->radicado . '.pdf');
            //guarda ruta
            $ruta_adj_logisticaEvento = 'storage/documentos_eventos/' . $solicitud->radicado . '/Logistica-evento-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_logisticaEvento = $ruta_adj_logisticaEvento;            
            $contador++;
        }else{
            $adjunto2 = false;
        } 

        if($request->adj_autorizacionTra_arch){
            $adjunto3 =  $request->file('adj_autorizacionTra_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Autorizacion-transito-update-' . $solicitud->radicado . '.pdf');
            // guarda ruta
            $ruta_adj_autorizacionTra = 'storage/documentos_eventos/' . $solicitud->radicado . '/Autorizacion-transito-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_autorizacionTra = $ruta_adj_autorizacionTra;

            $contador++;
        }else{
            $adjunto3 = false;
        } 

        if($request->adj_contratoArr_arch){
            $adjunto4 =  $request->file('adj_contratoArr_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Contrato-arrendamiento-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_contratoArr = 'storage/documentos_eventos/' . $solicitud->radicado . '/Contrato-arrendamiento-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_contratoArr = $ruta_adj_contratoArr;
            $contador++;
        }else{
            $adjunto4 = false;
        } 

        if($request->adj_conceptoCMGRD_arch){
            $adjunto5 =  $request->file('adj_conceptoCMGRD_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Concepto-CMGRD-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_conceptoCMGRD = 'storage/documentos_eventos/' . $solicitud->radicado . '/Concepto-CMGRD-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_conceptoCMGRD = $ruta_adj_conceptoCMGRD;
            $contador++;
        }else{
            $adjunto5 = false;
        } 

        
        if($request->adj_conceptoTecAmb_arch){
            $adjunto6 =  $request->file('adj_conceptoTecAmb_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Concepto-Tecnico-ambiental-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_conceptoTecAmb = 'storage/documentos_eventos/' . $solicitud->radicado . '/Concepto-Tecnico-ambiental-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_conceptoTecAmb = $ruta_adj_conceptoTecAmb;
            $contador++;
        }else{
            $adjunto6 = false;
        } 

        if($request->adj_certificadoPONAL_arch){
            $adjunto7 =  $request->file('adj_certificadoPONAL_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Concepto-PONAL-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_certificadoPONAL = 'storage/documentos_eventos/' . $solicitud->radicado . '/Concepto-PONAL-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_certificadoPONAL = $ruta_adj_certificadoPONAL;
            $contador++;
        }else{
            $adjunto7 = false;
        } 

        if($request->adj_certificadoBomberos_arch){
            $adjunto8 =  $request->file('adj_certificadoBomberos_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Concepto-BOMBEROS-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_certificadoBomberos = 'storage/documentos_eventos/' . $solicitud->radicado . '/Concepto-BOMBEROS-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_certificadoBomberos = $ruta_adj_certificadoBomberos;
            $contador++;
        }else{
            $adjunto8 = false;
        } 

        if($request->adj_hospitalaria_arch){
            $adjunto9=  $request->file('adj_hospitalaria_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Servicio-prehospitalario-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_hospitalaria = 'storage/documentos_eventos/' . $solicitud->radicado . '/Servicio-prehospitalario-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_hospitalaria = $ruta_adj_hospitalaria;
            $contador++;
        }else{
            $adjunto9 = false;
        } 

        if($request->adj_publicidad_arch){
            $adjunto10=  $request->file('adj_publicidad_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Pago-publicidad-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_publicidad = 'storage/documentos_eventos/' . $solicitud->radicado . '/Pago-publicidad-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_publicidad = $ruta_adj_publicidad;
            $contador++;
        }else{
            $adjunto10 = false;
        } 
       

        if($request->adj_certificadoEMAB_arch){
            $adjunto12=  $request->file('adj_certificadoEMAB_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Certificado-EMAB-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_certificadoEMAB = 'storage/documentos_eventos/' . $solicitud->radicado . '/Certificado-EMAB-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_certificadoEMAB = $ruta_adj_certificadoEMAB;
            $contador++;
        }else{
            $adjunto12 = false;
        } 

        if($request->adj_derAutor_arch){
            $adjunto13=  $request->file('adj_derAutor_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Certificado-derechos-autor-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_derAutor = 'storage/documentos_eventos/' . $solicitud->radicado . '/Certificado-derechos-autor-update-' . $solicitud->radicado . '.pdf';
            $docUpdate->adj_derAutor = $ruta_adj_derAutor;
            $contador++;
        }else{
            $adjunto13 = false;
        } 

        if($request->adj_poliza_arch){
            $adjunto14=  $request->file('adj_poliza_arch')->storeAs('documentos_eventos/' . $solicitud->radicado, 'Poliza-responsabilidad-civil-update-' . $solicitud->radicado . '.pdf');
            $ruta_adj_poliza = 'storage/documentos_eventos/' . $solicitud->radicado . '/Poliza-responsabilidad-civil-update-' . $solicitud->radicado . '.pdf';  
            $docUpdate->adj_poliza = $ruta_adj_poliza;
            $contador++;
        }else{
            $adjunto14 = false;
        }

        $detalleCorreo_fun = [
            'nombres' => ' Funcionario Carlos Fernando Calderon',
            'radicado' => $solicitud->radicado,
            'Subject' => 'Solicitud pendiente documentos actualizados de Permiso para espectáculos públicos No'.$solicitud->radicado,
            'documento'=> 'NO',
            'fecha_pendiente' => null,            
            'estado' => 'FUNCIONARIO',
            'mensaje'=> 'Usted tiene una solicitud pendiente del tramite "Permiso para espectáculos públicos diferentes a las artes escénicas" en la cual el ciudadano ya actualizo los documentos, por favor ingrese a la plataforma para revisarla. '
        ];
        $correo_funcionario = 'ccalderon@bucaramanga.gov.co';
        // $correo_funcionario = 'ojrincon@bucaramanga.gov.co';

        if($adjunto1 || $adjunto2 || $adjunto3 || $adjunto4 || $adjunto5 || $adjunto6 || $adjunto7 || $adjunto8 || $adjunto9 || $adjunto10 || $adjunto12 || $adjunto13 || $adjunto14){

            //auditoria
            $auditoria = Auditoria::create([
              'usuario' => $solicitud->ide_responsable,
              'proceso_afectado'=> 'Radicado-'.$solicitud->radicado,
              'tramite'=> 'PERMISOS PARA ESPECTACULOS PUBLICOS',
              'radicado'=> $solicitud->radicado,
              'accion'=>'update de documentos',
              'observacion'=> 'El señor(es) '.$responsable.'realizan actulización de documentos dentro de las fechas permitidas'

          ]);

          Mail::to($correo_funcionario)->queue(new NotificacionEventos($detalleCorreo_fun));

          $solicitud->act_documentos = "SI";
          $solicitud->save();   
          $docUpdate->save();         
          Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
          return redirect()->route('eventos.index');

      }else{
          Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
          return redirect()->route('eventos.index');
      }

    }

}

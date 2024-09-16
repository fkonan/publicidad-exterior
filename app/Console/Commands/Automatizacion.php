<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Prueba;
use App\Parqueadero;
use App\Evento;
use App\CertificacionDiscapacidad;
use App\EspacioPublico;
use App\EspectaculosPublicos;
use App\Auditoria;
use App\NitEspectaculos;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificacionEspectaculos;
use App\Mail\EnvioNotificacion;
use App\Mail\NotificacionEventos;
use App\Mail\NotificacionParqueaderos;
use App\Mail\NotificacionDiscapacidad;

class Automatizacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revision:diaria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando sirve para rechazar automaticamente las solicitudes por vencimiento de plazos establecidos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $solicitudes_espacio = EspacioPublico::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'PENDIENTE')->get();
        if($solicitudes_espacio->count()>0){
         
            foreach($solicitudes_espacio as $solicitud){                  
                // auditoria

                $auditoria = Auditoria::create([

                    "usuario" => 'SISTEMA',
                    "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
                    "accion"=> 'Update a estado RECHAZADA',
                    "tramite"=>'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO',
                    "radicado" => $solicitud->radicado,
                    "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado rechazada. debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.'


                ]);
                
                //correo
                $detalleCorreo = [
                    'nombres' => $solicitud->nom_responsable . ' ' . $solicitud->ape_responsable,
                    'mensaje' => 'Solicitud en estado rechazada debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud; Por lo tanto, debe volver a realizar la solicitud en la pagina  http://ocupacionespaciopublico.bucaramanga.gov.co/',
                    'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
                    'documento' => 'NO',
                    'fecha_pendiente' => null,
                    'radicado'  => $solicitud->radicado,
                    'estado' => 'RECHAZADA'
                ];

                Mail::to($solicitud->email_responsable)->send(new EnvioNotificacion($detalleCorreo));
                

                // actualizar solicitud

                $datos = EspacioPublico::findOrFail($solicitud->id);
                $datos->estado_solicitud = 'RECHAZADA';
                $datos->fecha_pendiente = null;
                $datos->observaciones_solicitud = 'Solicitud en estado rechazada. debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.';
                $datos->fecha_actuacion = $date;
                $datos->save();               

            }

        }

        //tramite eventos

        $eventos = Evento::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'PENDIENTE')->get();

        if($eventos->count()>0){            

          foreach($eventos as $solicitud){      
            
            //tipo personal

            if($solicitud->tipo_persona == 1){            
                $responsable = $solicitud->nom_responsable.' '.$solicitud->ape_responsable;
                }else if($solicitud->tipo_persona ==2){           
                    $responsable = $solicitud->razon_social;
                }
            
            // auditoria

            $auditoria = Auditoria::create([

                "usuario" => 'SISTEMA',
                "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
                "accion"=> 'Update a estado RECHAZADA',
                "tramite"=>'PERMISOS PARA ESPECTACULOS PUBLICOS',
                "radicado" => $solicitud->radicado,
                "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado rechazada. debido al vencimiento del término de 15 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.'


            ]);
            
            //correo
            $detalleCorreo = [
                'nombres' => $responsable,
                'mensaje' => 'Solicitud en estado rechazada debido al vencimiento del término de 15 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud; Por lo tanto, debe volver a realizar la solicitud en la pagina  http://tramitesenlinea.bucaramanga.gov.co/eventos-publicos',
                'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
                'documento' => 'NO',
                'fecha_pendiente' => null,
                'radicado'  => $solicitud->radicado,
                'estado' => 'RECHAZADA'
            ];

            Mail::to($solicitud->email_responsable)->send(new NotificacionEventos($detalleCorreo));
            

            // actualizar solicitud

            $datos = Evento::findOrFail($solicitud->id);
            $datos->estado_solicitud = 'RECHAZADA';
            $datos->fecha_pendiente = null;
            $datos->observaciones_solicitud = 'Solicitud en estado rechazada. debido al vencimiento del término de 15 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.';
            $datos->fecha_actuacion = $date;
            $datos->save();               

        }

      }
      
      // tramite parqueaderos correo a solicitante
      $parqueaderos =  Parqueadero::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'PENDIENTE')->get();

      if($parqueaderos->count()>0){

       
       foreach($parqueaderos as $solicitud){                  
        // auditoria

        $auditoria = Auditoria::create([

            "usuario" => 'SISTEMA',
            "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
            "accion"=> 'Update a estado RECHAZADA',
            "tramite"=>'CATEGORIZACION DE PARQUEADEROS',
            "radicado" => $solicitud->radicado,
            "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado rechazada. debido al vencimiento del término de 15 días habiles, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.'


        ]);
        
        //correo
        $detalleCorreo = [
            'nombres' => $solicitud->nom_solicitante . ' ' . $solicitud->ape_solicitante,
            'mensaje' => 'Solicitud en estado rechazada debido al vencimiento del término de 15 días habiles, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud; Por lo tanto, debe volver a realizar la solicitud en la pagina  http://tramitesenlinea.bucaramanga.gov.co/categorizacion-parqueaderos',
            'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'radicado'  => $solicitud->radicado,
            'estado' => 'RECHAZADA'
        ];

        Mail::to($solicitud->email_responsable)->send(new NotificacionParqueaderos($detalleCorreo));
        

        // actualizar solicitud

        $datos = Parqueadero::findOrFail($solicitud->id);
        $datos->estado_solicitud = 'RECHAZADA';
        $datos->fecha_pendiente = null;
        $datos->observaciones_solicitud = 'Solicitud en estado rechazada. debido al vencimiento del término de 15 días(habiles), para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.';
        $datos->fecha_actuacion = $date;
        $datos->save();               

       }

      }

      //tramite parqueaderos correo a funcionario por vecimiento de plazo para entregar concepto tecnico

    $concepto_parqueadero =Parqueadero::where('fecha_pendiente_planeacion','<', $date)->where('estado_solicitud', 'REVISION-PLANEACION')->get();

      if($concepto_parqueadero->count()>0){

       
        foreach($concepto_parqueadero as $solicitud){                  
         // auditoria
 
         $auditoria = Auditoria::create([
 
             "usuario" => 'SISTEMA',
             "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
             "accion"=> 'Update a estado RECHAZADA',
             "tramite"=>'CATEGORIZACION DE PARQUEADEROS',
             "radicado" => $solicitud->radicado,
             "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado rechazada. debido al vencimiento del término de 30 días habiles dispuestos a de secretaria de planecación para  subsanar o allegar el concepto tecnico del parqueadero.'
 
 
         ]);
         
         //correo
         $detalleCorreo = [
             'nombres' => 'Dr Carlos Guerrero',
             'mensaje' => 'Solicitud en estado rechazada debido al vencimiento del término de 30 días habiles, para subsanar o allegar el concepto tecnico del parqueadero por parte de secretaria de planecación; Por lo tanto el ciudadano, debe volver a realizar la solicitud en la pagina  http://tramitesenlinea.bucaramanga.gov.co/categorizacion-parqueaderos',
             'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
             'documento' => 'NO',
             'fecha_pendiente' => null,
             'radicado'  => $solicitud->radicado,
             'estado' => 'RECHAZADA'
         ];

         $correo_funcionario = 'cjguerrero@bucaramanga.gov.co';
 
         Mail::to($correo_funcionario)->send(new NotificacionParqueaderos($detalleCorreo));
         
 
         // actualizar solicitud
 
         $datos = Parqueadero::findOrFail($solicitud->id);
         $datos->estado_solicitud = 'RECHAZADA';
         $datos->fecha_pendiente = null;
         $datos->observaciones_solicitud = 'Solicitud en estado rechazada debido al vencimiento del término de 30 días habiles, para subsanar o allegar el concepto tecnico del parqueadero por parte de secretaria de planecación';
         $datos->fecha_actuacion = $date;
         $datos->save();               
 
        }
 
       }

        //    ESPECTACULOS PUBLICOS 

        $pendientes_espectaculos =EspectaculosPublicos::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'PENDIENTE')->get();

        if($pendientes_espectaculos->count()>0){
 
        
         foreach($pendientes_espectaculos as $solicitud){                  
          // auditoria
  
          $auditoria = Auditoria::create([
  
              "usuario" => 'SISTEMA',
              "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
              "accion"=> 'Update a estado RECHAZADA',
              "tramite"=>'ESPECTACULOS PUBLICOS',
              "radicado" => $solicitud->radicado,
              "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado cerrada. debido al vencimiento del término (3 dias antes de la realización del evento), para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.'
  
  
          ]);
          
          //correo
          $detalleCorreo = [
              'nombres' => $solicitud->nombre_o_razon,
              'mensaje' => 'Solicitud en estado rechazada debido al vencimiento (3 dias antes de la realización del evento), para subsanar o allegar la información faltante y continuar con el trámite de su solicitud; Por lo tanto, debe volver a realizar la solicitud en la pagina  http://tramitesenlinea.bucaramanga.gov.co/espectaculos-publicos',
              'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
              'documento' => 'NO',
              'fecha_pendiente' => null,
              'radicado'  => $solicitud->radicado,
              'estado' => 'CERRADA'
          ];
  
          Mail::to($solicitud->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
          
  
          // actualizar solicitud
  
          $datos = EspectaculosPublicos::findOrFail($solicitud->id);
          $datos->estado_solicitud = 'EVENTO_FINALIZADO';
          $datos->fecha_pendiente = null;
          $datos->observaciones = 'Solicitud en estado Cerrada debido al vencimiento del término de (3 dias antes de la realización del evento), para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.';
          $datos->fecha_actuacion = $date;
          $datos->save();               
  
         }
        
     }
 
     // EVENTO UNICO
   
 
     $unicos_espectaculos =EspectaculosPublicos::where('fecha_fin_evento','<=', $date)->where('estado_solicitud', 'EVENTO_APROBADO')->where('evento_id', 1)->get();
 
     if($unicos_espectaculos->count()>0){
 
         foreach($unicos_espectaculos as $solicitud){                  
             // auditoria
 
             $date_3 = date("Y-m-d", strtotime($solicitud->fecha_fin_evento . "+3 Weekday"));    
     
             $auditoria = Auditoria::create([
     
                 "usuario" => 'SISTEMA',
                 "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
                 "accion"=> 'Update a estado EVENTO_REALIZADO',
                 "tramite"=>'ESPECTACULOS PUBLICOS',
                 "radicado" => $solicitud->radicado,
                 "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado de liquidación el contribuyente debera cargar la certificacion de la boleteria vendida y elaborar la declaración antes de la fecha-'.$date_3.' para evitar el cobro coactivo'
     
     
             ]);
 
             // GUARDAR EN TABLA PARA ELABORACION DE DECLARACION
 
             DB::connection('sqlsrv')->table('nit_espectaculos')->insert(
                 array('nit'=> $solicitud->numero_identificacion,
                       'espectaculo_id' => $solicitud->id,
                       'radicado_pago'=>date("Ymd", strtotime($solicitud->fecha_fin_evento)).'-'.$solicitud->id,
                       'nombre_evento'=>$solicitud->nombre_evento,
                       'tipo_evento'=>$solicitud->evento_id,
                       'fecha_liquidacion'=>$solicitud->fecha_fin_evento,
                       'fecha_limite_liquidacion'=> $date_3,
                       'estado'=> 'LIQUIDACION',
                       'created_at'=> date('Y-d-m H:i:s'),
                       'updated_at'=> date('Y-d-m H:i:s')
             )); 
             
             //correo
             $detalleCorreo = [
                 'nombres' => $solicitud->nombre_o_razon,
                 'mensaje' => 'Su solicitud ha entrado en periodo de liquidación, recuerde que cuenta hasta el ' . $date_3.' para realizar la elaboración de la declaración y adjuntar la certificacion de la boletería vendida',
                 'Subject' => 'Solicitud en Liquidacion Rad-N°' . $solicitud->radicado,
                 'documento' => 'NO',                
                 'fecha_pendiente' => $date_3,
                 'radicado'  => $solicitud->radicado,
                 'estado' => 'LIQUIDACION',
                 'id'=> Crypt::encrypt($solicitud->id) 
             ];
     
             Mail::to($solicitud->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
             
     
             // actualizar solicitud
     
             $datos = EspectaculosPublicos::findOrFail($solicitud->id);
             $datos->estado_solicitud = 'EVENTO_REALIZADO';
             $datos->fecha_pendiente = $date_3;
             $datos->observaciones = 'Su solicitud ha entrado en periodo de liquidación, recuerde que cuenta hasta el ' . $date_3.' para realizar la elaboración de la declaración y adjuntar la certificacion de la boletería vendida';
             $datos->fecha_actuacion = $date;            
             $datos->save();               
     
            }
     
 
     }
     // //cerrar eventos UNICOS por vencimiento de terminos
     // $pendientes_espectaculos_sucesivos =EspectaculosPublicos::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'EVENTO_REALIZADO')->where('evento_id', 1)->get();
 
     // if($pendientes_espectaculos_sucesivos->count()>0){
 
        
     //     foreach($pendientes_espectaculos_sucesivos as $solicitud){                  
     //      // auditoria
  
     //      $auditoria = Auditoria::create([
  
     //          "usuario" => 'SISTEMA',
     //          "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
     //          "accion"=> 'Update a estado CERRADA',
     //          "tramite"=>'ESPECTACULOS PUBLICOS',
     //          "radicado" => $solicitud->radicado,
     //          "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado cerrada. debido al vencimiento del término (3 dias despues de la realización del evento), para elaborar la declaración y realizar el respectivo pago. la solicitud entrara en un estado de cobro coactivo y se hara efectiva la garantia'
  
  
     //      ]);
 
     //      //ACTUALIZAR TABLA DE DECLARACIONE NIT_ESPECTACULOS
 
     //      DB::connection('sqlsrv')->table('nit_espectaculos')
     //      ->where('nit', $solicitud->numero_identificacion)
     //      ->where('espectaculo_id' , $solicitud->id)
     //      ->update(['estado'=> 'CANCELADO']);
                   
                   
                           
     //      //correo
     //      $detalleCorreo = [
     //          'nombres' => $solicitud->nombre_o_razon,
     //          'mensaje' => 'Solicitud No '.$solicitud->radicado. ' en estado cerrada. debido al vencimiento del término (3 dias despues de la realización del evento), para elaborar la declaración y realizar el respectivo pago. la solicitud entrara en un estado de cobro coactivo y se hara efectiva la garantia',
     //          'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°-' . $solicitud->radicado,
     //          'documento' => 'NO',
     //          'fecha_pendiente' => null,
     //          'radicado'  => $solicitud->radicado,
     //          'estado' => 'CERRADA'
     //      ];
  
     //      Mail::to($solicitud->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
          
  
     //      // actualizar solicitud
  
     //      $datos = EspectaculosPublicos::findOrFail($solicitud->id);
     //      $datos->estado_solicitud = 'EVENTO_FINALIZADO';
     //      $datos->fecha_pendiente = null;
     //      $datos->estado_documentos= null;
     //      $datos->observaciones = 'Solicitud No '.$solicitud->radicado. ' en estado cerrada. debido al vencimiento del término (3 dias despues de la realización del evento), para elaborar la declaración y realizar el respectivo pago. la solicitud entrara en un estado de cobro coactivo y se hara efectiva la garantia';
     //      $datos->fecha_actuacion = $date;
     //      $datos->save();               
  
     //     }
        
     // }
 
     //cerrar evento unico
 
     // EVENTOS SUCESIVOS
 
     $unicos_espectaculos =EspectaculosPublicos::where('fecha_inicio_evento','<=', $date)->where('estado_solicitud', 'EVENTO_APROBADO')->where('evento_id', 2)->get();
 
     if($unicos_espectaculos->count()>0){
 
         foreach($unicos_espectaculos as $solicitud){                  
             // auditoria
 
             //  $date_3 = date("Y-m-d", strtotime($solicitud->fecha_fin_evento . "+3 Weekday"));    
     
             $auditoria = Auditoria::create([
     
                 "usuario" => 'SISTEMA',
                 "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
                 "accion"=> 'Update a estado EVENTO_REALIZADO',
                 "tramite"=>'ESPECTACULOS PUBLICOS',
                 "radicado" => $solicitud->radicado,
                 "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado de liquidación el contribuyente debera cargar la certificacion de la boleteria vendida y elaborar la declaración DIARIA POR CADA DIA DEL EVENTO TRANSCURRIDO'
     
     
             ]);
 
 
 
             // GUARDAR EN TABLA PARA ELABORACION DE DECLARACION
             $period = CarbonPeriod::create($solicitud->fecha_inicio_evento, $solicitud->fecha_fin_evento);
             
             foreach ($period as $date) {
                 
             // $date_3 = date("Y-m-d", strtotime($date->format('Y-m-d') . "+3 Weekday"));
             
             DB::connection('sqlsrv')->table('nit_espectaculos')->insert(
                 array('nit'=> $solicitud->numero_identificacion,
                       'espectaculo_id' => $solicitud->id,
                       'radicado_pago'=>date("Ymd", strtotime($date->format('Y-m-d'))).'-'.$solicitud->id,
                       'nombre_evento'=>$solicitud->nombre_evento,
                       'tipo_evento'=>$solicitud->evento_id,
                       'fecha_liquidacion'=>$date->format('Y-m-d'),
                       'fecha_limite_liquidacion'=> date("Y-m-d", strtotime($date->format('Y-m-d') . "+3 Weekday")),
                       'estado'=> 'LIQUIDACION',
                       'created_at'=> date('Y-d-m H:i:s'),
                       'updated_at'=> date('Y-d-m H:i:s')
             )); 
 
          }
             
             //correo
             $detalleCorreo = [
                 'nombres' => $solicitud->nombre_o_razon,
                 'mensaje' => 'Su solicitud ha entrado en periodo de liquidación, ahora debera cargar la certificacion de la boleteria vendida y elaborar la declaración DIARIA POR CADA  DIA DEL EVENTO TRANSCURRIDO',
                 'Subject' => 'Solicitud en Liquidacion Rad-N°' . $solicitud->radicado,
                 'documento' => 'NO',                
                 'fecha_pendiente' => null,
                 'radicado'  => $solicitud->radicado,
                 'estado' => 'LIQUIDACION',
                 'id'=> Crypt::encrypt($solicitud->id) 
             ];
     
             Mail::to($solicitud->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
             
     
             // actualizar solicitud
     
             $datos = EspectaculosPublicos::findOrFail($solicitud->id);
             $datos->estado_solicitud = 'EVENTO_REALIZADO';            
             $datos->observaciones = 'La solicitud ha entrado en periodo de liquidación, ahora debera cargar la certificación de la boleteria vendida y elaborar la declaración DIARIA POR CADA  DIA DEL EVENTO TRANSCURRIDO';
             $datos->fecha_actuacion = $date;            
             $datos->save();               
     
            }
     
 
     }
 
     //correos de validacion de fecha limite en evento sucesivos
     $fechas_limites = NitEspectaculos::where('fecha_limite_liquidacion' ,'<',$date)->where('estado', 'LIQUIDACION')->get(); 
 
     if($fechas_limites->count()>0){
 
         foreach($fechas_limites as $solicitud){
 
             $datos = EspectaculosPublicos::findOrFail($solicitud->espectaculo_id);
 
             $auditoria = Auditoria::create([
     
                 "usuario" => 'SISTEMA',
                 "proceso_afectado" => 'Radicado-'.$datos->radicado,
                 "accion"=> 'Envio de notificación',
                 "tramite"=>'ESPECTACULOS PUBLICOS',
                 "radicado" => $datos->radicado,
                 "observacion" => 'Solicitud No '.$datos->radicado. ' con radicado de pago N° '.$solicitud->radicado_pago.' no fue cancelada dentro de los plazos establecidos (fecha limite de pago: '.$solicitud->fecha_limite_liquidacion.') la cual correspondia a la declaración del dia '.$solicitud->fecha_liquidacion.' del espectaculo '.$datos->nombre_evento,' por lo cual este pago entrara en sancion por extemporaneidad o en proceso de cobro coactivo'
     
     
             ]);
 
             // envio de correo
 
              //correo
              $detalleCorreo = [
                 'nombres' => $datos->nombre_o_razon,
                 'mensaje' => 'Su Solicitud No '.$datos->radicado. ' con radicado de pago N° '.$solicitud->radicado_pago.' no fue cancelada dentro de los plazos establecidos (fecha limite de pago: '.$solicitud->fecha_limite_liquidacion.') la cual correspondia a la declaración del dia '.$solicitud->fecha_liquidacion.' del espectaculo '.$datos->nombre_evento,' por lo cual este pago entrara en sancion por extemporaneidad o en proceso de cobro coactivo',
                 'Subject' => 'Incumplimiento de obligacion Rad-N°' . $datos->radicado,
                 'documento' => 'NO',                
                 'fecha_pendiente' => null,
                 'radicado'  => $datos->radicado,
                 'estado' => 'LIQUIDACION',
                 'id'=> Crypt::encrypt($datos->id) 
             ];
     
             Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
 
 
             // actualizar solicitud
                       
             $datos->observaciones = $datos->observaciones.'. Incumplimiento de obligacion con radicado de pago N° '.$solicitud->radicado_pago.'';
             $datos->fecha_actuacion = $date;            
             $datos->save();  
 
             // ACTUALIZAR NIT ESPECTACULOS
             $datosNit = NitEspectaculos::findOrFail($solicitud->id);
 
             $datosNit->estado = 'LIQUIDACION-SANCION';
             $datosNit->save();
 
 
         }
 
 
 
     }

     //tramite discapacidad

     $discapacidad = CertificacionDiscapacidad::where('fecha_pendiente','<', $date)->where('estado_solicitud', 'PENDIENTE')->get();

     if($discapacidad->count()>0){            

       foreach($discapacidad as $solicitud){      
         
        
         $auditoria = Auditoria::create([

             "usuario" => 'SISTEMA',
             "proceso_afectado" => 'Radicado-'.$solicitud->radicado,
             "accion"=> 'Update a estado RECHAZADA',
             "tramite"=>'CERTIFICACION DE DISCAPACIDAD',
             "radicado" => $solicitud->radicado,
             "observacion" => 'Solicitud No '.$solicitud->radicado. ' en estado rechazada. debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.'


         ]);
         
         //correo
         $detalleCorreo = [
             'nombres' => $solicitud->nom_responsable.' '.$solicitud->ape_responsable,
             'mensaje' => 'Solicitud en estado rechazada debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud; Por lo tanto, debe volver a realizar la solicitud en la pagina  http://tramitesenlinea.bucaramanga.gov.co/certificado-discapacidad',
             'Subject' => 'Solicitud Cerrada por vencimiento de terminos N°' . $solicitud->radicado,
             'documento' => 'NO',
             'fecha_pendiente' => null,
             'radicado'  => $solicitud->radicado,
             'estado' => 'RECHAZADA'
         ];

         Mail::to($solicitud->email_responsable)->send(new NotificacionDiscapacidad($detalleCorreo));
         

         // actualizar solicitud

         $datos = CertificacionDiscapacidad::findOrFail($solicitud->id);
         $datos->estado_solicitud = 'RECHAZADA';
         $datos->fecha_pendiente = null;
         $datos->observaciones_solicitud = 'Solicitud en estado rechazada. debido al vencimiento del término de 30 días, para subsanar o allegar la información faltante y continuar con el trámite de su solicitud.';
         $datos->fecha_actuacion = $date;
         $datos->save();               

     }

   }
       
    }#finhandle
}

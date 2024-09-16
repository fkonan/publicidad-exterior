<?php

namespace App\Http\Controllers;

use App\Parametro;
use App\Barrio;
use App\CertificacionDiscapacidad;
use App\Auditoria;
use App\Mail\NotificacionDiscapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DiscapacidadController extends Controller
{
    public function index(){
        
        return view('tramites.discapacidad.index');
    }

    public function registro(){

        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
      
         return view('tramites.discapacidad.registro', compact('Parametros1', 'Parametros2', 'Barrios'));
 
     }

    public function confirmacion()
    {
        return view('tramites.discapacidad.confirmacion');
    }

    public function end()
    {
        Session::flush();
        return redirect("/certificado-discapacidad");
    }
    
    public function consulta(Request $request){

        $QuerySolicitud = CertificacionDiscapacidad::where($request->tipo_parametro, $request->parametro)->get();

        if ($QuerySolicitud->count() > 0) {
            
            // return $QuerySolicitud;
            return view('tramites.discapacidad.resultado', compact('QuerySolicitud'));
        } else {
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
            return redirect()->route('discapacidad.index');
        }
    }

    public function detalle($id){

        $solicitud = CertificacionDiscapacidad::FindOrFail(Crypt::decrypt($id));

        $date = Carbon::now();
        $date1 = Carbon::parse($solicitud->fecha_pendiente);
        $diff = $date1->diffInDays($date);      
        
        return view('tramites.discapacidad.detalle', compact('solicitud', 'diff'));



    }
    
    public function store(Request $request){


        // validacion campos requeridos
        $this->validate($request, [
            "nom_responsable"=>"required|max:20|string",
            "ape_responsable"=>"required|max:20|string",
            "ide_responsable"=>"required",
            "email_responsable"=>"required|email",
            "tel_responsable"=>"required|numeric|",
            "nom_solicitante"=>"required|max:20|string",
            "ape_solicitante"=>"required|max:20|string",
            "tipo_identificacion_sol"=>"required",
            "ide_solicitante"=>"required",     
            "direccion_solicitante"=>"required",
            "barrio_solicitante"=>"required",            
            "archivo_recibo"=>"required|mimes:pdf",
            "archivo_documento"=>"required|mimes:pdf",
            "archivo_historia_clinica"=>"required|mimes:pdf",           
            "tratamiento_datos"=>"required",
            "acepto_terminos"=>"required",
            "confirmo_mayorEdad"=>"required",
            "compartir_informacion" =>"required",
          
      ]);
  
      $ultimo_id = CertificacionDiscapacidad::latest('id')->first();
      // return $ultimo_id;
      if (!$ultimo_id) {
          $idRadicado = 1;
      } else {
          $idRadicado = $ultimo_id->id + 1;
      }
  
       $radicado = date("Ymd") . $idRadicado; // numero radicado
      
  
       $adjunto1 = $request->file('archivo_recibo')->storeAs('certificaciones_discapacidad/' . $radicado, 'recibo-servicio-' . $radicado . '.pdf');
  
  
       $adjunto2 = $request->file('archivo_documento')->storeAs('certificaciones_discapacidad/' . $radicado, 'copia-documento-' . $radicado . '.pdf');
       
       $adjunto3 = $request->file('archivo_historia_clinica')->storeAs('certificaciones_discapacidad/' . $radicado, 'historia-clinica-' . $radicado . '.pdf');      
          
       
       if ($adjunto1 && $adjunto2 && $adjunto3) {
  
          //rutas de guardado
          $adj_recibo = 'storage/certificaciones_discapacidad/' . $radicado . '/recibo-servicio-' . $radicado . '.pdf';        
  
          $adj_documento = 'storage/certificaciones_discapacidad/' . $radicado . '/copia-documento-' . $radicado . '.pdf';          
         
          $adj_historia_clinica = 'storage/certificaciones_discapacidad/' . $radicado . '/historia-clinica-' . $radicado . '.pdf';
         
         
          
          $request->request->add([
              'radicado' => $radicado,
              'adj_recibo' => $adj_recibo,            
              'adj_documento' => $adj_documento,
              'adj_historia_clinica' => $adj_historia_clinica,
              'ciudad_id'=>'68001',
              'estado_solicitud' => 'ENVIADA',
              'observaciones_solicitud' => 'El ciudadano '.$request->nom_responsable.' '.$request->ape_responsable. ' envia solicitud para la Autorizacion de la certificacion de discapacidad.',
              'fecha_actuacion'=>date('Y-m-d')
          ]);
  
        
          $solicitud = $request->all();
              // return $solicitud;
          $saveSolicitud = CertificacionDiscapacidad::create($solicitud);

          $certificiado_id = $saveSolicitud->id;
  
          $detalleCorreo = [
              'nombres' => $request->nom_solicitante . ' ' . $request->ape_solicitante,
              'radicado' => $radicado,
              'Subject' => 'Envió de Solicitud Autorizacion de la certificacion de discapacidad.',
              'documento'=> 'NO',
              'fecha_pendiente' => null,            
              'estado' => null,
              'mensaje'=> null,
              'id'=> Crypt::encrypt($certificiado_id)
          ];
  
          $detalleCorreo_fun = [
              'nombres' => 'Funcionario',
              'radicado' => $radicado,
              'Subject' => 'Solicitud Asignada de Autorizacion de la certificacion de discapacidad No'.$radicado,
              'documento'=> 'NO',
              'fecha_pendiente' => null,            
              'estado' => 'FUNCIONARIO',
              'mensaje'=> 'La solicitud '.$radicado. ' le fue asignada con exito',
          ];
          $correo_funcionario = 'laquinonez@bucaramanga.gov.co';
  
  
          if ($saveSolicitud) {
  
              //auditoria
              $auditoria = Auditoria::create([
                  'usuario' => $request->ide_solicitante,
                  'proceso_afectado'=> 'Radicado-'.$radicado,
                  'tramite'=> 'CERTIFICACION DE DISCAPACIDAD',
                  'radicado'=> $radicado,
                  'accion'=>'update a estado ENVIADO',
                  'observacion'=> 'El ciudadano '.$request->nom_responsable.' '.$request->ape_responsable. 'envia solicitud para la Autorizacion de la certificacion de discapacidad.'
  
              ]);
  
              // envio de correo                
              Mail::to($request->email_responsable)->queue(new NotificacionDiscapacidad($detalleCorreo));
              Mail::to($correo_funcionario)->queue(new NotificacionDiscapacidad($detalleCorreo_fun));
  
              $request->session()->flash('radicado_id', $radicado);
              return redirect()->route('discapacidad.confirmacion');
          } else {
              Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
              return redirect()->route('discapacidad.index');
          }
  
       }else {
  
              Alert::error('Ha Ocurrido un error', 'Los archivos no se han cargado correctamente vuelva intentarlo');
              return redirect()->route('discapacidad.index');
          }
      }

      public function updateDocs(Request $request){

        $solicitud = CertificacionDiscapacidad::FindOrFail($request->id);
        $contador = 0;

        

        if($request->archivo_recibo){
            $adjunto1 = $request->file('archivo_recibo')->storeAs('certificaciones_discapacidad/' . $solicitud->radicado, 'recibo-servicio-' . $solicitud->radicado . '.pdf');
            $contador++;
        }else{
            $adjunto1 = false;
        }        

        if($request->archivo_documento){
            $adjunto3 = $request->file('archivo_documento')->storeAs('certificaciones_discapacidad/' . $solicitud->radicado, 'copia-documento-' . $solicitud->radicado . '.pdf');
            $contador++;
        }else{
            $adjunto3 = false;
        }

        if($request->archivo_historia_clinica){
            $adjunto4 = $request->file('archivo_historia_clinica')->storeAs('certificaciones_discapacidad/' . $solicitud->radicado, 'historia-clinica-' . $solicitud->radicado . '.pdf');
            $contador++;

        }else{
            $adjunto4 = false;
        }

        $detalleCorreo_fun = [
            'nombres' => 'Funcionario',
            'radicado' => $solicitud->radicado,
            'Subject' => 'Solicitud Actualizada de Autorizacion de la certificacion de discapacidad No'.$solicitud->radicado,
            'documento'=> 'NO',
            'fecha_pendiente' => null,            
            'estado' => 'FUNCIONARIO',
            'mensaje'=> 'La solicitud '.$solicitud->radicado. ' fue actualizada con exito',
        ];
        $correo_funcionario = 'laquinonez@bucaramanga.gov.co';

        $detalleCorreo = [
            'nombres' => $solicitud->nom_responsable . ' ' . $solicitud->ape_responsable,
            'mensaje' => 'Los Documentos de la solicitud No' .$solicitud->radicado.' fueron actualizados correctamente, ',
            'Subject' => 'Solicitud Actualizada de Autorizacion de la certificacion de discapacidad No'.$solicitud->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'radicado'  => $solicitud->radicado,
            'estado' => 'ACTUALIZADA',
            'id'=> Crypt::encrypt($request->id)
        ];

        if($adjunto1 || $adjunto3 || $adjunto4){           
            


              //auditoria
              $auditoria = Auditoria::create([
                'usuario' => $solicitud->ide_solicitante,
                'proceso_afectado'=> 'Radicado-'.$solicitud->radicado,
                'tramite'=> 'CERTIFICACION DE DISCAPACIDAD',
                'radicado'=> $solicitud->radicado,
                'accion'=>'update de documentos pendientes',
                'observacion'=> 'El ciudadano '.$solicitud->nom_responsable.' '.$solicitud->nom_responsable. ' realiza actualización de documentos dentro de las fechas permitidas'

            ]);

            // envio de correo                
            Mail::to($solicitud->email_responsable)->queue(new NotificacionDiscapacidad($detalleCorreo));
            Mail::to($correo_funcionario)->queue(new NotificacionDiscapacidad($detalleCorreo_fun));

            $solicitud->act_documentos = "SI";
            $solicitud->estado_solicitud = 'ACTUALIZADA';
            $solicitud->fecha_actuacion = date("Y-m-d");
            $solicitud->fecha_pendiente = null;
            $solicitud->save();            
            Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
            return redirect()->route('discapacidad.index');

        }else{
            Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
            return redirect()->route('discapacidad.index');
        }

    }


}



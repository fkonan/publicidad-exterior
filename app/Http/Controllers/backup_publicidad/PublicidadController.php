<?php

namespace App\Http\Controllers;

use App\Barrio;
use App\Parametro;
use App\Publicidad;
use App\PublicidadDetalle;
use App\Auditoria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use App\Mail\NotificacionPublicidad;

class PublicidadController extends Controller
{

   public function index()
   {

      $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
      $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
      $Barrios = Barrio::all();

      return view('tramites.publicidad.index', compact('Parametros1', 'Parametros2', 'Barrios'));
   }

   public function cargarDatosVallas()
   {
      return View::make('tramites.publicidad.vallas');
   }

   public function cargarDatosMurales()
   {
      return View::make('tramites.publicidad.murales');
   }

   public function cargarDatosPasacalles()
   {
      return View::make('tramites.publicidad.pasacalles');
   }

   public function cargarDatosAerea()
   {
      return View::make('tramites.publicidad.aerea');
   }

   public function cargarDatosPendones()
   {
      return View::make('tramites.publicidad.pendones');
   }

   public function cargarDatosMovil()
   {
      return View::make('tramites.publicidad.movil');
   }

   public function store(Request $request)
   {

      // validacion campos requeridos
      $this->validate($request, [
         "tipo_publicidad" => "required",
         "publicidad_instalada" => "required",
         "numero_elementos" => "required",
         "ancho_publicidad" => "required",
         "alto_publicidad" => "required",
         "ubicacion_aviso" => "required",
         "fecha_inicial_fijacion" => "required",
         "fecha_final_fijacion" => "required",
         "tipo_documento" => "required",
         "numero_documento" => "required",
         "nombre_responsable" => "required",
         "apellido_responsable" => "required",
         "telefono_responsable" => "required",
         "email_responsable" => "required",
         "confirmar_email" => "required",
         "tratamiento_datos" => "required",
         "confirmo_mayorEdad" => "required",
         "compartir_informacion" => "required"
      ]);

      $ultimo_id = Publicidad::latest('id')->first();

      if (!$ultimo_id) {
         $idRadicado = 1;
      } else {
         $idRadicado = $ultimo_id->id + 1;
      }

      $radicado = date("Ymd") . $idRadicado; // numero radicado

      /** valido y guardo en variables documentos adjuntos  */
      if ($request->adj_certificado_lyt || $request->adj_certificado_lyt != null) {
         $adj_certificado_lyt = $request->file('adj_certificado_lyt')->storeAs('documentos_publicidad/' . $radicado, 'adj_certificado_lyt-' . $radicado . '.pdf');
         $adj_certificado_lyt_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_certificado_lyt-' . $radicado . '.pdf';
      } else {
         $adj_certificado_lyt_rut = null;
      }

      if ($request->adj_camara_comercio || $request->adj_camara_comercio != null) {
         $adj_camara_comercio =  $request->file('adj_camara_comercio')->storeAs('documentos_publicidad/' . $radicado, 'adj_camara_comercio-' . $radicado . '.pdf');
         $adj_camara_comercio_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_camara_comercio-' . $radicado . '.pdf';
      } else {
         $adj_camara_comercio_rut = null;
      }

      if ($request->adj_fotomontaje || $request->adj_fotomontaje != null) {
         $adj_fotomontaje = $request->file('adj_fotomontaje')->storeAs('documentos_publicidad/' . $radicado, 'adj_fotomontaje-' . $radicado . '.pdf');
         $adj_fotomontaje_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_fotomontaje-' . $radicado . '.pdf';
      } else {
         $adj_fotomontaje_rut = null;
      }

      if ($request->adj_autorizacion_propietarios || $request->adj_autorizacion_propietarios != null) {
         $adj_autorizacion_propietarios =  $request->file('adj_autorizacion_propietarios')->storeAs('documentos_publicidad/' . $radicado, 'adj_autorizacion_propietarios-' . $radicado . '.pdf');
         $adj_autorizacion_propietarios_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_autorizacion_propietarios-' . $radicado . '.pdf';
      } else {
         $adj_autorizacion_propietarios_rut = null;
      }

      if ($request->adj_licencia_construccion || $request->adj_licencia_construccion != null) {
         $adj_licencia_construccion =  $request->file('adj_licencia_construccion')->storeAs('documentos_publicidad/' . $radicado, 'adj_licencia_construccion-' . $radicado . '.pdf');
         $adj_licencia_construccion_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_licencia_construccion-' . $radicado . '.pdf';
      } else {
         $adj_licencia_construccion_rut = null;
      }

      if ($request->adj_RUT || $request->adj_RUT != null) {
         $adj_RUT =  $request->file('adj_RUT')->storeAs('documentos_publicidad/' . $radicado, 'adj_RUT-' . $radicado . '.pdf');
         $adj_RUT_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_RUT-' . $radicado . '.pdf';
      } else {
         $adj_RUT_rut = null;
      }

      if ($request->adj_descripcion_solicitud || $request->adj_descripcion_solicitud != null) {
         $adj_descripcion_solicitud =  $request->file('adj_descripcion_solicitud')->storeAs('documentos_publicidad/' . $radicado, 'adj_descripcion_solicitud-' . $radicado . '.pdf');
         $adj_descripcion_solicitud_rut = 'storage/documentos_publicidad/' . $radicado . '/adj_descripcion_solicitud-' . $radicado . '.pdf';
      } else {
         $adj_descripcion_solicitud_rut = null;
      }

      if ($request->req_poliza || $request->req_poliza != null) {
         $req_poliza =  $request->file('req_poliza')->storeAs('documentos_publicidad/' . $radicado, 'req_poliza-' . $radicado . '.pdf');
         $req_poliza_rut = 'storage/documentos_publicidad/' . $radicado . '/req_poliza-' . $radicado . '.pdf';
      } else {
         $req_poliza_rut = null;
      }

      if ($request->req_tarjeta_profesional || $request->req_tarjeta_profesional != null) {
         $req_tarjeta_profesional =  $request->file('req_tarjeta_profesional')->storeAs('documentos_publicidad/' . $radicado, 'req_tarjeta_profesional-' . $radicado . '.pdf');
         $req_tarjeta_profesional_rut = 'storage/documentos_publicidad/' . $radicado . '/req_tarjeta_profesional-' . $radicado . '.pdf';
      } else {
         $req_tarjeta_profesional_rut = null;
      }

      $request->request->add([
         'radicado' => $radicado,
         'estado_solicitud' => 'ENVIADA'
      ]);

      $solicitud = $request->all();
      // return $solicitud;
      $saveSolicitud = Publicidad::create($solicitud);

      if ($saveSolicitud) {
         $datos = new PublicidadDetalle;
         $datos->publicidad_id = $saveSolicitud->id;
         $datos->tipo_valla = $request->tipo_valla;
         $datos->alto_publicidad = $request->alto_publicidad;
         $datos->ancho_publicidad = $request->ancho_publicidad;
         $datos->observacion_medidas = $request->observacion_medidas;
         $datos->alto_fachada = $request->alto_fachada;
         $datos->ancho_fachada = $request->ancho_fachada;
         $datos->ubicacion_aviso = $request->ubicacion_aviso;
         $datos->barrio_aviso = $request->barrio_aviso;
         $datos->fecha_inicial_fijacion = $request->fecha_inicial_fijacion;
         $datos->fecha_final_fijacion = $request->fecha_final_fijacion;
         $datos->inferior_treintaDias = $request->inferior_treintaDias;
         $datos->propiedad_privada = $request->propiedad_privada;
         $datos->adj_certificado_lyt = $adj_certificado_lyt_rut;
         $datos->adj_camara_comercio = $adj_camara_comercio_rut;
         $datos->adj_fotomontaje = $adj_fotomontaje_rut;
         $datos->adj_autorizacion_propietarios = $adj_autorizacion_propietarios_rut;
         $datos->adj_licencia_construccion = $adj_licencia_construccion_rut;
         $datos->adj_RUT = $adj_RUT_rut;
         $datos->adj_descripcion_solicitud = $adj_descripcion_solicitud_rut;
         $datos->req_poliza = $req_poliza_rut;
         $datos->req_tarjeta_profesional = $req_tarjeta_profesional_rut;
         $datos->numero_caras = $request->numero_caras;
         $datos->save();

         $auditoria = Auditoria::create([
            'usuario' => $request->numero_documento,
            'proceso_afectado' => 'Radicado-' . $radicado,
            'tramite' => 'PUBLICIDAD EXTERIOR',
            'radicado' => $radicado,
            'accion' => 'update a estado ENVIADO',
            'observacion' => 'El ciudadano ' . $request->nombre_responsable . ' ' . $request->apellido_responsable . 'realiza una solicitud de: ' . $request->modalidad

         ]);

         $detalleCorreo = [
            'nombres' => $request->nombre_responsable . ' ' . $request->apellido_responsable,
            'radicado' => $radicado,
            'Subject' => 'Envió de Solicitud de Publicidad Exterior',
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'estado' => null,
            'mensaje' => null
         ];

         $detalleCorreo_fun = [
            'nombres' => ' Funcionario',
            'radicado' => $radicado,
            'Subject' => 'Solicitud pendiente Publicdad Exterior No' . $radicado,
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'estado' => 'FUNCIONARIO',
            'mensaje' => 'Funcionario'
         ];

         $correo_funcionario = 'fhernandez@bucaramanga.gov.co';

         // envio de correo                
         Mail::to($request->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
         Mail::to($correo_funcionario)->queue(new NotificacionPublicidad($detalleCorreo_fun));

         $request->session()->flash('radicado_id', $radicado);
         return redirect()->route('publicidad.confirmacion');
      } else {
         Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
         return redirect()->route('publicidad.index');
      }
   }

   public function end()
   {
      Session::flush();
      return redirect()->route('publicidad.index');
   }

   public function confirmacion()
   {
      return view('tramites.publicidad.confirmacion');
   }
   public function consulta(Request $request){

      $QuerySolicitud = Publicidad::where($request->tipo_parametro, $request->parametro)->get();

      if ($QuerySolicitud->count() > 0) {
          
          // return $QuerySolicitud;
          return view('tramites.publicidad.resultado', compact('QuerySolicitud'));
      } else {
          Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
          return redirect()->route('publicidad.index');
      }
  }

  public function detalle($id){

   $solicitud = Publicidad::FindOrFail(Crypt::decrypt($id));

   $date = Carbon::now();
   $date1 = Carbon::parse($solicitud->fecha_pendiente_ciudadano);
   $diff = $date1->diffInDays($date);      
   
   return view('tramites.publicidad.detalle', compact('solicitud', 'diff'));

}
public function updateDocs(Request $request){


//   return $request;
        
   $solicitud = Publicidad::FindOrFail($request->id);
   $contador = 0;
   if($request->adj_certificado_lyt){      
       $adjunto1 = $request->file('adj_certificado_lyt')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'adj_certificado_lyt-' . $solicitud->radicado . '.pdf');
       $contador++;
   }else{
       $adjunto1 = false;
   }

  

   if($request->adj_camara_comercio){
       $adjunto2 = $request->file('adj_camara_comercio')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'adj_camara_comercio-' . $solicitud->radicado . '.pdf');
       $contador++;
   }else{
       $adjunto2 = false;
   }

   if($request->adj_autorizacion_propietarios){
       $adjunto3 = $request->file('adj_autorizacion_propietarios')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'adj_autorizacion_propietarios-' . $solicitud->radicado . '.pdf');
       $contador++;
   }else{
       $adjunto3= false;
   }

   if($request->adj_fotomontaje){
       $adjunto4 = $request->file('adj_fotomontaje')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'adj_fotomontaje-' . $solicitud->radicado . '.pdf');
       $contador++;

   }else{
       $adjunto4 = false;
   }
  // para los demas modaliades
   // if($request->archivo_solicitud){
   //     $adjunto5 = $request->file('archivo_solicitud')->storeAs('documentos_espectaculos/' . $solicitud->radicado, 'SOLICITUD-' . $solicitud->radicado . '.pdf');
   //     $contador++;

   // }else{
   //     $adjunto5 = false;
   // }

   $detalleCorreo = [
       'nombres' => $solicitud->nombre_responsable.' '.$solicitud->apellido_responsable,
       'mensaje' => 'Usted ha actualizado los documentos correctamente en el sistema, ahora su solicitud sera revisada nuevamente',
       'Subject' => 'Documentos actualizados en solicitud de Publicidad Exterior N°' . $solicitud->radicado,
       'documento'=> 'NO',
       'fecha_pendiente' => null,
       'radicado'  => $solicitud->radicado,
       'estado' => 'SOLICITUD EN ESTUDIO',
       'id'=> Crypt::encrypt($request->id)               

   ];

   $detalleCorreo_fun = [
       'nombres' => ' Funcionario xxx',
       'radicado' => $solicitud->radicado,
       'Subject' => 'Actualización de documentos en solicitud No'.$solicitud->radicado,
       'documento'=> 'NO',
       'fecha_pendiente' => null,            
       'estado' => 'FUNCIONARIO',
       'mensaje'=> 'Tiene la solicitud No '. $solicitud->radicado.' pendiente por revisar en la plataforma debido a la actualización de documentos'
   ];
   $correo_funcionario = ['fabian.hernandez.murcia@gmail.com', 'julianrincon9230@gmail.com'];
   
   if($adjunto1 || $adjunto2 || $adjunto3 || $adjunto4){

        //auditoria
        $auditoria = Auditoria::create([
           'usuario' => $solicitud->numero_documento,
           'proceso_afectado'=> 'Radicado-'.$solicitud->radicado,
           'tramite'=> 'PUBLICIDAD EXTERIOR',
           'radicado'=> $solicitud->radicado,
           'accion'=>'update de documentos, cambio a estado DOCUMENTOS_ACTUALIZADOS',
           'observacion'=> 'El ciudadan@ '.$solicitud->nombre_responsable.' '.$solicitud->apellido_responsable. ' Actualiza documentos dentro de los plazos dispuestos'

       ]);



       $solicitud->act_documentos = "SI";
       $solicitud->fecha_pendiente_ciudadano = null;
       $solicitud->estado_solicitud = 'DOC-ACT-CIUDADANO';
       $solicitud->observacion_solicitud = 'Solicitud en estudio, posterior a la actualización de documentos pendientes';
       $solicitud->save();
        // envio de correo                
        Mail::to($solicitud->email_responsable)->send(new NotificacionPublicidad($detalleCorreo)); 
        Mail::to($correo_funcionario)->send(new NotificacionPublicidad($detalleCorreo_fun));             
       Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
       return redirect()->route('publicidad.index');

   }else{
       Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
       return redirect()->route('publicidad.index');
   }
}

public function detalleRequisitos($id){

   $solicitud = Publicidad::FindOrFail(Crypt::decrypt($id));
   $detalle =  PublicidadDetalle::where('publicidad_id', Crypt::decrypt($id))->get()->first();   
   $date = Carbon::now();
   $date1 = Carbon::parse($solicitud->fecha_pendiente_ciudadano);
   $diff = $date1->diffInDays($date);      
   
   return view('tramites.publicidad.requisitos', compact('solicitud', 'diff', 'detalle'));

}

public function updateReque(Request $request){

   if($request->tipo_valla == 'TUBULAR'){

      $this->validate($request, [
         "req_certi_civil" => 'required',
         "req_tarjeta_profesional" => 'required',
         'req_poliza'=>'required',
      ]);
   }else{

      $this->validate($request, [
       'req_poliza'=>'required',
      ]);

   }


   $solicitud = Publicidad::FindOrFail($request->id);
   $contador = 0;
   if($request->req_certi_civil){      
       $adjunto1 = $request->file('req_certi_civil')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'req_certi_civil-' . $solicitud->radicado . '.pdf');
       $req_certi_civil = 'storage/documentos_publicidad/' . $solicitud->radicado . '/req_certi_civil-' . $solicitud->radicado . '.pdf';
       $contador++;
   }else{
       $adjunto1 = false;
       $req_certi_civil= null;
   }

  

   if($request->req_tarjeta_profesional){
       $adjunto2 = $request->file('req_tarjeta_profesional')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'req_tarjeta_profesional-' . $solicitud->radicado . '.pdf');
       $req_tarjeta_profesional= 'storage/documentos_publicidad/' . $solicitud->radicado . '/req_tarjeta_profesional-' . $solicitud->radicado . '.pdf';
       $contador++;
   }else{
       $adjunto2 = false;
       $req_tarjeta_profesional= null;
   }

   if($request->req_poliza){
       $adjunto3 = $request->file('req_poliza')->storeAs('documentos_publicidad/' . $solicitud->radicado, 'req_poliza-' . $solicitud->radicado . '.pdf');
       $req_poliza= 'storage/documentos_publicidad/' . $solicitud->radicado . '/req_poliza-' . $solicitud->radicado . '.pdf';
       $contador++;
   }else{
       $adjunto3= false;
       $req_poliza= null;
   }

   $detalleCorreo = [
      'nombres' => $solicitud->nombre_responsable.' '.$solicitud->apellido_responsable,
      'mensaje' => 'Usted ha cargado Requisitos Finales los documentos correctamente en el sistema, ahora su solicitud sera revisada nuevamente',
      'Subject' => 'Requisitos Finales Cargados en solicitud de Publicidad Exterior N°' . $solicitud->radicado,
      'documento'=> 'NO',
      'fecha_pendiente' => null,
      'radicado'  => $solicitud->radicado,
      'estado' => 'SOLICITUD EN ESTUDIO',
      'id'=> Crypt::encrypt($request->id)               

  ];

  $detalleCorreo_fun = [
      'nombres' => ' Funcionario xxx',
      'radicado' => $solicitud->radicado,
      'Subject' => 'Requisitos Finales Cargados en solicitud No'.$solicitud->radicado,
      'documento'=> 'NO',
      'fecha_pendiente' => null,            
      'estado' => 'FUNCIONARIO',
      'mensaje'=> 'Tiene la solicitud No '. $solicitud->radicado.' pendiente por revisar en la plataforma debido al cargue de requisitos finales'
  ];
  $correo_funcionario = ['fabian.hernandez.murcia@gmail.com', 'ojrincon@gmail.com'];
  
  if($adjunto1 || $adjunto2 || $adjunto3){

   $detalle = PublicidadDetalle::where('publicidad_id', $request->id)->update([
       'req_poliza'=> $req_poliza,
       'req_tarjeta_profesional'=>$req_tarjeta_profesional,
       'req_certi_civil'=> $req_certi_civil   
   ]);

       //auditoria
       $auditoria = Auditoria::create([
          'usuario' => $solicitud->numero_documento,
          'proceso_afectado'=> 'Radicado-'.$solicitud->radicado,
          'tramite'=> 'PUBLICIDAD EXTERIOR',
          'radicado'=> $solicitud->radicado,
          'accion'=>'update de documentos, cambio a estado REQUISTOS FINALES CARGADOS',
          'observacion'=> 'El ciudadan@ '.$solicitud->nombre_responsable.' '.$solicitud->apellido_responsable. ' Actualiza documentos dentro de los plazos dispuestos'

      ]);



      $solicitud->act_documentos = "SI";
      $solicitud->fecha_pendiente_ciudadano = null;      
      $solicitud->observacion_solicitud = 'Solicitud en estudio, posterior aL cargue de los requisitos finales';
      $solicitud->save();
       // envio de correo                
       Mail::to($solicitud->email_responsable)->send(new NotificacionPublicidad($detalleCorreo)); 
       Mail::to($correo_funcionario)->send(new NotificacionPublicidad($detalleCorreo_fun));             
      Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
      return redirect()->route('publicidad.index');

  }else{
      Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
      return redirect()->route('publicidad.index');
  }






}
}

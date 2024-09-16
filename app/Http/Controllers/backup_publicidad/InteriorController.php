<?php

namespace App\Http\Controllers;

use App\Auditoria;
use App\Parqueadero;
use App\Publicidad;
use App\PublicidadConceptos;
use App\PublicidadDetalle;
use App\PublicidadActos;
use App\Evento;
use App\DocUpdate;
use App\AuditoriaParqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\NotificacionParqueaderos;
use App\Mail\NotificacionPublicidad;
use App\Mail\NotificacionEventos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class InteriorController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {
      return view('tramites.interior.index');
   }

   public function parqueaderoIndex()
   {

      $sEnviadas = Parqueadero::where('estado_solicitud', 'ENVIADA')->get();
      $sPendientes = Parqueadero::where('estado_solicitud', 'PENDIENTE')->get();
      $sEnRevision = Parqueadero::where('estado_solicitud', 'REVISION-PLANEACION')->get();
      $sRevisadas = Parqueadero::where('estado_solicitud', 'RESPUESTA-PLANEACION')->get();
      $sAprobadas = Parqueadero::where('estado_solicitud', 'APROBADA')->get();
      $sRechazadas = Parqueadero::where('estado_solicitud', 'RECHAZADA')->get();
      $porCerrar =  Parqueadero::where('estado_solicitud', 'PENDIENTE')->where('fecha_pendiente', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
      $porCerrarPlaneacion =  Parqueadero::where('estado_solicitud', 'REVISION-PLANEACION')->where('fecha_pendiente_planeacion', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
      $count_enviadas = $sEnviadas->count();
      $count_pendientes = $sPendientes->count();
      $count_enRevision = $sEnRevision->count();
      $count_revisadas = $sRevisadas->count();
      $count_aprobadas = $sAprobadas->count();
      $count_rechazadas = $sRechazadas->count();

      return view('tramites.interior.parqueaderos.index', compact('sEnviadas', 'sEnRevision', 'sPendientes', 'sRevisadas', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_enRevision', 'count_revisadas', 'count_aprobadas', 'count_rechazadas', 'porCerrar', 'porCerrarPlaneacion'));
   }

   /** PUBLICIDAD EXTERIOR */
   public function publicidadIndex()
   {

      $count_vallas = Publicidad::where('modalidad', 'VALLAS')->count();
      $count_pendones = Publicidad::where('modalidad', 'PENDONES')->count();
      $count_pend1 = Publicidad::where('sub_modalidad', 'AVISOS DE IDENTIFICACION DE ESTABLECIMEINTOS COMERCIALES')->count();
      $count_pend2 = Publicidad::where('sub_modalidad', 'IDENTIFICACION PROYECTOS INMOBOLIARIOS')->count();
      $count_pend3 = Publicidad::where('sub_modalidad', 'AVISOS TIPO COLOMBINA')->count();
      $count_murales = Publicidad::where('modalidad', 'MURALES')->count();
      $count_pasacalles = Publicidad::where('modalidad', 'PASACALLES')->count();
      $count_aerea = Publicidad::where('modalidad', 'PUBLICIDAD AEREA')->count();
      $count_movil = Publicidad::where('modalidad', 'MOVIL')->count();

      return view('tramites.interior.publicidad.index', compact('count_vallas', 'count_pendones', 'count_murales', 'count_pasacalles', 'count_aerea', 'count_movil', 'count_pend1', 'count_pend2', 'count_pend3'));
   }

   public function publicidadListarSolicitudes($modalidad)
   {
      $sEnviadas = Publicidad::where('estado_solicitud', 'ENVIADA')->where('modalidad', $modalidad)->get();
      $sPendientes = Publicidad::where('estado_solicitud', 'PENDIENTE')->where('modalidad', $modalidad)->get();
      $sEnRevision = Publicidad::whereIn('estado_solicitud', array('REVISION-CONCEPTOS-PLANEACION', 'REVISION-CONCEPTOS-SALUD'))->where('modalidad', $modalidad)->get();
      $sRevisadas = Publicidad::where('estado_solicitud', 'VIABILIDAD-PERMISO')->where('modalidad', $modalidad)->get();
      $sDocumentos =   Publicidad::where('estado_solicitud', 'DOC-ACT-CIUDADANO')->where('modalidad', $modalidad)->get();
      $sRequisitos =   Publicidad::where('estado_solicitud', 'REQUISITOS-FINALES')->where('modalidad', $modalidad)->get();
      $sAprobadas = Publicidad::where('estado_solicitud', 'APROBADA')->where('modalidad', $modalidad)->get();
      $sRechazadas = Publicidad::where('estado_solicitud', 'RECHAZADA')->where('modalidad', $modalidad)->get();
      $porCerrar = "";
      $porCerrarPlaneacion = "";
      //   $porCerrar =  Publicidad::where('estado_solicitud', 'PENDIENTE')->where('modalidad',$modalidad)->where('fecha_pendiente' ,'<',DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
      //   $porCerrarPlaneacion =  Publicidad::where('estado_solicitud', 'REVISION-PLANEACION')->where('modalidad',$modalidad)->where('fecha_pendiente_planeacion' ,'<',DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();           
      $count_enviadas = $sEnviadas->count();
      $count_pendientes = $sPendientes->count();
      $count_enRevision = $sEnRevision->count();
      $count_revisadas = $sRevisadas->count();
      $count_aprobadas = $sAprobadas->count();
      $count_rechazadas = $sRechazadas->count();
      $count_documentos = $sDocumentos->count();
      $count_requisitos = $sRequisitos->count();

      return view('tramites.interior.publicidad.listar_solicitudes', compact('modalidad', 'sEnviadas', 'sEnRevision', 'sPendientes', 'sRevisadas', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_enRevision', 'count_revisadas', 'count_aprobadas', 'count_rechazadas', 'porCerrar', 'porCerrarPlaneacion', 'sDocumentos', 'count_documentos', 'sRequisitos', 'count_requisitos'));
   }

   public function publicidadDetalle($id)
   {
      $solicitud = Publicidad::findOrFail($id);
      $adjunto = PublicidadConceptos::where('publicidad_id', $id)->get()->first();
      
      $detalle = PublicidadDetalle::leftJoin('barrio', 'barrio.codigo', '=', 'publicidad_detalle.barrio_aviso')->where('publicidad_id', $id)->get()->first();
      return view('tramites.interior.publicidad.detalle', compact('solicitud', 'detalle', 'adjunto'));
   }

   public function publicidadUpdate(Request $request)
   {
      $datos = Publicidad::findOrFail($request->id);

      if ($request->estado_solicitud == 'PENDIENTE') {

         $this->validate($request, [
            "observacion_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = date("Y-m-d", strtotime($date . "+15 Weekday"));

         $detalleCorreo = [
            'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
            'mensaje' => $request->observacion_solicitud,
            'Subject' => 'Documentos Pendientes Solicitud de Publicidad Exterior N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud,
            'id' => Crypt::encrypt($request->id)
         ];

         // actualizar datos
         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observacion_solicitud = $request->observacion_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente_ciudadano = $date_30;
         $datos->act_documentos = null;

         if ($datos->save()) {
            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'PUBLICIDAD EXTERIOR',
               'radicado' => $datos->radicado,
               'accion' => 'update estado ' . $request->estado_solicitud,
               'observacion' => $request->observacion_solicitud

            ]);

            Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.publicidad.index');
         } else {
            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            return redirect()->route('interior.publicidad.index');
         }
      }

      if ($request->estado_solicitud == 'RECHAZADA') {

         $this->validate($request, [
            "observacion_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         // fecha de actuacion
         $date = date('Y-m-d');

         $date_30 = null;

         $detalleCorreo = [
            'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
            'mensaje' => $request->observacion_solicitud,
            'Subject' => 'Solicitud Rechazada N°' . $datos->radicado,
            'documento' => 'RT',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observacion_solicitud = $request->observacion_solicitud;
         $datos->fecha_actuacion = $date;


         if ($datos->save()) {

            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'PUBLICIDAD EXTERIOR',
               'radicado' => $datos->radicado,
               'accion' => 'update estado ' . $request->estado_solicitud,
               'observacion' => $request->observacion_solicitud

            ]);

            Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.publicidad.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
            return redirect()->route('interior.publicidad.index');
         }
      }

      switch ($request->modalidad) {
         case 'VALLAS':
            if ($request->estado_solicitud == 'REVISION-CONCEPTOS-PLANEACION') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días
               $date_30 = NULL;
               $date_conceptos = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => 'Francia Milena Zuluaga Tangarife',
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Revision de Solicitud Pendiente Publicidad Exterior N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $date_30,
                  'radicado'  => $datos->radicado,
                  'estado' => 'FUNCIONARIO'
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_planeacion = $date_conceptos;
               $datos->fecha_pendiente_salud = null;
               $datos->act_documentos = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'REQUISITOS-FINALES') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días

               $fecha_pendiente_ciudadano = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Solicitud de Requisitos Finales Solicitud N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $fecha_pendiente_ciudadano,
                  'radicado'  => $datos->radicado,
                  'estado' => $request->estado_solicitud,
                  'id' => Crypt::encrypt($request->id)
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_ciudadano = $fecha_pendiente_ciudadano;
               $datos->act_documentos = null;
               $datos->fecha_pendiente_salud = null;
               $datos->fecha_pendiente_planeacion = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'REQUISITOS-FINALES-PENDIENTES') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días

               $fecha_pendiente_ciudadano = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Solicitud de Requisitos Finales Pendientes Solicitud N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $fecha_pendiente_ciudadano,
                  'radicado'  => $datos->radicado,
                  'estado' => $request->estado_solicitud,
                  'id' => Crypt::encrypt($request->id)
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_ciudadano = $fecha_pendiente_ciudadano;
               $datos->act_documentos = null;
               $datos->fecha_pendiente_salud = null;
               $datos->fecha_pendiente_planeacion = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'ORDEN-HACIENDA') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días
               $date_30 = NULL;
               $date_conceptos = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => 'Francia Milena Zuluaga Tangarife',
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Orden hacienda para liquidación de impuesto, radicado N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $date_30,
                  'radicado'  => $datos->radicado,
                  'estado' => 'FUNCIONARIO'
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_planeacion = null;
               $datos->fecha_pendiente_salud = null;
               $datos->act_documentos = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }
            break;

         case 'PASACALLES':
            if ($request->estado_solicitud == 'DOC-ACT-ADMINISTRATIVO') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días
               $date_30 = NULL;
               $date_conceptos = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => 'Francia Milena Zuluaga Tangarife',
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Revision de Solicitud Pendiente Publicidad Exterior N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $date_30,
                  'radicado'  => $datos->radicado,
                  'estado' => 'FUNCIONARIO'
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_planeacion = null;
               $datos->fecha_pendiente_salud = null;
               $datos->act_documentos = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               $publicidad_actos = new PublicidadActos;

               if ($request->adj_acto_administrativo || $request->adj_acto_administrativo != null) {
                  $adj_acto_administrativo =  $request->file('adj_acto_administrativo')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_acto_administrativo-' . $datos->radicado . '.pdf');
                  $adj_acto_administrativo_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_acto_administrativo-' . $datos->radicado . '.pdf';
               } else {
                  $adj_acto_administrativo = null;
               }

               $publicidad_actos->publicidad_id = $request->id;
               $publicidad_actos->nombre_acto = $request->nombre_acto;
               $publicidad_actos->adj_acto_administrativo = $adj_acto_administrativo_rut;

               if ($datos->save()) {
                  $publicidad_actos->save();
                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            break;

         case 'PUBLICIDAD AEREA':
            if ($request->estado_solicitud == 'REVISION-CONCEPTOS-SALUD') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días
               $date_30 = NULL;
               $date_conceptos = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => 'Francia Milena Zuluaga Tangarife',
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Revision de Solicitud Pendiente Publicidad Exterior N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $date_30,
                  'radicado'  => $datos->radicado,
                  'estado' => 'FUNCIONARIO'
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_salud = $date_conceptos;
               $datos->fecha_pendiente_planeacion = null;
               $datos->act_documentos = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'REQUISITOS-FINALES') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días

               $fecha_pendiente_ciudadano = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Solicitud de Requisitos Finales Solicitud N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $fecha_pendiente_ciudadano,
                  'radicado'  => $datos->radicado,
                  'estado' => $request->estado_solicitud,
                  'id' => Crypt::encrypt($request->id)
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_ciudadano = $fecha_pendiente_ciudadano;
               $datos->act_documentos = null;
               $datos->fecha_pendiente_salud = null;
               $datos->fecha_pendiente_planeacion = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'REQUISITOS-FINALES-PENDIENTES') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días

               $fecha_pendiente_ciudadano = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => $datos->nombre_responsable . ' ' . $datos->apellido_responsable,
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Solicitud de Requisitos Finales Pendientes Solicitud N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $fecha_pendiente_ciudadano,
                  'radicado'  => $datos->radicado,
                  'estado' => $request->estado_solicitud,
                  'id' => Crypt::encrypt($request->id)
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_ciudadano = $fecha_pendiente_ciudadano;
               $datos->act_documentos = null;
               $datos->fecha_pendiente_salud = null;
               $datos->fecha_pendiente_planeacion = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($datos->email_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }

            if ($request->estado_solicitud == 'ORDEN-HACIENDA') {
               $this->validate($request, [
                  "observacion_solicitud" => 'required',
                  "estado_solicitud" => 'required'
               ]);

               $date = date('Y-m-d');
               //sumo 30 días
               $date_30 = NULL;
               $date_conceptos = date("Y-m-d", strtotime($date . "+15 Weekday"));

               $detalleCorreo = [
                  'nombres' => 'Francia Milena Zuluaga Tangarife',
                  'mensaje' => $request->observacion_solicitud,
                  'Subject' => 'Orden hacienda para liquidación de impuesto, radicado N°' . $datos->radicado,
                  'documento' => 'NO',
                  'fecha_pendiente' => $date_30,
                  'radicado'  => $datos->radicado,
                  'estado' => 'FUNCIONARIO'
               ];

               // actualizar datos
               $datos->estado_solicitud = $request->estado_solicitud;
               $datos->observacion_solicitud = $request->observacion_solicitud;
               $datos->fecha_actuacion = $date;
               $datos->fecha_pendiente_planeacion = null;
               $datos->fecha_pendiente_salud = null;
               $datos->act_documentos = null;

               //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
               $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

               if ($datos->save()) {

                  //auditoria
                  $auditoria = Auditoria::create([
                     'usuario' => $request->username,
                     'proceso_afectado' => 'Radicado-' . $datos->radicado,
                     'tramite' => 'PUBLICIDAD EXTERIOR',
                     'radicado' => $datos->radicado,
                     'accion' => 'update a estado ' . $request->estado_solicitud,
                     'observacion' => $request->observacion_solicitud
                  ]);

                  Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
                  Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                  return redirect()->route('interior.publicidad.index');
               } else {
                  Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
               }
            }
            
            break;

         default:
            # code...
            break;
      }
   }

   /** FIN PUBLICIDAD EXTERIOR */

   public function parqueaderoDetalle($id)
   {

      $solicitud = Parqueadero::findOrFail($id);

      return view('tramites.interior.parqueaderos.detalle', compact('solicitud'));
   }

   public function parqueaderoUpdate(Request $request)
   {

      $datos = Parqueadero::findOrFail($request->id);

      if ($request->estado_solicitud == 'PENDIENTE') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);


         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = date("Y-m-d", strtotime($date . "+15 Weekday"));


         $detalleCorreo = [
            'nombres' => $datos->nom_solicitante . ' ' . $datos->ape_solicitante,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Documentos Pendientes Solicitud de Categorización de Parqueaderos N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         // actualizar datos
         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = $date_30;
         $datos->act_documentos = null;

         if ($datos->save()) {

            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'CATEGORIZACION DE PARQUEADEROS',
               'radicado' => $datos->radicado,
               'accion' => 'update estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.parqueaderos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            return redirect()->route('interior.parqueaderos.index');
         }
      } elseif ($request->estado_solicitud == 'REVISION-PLANEACION') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = NULL;
         $date_planeacion = date("Y-m-d", strtotime($date . "+15 Weekday"));

         $detalleCorreo = [
            'nombres' => 'Francia Milena Zuluaga Tangarife',
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Revision de Solicitud Pendiente Categorización de parqueaderos N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => 'FUNCIONARIO',

         ];

         // actualizar datos
         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = $date_30;
         $datos->act_documentos = null;
         $datos->fecha_pendiente_planeacion = $date_planeacion;

         $correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
         // $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

         if ($datos->save()) {

            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'CATEGORIZACION DE PARQUEADEROS',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($correo_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.parqueaderos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
         }
      } elseif ($request->estado_solicitud == 'RESPUESTA-PLANEACION') {

         $this->validate($request, [
            "observaciones_planeacion" => 'required',
            "documento_respuesta_planeacion" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = NULL;
         $date_planeacion = null;


         //mover documento a storage
         $adjunto1 = $request->file('documento_respuesta_planeacion')->storeAs('documentos_parqueaderos/' . $datos->radicado, 'Concepto_Tecnico-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_parqueaderos/' . $datos->radicado . '/Concepto_Tecnico-' . $datos->radicado . '.pdf';
         $correo_responsable = 'cjguerrero@bucaramanga.gov.co';
         // $correo_responsable = 'ojrincon@bucaramanga.gov.co';

         $detalleCorreo = [
            'nombres' => 'Carlos Javier Guerrero Gutierrez',
            'mensaje' => $request->observaciones_planeacion,
            'Subject' => 'Respuesta concepto Tecnico de Solicitud N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => 'FUNCIONARIO',

         ];

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_planeacion;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente_planeacion = $date_planeacion;
            $datos->adjunto_resPlaneacion = $ruta_guardado;
            $datos->act_documentos = null;



            if ($datos->save()) {

               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'CATEGORIZACION DE PARQUEADEROS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_planeacion

               ]);

               $auditoriaPlaneacion = AuditoriaParqueadero::create([
                  'parqueadero_id' => $datos->id,
                  'radicado' => $datos->radicado,
                  'nom_solicitante' => $datos->nom_solicitante,
                  'ape_solicitante' => $datos->ape_solicitante,
                  'tipo_documento' => $datos->tipo_documento,
                  'identificacion_solicitante' => $datos->identificacion_solicitante,
                  'direccion_solicitante' => $datos->direccion_solicitante,
                  'barrio_solicitante' => $datos->barrio_solicitante,
                  'tel_solicitante' => $datos->barrio_solicitante,
                  'email_responsable' => $datos->email_responsable,
                  'nombre_empresa' => $datos->nombre_empresa,
                  'direccion_empresa' => $datos->direccion_empresa,
                  'barrio_empresa' => $datos->barrio_empresa,
                  'tel_empresa' => $datos->tel_empresa,
                  'adjunto_camara_rut' => $datos->adjunto_camara_rut,
                  'adjunto_planos' => $datos->adjunto_planos,
                  'adjunto_licencia' => $datos->adjunto_licencia,
                  'estado_solicitud' => $request->estado_solicitud,
                  'observaciones_solicitud' => $request->observaciones_planeacion,
                  'fecha_actuacion' => $date,
                  'adjunto_resPlaneacion' => $ruta_guardado
               ]);

               Mail::to($correo_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('planeacion.parqueaderos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('planeacion.parqueaderos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('planeacion.parqueaderos.index');
         }
      } elseif ($request->estado_solicitud == 'RECHAZADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         // fecha de actuacion
         $date = date('Y-m-d');

         $date_30 = null;

         $detalleCorreo = [
            'nombres' => $datos->nom_solicitante . ' ' . $datos->ape_solicitante,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Rechazada N°' . $datos->radicado,
            'documento' => 'RT',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;


         if ($datos->save()) {

            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'CATEGORIZACION DE PARQUEADEROS',
               'radicado' => $datos->radicado,
               'accion' => 'update estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);



            Mail::to($datos->email_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.parqueaderos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
            return redirect()->route('interior.parqueaderos.index');
         }
      } elseif ($request->estado_solicitud == 'APROBADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "documento_respuesta" => 'required'
         ]);

         $date = date('Y-m-d');
         $date_30 = null;

         //mover documento a storage
         $adjunto1 = $request->file('documento_respuesta')->storeAs('documentos_parqueaderos/' . $datos->radicado, 'Acto_Administrativo_solicitiud_No-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_parqueaderos/' . $datos->radicado . '/Acto_Administrativo_solicitiud_No-' . $datos->radicado . '.pdf';

         $detalleCorreo = [
            'nombres' => $datos->nom_solicitante . ' ' . $datos->ape_solicitante,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Aprobada N°' . $datos->radicado,
            'documento' => 'SI',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud,

         ];

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->adjunto_respuesta = $ruta_guardado;



            if ($datos->save()) {

               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'CATEGORIZACION DE PARQUEADEROS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('interior.parqueaderos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('interior.parqueaderos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('interior.parqueaderos.index');
         }
      }
   }

   ////------------ FUCIONES PARA EVENTOS ---------------------------//////////////////////////////

   public function eventosIndex()
   {

      $sEnviadas = Evento::where('estado_solicitud', 'ENVIADA')->get();
      $sPendientes = Evento::where('estado_solicitud', 'PENDIENTE')->get();
      $sAprobadas = Evento::where('estado_solicitud', 'APROBADA')->get();
      $sRechazadas = Evento::where('estado_solicitud', 'RECHAZADA')->get();
      $porCerrar =  Evento::where('estado_solicitud', 'PENDIENTE')->where('fecha_pendiente', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
      $porCumplirEvento =  Evento::where('estado_solicitud', 'PENDIENTE')->where('fecha_evento', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 7 DAY)'))->get()->count();
      $porCumplirEnviada =  Evento::where('estado_solicitud', 'ENVIADA')->where('fecha_evento', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 7 DAY)'))->get()->count();
      $count_enviadas = $sEnviadas->count();
      $count_pendientes = $sPendientes->count();
      $count_aprobadas = $sAprobadas->count();
      $count_rechazadas = $sRechazadas->count();


      return view('tramites.interior.eventos.index', compact('sEnviadas', 'sPendientes', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_aprobadas', 'count_rechazadas', 'porCerrar', 'porCumplirEvento', 'porCumplirEnviada'));
   }

   public function eventoDetalle($id)
   {
      $solicitud = Evento::findOrFail($id);
      $doc_update = DocUpdate::where('evento_id', $id)->get();

      return view('tramites.interior.eventos.detalle', compact('solicitud', 'doc_update'));
   }

   public function eventosUpdate(Request $request)
   {

      $datos = Evento::findOrFail($request->id);

      if ($datos->tipo_persona == 1) {
         $responsable = $datos->nom_responsable . ' ' . $datos->ape_responsable;
      } else if ($datos->tipo_persona == 2) {
         $responsable = $datos->razon_social;
      }

      if ($request->estado_solicitud == 'PENDIENTE') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);


         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = date("Y-m-d", strtotime($date . "+15 days"));

         // pendiente validacion            


         $detalleCorreo = [
            'nombres' => $responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Documentos Pendientes Solicitud de Permisos para Espectaculos Públicos N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         // actualizar datos
         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = $date_30;
         $datos->act_documentos = null;

         if ($datos->save()) {

            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'PERMISOS PARA ESPECTACULOS PUBLICOS',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->queue(new NotificacionEventos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.eventos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            return redirect()->route('interior.eventos.index');
         }
      } elseif ($request->estado_solicitud == 'APROBADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "documento_respuesta" => 'required'
         ]);

         $date = date('Y-m-d');
         $date_30 = null;

         //mover documento a storage
         $adjunto1 = $request->file('documento_respuesta')->storeAs('documentos_eventos/' . $datos->radicado, 'Acto_Administrativo_solicitud_No-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_eventos/' . $datos->radicado . '/Acto_Administrativo_solicitud_No-' . $datos->radicado . '.pdf';

         $detalleCorreo = [
            'nombres' => $responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Aprobada N°' . $datos->radicado,
            'documento' => 'SI',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud,

         ];

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->adjunto_respuesta = $ruta_guardado;
            $datos->fecha_pendiente = null;
            $datos->act_documentos = null;

            if ($datos->save()) {

               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'PERMISOS PARA ESPECTACULOS PUBLICOS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->queue(new NotificacionEventos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('interior.eventos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('interior.eventos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('interior.eventos.index');
         }
      } elseif ($request->estado_solicitud == 'RECHAZADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         // fecha de actuacion
         $date = date('Y-m-d');

         $date_30 = null;

         $detalleCorreo = [
            'nombres' => $responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Rechazada N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = null;
         $datos->act_documentos = null;

         if ($datos->save()) {

            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'PERMISOS PARA ESPECTACULOS PUBLICOS',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->queue(new NotificacionEventos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('interior.eventos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            return redirect()->route('interior.eventos.index');
         }
      }
   }
}

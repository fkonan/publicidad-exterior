<?php

namespace App\Http\Controllers;

use App\EspacioPublico;
use App\Auditoria;
use App\Parqueadero;
use App\Publicidad;
use App\PublicidadDetalle;
use App\PublicidadConceptos;
use App\AuditoriaParqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnvioNotificacion;
use App\Mail\NotificacionPublicidad;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class PlaneacionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {

      return view('tramites.planeacion.index');
   }

   public function espacioIndex()
   {
      $sEnviadas = EspacioPublico::where('estado_solicitud', 'ENVIADA')->get();
      $sProgreso = EspacioPublico::where('estado_solicitud', 'EN PROGRESO')->get();
      $sPendientes = EspacioPublico::where('estado_solicitud', 'PENDIENTE')->get();
      $sAprobadas = EspacioPublico::where('estado_solicitud', 'APROBADA')->get();
      $sRechazadas = EspacioPublico::where('estado_solicitud', 'RECHAZADA')->get();
      $porCerrar =  EspacioPublico::where('estado_solicitud', 'PENDIENTE')->where('fecha_pendiente', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
      $count_enviadas = $sEnviadas->count();
      $count_progreso = $sProgreso->count();
      $count_pendientes = $sPendientes->count();
      $count_aprobadas = $sAprobadas->count();
      $count_rechazadas = $sRechazadas->count();

      return view('tramites.planeacion.espacio.index', compact('sEnviadas', 'sProgreso', 'sPendientes', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_progreso', 'count_pendientes', 'count_aprobadas', 'count_rechazadas', 'porCerrar'));
   }

   public function detalleSolicitud($id)
   {

      $solicitud = EspacioPublico::findOrFail($id);

      return view('tramites.planeacion.espacio.detalle', compact('solicitud'));
   }

   public function updateSolicitud(Request $request)
   {

      $datos = EspacioPublico::findOrFail($request->id);

      if ($request->estado_solicitud == 'PENDIENTE') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = date("Y-m-d", strtotime($date . "+ 30 days"));


         $detalleCorreo = [
            'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Documentos Pendientes Solicitud de Intervención de Espacio Publico N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         // actualizar

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
               'tramite' => 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->send(new EnvioNotificacion($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('espacio.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualizacion de la solicitud');
            return redirect()->route('espacio.index');
         }
      } elseif ($request->estado_solicitud == 'EN PROGRESO') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = NULL;


         $detalleCorreo = [
            'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Cita para solicitud de Intervención de Espacio Publico N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];
         // actualizar

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones_solicitud = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = $date_30;
         $datos->act_documentos = null;

         if ($datos->save()) {

            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud


            ]);

            Mail::to($datos->email_responsable)->send(new EnvioNotificacion($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('espacio.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualizacion de la solicitud');
            return redirect()->route('espacio.index');
         }
      } elseif ($request->estado_solicitud == 'APROBADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "documento_respuesta" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = NULL;


         $detalleCorreo = [
            'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Aprobada de Licencia Intervención de Espacio Publico N°' . $datos->radicado,
            'documento' => 'SI',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         //mover documento a storage
         $adjunto1 = $request->file('documento_respuesta')->storeAs('Respuestas/' . $datos->radicado, 'Respuesta_Solicitud-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/Respuestas/' . $datos->radicado . '/Respuesta_Solicitud-' . $datos->radicado . '.pdf';

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente = $date_30;
            $datos->documento_respuesta = $ruta_guardado;
            $datos->act_documentos = null;


            if ($datos->save()) {
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->send(new EnvioNotificacion($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('espacio.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('espacio.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('espacio.index');
         }
      } elseif ($request->estado_solicitud == 'RECHAZADA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "documento_respuesta" => 'required'
         ]);

         $date = date('Y-m-d');
         //sumo 30 días
         $date_30 = NULL;


         $detalleCorreo = [
            'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Rechazada de Licencia Intervención de Espacio Publico N°' . $datos->radicado,
            'documento' => 'SI',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         //mover documento a storage
         $adjunto1 = $request->file('documento_respuesta')->storeAs('Respuestas/' . $datos->radicado, 'Respuesta_Solicitud-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/Respuestas/' . $datos->radicado . '/Respuesta_Solicitud-' . $datos->radicado . '.pdf';

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente = $date_30;
            $datos->documento_respuesta = $ruta_guardado;
            $datos->act_documentos = null;

            if ($datos->save()) {

               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'LICENCIA DE INTERVENCION DE ESPACIO PUBLICO PARA LOCALIZACION DE EQUIPAMIENTO',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->send(new EnvioNotificacion($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('espacio.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('espacio.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('espacio.index');
         }
      }
   }
   public function indexParqueaderos()
   {

      $sEnRevision = Parqueadero::where('estado_solicitud', 'REVISION-PLANEACION')->get();
      $contador_revision = $sEnRevision->count();
      $sRevisadas = AuditoriaParqueadero::where('estado_solicitud', 'RESPUESTA-PLANEACION')->get();
      $contador_revisadas = $sRevisadas->count();
      $porCerrar =  Parqueadero::where('estado_solicitud', 'REVISION-PLANEACION')->where('fecha_pendiente_planeacion', '<', DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();


      return view('tramites.planeacion.parqueaderos.index', compact('sEnRevision', 'contador_revision', 'porCerrar', 'sRevisadas', 'contador_revisadas'));
   }

   public function parqueaderoDetalle($id)
   {

      $solicitud = Parqueadero::findOrFail($id);
      return view('tramites.planeacion.parqueaderos.detalle', compact('solicitud'));
   }
   public function parqueaderoDetalleAuditoria($id)
   {

      $solicitud = AuditoriaParqueadero::findOrFail($id);
      return view('tramites.planeacion.parqueaderos.auditoria', compact('solicitud'));
   }

   /** PUBLICIDAD EXTERIOR */

   public function publicidadIndex()
   {

      $sEnviadas = Publicidad::where('estado_solicitud', 'REVISION-CONCEPTOS-PLANEACION')->get();
      $porCerrar = "";
      $porCerrarPlaneacion = "";
      $count_enviadas = $sEnviadas->count();
      return view('tramites.planeacion.publicidad.listar_solicitudes', compact('sEnviadas', 'count_enviadas'));
   }

   // public function publicidadListarSolicitudes($modalidad)
   // {
   //    $sEnviadas = Publicidad::where('estado_solicitud', 'ENVIADA')->where('modalidad', $modalidad)->get();
   //    $sPendientes = Publicidad::where('estado_solicitud', 'PENDIENTE')->where('modalidad', $modalidad)->get();
   //    $sEnRevision = Publicidad::where('estado_solicitud', 'REVISION-PLANEACION')->where('modalidad', $modalidad)->get();
   //    $sRevisadas = Publicidad::where('estado_solicitud', 'RESPUESTA-PLANEACION')->where('modalidad', $modalidad)->get();
   //    $sAprobadas = Publicidad::where('estado_solicitud', 'APROBADA')->where('modalidad', $modalidad)->get();
   //    $sRechazadas = Publicidad::where('estado_solicitud', 'RECHAZADA')->where('modalidad', $modalidad)->get();
   //    $porCerrar = "";
   //    $porCerrarPlaneacion = "";
   //    //   $porCerrar =  Publicidad::where('estado_solicitud', 'PENDIENTE')->where('modalidad',$modalidad)->where('fecha_pendiente' ,'<',DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();
   //    //   $porCerrarPlaneacion =  Publicidad::where('estado_solicitud', 'REVISION-PLANEACION')->where('modalidad',$modalidad)->where('fecha_pendiente_planeacion' ,'<',DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->get()->count();           
   //    $count_enviadas = $sEnviadas->count();
   //    $count_pendientes = $sPendientes->count();
   //    $count_enRevision = $sEnRevision->count();
   //    $count_revisadas = $sRevisadas->count();
   //    $count_aprobadas = $sAprobadas->count();
   //    $count_rechazadas = $sRechazadas->count();

   //    return view('tramites.interior.publicidad.listar_solicitudes', compact('modalidad', 'sEnviadas', 'sEnRevision', 'sPendientes', 'sRevisadas', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_enRevision', 'count_revisadas', 'count_aprobadas', 'count_rechazadas', 'porCerrar', 'porCerrarPlaneacion'));
   // }

   public function publicidadDetalle($id)
   {
      $solicitud = Publicidad::findOrFail($id);
      $detalle = PublicidadDetalle::join('barrio', 'barrio.codigo', '=', 'publicidad_detalle.barrio_aviso')->where('publicidad_id', $id)->get()->first();
      return view('tramites.planeacion.publicidad.detalle', compact('solicitud', 'detalle'));
   }

   public function publicidadUpdate(Request $request)
   {
      $datos = Publicidad::findOrFail($request->id);
      $adjunto=new PublicidadConceptos;

      switch ($request->modalidad) {
         case 'VALLAS':

            $this->validate($request, [
               "observacion_solicitud" => 'required',
               "adj_concepto_planeacion" => 'required'
            ]);

            if ($request->adj_concepto_planeacion || $request->adj_concepto_planeacion != null) {
               $adj_concepto_planeacion =  $request->file('adj_concepto_planeacion')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_concepto_planeacion-' . $datos->radicado . '.pdf');
               $adj_concepto_planeacion_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_concepto_planeacion-' . $datos->radicado . '.pdf';
            } else {
               $adj_concepto_planeacion = null;
            }

            $date = date('Y-m-d');
            $date_30 = date("Y-m-d", strtotime($date . "+15 Weekday"));

            $detalleCorreo = [
               'nombres' => 'Francia Milena Zuluaga Tangarife',
               'mensaje' => $request->observacion_solicitud,
               'Subject' => 'Envio Concepto Técnico Publicidad Exterior N°' . $datos->radicado,
               'documento' => 'NO',
               'fecha_pendiente' => $date_30,
               'radicado'  => $datos->radicado,
               'estado' => 'FUNCIONARIO'
            ];

            // actualizar datos
            $datos->estado_solicitud = 'REVISION-CONCEPTOS-SALUD';
            $datos->observacion_solicitud = $request->observacion_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente_salud = $date_30;

            $adjunto->publicidad_id=$request->id;
            $adjunto->adj_concepto_planeacion=$adj_concepto_planeacion_rut;

            //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
            $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

            if ($datos->save()) {
               $adjunto->save();
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'PUBLICIDAD EXTERIOR',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado REVISION-CONCEPTOS-SALUD',
                  'observacion' => $request->observacion_solicitud
               ]);

               Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('planeacion.publicidad.index');
            } else {
               Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            }

            break;

         default:
            # code...
            break;
      }
   }

   /** FIN PUBLICIDAD EXTERIOR */
}

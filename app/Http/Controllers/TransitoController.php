<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Publicidad;
use App\Auditoria;
use App\PublicidadDetalle;
use App\PublicidadConceptos;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionPublicidad;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class TransitoController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {
      return view('tramites.transito.index');
   }

   public function publicidadIndex()
   {
      $sEnviadas = Publicidad::where('estado_solicitud', 'REVISION-CONCEPTOS-SALUD')->get();
      $count_enviadas = $sEnviadas->count();
      return view('tramites.transito.publicidad.listar_solicitudes', compact('sEnviadas', 'count_enviadas'));
   }

   public function publicidadDetalle($id)
   {
      $solicitud = Publicidad::findOrFail($id);
      $detalle = PublicidadDetalle::join('barrio', 'barrio.codigo', '=', 'publicidad_detalle.barrio_aviso')->where('publicidad_id', $id)->get()->first();
      return view('tramites.transito.publicidad.detalle', compact('solicitud', 'detalle'));
   }

   public function publicidadUpdate(Request $request)
   {
      $datos = Publicidad::findOrFail($request->id);

      switch ($request->modalidad) {
         case 'VALLAS':

            $this->validate($request, [
               "observacion_solicitud" => 'required',
               "adj_concepto_salud" => 'required'
            ]);

            if ($request->adj_concepto_salud || $request->adj_concepto_salud != null) {
               $adj_concepto_salud =  $request->file('adj_concepto_salud')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_concepto_salud-' . $datos->radicado . '.pdf');
               $adj_concepto_salud_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_concepto_salud-' . $datos->radicado . '.pdf';
            } else {
               $adj_concepto_salud = null;
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
            $datos->estado_solicitud = 'VIABILIDAD-PERMISO';
            $datos->observacion_solicitud = $request->observacion_solicitud;
            $datos->fecha_actuacion = $date;

            //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
            $correo_responsable = ['julianrincon9230@gmail.com', 'ojrincon@bucaramanga.gov.co'];

            if ($datos->save()) {
               $adjunto = PublicidadConceptos::where('publicidad_id', $request->id)->update(['adj_concepto_salud' => $adj_concepto_salud_rut]);
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
               return redirect()->route('salud.publicidad.index');
            } else {
               Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            }

            break;
         case 'PUBLICIDAD AEREA':
            $this->validate($request, [
               "observacion_solicitud" => 'required',
               "adj_concepto_salud" => 'required'
            ]);

            if ($request->adj_concepto_salud || $request->adj_concepto_salud != null) {
               $adj_concepto_salud =  $request->file('adj_concepto_salud')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_concepto_salud-' . $datos->radicado . '.pdf');
               $adj_concepto_salud_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_concepto_salud-' . $datos->radicado . '.pdf';
            } else {
               $adj_concepto_salud = null;
            }

            $date = date('Y-m-d');
            $date_30 = date("Y-m-d", strtotime($date . "+15 Weekday"));

            $detalleCorreo = [
               'nombres' => 'Francia Milena Zuluaga Tangarife',
               'mensaje' => $request->observacion_solicitud,
               'Subject' => 'Envio viabilidad concepto técnico Publicidad Exterior N°' . $datos->radicado,
               'documento' => 'NO',
               'fecha_pendiente' => $date_30,
               'radicado'  => $datos->radicado,
               'estado' => 'FUNCIONARIO'
            ];

            // actualizar datos
            $datos->estado_solicitud = 'VIABILIDAD-PERMISO';
            $datos->observacion_solicitud = $request->observacion_solicitud;
            $datos->fecha_pendiente_salud = null;
            $datos->fecha_actuacion = $date;

            //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
            $correo_responsable = [ 'fhernandez@bucaramanga.gov.co'];

            if ($datos->save()) {
               $adjunto=new PublicidadConceptos;
               $adjunto->publicidad_id=$request->id;
               $adjunto->adj_concepto_salud=$adj_concepto_salud_rut;
               $adjunto->save();
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'PUBLICIDAD EXTERIOR',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado VIABILIDAD-PERMISO',
                  'observacion' => $request->observacion_solicitud
               ]);

               Mail::to($correo_responsable)->queue(new NotificacionPublicidad($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('salud.publicidad.index');
            } else {
               Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            }
            break;

         default:
            # code...
            break;
      }
   }
}

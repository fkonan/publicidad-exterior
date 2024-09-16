<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\EspectaculosPublicos;
use App\Boletas;
use App\NitEspectaculos;
use App\Publicidad;
use App\PublicidadDetalle;
use Illuminate\Support\Facades\Mail;
use App\Auditoria;
use App\Mail\NotificacionEspectaculos;
use Illuminate\Support\Facades\Crypt;


class HaciendaController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {

      return view('tramites.hacienda.index');
   }

   public function espectaculoIndex()
   {


      $sEnviadas = EspectaculosPublicos::where('estado_solicitud', 'ENVIADA')->get();
      $sGarantia = EspectaculosPublicos::where('estado_solicitud', 'ENTREGA_GARANTIA')->get();
      $sPendientes = EspectaculosPublicos::where('estado_solicitud', 'PENDIENTE')->get();
      $sEstudio = EspectaculosPublicos::where('estado_solicitud', 'DOCUMENTOS_ACTUALIZADOS')->get();
      $sAprobadas = EspectaculosPublicos::where('estado_solicitud', 'EVENTO_APROBADO')->get();
      $sRechazadas = EspectaculosPublicos::where('estado_solicitud', 'RECHAZADA')->get();
      $sCanceladas = EspectaculosPublicos::where('estado_solicitud', 'EVENTO_CANCELADO')->get();
      $sActoRevoca = EspectaculosPublicos::where('estado_solicitud', 'ACTO_REVOCADO')->get();
      $sDevolucion = EspectaculosPublicos::where('estado_solicitud', 'DEVOLUCION_GARANTIA')->get();
      $sCerradas = EspectaculosPublicos::where('estado_solicitud', 'EVENTO_FINALIZADO')->get();
      $sLiquidacion = EspectaculosPublicos::where('estado_solicitud', 'EVENTO_REALIZADO')->get();
      $sPagados = EspectaculosPublicos::where('estado_solicitud', 'PAGO_REALIZADO')->get();
      $porCerrar =  EspectaculosPublicos::where('estado_solicitud', 'PENDIENTE')->where('fecha_pendiente', '<', DB::raw('DATEADD(day,5, CONVERT (date, GETDATE()))'))->get()->count();
      $count_enviadas = $sEnviadas->count();
      $count_garantias = $sGarantia->count();
      $count_pendientes = $sPendientes->count();
      $count_aprobadas = $sAprobadas->count();
      $count_rechazadas = $sRechazadas->count();
      $count_enEstudio = $sEstudio->count();
      $count_canceladas = $sCanceladas->count();
      $count_revoca = $sActoRevoca->count();
      $count_devolucion = $sDevolucion->count();
      $count_cerradas = $sCerradas->count();
      $count_liquidacion = $sLiquidacion->count();
      $count_pagados = $sPagados->count();

      return view('tramites.hacienda.espectaculos.index', compact('sEnviadas', 'sPendientes', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_rechazadas', 'porCerrar', 'sGarantia', 'count_garantias', 'sEstudio', 'count_enEstudio', 'sAprobadas', 'count_aprobadas', 'sCanceladas', 'count_canceladas', 'sActoRevoca', 'count_revoca', 'sDevolucion', 'count_devolucion', 'sCerradas', 'count_cerradas', 'sLiquidacion', 'count_liquidacion', 'sPagados', 'count_pagados'));
   }

   public function espectaculoDetalle($id)
   {

      $solicitud = EspectaculosPublicos::findOrFail($id);
      $boletas = Boletas::where('espectaculo_id', $id)->get();
      $fechas =  NitEspectaculos::where('espectaculo_id', $id)->get();

      return view('tramites.hacienda.espectaculos.detalle', compact('solicitud', 'boletas', 'fechas'));
   }

   public function espectaculoUpdate(Request $request)
   {

      

      $datos = EspectaculosPublicos::findOrFail($request->id);
      if ($request->estado_solicitud == 'ENTREGA_GARANTIA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "tipo_garantia" => 'required',
            "numero_poliza_cheque" => 'required',
            "valor_poliza_cheque" => 'required',
            "arch_documentoGarantia" => 'required',
            "arch_acta_reunion" => 'required'
         ]);


         $date = date('Y-m-d');
         $date_30 = null;

         //mover documento a storage
         $adjunto1 = $request->file('arch_documentoGarantia')->storeAs('documentos_espectaculos/' . $datos->radicado, 'GARANTIA-' . $datos->radicado . '.pdf');
         $adjunto2 = $request->file('arch_acta_reunion')->storeAs('documentos_espectaculos/' . $datos->radicado, 'ACTA-REUNION-ENTREGA-' . $datos->radicado . '.pdf');
         //crear ruta de guardado
         $ruta_garantia = 'storage/documentos_espectaculos/' . $datos->radicado . '/GARANTIA-' . $datos->radicado . '.pdf';
         $ruta_acta = 'storage/documentos_espectaculos/' . $datos->radicado . '/ACTA-REUNION-ENTREGA-' . $datos->radicado . '.pdf';

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Recepción de garantía física de solicitud de espectaculos publicos N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_30,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud,


         ];
         if ($adjunto1 && $adjunto2) {

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->tipo_garantia = $request->tipo_garantia;
            $datos->numero_poliza_cheque = $request->numero_poliza_cheque;
            $datos->valor_poliza_cheque = $request->valor_poliza_cheque;
            $datos->adj_documentoGarantia = $ruta_garantia;
            $datos->adj_acta_reunion = $ruta_acta;
            $datos->exento_imp = $request->exento_imp;

            if ($datos->save()) {

               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'ESPECTACULOS PUBLICOS',
                  'radicado' => $datos->radicado,
                  'accion' => 'actualización de estado del tramite a ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->queue(new NotificacionEspectaculos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('hacienda.espectaculos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('hacienda.espectaculos.index');
            }
         } else {
            Alert::error('Error', 'Ocurrio un error al cargar los archivos al servidor');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'PENDIENTE') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required'
         ]);

         $date = date('Y-m-d');
         $date_3 = date("Y-m-d", strtotime($datos->fecha_inicio_evento . "-3 day"));


         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Documentos pendientes en solicitud de espectaculos publicos N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => $date_3,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud,
            'id' => Crypt::encrypt($request->id)

         ];

         // actualizar datos
         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = $date_3;
         $datos->exento_imp = $request->exento_imp;

         if ($datos->save()) {

            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'ESPECTACULOS PUBLICOS',
               'radicado' => $datos->radicado,
               'accion' => 'actualización de estado del tramite a ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);


            Mail::to($datos->email_responsable)->queue(new NotificacionEspectaculos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('hacienda.espectaculos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'EVENTO_APROBADO') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "arch_acto_administrativo" => 'required'
         ]);

         $date = date('Y-m-d');

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Aprobada de Espectáculo Publico de Radicado N°' . $datos->radicado,
            'documento' => 'SI',
            'fecha_pendiente' => null,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         //mover documento a storage
         $adjunto1 = $request->file('arch_acto_administrativo')->storeAs('documentos_espectaculos/' . $datos->radicado, 'ACTO-ADMINISTRATIVO-RAD-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_espectaculos/' . $datos->radicado . '/ACTO-ADMINISTRATIVO-RAD-' . $datos->radicado . '.pdf';

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente = null;
            $datos->adj_acto_administrativo = $ruta_guardado;
            $datos->estado_documentos = null;


            if ($datos->save()) {
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'ESPECTACULOS PUBLICOS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               // guardado tabla de declaraciones
               $buscaNit = DB::connection('sqlsrv')->table('nit')->where('nit',  $datos->numero_identificacion)->where('estado', 'activo')->get();

               if ($buscaNit->count() <= 0) {

                  DB::connection('sqlsrv')->table('nit')->insert(
                     array(
                        'nit' => $datos->numero_identificacion,
                        'razon_social' => $datos->nombre_o_razon,
                        'estado' => 'activo',
                        'fecha_registro' => date('Y-d-m H:i:s')
                     )
                  );
               }

               $buscarMae = DB::connection('sqlsrv')->table('mae_impuestos')->where('nit',  $datos->numero_identificacion)->where('id_modulo', 26)->get();

               if ($buscarMae->count() <= 0) {

                  $insertMae =  DB::connection('sqlsrv')->table('mae_impuestos')->insertGetId(
                     array(
                        'nit' => $datos->numero_identificacion,
                        'id_modulo' => 26,
                        'nombre' => $datos->nombre_o_razon,
                        'tipo_persona' => $datos->tipo_persona,
                        'direccion' => $datos->direccion_notificacion . '-' . $datos->barrio_notificacion,
                        'telefono_fijo' => $datos->telefono_movil,
                        'telefono_celular' => $datos->telefono_movil,
                        'correo_notificacion' => $datos->email_responsable,
                        'direccion_notificacion' => $datos->direccion_notificacion . '-' . $datos->barrio_notificacion,
                        'fecha_registro' => date('Y-d-m H:i:s')
                     )
                  );

                  DB::connection('sqlsrv')->table('datos_contacto')->insert(
                     array(
                        'id_mae_impuestos' => $insertMae,
                        'correo_notificacion' => $datos->email_responsable,
                        'direccion_notificacion' => $datos->direccion_notificacion . '-' . $datos->barrio_notificacion,
                        'telefono_contacto' => $datos->telefono_movil,
                        'fecha_registro' => date('Y-d-m H:i:s')
                     )
                  );
               }

               // envia correo

               Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('hacienda.espectaculos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('hacienda.espectaculos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'ACTO_REVOCADO') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "arch_acto_revocatorio" => 'required|mimes:pdf|file'
         ]);

         $date = date('Y-m-d');

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud de acto revocatorio de Espectáculo Publico de Radicado N°' . $datos->radicado,
            'documento' => 'SI-REVOCA',
            'fecha_pendiente' => null,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         //mover documento a storage
         $adjunto1 = $request->file('arch_acto_revocatorio')->storeAs('documentos_espectaculos/' . $datos->radicado, 'ACTO-ADMINISTRATIVO-REVOCADO-RAD-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_espectaculos/' . $datos->radicado . '/ACTO-ADMINISTRATIVO-REVOCADO-RAD-' . $datos->radicado . '.pdf';

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente = null;
            $datos->adj_acto_revocatorio = $ruta_guardado;
            $datos->estado_documentos = null;


            if ($datos->save()) {
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'ESPECTACULOS PUBLICOS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('hacienda.espectaculos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('hacienda.espectaculos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'DEVOLUCION_GARANTIA') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',
            "arch_actReu_revocatorio" => 'required|mimes:pdf|file'
         ]);

         $date = date('Y-m-d');

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Devolucion de Garantia de Espectáculo Publico con Radicado N°' . $datos->radicado,
            'documento' => 'SI-DEVOLUCION',
            'fecha_pendiente' => null,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         //mover documento a storage
         $adjunto1 = $request->file('arch_actReu_revocatorio')->storeAs('documentos_espectaculos/' . $datos->radicado, 'DEVOLUCION-GARANTIA-' . $datos->radicado . '.pdf');

         //crear ruta de guardado
         $ruta_guardado = 'storage/documentos_espectaculos/' . $datos->radicado . '/DEVOLUCION-GARANTIA-' . $datos->radicado . '.pdf';

         if ($adjunto1) {
            // actualizar

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->fecha_pendiente = null;
            $datos->adj_actReu_revocatorio = $ruta_guardado;
            $datos->estado_documentos = null;


            if ($datos->save()) {
               //auditoria
               $auditoria = Auditoria::create([
                  'usuario' => $request->username,
                  'proceso_afectado' => 'Radicado-' . $datos->radicado,
                  'tramite' => 'ESPECTACULOS PUBLICOS',
                  'radicado' => $datos->radicado,
                  'accion' => 'update a estado ' . $request->estado_solicitud,
                  'observacion' => $request->observaciones_solicitud

               ]);

               Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
               Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
               return redirect()->route('hacienda.espectaculos.index');
            } else {

               Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
               return redirect()->route('hacienda.espectaculos.index');
            }
         } else {

            Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'EVENTO_FINALIZADO') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',

         ]);

         $date = date('Y-m-d');

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud Cerrada de Espectaculos Publicos Rad N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = null;
         $datos->estado_documentos = null;
         $datos->exento_imp = $request->exento_imp;


         if ($datos->save()) {
            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'ESPECTACULOS PUBLICOS',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('hacienda.espectaculos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
            return redirect()->route('hacienda.espectaculos.index');
         }
      } else if ($request->estado_solicitud == 'PAGO_REALIZADO') {

         $this->validate($request, [
            "observaciones_solicitud" => 'required',
            "estado_solicitud" => 'required',

         ]);

         $date = date('Y-m-d');

         $detalleCorreo = [
            'nombres' => $datos->nombre_o_razon,
            'mensaje' => $request->observaciones_solicitud,
            'Subject' => 'Solicitud con Pago Realizado de Espectaculos Publicos Rad N°' . $datos->radicado,
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'radicado'  => $datos->radicado,
            'estado' => $request->estado_solicitud
         ];

         $datos->estado_solicitud = $request->estado_solicitud;
         $datos->observaciones = $request->observaciones_solicitud;
         $datos->fecha_actuacion = $date;
         $datos->fecha_pendiente = null;
         $datos->estado_documentos = null;

         //cambiar estado
         $liquidacion = NitEspectaculos::where('espectaculo_id', $request->id)->update(['estado' => 'PAGADO']);




         if ($datos->save()) {
            //auditoria
            $auditoria = Auditoria::create([
               'usuario' => $request->username,
               'proceso_afectado' => 'Radicado-' . $datos->radicado,
               'tramite' => 'ESPECTACULOS PUBLICOS',
               'radicado' => $datos->radicado,
               'accion' => 'update a estado ' . $request->estado_solicitud,
               'observacion' => $request->observaciones_solicitud

            ]);

            Mail::to($datos->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
            Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
            return redirect()->route('hacienda.espectaculos.index');
         } else {

            Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
            return redirect()->route('hacienda.espectaculos.index');
         }
      }
      // return $request;
   }

  public function publicidadIndex()
   {
      $sEnviadas = Publicidad::where('estado_solicitud', 'ORDEN-HACIENDA')->get();
      $porCerrar = "";
      $porCerrarPlaneacion = "";
      $count_enviadas = $sEnviadas->count();
      return view('tramites.hacienda.publicidad.listar_solicitudes', compact('sEnviadas', 'count_enviadas'));
   }

   public function publicidadDetalle($id)
   {
      $solicitud = Publicidad::findOrFail($id);
      $detalle = PublicidadDetalle::join('barrio', 'barrio.codigo', '=', 'publicidad_detalle.barrio_aviso')->where('publicidad_id', $id)->get()->first();
      return view('tramites.hacienda.publicidad.detalle', compact('solicitud', 'detalle'));
   }

   // EMPLEO JOVEN

   public function indexReportes(){
    
      return view('tramites.hacienda.empleo-joven.index');
   }

   public function reporteEmpleoJoven(){
       $sql1= "SELECT empr.nombre_empresa AS 'empresa', empr.nit, empr.representante, empr.numero_documento_rl AS 'documento representante', empr.direccion_empresa AS 'Direccion Empresa', empr.telefono_contacto AS 'telefono empresa', empr.correo_electronico as 'correo empresa', empr.codigo_ciiu as 'CIIU', CONCAT('https://empleo-joven.bucaramanga.gov.co/',empr.ruta_documentos_empresa_enero) as 'DOCUMENTOS 1ER MES', CONCAT('https://empleo-joven.bucaramanga.gov.co/',empr.ruta_certificados_empresa_enero) as 'CERTIFICADOS 1ER MES', CONCAT('https://empleo-joven.bucaramanga.gov.co/',empr.ruta_documentos_empresa_febrero) as 'DOCUMENTOS EMPRESA 2DO MES', CONCAT('https://empleo-joven.bucaramanga.gov.co/',empr.ruta_certificados_empresa_febrero) as 'CERTIFICADOS EMPRESA 2DO MES', empr.created_at as 'HORA Y FECHA DE CREACION', empr.updated_at as 'HORA Y FECHA DE ACTUALIZACION',CONCAT(empl.nombres_empleado,' ',empl.apellidos_empleado) AS 'nombre empleado', empl.numero_documento, empl.fecha_nacimiento as 'fecha de nacimiento', empl.edad as 'edad',empl.direccion_empleado, empl.telefono_contacto as 'telefono empleado',empl.correo_electronico as 'Correo empleado',CONCAT('https://empleo-joven.bucaramanga.gov.co/',empl.ruta_documentos_empleado_enero) AS 'DOC 1ER MES', CONCAT('https://empleo-joven.bucaramanga.gov.co/',empl.ruta_documentos_empleado_febrero) AS 'DOC 2DO MES', empl.created_at as 'HORA Y FECHA DE CREACION EMPLEADO', empl.updated_at as 'HORA Y FECHA DE ACTUALIZACION EMPLEADO' FROM empresa AS empr INNER JOIN empleado AS empl ON empr.id = empl.empresa_id";

        $sql2 = "SELECT nombre_empresa AS 'Nombre Empresa', nit, representante, numero_documento_rl AS 'Documento Representante', codigo_ciiu AS 'Codigo CIIU', 
        direccion_empresa AS 'Direccion Empresa', telefono_contacto AS 'Telefono', correo_electronico AS 'Correo',  
        CONCAT('https://empleo-joven.bucaramanga.gov.co/',ruta_documentos_empresa_enero) AS 'DOCUMENTOS EMPRESA 1ER MES', 
        CONCAT('https://empleo-joven.bucaramanga.gov.co/',ruta_certificados_empresa_enero) AS 'CERTIFICADOS EMPRESA 1ER MES',
         CONCAT('https://empleo-joven.bucaramanga.gov.co/',ruta_documentos_empresa_febrero) AS 'DOCUMENTOS EMPRESA 2DO MES', 
         CONCAT('https://empleo-joven.bucaramanga.gov.co/',ruta_certificados_empresa_febrero) AS 'CERTIFICADOS EMPRESA 2DO MES', 
         created_at AS 'HORA Y FECHA DE CREACION',updated_at AS 'HORA Y FECHA DE ACTUALIZACION' FROM empresa ";
      $data_empresa_empleado = DB::connection('mysql4')->select($sql1);  
      $data_empresas = DB::connection('mysql4')->select($sql2);   
      return response()->json(['empresas_empleados' => $data_empresa_empleado, 'data_empresa'=>$data_empresas]);
   }
   public function indexMetrolinea(){
    
      return view('tramites.hacienda.metrolinea.index');
   }

   public function reporteMetrolinea(){
      $sql1= "SELECT `numero_solicitud` AS '# solicitud', `tipo_poblacion`, `nombre_usuario`, `apellido_usuario`, `fecha_nacimiento`, `edad`, `estado_civil`, `nombre_acudiente` AS 'nombre acudiente', `nombre_cuidador` AS 'nombre cuidador', `nivel_estudios` AS 'nivel de estudios', `documento_usuario` AS '# documento', `sexo`, `telefono_usuario`, `email_usuario`, `barrio`, `corregimiento`, `direccion_usuario`, `institucion_educativa`, `estrato_socioeconomico` AS 'Estrato', `trabaja_actualmente`AS '¿trabaja actualmente?', `ruta_frecuente` AS 'rutas frecuentes', `discapacidad` AS 'discapacidad', `tiene_sisben` '¿ tiene sisben ?', `entrega_tarjeta` AS 'lugar de entrega de tarjeta', `adj_documentoIdentidad`AS 'ruta documento identidad', `adj_certiVecindad` AS 'ruta certificado vecindad', `adj_certificadoEstudio` AS 'ruta certificado estudio', `adj_docAcudiente` AS 'ruta documento acudiente', `adj_docSisben` AS 'documento sisben', `adj_deportistas_artistas` AS 'certificado deportistas', `adj_discapacidad` AS 'certificado discapacidad', `estado_solicitud`, `observaciones_solicitud` AS 'observaciones', `created_at` AS 'fecha creacion', `updated_at` AS 'fecha actualizacion' FROM `tramites`.`caracterizacion_metrolinea`";

     $data_metrolinea = DB::connection('mysql')->select($sql1); 
     return response()->json(['metrolinea' => $data_metrolinea]);
  }
}

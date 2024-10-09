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
use App\PublicidadDetalle;
use App\PublicidadAdjunto;
use App\PublicidadLiquidacion;
use App\Publicidad;
use App\Mail\MailDadep;
use App\PublicidadNovedad;
use App\PublicidadParamAdjuntos;
use Dotenv\Exception\ValidationException;

include_once "PublicidadAdmin.php";

class PublicidadController extends Controller
{
   public function index()
   {
      return view('tramites.publicidad.index');
   }

   /*FABIAN 20240827 */
   public function inicio()
   {
      $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
      $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
      $Barrios = Barrio::all();
      return view('tramites.publicidad.inicio', compact('Parametros1', 'Parametros2', 'Barrios'));
   }

   public function solicitud($documento)
   {
      $datos = Persona::where("PersonaDoc", $documento)->first();
      $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
      $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
      $Barrios = Barrio::all();
      return view('tramites.publicidad.Solicitud', compact('datos', 'Parametros1', 'Parametros2', 'Barrios'));
   }

   public function validarDocumento(Request $request)
   {
      $tipo_documento = $request->input('tipo_documento');
      $documento = $request->input('documento');
      $persona = Persona::where('PersonaTipDoc', $tipo_documento)->where('PersonaDoc', $documento)->first();
      if ($persona) {
         return response()->json(['success' => true, 'persona' => $persona]);
      } else {
         return response()->json(['success' => false]);
      }
   }

   public function personasGuardar(Request $request)
   {
      try {
         $rules = [
            'PersonaDoc' => 'required',
            'PersonaTip' => 'required',
            'PersonaTipDoc' => 'required',
            'PersonaMail' => 'required|email',
            'PersonaTel' => 'required',
            'dir_solicitante' => 'required',
            'PersonaBarrio' => 'required'
         ];

         if ($request->PersonaTip == 'Natural') {
            $rules['PersonaNombre'] = 'required';
            $rules['PersonaApe'] = 'required';
         } elseif ($request->PersonaTip == 'Juridica') {
            $rules['PersonaRazon'] = 'required';
         }

         $validar = $request->validate($rules);
         if (!$validar) {
            return response()->json(['success' => false, 'errors' => $validar->errors()]);
         }

         $datos = Persona::updateOrCreate(
            ['PersonaDoc' => $request->PersonaDoc],
            [
               'PersonaTip' => $request->PersonaTip,
               'PersonaTipDoc' => $request->PersonaTipDoc,
               'PersonaDoc' => $request->PersonaDoc,
               'PersonaNombre' => $request->PersonaNombre,
               'PersonaRazon' => $request->PersonaRazon,
               'PersonaApe' => $request->PersonaApe,
               'PersonaMail' => $request->PersonaMail,
               'PersonaTel' => $request->PersonaTel,
               'PersonaDir' => $request->dir_solicitante,
               'PersonaBarrio' => $request->PersonaBarrio,
            ]
         );
         if ($datos->wasRecentlyCreated) {
            return response()->json(['success' => true, 'persona' => $datos]);
         } else {
            return response()->json(['success' => true, 'persona' => $datos]);
         }
      } catch (ValidationException $e) {
         return response()->json(['success' => false, 'errors' => $e]);
      }
   }

   public function cargarDocumentos($modalidad)
   {
      $documentos = PublicidadParamAdjuntos::where('modalidad', $modalidad)->where('inicial', 1)->get();
      return response()->json(['success' => true, 'documentos' => $documentos]);
   }

   public function finalizar(Request $request)
   {
      DB::beginTransaction();

      try {

         $modalidad = $request->publicidad_modalidad;
         $personas = Persona::find($request->PersonaId);
         $publicidad = new Publicidad();
         //Creando radicado
         $y = date("Y");
         $m = date("m");
         $sql = "select count(id) as Cantidad from publicidad_exterior Where ( YEAR(created_at)=$y)";
         $obj = DB::select($sql);
         $id = $obj[0]->Cantidad + 1;
         $id = 10000000 + $id;
         $id = "$id";

         $publicidad->radicado = $id;
         $publicidad->PersonaId = $personas->PersonaId;
         $publicidad->modalidad = $modalidad;
         $publicidad->tipo_publicidad =  $request->tipo_publicidad;
         $publicidad->fecha_renovacion =  $request->fecha_renovacion;
         $publicidad->fecha_vencimiento =  $request->fecha_vencimiento;

         $publicidad->numero_elementos = $request->input($modalidad . "_numero_elementos");
         $publicidad->esquinero = $request->input($modalidad . "_esquinero");
         $publicidad->estado_solicitud = "radicado";
         $publicidad->novedad = "Revisión de documentos radicados";
         $publicidad->dependencia = "interior";

         $publicidad->tratamiento_datos =  $request->tratamiento_datos;
         $publicidad->acepto_terminos = $request->acepto_terminos;
         $publicidad->confirmo_mayorEdad = $request->confirmo_mayorEdad;
         $publicidad->compartir_informacion = $request->compartir_informacion;

         $publicidad->radicado = $y . "-" . $m . "-" . substr($id, -3);
         $publicidad->save();

         $detalle = new Publicidaddetalle;
         $detalle = new Publicidaddetalle;
         $detalle->publicidad_id = $publicidad->id;
         $detalle->tipo_valla = $request->input($modalidad . "_tipo_valla", null);

         if ($publicidad->id > 0) {
            $detalle = new Publicidaddetalle;
            $detalle->publicidad_id = $publicidad->id;
            $detalle->tipo_valla = $request->input($modalidad . "_tipo_valla", null);

            for ($i = 1; $i <= $publicidad->numero_elementos; $i++) {
               $detalle->numero_caras = $request->input($modalidad . "_numero_caras" . $i, null);
               $detalle->alto_elemento = $request->input($modalidad . "_alto_elemento" . $i, null);
               $detalle->ancho_elemento = $request->input($modalidad . "_ancho_elemento" . $i, null);
               $detalle->numero_caras = $request->input($modalidad . "_numero_caras" . $i, null);
               $detalle->area_total_elemento = $request->input($modalidad . "_area_total_elemento" . $i, null);
               $detalle->ancho_fachada = $request->input($modalidad . "_ancho_fachada" . $i, null);
               $detalle->alto_fachada = $request->input($modalidad . "_alto_fachada" . $i, null);
               $detalle->area_total_fachada = $request->input($modalidad . "_area_total_fachada" . $i, null);
               $detalle->descripcion_elemento = $request->input($modalidad . "_descripcion_elemento" . $i, null);
               $detalle->direccion_elemento = $request->input($modalidad . "_direccion_elemento" . $i, null);
               $detalle->caracteristicas_vehiculo = $request->input($modalidad . "_caracteristicas_vehiculo" . $i, null);
               $detalle->tipo_vehiculo = $request->input($modalidad . "_tipo_vehiculo" . $i, null);
               $detalle->placa_vehiculo = $request->input($modalidad . "_placa_vehiculo" . $i, null);
               $detalle->save();
            }
         }

         $folder = 'documentos_publicidad/' . $publicidad->radicado;

         foreach ($request->allFiles() as $key => $file) {
            $documentos = PublicidadAdjunto::where('radicado', $publicidad->radicado)->where('codigo_adjunto', $key)->get();
            $nombre_adjunto = PublicidadParamAdjuntos::where('codigo_adjunto', $key)->where('modalidad', $modalidad)->first();

            if ($documentos->count() == 0) {
               $documento = new PublicidadAdjunto;
               $documento->publicidad_id = $publicidad->id;
               $documento->codigo_adjunto = $key;
               $documento->nombre_adjunto = $nombre_adjunto->titulo_adjunto;
               $documento->ruta = $folder . '/' . $key . ".pdf";
               $documento->radicado = $publicidad->radicado;
               $documento->save();

               $file->storeAs($folder, $key . ".pdf");
            }
         }

         $novedades = new PublicidadNovedad();
         $novedades->NovedadTipo = 'radicado';
         $novedades->NovedadComentario = 'Radicación de solicitud';
         $novedades->NovedadEstado = 'radicado';
         $novedades->SolicitudId = $publicidad->id;
         $novedades->save();

         PublicidadAdmin::sendMail($personas, $publicidad, 'Radicación de solicitud', 'NO');

         DB::commit();
      } catch (\Exception $e) {
         DB::rollBack();
         throw $e;
      }

      return view('tramites.publicidad.ResSol', ['radicado' => $publicidad->radicado]);
   }

   public function consulta(Request $request)
   {
      $Qs = Publicidad::where($request->tipo_parametro, $request->parametro)->get();
      //dd($Qs);
      if ($Qs->count() > 0) {
         $array = $Qs->getDictionary();
         $Solicitud = reset($array);

         $estado = DB::select("SELECT pce.id AS estado_id,pcn.id AS novedad_id,titulo_estado,adj_ciudadano
         FROM publicidad_config_estados AS pce
         INNER JOIN publicidad_config_novedades AS pcn ON pce.id=pcn.estado_id
         WHERE modalidad='$Solicitud->modalidad' AND estado='$Solicitud->estado_solicitud'; ");

         $adjuntos = [];
         if (count($estado) > 0) {


            if ($estado[0]->adj_ciudadano == 1) {
               $adjuntos = DB::select("SELECT id,codigo_adjunto,titulo_adjunto
            FROM publicidad_config_adjuntos
            WHERE modalidad='$Solicitud->modalidad' AND ciudadano=1;");
            }
         }

         $Persona = Persona::Find($Solicitud->PersonaId);
         $documento = null;
         $liquidacion = null;

         if ($Solicitud->estado_solicitud == 'finalizado') {
            $documento = PublicidadAdjunto::where("publicidad_id", $Solicitud->id)->where("codigo_adjunto", "generar_acto")->first();
         }

         if ($Solicitud->estado_solicitud == 'PENDIENTE' && $Solicitud->dependencia == 'HACIENDA') {
            $liquidacion = PublicidadLiquidacion::where("publicidad_id", $Solicitud->id)->whereNull("fecha_pago")->get();
         }
         return view('tramites.publicidad.Consulta', compact('Solicitud', 'Persona', 'documento', 'liquidacion', 'adjuntos', 'estado'));
      } else {
         Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
         return redirect()->route('publicidad.index');
      }
   }

   //fin fabian

   //----Documentos Pendientes-----//

   public function DocConsulta()
   {

      $Datos = new Persona();
      $Datos->TituloApp = "publicidad-exterior";
      $funcion = "DocPendientes";
      return view('tramites.publicidad.BusRadicado', compact('funcion', 'Datos'));
   }

   public function DocPendientes(Request $request)
   {

      $Qs = Publicidad::where("radicado", $request->Radicado)->get();

      if ($Qs->count() > 0) {
         $array = $Qs->getDictionary();
         $Solicitud = reset($array);

         $estado = DB::select("SELECT pce.id AS estado_id,pcn.id AS novedad_id,titulo_estado,adj_ciudadano,estado_sig
         FROM publicidad_config_estados AS pce
         INNER JOIN publicidad_config_novedades AS pcn ON pce.id=pcn.estado_id
         WHERE modalidad='$Solicitud->modalidad' AND estado='$Solicitud->estado_solicitud'; ");

         $adjuntos = [];
         if ($estado[0]->adj_ciudadano == 1) {
            $adjuntos = DB::select("SELECT id,codigo_adjunto,titulo_adjunto
            FROM publicidad_config_adjuntos
            WHERE modalidad='$Solicitud->modalidad' AND ciudadano=1;");
         }

         if ($Solicitud->dependencia == "ciudadano") {
            $Datos = Persona::Find($Solicitud->PersonaId);
            return view('tramites.publicidad.DocPendientes', compact('Solicitud', 'Datos', 'estado', 'adjuntos'));
         } else {
            Alert::warning('Lo sentimos', 'El Número: .' . $request->Radicado . ' no tiene documentos pendientes');
            return redirect()->route('publicidad.index');
         }
      } else {
         Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->Radicado . ' no tiene registros asociados');
         return redirect()->route('publicidad.index');
      }
   }

   public function Guardar(Request $req)
   {
      $Qs = Publicidad::where("radicado", $req->Radicado)->get();
      if ($Qs->count() > 0) {
         $array = $Qs->getDictionary();
         $Solicitud = reset($array);
         $solicitud = Publicidad::Find($Solicitud->id);

         DB::beginTransaction();

         try {

            $config_novedad = DB::select("SELECT estado,titulo_estado,dependencia,novedad,opcion,estado_sig FROM publicidad_config_estados pce
            INNER JOIN publicidad_config_novedades AS pcn ON pce.id=pcn.estado_id  WHERE pcn.id=$req->novedad_id LIMIT 1;");

            $estado_sig = $config_novedad[0]->estado_sig;

            $estado_siguiente = DB::select("SELECT estado,titulo_estado,dependencia,novedad,opcion,estado_sig FROM publicidad_config_estados pce
            INNER JOIN publicidad_config_novedades AS pcn ON pce.id=pcn.estado_id  WHERE pce.id=$estado_sig LIMIT 1;");

            $novedad = new PublicidadNovedad();
            $novedad->NovedadTipo = $config_novedad[0]->opcion;
            $novedad->NovedadComentario = $config_novedad[0]->novedad;
            $novedad->NovedadEstado = $config_novedad[0]->estado;
            $novedad->FuncionarioId = 1;
            $novedad->SolicitudId = $Solicitud->id;
            $novedad->save();

            $solicitud->estado_solicitud = $estado_siguiente[0]->estado;
            $solicitud->dependencia = $estado_siguiente[0]->dependencia;
            $solicitud->novedad = $estado_siguiente[0]->novedad;

            $solicitud->save();

            $folder = 'documentos_publicidad/' . $solicitud->radicado;

            foreach ($req->allFiles() as $key => $file) {
               $documentos = PublicidadAdjunto::where('radicado', $solicitud->radicado)->where('codigo_adjunto', $config_novedad[0]->estado)->get();
               $nombre_adjunto = DB::select("SELECT titulo_adjunto FROM `publicidad_config_adjuntos` WHERE modalidad='$solicitud->modalidad' AND codigo_adjunto='$key';");
               if ($documentos->count() == 0) {
                  $documento = new PublicidadAdjunto;
                  $documento->publicidad_id = $solicitud->id;
                  $documento->codigo_adjunto = $key;
                  $documento->nombre_adjunto = $nombre_adjunto[0]->titulo_adjunto;
                  $documento->ruta = $folder . '/' . $key . ".pdf";
                  $documento->radicado = $solicitud->radicado;
                  $documento->save();

                  $file->storeAs($folder, $key . ".pdf");
               }
            }

            $personas = Persona::Find($solicitud->PersonaId);

            PublicidadAdmin::sendMail($personas, $solicitud, $config_novedad[0]->novedad, 'NO');

            DB::commit();
         } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
         }
      }


      //PublicidadAdmin::sendMail($Datos, $Solicitud, 'emails.notificacion_publicidad', 'emails.funcionario_publicidad');

      return view('tramites.publicidad.ResDocPendientes', compact('Solicitud'));
   }
}

    /// ================== FIND MODIFICACION  =====================================  ///

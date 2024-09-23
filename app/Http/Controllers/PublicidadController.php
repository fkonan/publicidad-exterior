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
         } elseif ($request->PersonaTip == 'JURIDICA') {
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
      $personas = Persona::find($request->PersonaId);

      $modalidades = array(
         "VALLAS",
         "PENDONES",
         "MURALES",
         "PASACALLES",
         "PUBLICIDAD AEREA",
         "MOVIL",
         "AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS COMERCIALES",
         "IDENTIFICACION PROYECTOS INMOBOLIARIOS",
         "AVISOS TIPO COLOMBINA"
      );
      $modalidades[""] = "";
      $modalidades[$request->modalidad];
      //Creando o actualizando solicitud-------------------
      $publicidad = new Publicidad();
      $publicidad->PersonaId = $personas->PersonaId;
      $publicidad->apellido_responsable = $request->apellido_responsable;
      $publicidad->tipo_documento = $request->tipo_documento;
      $publicidad->numero_documento = $personas->PersonaDoc;
      $publicidad->modalidad = $modalidades[$request->modalidad];
      $publicidad->nombre_responsable = $personas->PersonaNombre;
      $publicidad->apellido_responsable =  $personas->PersonaApe;
      $publicidad->tipo_documento =  $personas->PersonaTipDoc;
      $publicidad->email_responsable =  $personas->PersonaMail;
      $publicidad->telefono_responsable =  $personas->PersonaTel;
      $publicidad->tipo_publicidad =  $request->tipo_publicidad;
      $publicidad->numero_elementos =  $request->numero_elementos;
      $publicidad->observacion_solicitud =  $request->observacion_medidas;
      $publicidad->tipo_publicidad =  $request->tipo_publicidad;
      $publicidad->tipo_publicidad =  $request->tipo_publicidad;
      $publicidad->acepto_terminos = $request->acepto_terminos;
      $publicidad->confirmo_mayorEdad = $request->confirmo_mayorEdad;
      $publicidad->compartir_informacion = $request->compartir_informacion;
      $publicidad->estado_solicitud = "ENVIADA";
      $publicidad->dependencia = "INTERIOR";

      //Creando radicado
      $y = date("Y");
      $sql = "select count(id) as Cantidad from publicidad_exterior Where ( YEAR(created_at)=$y)";
      $obj = DB::select($sql);
      $id = $obj[0]->Cantidad + 1;
      $id = 10000000 + $id;
      $id = "$id";

      $publicidad->radicado = $y . "-" . substr($id, -3);
      $publicidad->save();

      $request->request->add([
         'radicado' => $publicidad->radicado,
         'NovedadTipo' => ""

      ]);

      if ($publicidad->id > 0) {
         $detalle = new Publicidaddetalle;
         $detalle->tipo_valla = $request->tipo_valla;
         $detalle->alto_publicidad = $request->alto_publicidad;
         $detalle->ancho_publicidad = $request->ancho_publicidad;
         $detalle->numero_caras = $request->numero_caras;
         $detalle->area_total = $request->area_total;
         $detalle->ubicacion_aviso = $request->ubicacion_aviso;
         $detalle->publicidad_id = $publicidad->id;
         $detalle->save();
      }

      $docs = [];
      foreach ($request->allFiles() as $key => $file) {
         $docs[] = $key;
      }

      PublicidadAdmin::CargarDoc($request, $docs, $publicidad->radicado, $publicidad->id);

      // DadepGeneral::sendMail($Datos, $Cs, 'tramites.Dadep.CorreoSol', 'tramites.Dadep.CorreoFun');
      PublicidadAdmin::sendMail($personas, $request, 'tramites.PublicidadAdmin.CorreoSol', false);

      return view('tramites.publicidad.ResSol', compact('request'));
   }

   public function consulta(Request $request)
   {

      $Qs = Publicidad::where($request->tipo_parametro, $request->parametro)->get();
      //dd($Qs);
      if ($Qs->count() > 0) {
         $array = $Qs->getDictionary();
         $Solicitud = reset($array);
         $Persona = Persona::Find($Solicitud->PersonaId);
         $documento = null;
         $liquidacion = null;
         if ($Solicitud->estado_solicitud == 'APROBADA') {
            $documento = PublicidadAdjunto::where("publicidad_id", $Solicitud->id)->where("DocTitulo", "Acto administrativo")->get();
         }
         if ($Solicitud->estado_solicitud == 'PENDIENTE' && $Solicitud->dependencia == 'HACIENDA') {
            $liquidacion = PublicidadLiquidacion::where("publicidad_id", $Solicitud->id)->whereNull("fecha_pago")->get();
         }
         return view('tramites.publicidad.Consulta', compact('Solicitud', 'Persona', 'documento', 'liquidacion'));
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

      $Qs = Publicidad::where("radicado", $request->Radicado)->where("numero_documento", $request->identificacion)->get();
      if ($Qs->count() > 0) {
         $array = $Qs->getDictionary();
         $Solicitud = reset($array);
         if ($Solicitud->estado_solicitud == "PENDIENTE") {
            $Datos = Persona::Find($Solicitud->PersonaId);
            $Datos->TituloApp = "publicidad-exterior";
            return view('tramites.publicidad.DocPendientes', compact('Solicitud', 'Datos'));
         } else {
            Alert::warning('Lo sentimos', 'El Numero: .' . $request->Radicado . ' no tiene documentos pendientes');
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
         $Solicitud->estado_solicitud = "EN PROGRESO";
         $Solicitud->save();
         $Datos = Persona::Find($Solicitud->PersonaId);
         $req->SolicitudId = $Solicitud->id;
      }
      $docs = array(
         "Tarjeta profesional",
         "Poliza",
         "Otro"
      );
      $Datos->TituloApp = "publicidad exterior visual";
      PublicidadAdmin::CargarDoc($req, $docs, $req->Radicado);
      PublicidadAdmin::sendMail($Datos, $Solicitud, 'emails.notificacion_publicidad', 'emails.funcionario_publicidad');

      return view('tramites.publicidad.ResDocPendientes', compact('Solicitud', 'Datos'));
   }
}

    /// ================== FIND MODIFICACION  =====================================  ///

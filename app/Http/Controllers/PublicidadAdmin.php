<?php

namespace App\Http\Controllers;

use App\Publicidad;
use App\Persona;
use App\PublicidadDetalle;
use App\PublicidadLiquidacion;
use App\PublicidadConceptos;
use App\PublicidadNovedad;
use App\PublicidadAdjunto;

use App\Mail\MailNotificacion;

use App\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnvioNotificacion;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use PDF;

include_once 'DadepGeneral.php';

class myObject
{
   public function __set($name, $value)
   {
      $this->{$name} = $value;
   }
}

class PublicidadAdmin extends Controller
{
   public function __construct()
   {
      //  $this->middleware('auth');
   }

   public function index()
   {
      dd('dd');
   }

   public function Administrar(Request $r)
   {
      $tipo = $r->modalidad;
      $dep = $r->dependencia;

      $sGrupos = [];
      $estados = ['ENVIADA', 'EN PROGRESO', 'PENDIENTE', 'APROBADA', 'RECHAZADA'];
      $nombres = ['Enviadas', 'En Progreso', 'Pendientes', 'Aprobadas', 'Rechazadas'];
      $i = 0;
      foreach ($estados as $estado) {
         $objeto = new myObject();
         $objeto->datos = DB::select(Publicidad::SqlEstado($estado, $tipo, $dep));
         $objeto->titulo = str_replace(' ', '', $estado);
         $objeto->cantidad = count($objeto->datos);
         $objeto->nombre = $nombres[$i];
         $objeto->activo = '';
         $sGrupos[] = $objeto;
         $i++;
      }
      $sGrupos[0]->activo = 'active';

      $porCerrar = DB::select(Publicidad::SqlXCerrar());
      $PORCERRAR = 0;
      if (!empty($porCerrar)) {
         $PORCERRAR = $porCerrar[0]->Cantidad;
      }

      return view('tramites.interior.publicidad.index1', compact('sGrupos', 'PORCERRAR', 'tipo'));
   }

   public function interior(Request $r)
   {
      $r->dependencia = 'INTERIOR';
      return $this->Administrar($r);
   }

   public function planeacion(Request $r)
   {
      $r->modalidad = '%';
      $r->dependencia = 'PLANEACION';
      return $this->Administrar($r);
   }

   public function salud(Request $r)
   {
      $r->modalidad = '%';
      $r->dependencia = 'SALUD';
      return $this->Administrar($r);
   }

   public function hacienda(Request $r)
   {
      $r->modalidad = '%';
      $r->dependencia = 'HACIENDA';
      return $this->Administrar($r);
   }

   public function transito(Request $r)
   {
      $r->modalidad = '%';
      $r->dependencia = 'TRANSITO';
      return $this->Administrar($r);
   }

   public function detalle(Request $req, $id)
   {
      $solicitud = Publicidad::findOrFail($id);
      $documento = PublicidadAdjunto::where('Radicado', $solicitud->radicado)->get();
      $documentos = [];
      if ($documento->count() > 0) {
         $documentos = $documento->getDictionary();
      }

      $novedad = PublicidadNovedad::where('SolicitudId', $solicitud->id)->get();
      $novedades = [];

      if ($novedad->count() > 0) {
         $novedades = $novedad->getDictionary();
      }

      $adjunto = PublicidadConceptos::where('publicidad_id', $id)
         ->get()
         ->first();

      $detalle = PublicidadDetalle::where('publicidad_id', $id)
         ->get()
         ->first();

      $vista = $this->vistas($solicitud->dependencia, $solicitud->modalidad);
      $pendiente_pago = false;
      $fecha_actual = date('d-m-Y');
      $fecha_limite = date('d-m-Y', strtotime($fecha_actual . '+ 2 month'));

      if ($solicitud->dependencia == 'HACIENDA' && $solicitud->estado_solicitud == 'PENDIENTE') {
         $liquidacion = PublicidadLiquidacion::where('publicidad_id', $solicitud->id)->first();
         if ($liquidacion->fecha_pago == null) {
            $pendiente_pago = true;
         }
      }

      return view($vista, compact('solicitud', 'detalle', 'adjunto', 'novedades', 'documentos', 'pendiente_pago', 'fecha_limite'));
   }

   public function AgregarNovedad(Request $req)
   {
      $solicitud = Publicidad::Find($req->SolicitudId);
      if (!empty($solicitud)) {
         $tipo = ['', 'Revision de documentos', 'Concepto tecnico planeacion', 'Concepto tecnico transito', 'concepto tecnico salud', 'Viabilidad del permiso', 'Revisión documentos finales', 'Liquidacion', 'Acto administrativo'];

         $novedad = new PublicidadNovedad();
         $novedad->NovedadComentario = $req->NovedadComentario;
         $novedad->NovedadEstado = $req->Novedad[$req->tiponovedad];
         $novedad->NovedadTipo = $tipo[$req->tiponovedad];
         $novedad->SolicitudId = $solicitud->id;
         $novedad->FuncionarioId = 1;

         $solicitud->estado_solicitud = $this->estado($req->tiponovedad, $novedad->NovedadEstado, $solicitud->modalidad);
         $solicitud->dependencia = $this->destino($req->tiponovedad, $novedad->NovedadEstado, $solicitud->modalidad);
         $solicitud->save();
         $docs = [$novedad->NovedadTipo];
         $documentos = PublicidadAdmin::CargarDoc($req, $docs, $solicitud->radicado, $req->SolicitudId);

         $user = DadepGeneral::GetUser();
         if ($novedad->save()) {
            $per = Persona::Find($solicitud->PersonaId);

            $solicitud->Comentario = $novedad->NovedadComentario;
            $solicitud->NovedadTipo = $novedad->NovedadTipo;
            $solicitud->NovedadEstado = $novedad->NovedadEstado;
            $solicitud->PerNombre = $per->PersonaNombre . ' ' . $per->PersonaApe;

            PublicidadAdmin::sendMail($per, $solicitud, 'tramites.PublicidadAdmin.CorreoSol', false, reset($documentos));

            // $auditoria = Auditoria::create([
            //    'usuario' => $user,
            //    'proceso_afectado' => 'Radicado-Publicidad-' . $solicitud->radicado,
            //    'tramite' => 'PUBLICIDAD EXTERIOR VISUAL',
            //    'radicado' => $solicitud->radicado,
            //    'accion' => 'update a estado ' . $solicitud->estado_solicitud . ' ' . $novedad->NovedadTipo . ' ' . $novedad->NovedadEstado,
            //    'observacion' => $req->NovedadComentario,
            // ]);
         }
      }
      // echo $novedad->NovedadEstado;
      // echo $solicitud->dependencia;

      return redirect('/tramites/interior/publicidad/detalle');
   }

   public function downloadPdf($id)
   {
      $solicitud = Publicidad::Find($id);
      $detalle = PublicidadDetalle::where('publicidad_id', $id)->get()[0];
      $persona = Persona::Find($solicitud->PersonaId);
      $pdf = PDF::loadView('tramites.publicidad.res_permanente', compact('solicitud', 'detalle', 'persona'));
      return $pdf->stream();
   }

   public function Liquidacion(Request $req)
   {
      $solicitud = Publicidad::Find($req->SolicitudId);
      $detalle = PublicidadDetalle::where('publicidad_id', $req->SolicitudId)->get()[0];
      $persona = Persona::Find($solicitud->PersonaId);
      if ($req->tipo_liquidacion == "PERMANENTE") {
         $pdf = PDF::loadView('tramites.publicidad.res_permanente', compact('solicitud', 'detalle', 'persona'));
      } else {
         $pdf = PDF::loadView('tramites.publicidad.res_transitoria', compact('solicitud', 'detalle', 'persona'));
      }

      $nombre = $solicitud->radicado . '-Resolución.pdf';
      $folder = 'documentos_publicidad/' . $solicitud->radicado;
      $ruta = 'storage/' . $folder . '/' . $nombre;
      $pdf->save($ruta);

      $doc = new PublicidadAdjunto();
      $doc->publicidad_id = $req->SolicitudId;
      $doc->DocNombre = $nombre;
      //   $doc->DocTitulo = 'Resolucion del radicado '.$solicitud->radicado;
      $doc->DocTitulo = 'Resolución de liquidación';
      $doc->DocRuta = $ruta . '?1';
      $doc->Radicado = $solicitud->radicado;
      $doc->save();

      $novedad = new PublicidadNovedad();
      $novedad->NovedadComentario = 'Realizar el pago del impuesto de publicidad exterior visual';
      $novedad->NovedadEstado = 'PENDIENTE';
      $novedad->NovedadTipo = 'Generación liquidación impuesto';
      $novedad->SolicitudId = $req->SolicitudId;
      $novedad->FuncionarioId = 1;
      $novedad->save();

      $solicitud = Publicidad::Find($req->SolicitudId);
      $solicitud->estado_solicitud = 'PENDIENTE';
      $solicitud->dependencia = 'HACIENDA';
      $solicitud->save();

      $per = Persona::Find($solicitud->PersonaId);

      $solicitud->Comentario = $novedad->NovedadComentario;
      $solicitud->NovedadTipo = $novedad->NovedadTipo;
      $solicitud->NovedadEstado = $novedad->NovedadEstado;
      $solicitud->PerNombre = $per->PersonaNombre . ' ' . $per->PersonaApe;

      $docs = [$novedad->NovedadTipo];
      //$documentos = PublicidadAdmin::CargarDoc($req, $docs, $solicitud->radicado);

      $user = DadepGeneral::GetUser();

      $auditoria = Auditoria::create([
         'usuario' => $user,
         'proceso_afectado' => 'Radicado-Publicidad-' . $solicitud->radicado,
         'tramite' => 'PUBLICIDAD EXTERIOR VISUAL',
         'radicado' => $solicitud->radicado,
         'accion' => 'update a estado ' . $solicitud->estado_solicitud . ' ' . $novedad->NovedadTipo . ' ' . $novedad->NovedadEstado,
         'observacion' => $req->NovedadComentario,
      ]);

      $publicidadDetalle = PublicidadDetalle::where('publicidad_id', '=', $solicitud->id)->first();
      $responsable = $solicitud->nombre_responsable . ' ' . $solicitud->apellido_responsable;
      $concepto = '';
      switch ($solicitud->modalidad) {
         case 'VALLAS':
            $concepto = 1;
            break;
         case 'PENDONES':
            if ($solicitud->sub_modalidad == 'AVISOS DE IDENTIFICACION DE ESTABLECIMIENTOS COMERCIALES') {
               $concepto = 10;
            }
            if ($solicitud->sub_modalidad == 'IDENTIFICACION PROYECTOS INMOBOLIARIOS') {
               $concepto = 14;
            }
            if ($solicitud->sub_modalidad == 'AVISOS TIPO COLOMBINA') {
               $concepto = 15;
            }
            break;
         case 'MURALES':
            $concepto = 4;
            break;
         case 'PASACALLES':
            $concepto = 6;
            break;
         case 'PUBLICIDAD AEREA':
            $concepto = 8;
            break;
         case 'MOVIL':
            $concepto = 9;
            break;
      }

      $fecha_actual = date('d-m-Y');
      //sumo 1 mes
      //$fecha = date("d-m-Y", strtotime($fecha_actual . "+ 2 month"));
      $fecha = date('d-m-Y', strtotime($req->fecha_limite));
      $sql = "SET NOCOUNT ON  EXEC [Pa_Publicidad] 1,'" . $responsable . "','" . $solicitud->numero_documento . "','" . $solicitud->radicado . "'," . date('Y') . ',' . $solicitud->id . ",'" . $publicidadDetalle->ubicacion_aviso . "'," . (int) $req->valor_total . ",'" . $fecha . "','" . $req->tipo_liquidacion . "'," . $concepto;
      $conexion = DB::connection('sqlsrv');
      $resultado = $conexion->select($sql);
      //dd($sql);
      $liquidacion = new PublicidadLiquidacion();
      $liquidacion->publicidad_id = $req->SolicitudId;
      $liquidacion->tipo_liquidacion = $req->tipo_liquidacion;
      $liquidacion->salario_minimo = 1000000;
      $liquidacion->area_publicidad = $req->area_publicidad;
      $liquidacion->valor_m2 = $req->valor_m2;
      $liquidacion->valor_mensual = $req->valor_mensual;
      $liquidacion->meses_pautar = $req->meses_pautar;
      $liquidacion->valor_total = $req->valor_total;

      $liquidacion->fecha_limite = date('Y-m-d', strtotime($req->fecha_limite));
      $liquidacion->url_pago = $resultado[0]->dirurl;
      $liquidacion->save();

      $documentos = $ruta;
      PublicidadAdmin::sendMail($per, $solicitud, 'tramites.PublicidadAdmin.CorreoSol', false, $documentos, $resultado[0]->dirurl);

      echo $novedad->NovedadEstado;
      echo $solicitud->dependencia;
      // return redirect('/tramites/interior/publicidad/detalle/' . $solicitud->id);
      return redirect('/tramites/interior/publicidad/detalle');
   }

   private function estado($tipo, $estado, $modalidad)
   {
      $estados = [];
      $estados['COMPLETO1'] = 'EN PROGRESO';
      $estados['INCOMPLETO1'] = 'PENDIENTE';
      $estados['RECHAZADO1'] = 'RECHAZADA';
      $estados['FAVORABLE2'] = 'EN PROGRESO';
      $estados['NOFAVORABLE2'] = 'EN PROGRESO';
      $estados['FAVORABLE3'] = 'EN PROGRESO';
      $estados['NOFAVORABLE3'] = 'EN PROGRESO';
      $estados['FAVORABLE4'] = 'EN PROGRESO';
      $estados['NOFAVORABLE4'] = 'EN PROGRESO';
      $estados['VIABLE5'] = 'EN PROGRESO';
      $estados['VIABLE5VALLAS'] = 'PENDIENTE';
      $estados['NOVIABLE5'] = 'RECHAZADA';
      $estados['COMPLETO6'] = 'EN PROGRESO';
      $estados['INCOMPLETO6'] = 'PENDIENTE';
      $estados['LIQUIDADO7'] = 'EN PROGRESO';
      $estados['APROBADO8'] = 'APROBADA';

      $estado = str_replace(' ', '', $estado) . $tipo;
      $estado1 = $estado . str_replace(' ', '', $modalidad);
      echo "$estado : $estado1 <br>";
      if (array_key_exists($estado1, $estados)) {
         return $estados[$estado1];
      }
      return $estados[$estado];
   }

   private function destino($tipo, $estado, $modalidad)
   {
      $estados = [];
      $estados['COMPLETO1'] = 'PLANEACION';
      $estados['COMPLETO1PASACALLES'] = 'INTERIOR';
      $estados['COMPLETO1PUBLICIDADAEREA'] = 'SALUD';
      $estados['COMPLETO1MOVIL'] = 'TRANSITO';
      $estados['INCOMPLETO1'] = 'INTERIOR';
      $estados['RECHAZADO1'] = 'INTERIOR';
      $estados['FAVORABLE2'] = 'SALUD';
      $estados['NOFAVORABLE2'] = 'INTERIOR';
      $estados['FAVORABLE3'] = 'SALUD';
      $estados['NOFAVORABLE3'] = 'INTERIOR';
      $estados['FAVORABLE4'] = 'INTERIOR';
      $estados['NOFAVORABLE4'] = 'INTERIOR';
      $estados['VIABLE5'] = 'HACIENDA';
      $estados['VIABLE5VALLAS'] = 'INTERIOR';
      $estados['NOVIABLE5'] = 'INTERIOR';
      $estados['COMPLETO6'] = 'HACIENDA';
      $estados['INCOMPLETO6'] = 'INTERIOR';
      $estados['LIQUIDADO7'] = 'INTERIOR';
      $estados['APROBADO8'] = 'INTERIOR';

      $estados['VIABLE5MURALES'] = 'INTERIOR';
      $estados['VIABLE5PUBLICIDADAEREA'] = 'HACIENDA';
      $estados['VIABLE5MOVIL'] = 'HACIENDA';

      $estado = str_replace(' ', '', $estado) . $tipo;
      $estado1 = $estado . str_replace(' ', '', $modalidad);
      if (array_key_exists($estado1, $estados)) {
         return $estados[$estado1];
      }
      return $estados[$estado];
   }

   private function vistas($dependencia, $modalidad)
   {
      $estados = [];
      $estados['INTERIOR'] = 'tramites.interior.publicidad.detalle';
      $estados['INTERIORVALLAS'] = 'tramites.interior.publicidad.detalle';

      $estado = str_replace(' ', '', $dependencia);
      $estado1 = str_replace(' ', '', $dependencia) . str_replace(' ', '', $modalidad);
      if (array_key_exists($estado1, $estados)) {
         return $estados[$estado1];
      } elseif (array_key_exists($estado, $estados)) {
         return $estados[$estado];
      }
      return 'tramites.interior.publicidad.detalle';
   }

   public static function CargarDoc(Request $req, $titulos, $radicado, $publicidad_id)
   {
      $cant = count($titulos);
      $cargados = true;
      $utimos = [];
      for ($i = 0; $i < $cant; $i++) {
         $titulo0 = str_replace(' ', '', $titulos[$i]);
         $titulo = "documento0";
         $nombre = $radicado . '-' . $titulo0 . '.pdf';
         $folder = 'documentos_publicidad/' . $radicado;
         $ruta = 'storage/' . $folder . '/' . $nombre;


         if ($req->$titulo || $req->$titulo != null) {

            $g = $req->file($titulo)->storeAs($folder, $nombre);
         } else {
            $g = false;
         }
         if ($g) {
            $docs = PublicidadAdjunto::where('DocNombre', $nombre)->get();
            if ($docs->count() > 0) {
               $array = $docs->getDictionary();
               $doc = reset($array);
               $idx = substr($doc->DocRuta, -1);
               if (is_numeric($idx)) {
                  $idx++;
               } else {
                  $idx = 1;
               }
            } else {
               $doc = new PublicidadAdjunto();
               $idx = 1;
            }
            $doc->publicidad_id = $publicidad_id;
            $doc->DocNombre = $nombre;
            $doc->DocTitulo = $titulos[$i];
            $doc->DocRuta = $ruta . '?' . $idx;
            $doc->Radicado = $radicado;
            $doc->save();
            $ultimos[] = $ruta;
         } else {
            $cargados = false;
            $ultimos[] = 'NO';
         }
      }
      return $ultimos;
   }

   public static function sendMail($persona, $Cs, $vista1 = false, $vista2 = false, $doc = 'NO', $liquidacion = '')
   {
      if ($Cs instanceof \Illuminate\Http\Request) {
         $detalleCorreo = [
            'nombres' => $persona->PersonaNombre,
            'radicado' => $Cs->request->all()['radicado'],
            'Subject' => 'Solucitud publicidad exterior visual',
            'documento' => $doc,
            'fecha_pendiente' => null,
            'estado' => null,
            'mensaje' => null,
            'Solicitud' => $Cs->request->all(),
            'liquidacion' => $liquidacion,
            'NovedadTipo' => $Cs->request->all()['NovedadTipo'],
         ];

         $detalleCorreo_fun = [
            'nombres' => ' Funcionario Carlos guerrero',
            'radicado' => $Cs->request->all()['radicado'],
            'Subject' => 'Solicitud pendiente para revision de documentos No' . $Cs->request->all()['radicado'],
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'estado' => 'FUNCIONARIO',
            'mensaje' => null,
            'Solicitud' => $Cs->request->all(),
            'liquidacion' => $liquidacion,
         ];
      } else {
         $Cs = $Cs->toArray();
         $detalleCorreo = [
            'nombres' => $persona->PersonaNombre,
            'radicado' => $Cs['radicado'],
            'Subject' => 'Solucitud publicidad exterior visual',
            'documento' => $doc,
            'fecha_pendiente' => null,
            'estado' => null,
            'mensaje' => null,
            'Solicitud' => $Cs,
            'liquidacion' => $liquidacion,
            'NovedadTipo' => $Cs['NovedadTipo'],
         ];

         $detalleCorreo_fun = [
            'nombres' => ' Funcionario Carlos guerrero',
            'radicado' => $Cs['radicado'],
            'Subject' => 'Solicitud pendiente para revision de documentos No' . $Cs['radicado'],
            'documento' => 'NO',
            'fecha_pendiente' => null,
            'estado' => 'FUNCIONARIO',
            'mensaje' => null,
            'Solicitud' => $Cs,
            'liquidacion' => $liquidacion,
         ];
      }


      // dd($detalleCorreo);
      $correo_funcionario = 'notificacioneselectronicastributria@bucaramanga.gov.co';
      // envio de correo
      if ($vista1 != false) {

         Mail::to($persona->PersonaMail)
            ->bcc($correo_funcionario)
            ->queue(new MailNotificacion($detalleCorreo, $vista1));
      }
      if ($vista2 != false) {
         Mail::to($correo_funcionario)->queue(new MailNotificacion($detalleCorreo, $vista1));

         // Mail::to($correo_funcionario)->queue(new MailNotificacion($detalleCorreo_fun, $vista2));
      }
   }
}

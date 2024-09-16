<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;
use App\Rita;
use App\AnexosRita;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificacionesRITA;
use RealRashid\SweetAlert\Facades\Alert;

class JuridicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tramites.juridica.index');
    }
    public function main()
    {
        return view('tramites.juridica.rita.main');
    }

    public function denuncias()
    {
        $deRadicadas = Rita::where('estado_solicitud', 'RADICADA')->get();
        // $sPendientes = Rita::where('estado_solicitud', 'PENDIENTE')->get();
        $deContestada = Rita::where('estado_solicitud', 'CONTESTADA')->get();
        $deRemitidas = Rita::where('estado_solicitud', 'REMITIDA POR COMPETENCIA')->get();
        $deNoContestada = Rita::where('estado_solicitud', 'NO CONTESTADA')->get();
        // $sRechazadas = Rita::where('estado_solicitud', 'RECHAZADA')->get();
        $countRa = $deRadicadas->count();
        // $count_pendientes = $sPendientes->count();
        $countCon = $deContestada->count();
        $countRemi = $deRemitidas->count();
        $countNoCon = $deNoContestada->count();
        $porCerrar =  Rita::where('fecha_limite' ,'<',DB::raw('DATE_ADD(NOW(),INTERVAL 5 DAY)'))->where('estado_solicitud', 'RADICADA')->get()->count();
        // $count_rechazadas = $sRechazadas->count();
        return view('tramites.juridica.rita.index', compact('deRadicadas','deContestada', 'deRemitidas', 'deNoContestada','countRa', 'countCon', 'countRemi', 'countNoCon','porCerrar' ));
    }

    public function denunciasDetalle($id){

        $solicitud = Rita::where('id',$id)->join('departamento', 'departamento.codigo_depto', '=', 'rita.departamento')->get();
        $trazabilidad = Auditoria::where('radicado',$solicitud[0]->radicado)->where('tramite','LIKE', 'RITA')->get();
        $anexos = AnexosRita::where('rita_id',$id)->get();
        $respuestas = AnexosRita::where('rita_id',$id)->where('titulo', 'Respuestas')->get();
        return view('tramites.juridica.rita.detalle', compact('solicitud','trazabilidad', 'anexos', 'respuestas'));     


    }

    public function updateDenuncia(Request $request){
        $validator = Validator::make($request->all(),[
            'estado_solicitud'=>'required',
            'observaciones_solicitud'=>'required',
            'id'=>'required',
           ]);

           if($validator->fails()){         
            return response()->json(['sucess'=>false,'error'=>$validator->errors()->all()]);
         }else{
           
            $rita = Rita::findOrFail($request->id);
            $rita->estado_solicitud = $request->estado_solicitud;
            $rita->observaciones_solicitud = $request->observaciones_solicitud;
            $rita->fecha_actuacion = date('Y-m-d');
            $files = array();
            if($rita->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->username,
                    'proceso_afectado'=> 'Radicado-'.$rita->radicado,
                    'tramite'=> 'RITA',
                    'radicado'=> $rita->radicado,
                    'accion'=>'DENUNCIA CAMBIA DE ESTADO A : '.$request->estado_solicitud,
                    'observacion'=> $request->observaciones_solicitud
    
                ]);
                if($request->countFiles>0){
                    for ($x = 0; $x < $request->countFiles; $x++) {
                        if ($request->hasFile('files'.$x)){
                            $ext = '.'.$request->file('files'.$x)->getClientOriginalExtension();
                            $anexos = $request->file('files'.$x)->storeAs('documentos_RITA/' . $rita->radicado, 'Respuesta-'.$x.'-' . $rita->radicado . $ext);

                        } 
                        $anexos = New AnexosRita();
                        $anexos->rita_id = $rita->id;
                        $anexos->radicado = $rita->radicado;
                        $anexos->titulo = 'Respuestas';
                        $anexos->nombre_archivo = 'Respuesta-'.$x.'-' . $rita->radicado . $ext;
                        $anexos->ruta= 'storage/documentos_RITA/' . $rita->radicado .'/Respuesta-'.$x.'-' . $rita->radicado . $ext;
                        $anexos->save();
                        $files[] = 'Respuesta-'.$x.'-' . $rita->radicado . $ext;
           
                }                    
            

            }

            
            $detalleCorreo = [
                'mensaje' => $request->observaciones_solicitud,
                'Subject' => 'CONTESTACION DE DENUNCIA '.$rita->radicado. ' RITA',
                'documento' => ($request->countFiles)? 'SI': 'NO',
                'files' => $files,
                'radicado'  => $rita->radicado,
                'estado' => $request->estado_solicitud,

            ];
            if($rita->medio_respuesta=='CORREO ELECTRONICO'){
                if($rita->email_responsable){
                    Mail::to($rita->email_responsable)->send(new NotificacionesRITA($detalleCorreo));
                }
            }

            $resp = ["success" => true,'titulo' => 'Proceso exitoso!', 'message' => 'Denuncia Actualizada','icono'=>'success'];
            return response()->json($resp);

         }
        
    }
  }

  public function reporte(){
    return view('tramites.juridica.rita.reportes');
 }

 public function queryReport(Request $request){
 
    $this->validate($request, [
        "radicado" => 'numeric|nullable',        
    ]); 
    
    $estado = ($request->estado_solicitud) ? $request->estado_solicitud : '%';
    $radicado = ($request->radicado) ? $request->radicado : '%';
    $identificacion = ($request->identificacion) ? $request->identificacion : '%';
    $fecha_inicial = ($request->fecha_inicial) ? $request->fecha_inicial : '2022-01-01';
    $fecha_final = ($request->fecha_final) ? $request->fecha_final : '2050-12-31';

    $sql = "SELECT id, radicado, tipo_solicitud, tipo_persona, tipo_doc, identificacion, nombres, apellidos, razon_social, asunto, telefono_movil, telefono_fijo, direccion, barrio, email_responsable, pais, departamento, municipio, medio_respuesta, lugar_denuncia, cuando_denuncia, involucrados_denuncia, descripcion_hechos, adj_descripcion, riesgo_denuncia, proceso_seleccion, tipo_contrato, informacion_contrato, adj_informacion, fecha_aprox_proceso, lugar_contrato, entidad_contrato, link_contrato, tiene_evidencias, ha_denunciado, entidad_denuncia, otra_entidad, impacta_organizacion, contacto_adicional, disuadirlo, quien_disuade, fecha_limite, estado_solicitud, observaciones_solicitud, fecha_actuacion, tratamiento_datos, acepto_terminos, confirmo_mayorEdad, compartir_informacion, date_format(created_at,'%Y-%m-%d'), updated_at FROM rita WHERE radicado LIKE '$radicado' AND estado_solicitud LIKE '$estado' AND IFNULL(identificacion,'') LIKE '$identificacion' AND created_at BETWEEN STR_TO_DATE('$fecha_inicial','%Y-%m-%d') AND STR_TO_DATE('$fecha_final','%Y-%m-%d')" ; 
    
    $query = DB::select($sql);
    if($query){
     return view('tramites.juridica.rita.export',compact('query'));
    }else{
        Alert::info('Atencion!', 'No se encontraron resultados para esta búsqueda');
        return redirect()->route('juridica.rita.reporte');
    }
    

  }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auditoria;
use App\AtencionUTSP;
use App\DocumentoUTSP;
use App\ObservacionUTSP;
use App\User;
use App\Parametro;
use App\Barrio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Connection;
use Illuminate\Database\QueryException;
use PDF;

class UTSPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('tramites.utsp.index');
    }

    public function indexRegister()
    {
        $ultimo_id = AtencionUTSP::latest('id')->first();
        // return $ultimo_id;
        if (!$ultimo_id) {
            $idRadicado = 1;
        } else {
            $idRadicado = $ultimo_id->id + 1;
        }
        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
        $Barrios = Barrio::orderBy('nombre', 'asc')->get();
        $radicado = "UTSP-" . str_pad($idRadicado, 4, "0", STR_PAD_LEFT);
        $tipos_atencion =  Config::get('global.tipos_atencion');
        $tipos_servicio =  Config::get('global.tipos_servicio');
        $tipos_tramite =  Config::get('global.tipos_tramite');
        $empresas =  Config::get('global.empresas_publicas');
        $date = date('Y-m-d');
        return view('tramites.utsp.registro', compact('radicado', 'tipos_servicio', 'tipos_atencion', 'date', 'Parametros1', 'Parametros2', 'Barrios', 'tipos_tramite', 'empresas'));
    }
  

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'radicado' => 'required|unique:atencion_utsp,radicado',
            'fecha' => 'required|date',
            'nombre_usuario' => 'required|max:30|string',
            'apellido_usuario' => 'required|max:30',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:15',
            'email_responsable' => 'required|max:80|regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{1,12}$/',
            'email_confirmado' => 'required|max:80|regex:/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z0-9\.]{1,12}$/',
            'telefono' => 'required|digits_between:7,10',
            'direccion_solicitante' => 'required|max:120',
            'barrio_solicitante' => 'required',
            'comuna' => 'required|numeric',
            'tipo_atencion' => 'required',
            'tipo_servicio' => 'required',
            'asunto' => 'required|max:255',
            'tipo_tramite' => 'required',
            'empresa_publica' => 'nullable',
            'observacion' => 'required|max:600',
            'tratamiento_datos' => 'required',
            'acepto_terminos' => 'required',
            'compartir_informacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['sucess' => false, 'error' => $validator->errors()->all()]);
        }
        $estado = 'CERRADO';
        if($request->tipo_servicio=='TRAMITE'){
            $estado = 'ABIERTO';
        }
        $empresa = $request->empresa_publica;

        if($request->empresa_publica == 'Otra' && $request->otra_empresa != null){
            $empresa = $request->otra_empresa;
        }

        try {
            DB::beginTransaction();

            $atencion_id =  DB::table('atencion_utsp')->insertGetId([
                'radicado' => $request->radicado,
                'fecha_radicacion' => $request->fecha,
                'nombre_usuario' => $request->nombre_usuario,
                'apellido_usuario' => $request->apellido_usuario,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'correo_electronico' => $request->email_responsable,
                'direccion' => $request->direccion_solicitante,
                'barrio_id' => $request->barrio_solicitante,
                'comuna' => $request->comuna,
                'telefono' => $request->telefono,
                'tipo_atencion' => $request->tipo_atencion,
                'tipo_servicio' => $request->tipo_servicio,
                'empresa_publica' => $empresa,
                'asunto' => $request->asunto,
                'estado_solicitud' => $estado,
                'user_id' => auth()->user()->id,
                'tratamiento_datos' => $request->tratamiento_datos,
                'acepto_terminos' => $request->acepto_terminos,
                'compartir_informacion' => $request->compartir_informacion,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);

            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->username,
                'proceso_afectado' => 'Radicado-' . $request->radicado,
                'tramite' => 'GESTION UTSP',
                'radicado' => $request->radicado,
                'accion' => 'CREACION DE ATENCION ' . $atencion_id . ' EN ESTADO ABIERTO',
                'observacion' => $request->asunto

            ]);

            $observacion_id =  DB::table('observacion_utsp')->insertGetId([
                'atencion_id' => $atencion_id,
                'observacion' => $request->observacion,
                'tipo_tramite' => $request->tipo_tramite,
                'empresa_servicios' => $empresa,
                'fecha' => $request->fecha,
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')


            ]);

            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->username,
                'proceso_afectado' => 'Radicado-' . $request->radicado,
                'tramite' => 'GESTION UTSP',
                'radicado' => $request->radicado,
                'accion' => 'CREACION DE OBSERVACION ' . $observacion_id . ' EN ESTADO ABIERTO',
                'observacion' => $request->observacion

            ]);

            if ($request->countFiles > 0) {
                for ($x = 0; $x < $request->countFiles; $x++) {
                    if ($request->hasFile('files' . $x)) {
                        $ext = '.' . $request->file('files' . $x)->getClientOriginalExtension();
                        $anexos = $request->file('files' . $x)->storeAs('documentos_UTSP/' . $request->radicado, 'Anexo-' . $x . '-' . $observacion_id . '-' . $request->radicado . $ext);
                    }
                    $ruta = 'storage/documentos_UTSP/' . $request->radicado . '/Anexo-' . $x . '-' . $observacion_id . '-' . $request->radicado . $ext;
                    $documento = ' Anexo-' . $x . '-' . $observacion_id . '-' . $request->radicado . $ext;

                    $documentos_id =  DB::table('documentos_utsp')->insertGetId([
                        'observacion_id' => $observacion_id,
                        'ruta' => $ruta,
                        'nombre_documento' => $documento,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')


                    ]);
                }
            }


            DB::commit();
            $resp = ["success" => true,'titulo' => 'Proceso exitoso!', 'message' => 'Solicitud Creada','icono'=>'success'];
            return response()->json($resp);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'errors' => [$e->getMessage()]
            ];
            return response()->json($response);
        }



    }
    public function storeAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'fecha' => 'required|date',            
            'tipo_tramite' => 'required',
            'empresa_publica' => 'required',
            'observacion' => 'required|max:600',
            'id_solicitud' => 'required',
            'estado_solicitud' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['sucess' => false, 'error' => $validator->errors()->all()]);
        }        
       
        $solicitud = AtencionUTSP::findOrFail($request->id_solicitud);
        try {
            DB::beginTransaction();

            $atencion =  DB::table('atencion_utsp')->where('id', $request->id_solicitud)
            ->update([              
                'estado_solicitud' => $request->estado_solicitud,          
            ]);
              
            if($atencion>0){
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->username,
                'proceso_afectado' => 'Radicado-' . $solicitud->radicado,
                'tramite' => 'GESTION UTSP',
                'radicado' => $solicitud->radicado,
                'accion' => 'CAMBIO DE ESTADO A  ' . $request->estado_solicitud . '',
                'observacion' => $request->observacion

            ]);
        }

            $observacion_id =  DB::table('observacion_utsp')->insertGetId([
                'atencion_id' => $request->id_solicitud,
                'observacion' => $request->observacion,
                'tipo_tramite' => $request->tipo_tramite,
                'empresa_servicios' => $request->empresa_publica,
                'fecha' => $request->fecha,
                'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')


            ]);

            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->username,
                'proceso_afectado' => 'Radicado-' . $solicitud->radicado,
                'tramite' => 'GESTION UTSP',
                'radicado' => $solicitud->radicado,
                'accion' => 'CREACION DE OBSERVACION ' . $observacion_id . ' EN ESTADO '.$request->estado_solicitud,
                'observacion' => $request->observacion

            ]);

            if ($request->countFiles > 0) {
                for ($x = 0; $x < $request->countFiles; $x++) {
                    if ($request->hasFile('files' . $x)) {
                        $ext = '.' . $request->file('files' . $x)->getClientOriginalExtension();
                        $anexos = $request->file('files' . $x)->storeAs('documentos_UTSP/' . $solicitud->radicado, 'Anexo-' . $x . '-' . $observacion_id . '-' . $solicitud->radicado . $ext);
                    }
                    $ruta = 'storage/documentos_UTSP/' . $solicitud->radicado . '/Anexo-' . $x . '-' . $observacion_id . '-' . $solicitud->radicado . $ext;
                    $documento = ' Anexo-' . $x . '-' . $observacion_id . '-' . $solicitud->radicado . $ext;

                    $documentos_id =  DB::table('documentos_utsp')->insertGetId([
                        'observacion_id' => $observacion_id,
                        'ruta' => $ruta,
                        'nombre_documento' => $documento,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')


                    ]);
                }
            }


            DB::commit();
            $resp = ["success" => true,'titulo' => 'Proceso exitoso!', 'message' => 'Solicitud Actualizada','icono'=>'success'];
            return response()->json($resp);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            return response()->json(['success' => false, 'errors' => ["Se ha producido un error $errorCode en la base de datos"], 'errorMessage' => $errorMessage]);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'errors' => [$e->getMessage()]
            ];
            return response()->json($response);
        }



    }

    public function loadData(){
        
        $atenciones = AtencionUTSP::join('users', 'atencion_utsp.user_id', '=', 'users.id')
        ->join('barrio', 'atencion_utsp.barrio_id', '=', 'barrio.codigo')
        ->select('atencion_utsp.*', 'users.name as username', 'barrio.nombre as nombre_barrio')
        ->where('atencion_utsp.estado_solicitud', 'ABIERTO')
        ->orderBy('atencion_utsp.id', 'DESC')
        ->get();
        return view('tramites.utsp.resultado', compact('atenciones'));
    }

    public function loadTrazabilidad($id){
         
        $tipos_tramite =  Config::get('global.tipos_tramite_action');
        $empresas =  Config::get('global.empresas_publicas');
        $date = date('Y-m-d');
        $solicitud = AtencionUTSP::with([
            'observaciones.documentos','observaciones.user'
        ])
        ->join('users', 'atencion_utsp.user_id', '=', 'users.id') 
        ->join('barrio', 'atencion_utsp.barrio_id', '=', 'barrio.codigo')
        ->select('atencion_utsp.*', 'users.name as username', 'barrio.nombre as nombre_barrio')
        ->find($id);
        return  view('tramites.utsp.detalle', compact('solicitud', 'empresas', 'tipos_tramite', 'date'));


    }
    public function reportes(){
        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
        $empresas =  Config::get('global.empresas_publicas');
        $Barrios = Barrio::orderBy('nombre', 'asc')->get();
        $tipos_atencion =  Config::get('global.tipos_atencion');
        $tipos_servicio =  Config::get('global.tipos_servicio');
        $usuarios = AtencionUTSP::select('numero_documento','nombre_usuario', 'apellido_usuario')
        ->groupBy('numero_documento')
        ->orderBy('apellido_usuario')
        ->get();
        return view('tramites.utsp.reportes', compact('empresas', 'usuarios', 'Barrios', 'tipos_servicio', 'tipos_atencion', 'Parametros1', 'Parametros2'));



    }

    public function searchCaso($id)
    {
       
        $solicitud = AtencionUTSP::with([
            'observaciones.documentos','observaciones.user'
        ])
        ->join('users', 'atencion_utsp.user_id', '=', 'users.id') 
        ->join('barrio', 'atencion_utsp.barrio_id', '=', 'barrio.codigo')
        ->select('atencion_utsp.*', 'users.name as username', 'barrio.nombre as nombre_barrio')
        ->find($id);
        return  view('tramites.utsp.detalle-caso', compact('solicitud'));
    }

    public function searchComuna(Request $request)
    {
       $barrio = Barrio::where('codigo', $request->codigo)->get()->first();

       if(isset($barrio) && $barrio->count() > 0){
          $comuna = DB::table('comuna')->where('codigo', $barrio->codigo_comuna)->first();
          if(isset($comuna)){
            $response = [
                'success' => true ,
                'comuna' => $comuna->codigo           
            ];
            return response()->json($response);
          }else{
            $response = [
                'success' => false            
            ];
            return response()->json($response);
          }
       }else{
        $response = [
            'success' => false            
        ];
        return response()->json($response);

       }
     
        
    }
    public function downloadDocument($id)
    {
        $solicitud = AtencionUTSP::with([
            'observaciones.documentos','observaciones.user'
        ])
        ->join('users', 'atencion_utsp.user_id', '=', 'users.id') 
        ->join('barrio', 'atencion_utsp.barrio_id', '=', 'barrio.codigo')
        ->select('atencion_utsp.*', 'users.name as username', 'barrio.nombre as nombre_barrio')
        ->find($id);
        $radicado = $solicitud->radicado;

        $pdf = PDF::loadView('tramites.utsp.document', compact('solicitud'));
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isPhpEnabled', true);
        $nomDoc = "Solicitud N° $radicado.pdf";
        return $pdf->download($nomDoc);
       

    }

    public function searchUTSP(Request $request)
    {
        


        if (
            !$request->empresa_publica &&
            !$request->radicado &&
            !$request->usuarios &&
            !$request->barrio &&
            !$request->tipo_atencion &&
            !$request->tipo_servicio &&
            !$request->fecha_inicial &&
            !$request->fecha_final &&
            !$request->direccion_solicitante

        ) {
            Alert::info('Atencion!', 'Todos los campos de busqueda estan vacios');
            return redirect()->route('utsp.reportes');
        }
        if ($request->fecha_inicial && $request->fecha_final) {
            if ($request->fecha_inicial > $request->fecha_final) {
                Alert::info('Atencion!', 'La fecha inicial no puede ser mayor que la fecha final');
                return redirect()->route('utsp.reportes');
            }
        }
        if($request->empresa_publica == 'Otra' && $request->otra_empresa == null){
            Alert::info('Atencion!', 'Debe dilegenciar el campo de otra empresa ');
                return redirect()->route('utsp.reportes');  
        }

        if($request->empresa_publica ==  'Otra'){
            $empresa = $request->otra_empresa;

        }else{
            $empresa = $request->empresa_publica;
        }

        
        $empresa_publica = ($empresa) ? $empresa : '%';
        $barrio = ($request->barrio) ? $request->barrio : '%';
        $usuarios = ($request->usuarios) ? $request->usuarios : '%';
        $radicado = ($request->radicado) ? $request->radicado : '%';
        $direccion = ($request->direccion_solicitante) ? trim($request->direccion_solicitante) : '%';
        $fecha_inicial = ($request->fecha_inicial) ? $request->fecha_inicial : '2019-01-01';
        $fecha_final = ($request->fecha_final) ? $request->fecha_final : '2050-12-31';
        $tipo_atencion = ($request->tipo_atencion) ? $request->tipo_atencion : '%';
        $tipo_servicio = ($request->tipo_servicio) ? $request->tipo_servicio : '%';
      
        $atencion = AtencionUTSP::join('users', 'atencion_utsp.user_id', '=', 'users.id')
        ->join('barrio', 'atencion_utsp.barrio_id', '=', 'barrio.codigo')
        ->select('atencion_utsp.*', 'users.name as username', 'barrio.nombre as nombre_barrio')->where('atencion_utsp.radicado', 'LIKE', "%$radicado")
            ->where('atencion_utsp.numero_documento', 'LIKE', "%$usuarios")
            ->where('atencion_utsp.barrio_id', 'LIKE', "%$barrio")
            ->where('atencion_utsp.direccion', 'LIKE', "%$direccion%")
            ->where('atencion_utsp.tipo_atencion', 'LIKE', "%$tipo_atencion")
            ->where('atencion_utsp.tipo_servicio', 'LIKE', "%$tipo_servicio")
            ->where(function ($query) use ($empresa_publica) {
                $query->whereRaw("IFNULL(empresa_publica, '') LIKE ?", ["$empresa_publica"]);
            })
            ->whereBetween('fecha_radicacion', [$fecha_inicial, $fecha_final])           
            ->get();


    

        if (isset($atencion) || $atencion->count() > 0) {
            return view('tramites.utsp.export-table', compact('atencion'));
        } else {
            Alert::info('Atencion!', 'No se encontraron resultados para esta búsqueda');
            return redirect()->route('utsp.reportes');
        }
    }

    public function exportDocument($id)
    {
        $certificado = CertificadoPredio::findOrFail($id);
        $radicado = $certificado->radicado;

        $timestamp = strtotime($certificado->fecha);

        $numeroDia = date('d', $timestamp);
        setlocale(LC_TIME, 'es_ES');
        $nombreDia = utf8_encode(strftime('%A', $timestamp));
        $nombreMes = utf8_encode(strftime('%B', $timestamp));
        $anoActual = date('Y', $timestamp);
        $fechaActual = "$nombreDia ($numeroDia) del mes de $nombreMes de $anoActual";
        $pdf = PDF::loadView('tramites.general.certificado_predios.certificado', ['certificado' => $certificado, 'fechaActual' => $fechaActual]);
        $filename = "certificado_de_predio-$radicado.pdf";
        return $pdf->download($filename);
    }
}

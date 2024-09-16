<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publicidad;
use App\Auditoria;
use App\PublicidadDetalle;
use App\PublicidadConceptos;
use App\PgirhDetalle;
use App\PgirhReporte;
use App\PgirhEmpresa;
use App\Barrio;
use App\Parametro;
use App\CertificacionDiscapacidad;
use App\FamiliaLactante;
use App\Exports\ReportesPgirh;
use App\Exports\PgirhExports;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionPublicidad;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Mail\NotificacionDiscapacidad;

class SaludController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['indexFamilia', 'storeFamilia', 'confirmacion', 'end']]);
    }

    public function index()
    {
        return view('tramites.salud.index');
    }

    //publicidad
    public function publicidadIndex()
    {
        $sEnviadas = Publicidad::where('estado_solicitud', 'REVISION-CONCEPTOS-SALUD')->get();
        $count_enviadas = $sEnviadas->count();
        return view('tramites.salud.publicidad.listar_solicitudes', compact('sEnviadas', 'count_enviadas'));
    }

    public function publicidadDetalle($id)
    {
        $solicitud = Publicidad::findOrFail($id);
        $detalle = PublicidadDetalle::join('barrio', 'barrio.codigo', '=', 'publicidad_detalle.barrio_aviso')
            ->where('publicidad_id', $id)
            ->get()
            ->first();
        return view('tramites.salud.publicidad.detalle', compact('solicitud', 'detalle'));
    }

    public function publicidadUpdate(Request $request)
    {
        $datos = Publicidad::findOrFail($request->id);

        switch ($request->modalidad) {
            case 'VALLAS':
                $this->validate($request, [
                    'observacion_solicitud' => 'required',
                    'adj_concepto_salud' => 'required',
                ]);

                if ($request->adj_concepto_salud || $request->adj_concepto_salud != null) {
                    $adj_concepto_salud = $request->file('adj_concepto_salud')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_concepto_salud-' . $datos->radicado . '.pdf');
                    $adj_concepto_salud_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_concepto_salud-' . $datos->radicado . '.pdf';
                } else {
                    $adj_concepto_salud = null;
                }

                $date = date('Y-m-d');
                $date_30 = date('Y-m-d', strtotime($date . '+15 Weekday'));

                $detalleCorreo = [
                    'nombres' => 'Francia Milena Zuluaga Tangarife',
                    'mensaje' => $request->observacion_solicitud,
                    'Subject' => 'Envio Concepto Técnico Publicidad Exterior N°' . $datos->radicado,
                    'documento' => 'NO',
                    'fecha_pendiente' => $date_30,
                    'radicado' => $datos->radicado,
                    'estado' => 'FUNCIONARIO',
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
                        'observacion' => $request->observacion_solicitud,
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
                    'observacion_solicitud' => 'required',
                    'adj_concepto_salud' => 'required',
                ]);

                if ($request->adj_concepto_salud || $request->adj_concepto_salud != null) {
                    $adj_concepto_salud = $request->file('adj_concepto_salud')->storeAs('documentos_publicidad/' . $datos->radicado, 'adj_concepto_salud-' . $datos->radicado . '.pdf');
                    $adj_concepto_salud_rut = 'storage/documentos_publicidad/' . $datos->radicado . '/adj_concepto_salud-' . $datos->radicado . '.pdf';
                } else {
                    $adj_concepto_salud = null;
                }

                $date = date('Y-m-d');
                $date_30 = date('Y-m-d', strtotime($date . '+15 Weekday'));

                $detalleCorreo = [
                    'nombres' => 'Francia Milena Zuluaga Tangarife',
                    'mensaje' => $request->observacion_solicitud,
                    'Subject' => 'Envio viabilidad concepto técnico Publicidad Exterior N°' . $datos->radicado,
                    'documento' => 'NO',
                    'fecha_pendiente' => $date_30,
                    'radicado' => $datos->radicado,
                    'estado' => 'FUNCIONARIO',
                ];

                // actualizar datos
                $datos->estado_solicitud = 'VIABILIDAD-PERMISO';
                $datos->observacion_solicitud = $request->observacion_solicitud;
                $datos->fecha_pendiente_salud = null;
                $datos->fecha_actuacion = $date;

                //$correo_responsable = ['fzuluaga@bucaramanga.gov.co', 'pdiaz@bucaramanga.gov.co'];
                $correo_responsable = ['fhernandez@bucaramanga.gov.co'];

                if ($datos->save()) {
                    $adjunto = new PublicidadConceptos();
                    $adjunto->publicidad_id = $request->id;
                    $adjunto->adj_concepto_salud = $adj_concepto_salud_rut;
                    $adjunto->save();
                    //auditoria
                    $auditoria = Auditoria::create([
                        'usuario' => $request->username,
                        'proceso_afectado' => 'Radicado-' . $datos->radicado,
                        'tramite' => 'PUBLICIDAD EXTERIOR',
                        'radicado' => $datos->radicado,
                        'accion' => 'update a estado VIABILIDAD-PERMISO',
                        'observacion' => $request->observacion_solicitud,
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

    //fin publicidad

    //pgirh
    public function indexEmpresas()
    {
        $datos_empresa = PgirhEmpresa::join('actividad_economica', 'actividad_economica.id', '=', 'empresas.actividad_id')
            ->select('empresas.razon_social', 'empresas.nit', 'empresas.representante_legal', 'empresas.correo_electronico', 'empresas.telefono', 'actividad_economica.descripcion', 'empresas.direccion_empresa', 'empresas.barrio', 'empresas.created_at', 'empresas.id', 'documentos_empresa.id AS ultimo_documento_id')
            ->leftJoin('documentos_empresa', function ($join) {
                $join->on('documentos_empresa.empresa_id', '=', 'empresas.id')
                    ->whereRaw('documentos_empresa.id = (
                        SELECT MAX(id) 
                        FROM documentos_empresa 
                        WHERE empresa_id = empresas.id
                    )');
            })
            ->orderBy('empresas.id', 'desc')
            ->get();

        return view('tramites.salud.pgirh.resultado', compact('datos_empresa'));
    }

    public function reportesEmpresas($id)
    {
        $reportes = PgirhReporte::join('empresas', 'empresas.id', '=', 'reporte.empresa_id')
            ->select('empresas.razon_social', 'empresas.nit', 'empresas.direccion_empresa', 'reporte.id', 'reporte.gestor_residuos', 'reporte.nombre_solicitante', 'reporte.year', 'reporte.semestre', 'reporte.ruta_acta_disposicion', 'reporte.created_at', 'sede.nombre_sede', 'sede.direccion')
            ->leftjoin('sede', 'reporte.sede_id', '=', 'sede.id')
            ->where('reporte.empresa_id', $id)
            ->orderBy('reporte.id', 'desc')
            ->get();
          

        return view('tramites.salud.pgirh.detalle', compact('reportes'));
    }

    public function indexReportes(){
        $empresas =PgirhEmpresa::all();
        return view('tramites.salud.pgirh.reportes', compact('empresas'));
    }

    public function getSedes($empresa_id){
        $sedes = DB::connection('mysql3')->table('sede')->where('empresa_id', $empresa_id)->get();
        if($sedes->count()>0){
        return response()->json(['success' =>true, 'sedes' =>$sedes]);
       }else{
        return response()->json(['success' =>false, 'sedes' =>[]]);
       }
    }

    public function exportReport(Request $request){
         
        if(!$request->empresa && 
           !$request->sede && 
           !$request->year &&
           !$request->semestre &&
           !$request->fecha_inicial &&
           !$request->fecha_final
           ){
            Alert::info('Atencion!', 'Todos los campos de busqueda estan vacios');
             return redirect()->route('salud.pgirh.reportes.general');
        }

        if($request->fecha_inicial && $request->fecha_final){
            if($request->fecha_inicial > $request->fecha_final){
                Alert::info('Atencion!', 'La fecha inicial no puede ser mayor que la fecha final');
                 return redirect()->route('salud.pgirh.reportes.general');     
                
            }
        }
            
        $empresa_id = ($request->empresa) ? $request->empresa : '%';
        $sede_id = ($request->sede) ? $request->sede : '%';
        $year = ($request->year) ? $request->year : '%';
        $fecha_inicial = ($request->fecha_inicial) ? $request->fecha_inicial : '2019-01-01';
        $fecha_final = ($request->fecha_final) ? $request->fecha_final : '2050-12-31';
        $semestre = ($request->semestre) ? $request->semestre : '%';

        $sql = "SELECT 
        r.semestre,
        r.year,
        r.gestor_residuos,
        r.nombre_solicitante,
        r.created_at,
        e.nit,
        e.razon_social,
        e.direccion_empresa,
        e.telefono,
        e.correo_electronico,
        s.nombre_sede,
        s.direccion,
        ae.descripcion,
        ae.detalle,
        SUM(IF(rd.residuo_id = 1, rd.kilos, 0)) AS biodegradable,
        SUM(IF(rd.residuo_id = 2, rd.kilos, 0)) AS reciclables,  
        SUM(IF(rd.residuo_id = 3, rd.kilos, 0)) AS ordinarios,  
        SUM(IF(rd.residuo_id = 4, rd.kilos, 0)) AS biosanitarios,  
        SUM(IF(rd.residuo_id = 5, rd.kilos, 0)) AS anatomopatologicos,  
        SUM(IF(rd.residuo_id = 6, rd.kilos, 0)) AS cortopunzantes, 
        SUM(IF(rd.residuo_id = 7, rd.kilos, 0)) AS animales,  
        SUM(IF(rd.residuo_id = 8, rd.kilos, 0)) AS farmacos,  
        SUM(IF(rd.residuo_id = 9, rd.kilos, 0)) AS citoxicos,
        SUM(IF(rd.residuo_id = 10,rd.kilos, 0)) AS metales,
        SUM(IF(rd.residuo_id = 11, rd.kilos, 0)) AS reactivos,  
        SUM(IF(rd.residuo_id = 12, rd.kilos, 0)) AS contenedores,
        SUM(IF(rd.residuo_id = 13,  rd.kilos, 0)) AS aceites,   
        SUM(IF(rd.residuo_id = 14,  rd.kilos, 0)) AS fuentesA,
        SUM(IF(rd.residuo_id = 15,  rd.kilos, 0)) AS fuentesC                 
        FROM  reporte_detalle AS rd
        INNER JOIN reporte AS r      
        ON rd.reporte_id = r.id 
        LEFT JOIN empresas AS e
        ON e.id = r.empresa_id 
        LEFT JOIN sede AS s
        ON r.sede_id = s.id 
        LEFT JOIN actividad_economica AS ae
        ON ae.id = e.actividad_id
        WHERE rd.reporte_id LIKE '%' 
        AND r.empresa_id LIKE :empresa_id
        AND IFNULL(r.sede_id,'') LIKE :sede_id
        AND r.year LIKE :anio
        AND r.semestre LIKE :semestre
        AND DATE(r.created_at) BETWEEN :fecha_inicio AND :fecha_fin     
        GROUP BY r.id ORDER BY e.razon_social ASC;";

        $query = DB::connection('mysql3')->select($sql,['empresa_id'=>$empresa_id,
        'sede_id'=>$sede_id,'anio'=>$year,'semestre'=>$semestre,'fecha_inicio'=>$fecha_inicial, 'fecha_fin'=>$fecha_final]);

        if (count($query) > 0) {
            return Excel::download(new PgirhExports($query), 'Reporte-' . date('Y-m-d H:i:s') . '.xlsx');
            
        } else {
            Alert::info('Atencion!', 'No se encontraron resultados para esta busqueda');
            return redirect()->route('salud.pgirh.reportes.general');     
           
        }

       

        

    }

    public function excelDetalle($id, $empresa, $nit, $gestor,$sede)
    {
        return Excel::download(new ReportesPgirh($id, $empresa, $nit, $gestor, $sede), 'Reporte-' . $id . '-' . $empresa . '.xlsx');
    }

    //FAMILIA LACTANTE

    public function indexFamilia()
    {
        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru', 'ABREDIR')->get();
        $Barrios = Barrio::all();

        return view('tramites.gestantes.index', compact('Parametros1', 'Parametros2', 'Barrios'));
    }

    public function storeFamilia(Request $request)
    {
        $this->validate($request, [
            'nit' => 'required|unique:familia_lactante',
            'razon_social' => 'required',
            'direccion' => 'required',
            'barrio' => 'required',
            'telefono_empresa' => 'required|digits_between:7,10',
            'correo_electronico' => 'required',
            'nom_representante' => 'required',
            'ape_representante' => 'required',
            'numero_mujeres_empresa' => 'required|digits_between:1,4',
            'numero_mujeres_gestantes' => 'required|digits_between:1,4',
            'numero_mujeres_lactantes' => 'required|digits_between:1,4',
            'tratamiento_datos' => 'required',
            'acepto_terminos' => 'required',
            'confirmo_mayorEdad' => 'required',
            'compartir_informacion' => 'required',
        ]);

        $reporte = $request->all();
        $saveSolicitud = FamiliaLactante::create($reporte);

        if ($saveSolicitud) {
            $request->session()->flash('radicado_id', $saveSolicitud->id);
            return redirect()->route('familia.confirmacion');
        } else {
            Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
            return redirect()->route('home');
        }
    }

    public function confirmacion()
    {
        return view('tramites.gestantes.confirmacion');
    }

    public function end()
    {
        Session::flush();
        return redirect('/familia-lactante');
    }

    //FUNCIONES DISCAPACIDAD

    public function indexDiscapacidad()
    {
        $sEnviadas = CertificacionDiscapacidad::where('estado_solicitud', 'ENVIADA')->get();
        $sPendientes = CertificacionDiscapacidad::where('estado_solicitud', 'PENDIENTE')->get();
        $sActualizadas = CertificacionDiscapacidad::where('estado_solicitud', 'ACTUALIZADA')->get();
        $sRadicadas = CertificacionDiscapacidad::where('estado_solicitud', 'RADICADA')->get();
        $sAprobadas = CertificacionDiscapacidad::where('estado_solicitud', 'APROBADA')->get();
        $sRechazadas = CertificacionDiscapacidad::where('estado_solicitud', 'RECHAZADA')->get();
        $count_enviadas = $sEnviadas->count();
        $count_pendientes = $sPendientes->count();
        $count_actualizadas = $sActualizadas->count();
        $count_radicadas = $sRadicadas->count();
        $count_aprobadas = $sAprobadas->count();
        $count_rechazadas = $sRechazadas->count();

        return view('tramites.salud.discapacidad.index', compact('sEnviadas', 'sActualizadas', 'sPendientes', 'sRadicadas', 'sAprobadas', 'sRechazadas', 'count_enviadas', 'count_pendientes', 'count_actualizadas', 'count_radicadas', 'count_aprobadas', 'count_rechazadas'));
    }

    public function discapacidadDetalle($id)
    {
        $solicitud = CertificacionDiscapacidad::findOrFail($id);

        return view('tramites.salud.discapacidad.detalle', compact('solicitud'));
    }

    public function discapacidadUpdate(Request $request)
    {
        $datos = CertificacionDiscapacidad::findOrFail($request->id);

        if ($request->estado_solicitud == 'PENDIENTE') {
            $this->validate($request, [
                'observaciones_solicitud' => 'required',
                'estado_solicitud' => 'required',
            ]);

            $date = date('Y-m-d');
            //sumo 30 días
            $date_30 = date('Y-m-d', strtotime($date . '+30 days'));

            $detalleCorreo = [
                'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
                'mensaje' => $request->observaciones_solicitud,
                'Subject' => 'Documentos Pendientes Solicitud de Autorizacion de la certificacion de discapacidad N°' . $datos->radicado,
                'documento' => 'NO',
                'fecha_pendiente' => $date_30,
                'radicado' => $datos->radicado,
                'estado' => $request->estado_solicitud,
                'id' => Crypt::encrypt($request->id),
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
                    'tramite' => 'CERTIFICACION DE DISCAPACIDAD',
                    'radicado' => $datos->radicado,
                    'accion' => 'update a estado ' . $request->estado_solicitud,
                    'observacion' => $request->observaciones_solicitud,
                ]);

                Mail::to($datos->email_responsable)->queue(new NotificacionDiscapacidad($detalleCorreo));
                Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                return redirect()->route('salud.discapacidad.index');
            } else {
                Alert::error('Error', 'Ha ocurrido un erro al registrar la actualización de la solicitud');
                return redirect()->route('salud.discapacidad.index');
            }
        } elseif ($request->estado_solicitud == 'RADICADA') {
            $this->validate($request, [
                'observaciones_solicitud' => 'required',
                'estado_solicitud' => 'required',
            ]);

            $date = date('Y-m-d');
            //sumo 30 días
            $date_30 = null;

            $detalleCorreo = [
                'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
                'mensaje' => $request->observaciones_solicitud,
                'Subject' => 'Solicitud Radicada de Autorizacion de la certificacion de discapacidad N°' . $datos->radicado,
                'documento' => 'NO',
                'fecha_pendiente' => $date_30,
                'radicado' => $datos->radicado,
                'estado' => $request->estado_solicitud,
                'id' => Crypt::encrypt($request->id),
            ];

            // actualizar datos
            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;
            $datos->act_documentos = null;

            if ($datos->save()) {
                //auditoria
                $auditoria = Auditoria::create([
                    'usuario' => $request->username,
                    'proceso_afectado' => 'Radicado-' . $datos->radicado,
                    'tramite' => 'CERTIFICACION DE DISCAPACIDAD',
                    'radicado' => $datos->radicado,
                    'accion' => 'update a estado ' . $request->estado_solicitud,
                    'observacion' => $request->observaciones_solicitud,
                ]);

                Mail::to($datos->email_responsable)->queue(new NotificacionDiscapacidad($detalleCorreo));
                Alert::success('Operacion Exitosa', 'Se ha actualizado exitosamente el estado del tramite en el sistema');
                return redirect()->route('salud.discapacidad.index');
            } else {
                Alert::error('Error', 'Ha ocurrido un error al registrar la actualización de la solicitud');
                return redirect()->route('salud.discapacidad.index');
            }
        } elseif ($request->estado_solicitud == 'APROBADA') {
            $this->validate($request, [
                'observaciones_solicitud' => 'required',
                'estado_solicitud' => 'required',
                'documento_respuesta' => 'required',
            ]);

            $date = date('Y-m-d');
            $date_30 = null;

            //mover documento a storage
            $adjunto1 = $request->file('documento_respuesta')->storeAs('certificaciones_discapacidad/' . $datos->radicado, 'Autorizacion-certificacion-discapacidad-' . $datos->radicado . '.pdf');

            //crear ruta de guardado
            $ruta_guardado = 'storage/certificaciones_discapacidad/' . $datos->radicado . '/Autorizacion-certificacion-discapacidad-' . $datos->radicado . '.pdf';

            $detalleCorreo = [
                'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
                'mensaje' => $request->observaciones_solicitud,
                'Subject' => 'Solicitud Aprobada de Autorizacion de la certificacion de discapacidad N°' . $datos->radicado,
                'documento' => 'SI',
                'fecha_pendiente' => $date_30,
                'radicado' => $datos->radicado,
                'estado' => $request->estado_solicitud,
                'id' => Crypt::encrypt($request->id),
            ];

            if ($adjunto1) {
                // actualizar

                $datos->estado_solicitud = $request->estado_solicitud;
                $datos->observaciones_solicitud = $request->observaciones_solicitud;
                $datos->fecha_actuacion = $date;
                $datos->adj_certificado = $ruta_guardado;

                if ($datos->save()) {
                    $auditoria = Auditoria::create([
                        'usuario' => $request->username,
                        'proceso_afectado' => 'Radicado-' . $datos->radicado,
                        'tramite' => 'CERTIFICACION DE DISCAPACIDAD',
                        'radicado' => $datos->radicado,
                        'accion' => 'update estado ' . $request->estado_solicitud,
                        'observacion' => $request->observaciones_solicitud,
                    ]);

                    Mail::to($datos->email_responsable)->queue(new NotificacionDiscapacidad($detalleCorreo));
                    Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
                    return redirect()->route('salud.discapacidad.index');
                } else {
                    Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
                    return redirect()->route('salud.discapacidad.index');
                }
            } else {
                Alert::error('Error', 'Ocurrio un error al cargar el archivo al servidor');
                return redirect()->route('salud.discapacidad.index');
            }
        } elseif ($request->estado_solicitud == 'RECHAZADA') {
            $this->validate($request, [
                'observaciones_solicitud' => 'required',
                'estado_solicitud' => 'required',
            ]);

            $date = date('Y-m-d');
            $date_30 = null;

            $detalleCorreo = [
                'nombres' => $datos->nom_responsable . ' ' . $datos->ape_responsable,
                'mensaje' => $request->observaciones_solicitud,
                'Subject' => 'Solicitud Rechazada de Autorizacion de la certificacion de discapacidad N°' . $datos->radicado,
                'documento' => 'NO',
                'fecha_pendiente' => $date_30,
                'radicado' => $datos->radicado,
                'estado' => $request->estado_solicitud,
                'id' => Crypt::encrypt($request->id),
            ];

            $datos->estado_solicitud = $request->estado_solicitud;
            $datos->observaciones_solicitud = $request->observaciones_solicitud;
            $datos->fecha_actuacion = $date;

            if ($datos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => $request->username,
                    'proceso_afectado' => 'Radicado-' . $datos->radicado,
                    'tramite' => 'CERTIFICACION DE DISCAPACIDAD',
                    'radicado' => $datos->radicado,
                    'accion' => 'update estado ' . $request->estado_solicitud,
                    'observacion' => $request->observaciones_solicitud,
                ]);

                Mail::to($datos->email_responsable)->send(new NotificacionDiscapacidad($detalleCorreo));
                Alert::success('Operacion Exitosa', 'Se actualizado exitosamente el estado del tramite en el sistema');
                return redirect()->route('salud.discapacidad.index');
            } else {
                Alert::error('Error', 'Ha ocurrido un error al registrar la actualizacion de la solicitud');
                return redirect()->route('salud.discapacidad.index');
            }
        }
    }
}

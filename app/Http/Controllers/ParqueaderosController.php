<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;
use App\Barrio;
use App\Parqueadero;
use App\Auditoria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionParqueaderos;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;

class ParqueaderosController extends Controller
{
    public function index(){
      
            
        return view('tramites.parqueaderos.index');

    }

    public function registro(){

        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
      
         return view('tramites.parqueaderos.registro', compact('Parametros1', 'Parametros2', 'Barrios'));
 
     }

    public function confirmacion()
    {
        return view('tramites.parqueaderos.confirmacion');
    }
    public function consultarTramite()
    {
        return view('tramites.parqueaderos.consulta');
    }

    public function end()
    {
        Session::flush();
        return redirect("/categorizacion-parqueaderos");
    }

    public function store(Request $request){

      // validacion campos requeridos
      $this->validate($request, [
        "nom_solicitante" => "required",
        "ape_solicitante" => "required",
        "tipo_documento" => "required",
        "identificacion_solicitante" => "required",
        "direccion_solicitante" => "required",
        "barrio_solicitante" => "required",
        "tel_solicitante" => "required",
        "email_responsable" => "required",
        "nombre_empresa" => "required",
        "direccion_empresa" => "required",
        "barrio_empresa" => "required",
        "tel_empresa" => "required",
        "archivo_camara_rut" => "required",       
        "archivo_planos" => "required",
        "archivo_licencia"=> "required",       
        "tratamiento_datos" => "required",
        "acepto_terminos" => "required",
        "confirmo_mayorEdad" => "required",
        "compartir_informacion" => "required"
        
    ],[
       "tratamiento_datos.required" =>'Aprobar el tratamiento de datos es obligatorio',
       "acepto_terminos.required"=>'Aceptar los terminos y condiciones es obligatorio',
       "confirmo_mayorEdad.required"=>'Confirmar que es mayor de edad es obligatorio',
       "compartir_informacion.required"=>'Responder si acepta compartir su informacion es obligatorio'
    ]);

    $ultimo_id = Parqueadero::latest('id')->first();
    // return $ultimo_id;
    if (!$ultimo_id) {
        $idRadicado = 1;
    } else {
        $idRadicado = $ultimo_id->id + 1;
    }

     $radicado = date("Ymd") . $request->identificacion_solicitante . $idRadicado; // numero radicado
    

     $adjunto1 = $request->file('archivo_camara_rut')->storeAs('documentos_parqueaderos/' . $radicado, 'camara_comercio_RUT-' . $radicado . '.pdf');


     $adjunto3 = $request->file('archivo_planos')->storeAs('documentos_parqueaderos/' . $radicado, 'planos_aprobados-' . $radicado . '.pdf');

     if($request->archivo_licencia || $request->archivo_licencia != null){  
        $adjunto4 = $request->file('archivo_licencia')->storeAs('documentos_parqueaderos/' . $radicado, 'licencia_construccion-' . $radicado . '.pdf');
        }else{
            $adjunto4 = false;
        }

     if ($adjunto1 && $adjunto3 || $adjunto4) {

        //rutas de guardado
        $adjunto_camara_rut = 'storage/documentos_parqueaderos/' . $radicado . '/camara_comercio_RUT-' . $radicado . '.pdf';        

        $archivo_planos = 'storage/documentos_parqueaderos/' . $radicado . '/planos_aprobados-' . $radicado . '.pdf';

        if($adjunto4){
            $archivo_licencia = 'storage/documentos_parqueaderos/' . $radicado . '/licencia_construccion-' . $radicado . '.pdf';
            }else{
             $archivo_licencia = null;  
            }

        $request->request->add([
            'radicado' => $radicado,
            'adjunto_camara_rut' => $adjunto_camara_rut,            
            'adjunto_planos' => $archivo_planos,
            'adjunto_licencia' => $archivo_licencia,
            'estado_solicitud' => 'ENVIADA'
        ]);

      

        $detalleCorreo = [
            'nombres' => $request->nom_solicitante . ' ' . $request->ape_solicitante,
            'radicado' => $radicado,
            'Subject' => 'Envió de Solicitud de Categorización de Parqueaderos',
            'documento'=> 'NO',
            'fecha_pendiente' => null,            
            'estado' => null,
            'mensaje'=> null
        ];

        $detalleCorreo_fun = [
            'nombres' => ' Funcionario Carlos Guerrero',
            'radicado' => $radicado,
            'Subject' => 'Solicitud pendiente Categorización de parqueaderos No'.$radicado,
            'documento'=> 'NO',
            'fecha_pendiente' => null,            
            'estado' => 'FUNCIONARIO',
            'mensaje'=> 'Dr Carlos Guerrero'
        ];

        $correo_funcionario = 'cjguerrero@bucaramanga.gov.co';

        $solicitud = $request->all();
            // return $solicitud;
        $saveSolicitud = Parqueadero::create($solicitud);

        if ($saveSolicitud) {

            //auditoria
            $auditoria = Auditoria::create([
                'usuario' => $request->identificacion_solicitante,
                'proceso_afectado'=> 'Radicado-'.$radicado,
                'tramite'=> 'CATEGORIZACION DE PARQUEADEROS',
                'radicado'=> $radicado,
                'accion'=>'update a estado ENVIADO',
                'observacion'=> 'El ciudadano '.$request->nom_solicitante.' '.$request->ape_solicitante. 'realiza una solicitud de categorización de parqueaderos'

            ]);

            // envio de correo                
            Mail::to($request->email_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
            Mail::to($correo_funcionario)->queue(new NotificacionParqueaderos($detalleCorreo_fun));

            $request->session()->flash('radicado_id', $radicado);
            return redirect()->route('parqueaderos.confirmacion');
        } else {
            Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
            return redirect()->route('home');
        }

     }else {

            Alert::error('Ha Ocurrido un error', 'Los archivos no se han cargado correctamente vuelva intentarlo');
            return redirect()->route('parqueaderos.index');
        }
    }

    public function consulta(Request $request){

        $QuerySolicitud = Parqueadero::where($request->tipo_parametro, $request->parametro)->get();

        if ($QuerySolicitud->count() > 0) {
            
            // return $QuerySolicitud;
            return view('tramites.parqueaderos.resultado', compact('QuerySolicitud'));
        } else {
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
            return redirect()->route('parqueaderos.index');
        }
    }

    public function detalle($id){

        $solicitud = Parqueadero::FindOrFail(Crypt::decrypt($id));

        $date = Carbon::now();
        $date1 = Carbon::parse($solicitud->fecha_pendiente);
        $diff = $date1->diffInDays($date);      
        
        return view('tramites.parqueaderos.detalle', compact('solicitud', 'diff'));



    }

    public function updateDocs(Request $request){

        $solicitud = Parqueadero::FindOrFail($request->id);
        $contador = 0;

        

        if($request->archivo_camara_rut){
            $adjunto1 = $request->file('archivo_camara_rut')->storeAs('documentos_parqueaderos/' . $solicitud->radicado, 'camara_comercio_RUT-' . $solicitud->radicado . '.pdf');
            $contador++;
        }else{
            $adjunto1 = false;
        }        

        if($request->archivo_planos){
            $adjunto3 = $request->file('archivo_planos')->storeAs('documentos_parqueaderos/' . $solicitud->radicado, 'planos_aprobados-' . $solicitud->radicado . '.pdf');
            $contador++;
        }else{
            $adjunto3 = false;
        }

        if($request->archivo_licencia){
            $adjunto4 = $request->file('archivo_licencia')->storeAs('documentos_parqueaderos/' . $solicitud->radicado, 'licencia_construccion-' . $solicitud->radicado . '.pdf');
            $contador++;

        }else{
            $adjunto4 = false;
        }

        $detalleCorreo_fun = [
            'nombres' => ' Funcionario Carlos Guerrero',
            'radicado' => $solicitud->radicado,
            'Subject' => 'Actualizacion de documentos pendiente por revisar en Categorización de parqueaderos No'.$solicitud->radicado,
            'documento'=> 'NO',
            'fecha_pendiente' => null,            
            'estado' => 'FUNCIONARIO',
            'mensaje'=> 'Usted tiene la solicitud #'.$solicitud->radicado.' pendiente por revisar en el sistema la actualizacion de documentos faltantes'
        ];

        $correo_funcionario = 'cjguerrero@bucaramanga.gov.co';
        //   $correo_funcionario = 'ojrincon@bucaramanga.gov.co';

        if($adjunto1 || $adjunto3 || $adjunto4){

              //auditoria
              $auditoria = Auditoria::create([
                'usuario' => $solicitud->identificacion_solicitante,
                'proceso_afectado'=> 'Radicado-'.$solicitud->radicado,
                'tramite'=> 'CATEGORIZACION DE PARQUEADEROS',
                'radicado'=> $solicitud->radicado,
                'accion'=>'update de documentos',
                'observacion'=> 'El ciudadano '.$solicitud->nom_solicitante.' '.$solicitud->ape_solicitante. 'realiza actulización de documentos dentro de las fechas permitidas'

            ]);

            $solicitud->act_documentos = "SI";
            $solicitud->save();
            Mail::to($correo_funcionario)->queue(new NotificacionParqueaderos($detalleCorreo_fun));            
            Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
            return redirect()->route('parqueaderos.index');

        }else{
            Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
            return redirect()->route('parqueaderos.index');
        }








    }

    


    }





    


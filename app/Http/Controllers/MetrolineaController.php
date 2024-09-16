<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barrio;
use App\Orientacion;
use App\Vereda;
use App\Instituciones;
use App\Metrolinea;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class MetrolineaController extends Controller
{
    public function index(){

        $Barrios = Barrio::all();
        // $instituciones = Instituciones::where('tipo', '1')->Orwhere('tipo','4')->get();
        // $orientacion_sexual = Orientacion::all();
        $discapacidades = DB::table('tipo_discapacidad')->get();
        
       
       return view('tramites.metrolinea.index', compact('Barrios','discapacidades'));

    }

    public function confirmacion()
    {
        return view('tramites.metrolinea.confirmacion');

    }

    public function end()
    {
        Session::flush();
        return redirect("https://www.bucaramanga.gov.co/beneficio-metrolinea/");
    }
    

    public function store(Request $request){

       // validacion campos requeridos
    if($request->tipo_poblacion=='ESTUDIANTE-COLEGIO' || $request->tipo_poblacion=='ESTUDIANTE-UNIVERSIDAD'){
       
      $this->validate($request, [
        "tipo_poblacion" => "required",
        "nombre_usuario" => "required",
        "apellido_usuario" => "required",        
        "fecha_nacimiento" => "required",
        "estado_civil" => "required",
        "nivel_estudios" => "required",
        "tipo_documento" => "required",
        "documento_usuario" => "required|unique:caracterizacion_metrolinea",
        "sexo" => "required",
        "telefono_usuario" => "required",
        "email_usuario" => "required",
        "id_municipio" => "required",       
        "barrio" => "required", 
        "corregimiento"=> "required",       
        "direccion_usuario" => "required",        
        "ruta_frecuente" => "required",
        "estrato_socioeconomico" => "required",
        "trabaja_actualmente"=> "required",
        "entrega_tarjeta"=> "required",
        "tratamiento_datos"=> "required",
        "acepto_terminos"=> "required",
        "confirmo_mayorEdad"=> "required",
        "compartir_informacion"=> "required",
        "edad"=> "required",
        "archivo_documentoIdentidad"=> "required",
        "institucion_educativa"=> "required",
        "archivo_certificadoEstudio"=> "required|mimes:pdf|max:3000",
        
    ]);
   }elseif($request->tipo_poblacion == 'DEPORTISTA-ARTISTA'){

    $this->validate($request, [
        "tipo_poblacion" => "required",
        "nombre_usuario" => "required",
        "apellido_usuario" => "required",        
        "fecha_nacimiento" => "required",
        "estado_civil" => "required",
        "nivel_estudios" => "required",
        "tipo_documento" => "required",
        "documento_usuario" => "required|unique:caracterizacion_metrolinea",
        "sexo" => "required",
        "telefono_usuario" => "required",
        "email_usuario" => "required",
        "id_municipio" => "required",       
        "barrio" => "required", 
        "corregimiento"=> "required",       
        "direccion_usuario" => "required",        
        "ruta_frecuente" => "required",
        "estrato_socioeconomico" => "required",
        "trabaja_actualmente"=> "required",
        "entrega_tarjeta"=> "required",
        "tratamiento_datos"=> "required",
        "acepto_terminos"=> "required",
        "confirmo_mayorEdad"=> "required",
        "compartir_informacion"=> "required",
        "edad"=> "required",
        "archivo_documentoIdentidad"=> "required|mimes:pdf|max:3000",
        "archivo_deportistas_artistas"=> "required|mimes:pdf|max:3000",
       
        
    ]);

   }elseif($request->tipo_poblacion == 'ADULTO MAYOR'){

    $this->validate($request, [
        "tipo_poblacion" => "required",
        "nombre_usuario" => "required",
        "apellido_usuario" => "required",        
        "fecha_nacimiento" => "required",
        "estado_civil" => "required",
        "nivel_estudios" => "required",
        "tipo_documento" => "required",
        "documento_usuario" => "required|unique:caracterizacion_metrolinea",
        "sexo" => "required",
        "telefono_usuario" => "required",
        "email_usuario" => "required",
        "id_municipio" => "required",       
        "barrio" => "required", 
        "corregimiento"=> "required",       
        "direccion_usuario" => "required",        
        "ruta_frecuente" => "required",
        "estrato_socioeconomico" => "required",
        "trabaja_actualmente"=> "required",
        "entrega_tarjeta"=> "required",
        "tratamiento_datos"=> "required",
        "acepto_terminos"=> "required",
        "confirmo_mayorEdad"=> "required",
        "compartir_informacion"=> "required",
        "edad"=> "required",
        "archivo_documentoIdentidad"=> "required|mimes:pdf|max:3000"      
       
        
    ]);



   }elseif($request->tipo_poblacion == 'PERSONAS CON DISCAPACIDAD'){

    $this->validate($request, [
        "tipo_poblacion" => "required",
        "nombre_usuario" => "required",
        "apellido_usuario" => "required",        
        "fecha_nacimiento" => "required",
        "estado_civil" => "required",
        "nivel_estudios" => "required",
        "tipo_documento" => "required",
        "documento_usuario" => "required|unique:caracterizacion_metrolinea",
        "sexo" => "required",
        "telefono_usuario" => "required",
        "email_usuario" => "required",
        "id_municipio" => "required",       
        "barrio" => "required", 
        "corregimiento"=> "required",       
        "direccion_usuario" => "required",  
        "discapacidad"=> "required",      
        "ruta_frecuente" => "required",
        "estrato_socioeconomico" => "required",
        "trabaja_actualmente"=> "required",
        "entrega_tarjeta"=> "required",
        "tratamiento_datos"=> "required",
        "acepto_terminos"=> "required",
        "confirmo_mayorEdad"=> "required",
        "compartir_informacion"=> "required",
        "edad"=> "required",
        "archivo_documentoIdentidad"=> "required|mimes:pdf|max:3000",
        "archivo_discapacidad" => "required|mimes:pdf|max:3000"   
              
    ]);


   }

   // validacion sisben Y/O VECINDAD
    
   if($request->tiene_sisben == 'SI'){
        $this->validate($request, [
            "archivo_docSisben" => "required|mimes:pdf|max:3000"
        ]);
   }else{
    $this->validate($request, [
        "archivo_certiVencidad" => "required|mimes:pdf|max:3000"
    ]);
   }

   // validacion menor de edad
    
        if($request->edad < 18){
            $this->validate($request, [
                "archivo_docAcudiente" => "required|mimes:pdf|max:3000"
            ]);
          }


    $ultimo_id = Metrolinea::latest('id')->first();
    // return $ultimo_id;
    if (!$ultimo_id) {
        $idRadicado = 1;
    } else {
        $idRadicado = $ultimo_id->id + 1;
    }
    $radicado = $request->documento_usuario . $idRadicado; // numero de solicitud

    $adjunto1 = $request->file('archivo_documentoIdentidad')->storeAs('documentos_metrolinea/' . $radicado, 'documento-de-identidad-' . $radicado . '.pdf');

    if($request->archivo_certiVencidad || $request->archivo_certiVencidad != null){  
    $adjunto2 = $request->file('archivo_certiVencidad')->storeAs('documentos_metrolinea/' . $radicado, 'certificado-vecindad-' . $radicado . '.pdf');
    }else{
        $adjunto2 = false;
    }
    if($request->archivo_certificadoEstudio || $request->archivo_certificadoEstudio != null){  
    $adjunto3 = $request->file('archivo_certificadoEstudio')->storeAs('documentos_metrolinea/' . $radicado, 'certificado-estudio-' . $radicado . '.pdf');
    }else{
        $adjunto3 = false;
    }

    if($request->archivo_docAcudiente || $request->archivo_docAcudiente != null){
        $adjunto4 =  $request->file('archivo_docAcudiente')->storeAs('documentos_metrolinea/' . $radicado, 'documento-identidad-acudiente-' . $radicado . '.pdf');
    }else{
        $adjunto4 =false;
    }

    if($request->archivo_docSisben || $request->archivo_docSisben != null){
        $adjunto5 =  $request->file('archivo_docSisben')->storeAs('documentos_metrolinea/' . $radicado, 'calificacion-sisben-' . $radicado . '.pdf');
    }else{
        $adjunto5 =false;
    }

    if($request->archivo_discapacidad || $request->archivo_discapacidad != null){
        $adjunto6 =  $request->file('archivo_discapacidad')->storeAs('documentos_metrolinea/' . $radicado, 'registro-discapacidad-' . $radicado . '.pdf');
    }else{
        $adjunto6 =false;
    }

    if($request->archivo_deportistas_artistas || $request->archivo_deportistas_artistas != null){
        $adjunto7 =  $request->file('archivo_deportistas_artistas')->storeAs('documentos_metrolinea/' . $radicado, 'carnet-deportista-artista-' . $radicado . '.pdf');
    }else{
        $adjunto7 =false;
    }

    if ($adjunto1 || $adjunto2 || $adjunto3 || $adjunto4 || $adjunto5 || $adjunto6 || $adjunto7) {

        $adj_documentoIdentidad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/documento-de-identidad-' . $radicado . '.pdf';        
        
        if($adjunto2){
         $adj_certiVecindad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/certificado-vecindad-' . $radicado . '.pdf';
        }else{
            $adj_certiVecindad = null;
        }
         
        if($adjunto3){
        $adj_certificadoEstudio = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/certificado-estudio-' . $radicado . '.pdf';
        }else{
         $adj_certificadoEstudio = null;  
        }

        if($adjunto4){
         $adj_docAcudiente = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/documento-identidad-acudiente-' . $radicado . '.pdf';
        }else{
            $adj_docAcudiente= null; 
        }

        if($adjunto5){
            $adj_docSisben = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/calificacion-sisben-' . $radicado . '.pdf';
           }else{
               $adj_docSisben= null; 
           }

           if($adjunto6){
            $adj_discapacidad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/registro-discapacidad-' . $radicado . '.pdf';
           }else{
               $adj_discapacidad= null; 
           }

           if($adjunto7){
            $adj_deportistas_artistas = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $radicado . '/carnet-deportista-artista-' . $radicado . '.pdf';
           }else{
               $adj_deportistas_artistas= null; 
           }

           if($request->autorizacion_tratamiento){       
            $tratamiento_compartido = 'SI';      
         }else{
             $tratamiento_compartido = 'NO';
           }

        $request->request->add([
            'numero_solicitud' => $radicado,
            'adj_documentoIdentidad' => $adj_documentoIdentidad,            
            'adj_certiVecindad' => $adj_certiVecindad,
            'adj_certificadoEstudio' => $adj_certificadoEstudio,
            'adj_docAcudiente'=> $adj_docAcudiente,
            'adj_docSisben'=> $adj_docSisben,
            'adj_discapacidad'=> $adj_discapacidad,
            'adj_deportistas_artistas' => $adj_deportistas_artistas,
            'estado_solicitud' => 'ENVIADA',
            'autorizacion_tratamiento_compartido' => $tratamiento_compartido

        ]);

        $request->merge([
            "ruta_frecuente" => implode("-", $request->ruta_frecuente)
        ]);

        $solicitud = $request->all();
        // return $solicitud;
        $saveSolicitud = Metrolinea::create($solicitud);

        if ($saveSolicitud) {

            // envio de correo                
            // Mail::to($request->email_responsable)->queue(new NotificacionParqueaderos($detalleCorreo));
            // Mail::to($correo_funcionario)->queue(new NotificacionParqueaderos($detalleCorreo_fun));

            $request->session()->flash('radicado_id', $radicado);
            return redirect()->route('metrolinea.confirmacion');
        } else {
            Alert::error('Ha Ocurrido un error', 'Ha ocurrido un error en en registrar su solicitud');
            return redirect()->route('metrolinea.index');
        }


    }else {

        Alert::error('Ha Ocurrido un error', 'Los archivos no se han cargado correctamente vuelva intentarlo');
        return redirect()->route('metrolinea.index');
    }
     

    }
    public function consulta(Request $request){

        $QuerySolicitud = Metrolinea::where($request->tipo_parametro, $request->parametro)->get();

        if ($QuerySolicitud->count() > 0) {
            
            // return $QuerySolicitud;
            return view('tramites.metrolinea.resultado', compact('QuerySolicitud'));
        } else {
            Alert::error('Ha Ocurrido un error', 'El Numero: .' . $request->parametro . ' no tiene registros asociados');
            return redirect()->route('metrolinea.index');
        }
    }

    public function entidades(Request $request){

        if($request->tipo == 'ESTUDIANTE-COLEGIO'){
       
        $instituciones = Instituciones::where('tipo', '1')->Orwhere('tipo','2')->pluck('nombre_institucion');
        $resp = ["success" => true ,"respuesta" => $instituciones];
        return response()->json($resp);
        }else if($request->tipo == 'ESTUDIANTE-UNIVERSIDAD'){

        $instituciones = Instituciones::where('tipo', '6')->pluck('nombre_institucion');
        $resp = ["success" => true ,"respuesta" => $instituciones];
        return response()->json($resp);


        }
        
    }

    public function detalle($id){

        $solicitud = Metrolinea::FindOrFail(Crypt::decrypt($id));         
        
        return view('tramites.metrolinea.detalle', compact('solicitud'));

    }

    public function updateDocs(Request $request){

        $solicitud = Metrolinea::FindOrFail($request->id);
        $solicitud->numero_actualizaciones = $solicitud->numero_actualizaciones + 1;
        $contador = 0;

        if($request->archivo_documentoIdentidad){
        $adjunto1 = $request->file('archivo_documentoIdentidad')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'documento-de-identidad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf');
        $solicitud->adj_documentoIdentidad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/documento-de-identidad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
        $contador++;

        }else{
            $adjunto1 = false;
        }
        if($request->archivo_certiVencidad || $request->archivo_certiVencidad != null){  
        $adjunto2 = $request->file('archivo_certiVencidad')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'certificado-vecindad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones.'.pdf');
        $solicitud->adj_certiVecindad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/certificado-vecindad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
        $contador++;

        }else{
            $adjunto2 = false;
        }
        if($request->archivo_certificadoEstudio || $request->archivo_certificadoEstudio != null){  
        $adjunto3 = $request->file('archivo_certificadoEstudio')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'certificado-estudio-' . $solicitud->numero_solicitud. '-'.$solicitud->numero_actualizaciones.'.pdf');
        $solicitud->adj_certificadoEstudio = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/certificado-estudio-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';

        $contador++;

        }else{
            $adjunto3 = false;
        }
    
        if($request->archivo_docAcudiente || $request->archivo_docAcudiente != null){
            $adjunto4 =  $request->file('archivo_docAcudiente')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'documento-identidad-acudiente-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones.'.pdf');
            $solicitud->adj_docAcudiente = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/documento-identidad-acudiente-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
            $contador++;

        }else{
            $adjunto4 =false;
        }
    
        if($request->archivo_docSisben || $request->archivo_docSisben != null){
            $adjunto5 =  $request->file('archivo_docSisben')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'calificacion-sisben-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones.'.pdf');
            $solicitud->adj_docSisben = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/calificacion-sisben-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
            $contador++;

        }else{
            $adjunto5 =false;
        }
    
        if($request->archivo_discapacidad || $request->archivo_discapacidad != null){
            $adjunto6 =  $request->file('archivo_discapacidad')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'registro-discapacidad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones.'.pdf');
            $solicitud->adj_discapacidad = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/registro-discapacidad-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
            $contador++;

        }else{
            $adjunto6 =false;
        }
    
        if($request->archivo_deportistas_artistas || $request->archivo_deportistas_artistas != null){
            $adjunto7 =  $request->file('archivo_deportistas_artistas')->storeAs('documentos_metrolinea/' . $solicitud->numero_solicitud, 'carnet-deportista-artista-' .$solicitud->numero_solicitud.'-'.$solicitud->numero_actualizaciones.'.pdf');
            $solicitud->adj_deportistas_artistas = 'https://tramitesenlinea.bucaramanga.gov.co/storage/documentos_metrolinea/' . $solicitud->numero_solicitud . '/carnet-deportista-artista-' . $solicitud->numero_solicitud .'-'.$solicitud->numero_actualizaciones. '.pdf';
            $contador++;

        }else{
            $adjunto7 =false;
        }

        if ($adjunto1 || $adjunto2 || $adjunto3 || $adjunto4 || $adjunto5 || $adjunto6 || $adjunto7) {

        
        $solicitud->estado_solicitud = "DOCUMENTOS-CARGADOS";
        $solicitud->fecha_actuacion = Carbon::now();
        // $solicitud->numero_actualizaciones = $solicitud->numero_actualizaciones + 1;
        $solicitud->save();

        Alert::success('Operacion exitosa', 'Se han cargado '.$contador.' archivo(s) en el sistema');
            return redirect()->route('metrolinea.index');

        }else{
            Alert::error('Error', 'No se ha realizado la carga de los archivos en el sistema');
            return redirect()->route('metrolinea.index');
        }


    }

    
}

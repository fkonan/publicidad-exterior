<?php

namespace App\Http\Controllers;
use App\Parametro;
use App\Barrio;
use App\LOEstampi;
use App\Auditoria;
use App\Mail\NotificacionEspectaculos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;

class LiqEstampillasController extends Controller
{ 
    public function index(){

       
        return view('tramites.liqestampillas.index');
  
      } 

    public function registro(){

        $Parametros1 = Parametro::where('ParNomGru', 'LETRA')->get();
        $Parametros2 = Parametro::where('ParNomGru','ABREDIR')->get();
        $Barrios = Barrio::all();
      
         return view('tramites.liqestampillas.registro', compact('Parametros1', 'Parametros2', 'Barrios'));
    }

    public function confirmacion()
    {
        return view('tramites.liquidacion.confirmacion');
    }

    public function end()
    {
        Session::flush();
        return redirect("/espectaculos-publicos");
    }

    

    public function store(Request $request)
    { 
        
    
      
          
      // validacion campos requeridos
      

          $validator = Validator::make($request->all(),[
              'nom_solicitante'=>'required',
              'ape_solicitante'=>'required',
              'tipo_identificacion'=>'required',
              'numero_identificacion'=>'required',
              'telefono_movil'=>'required',
              'email_responsable'=>'required',
              'numero_acto'=>'required',             
              'fecha_acto'=>'required',              
              'entidad_pos'=>'required',
              'cargo_pos'=>'required',
              'codigo_pos'=>'required',
              'grado_pos'=>'required',
              'tipo_nombramiento'=>'required',
              'valor_mensual'=>'required',
              'archivo_acta_posesion'=>'required',
              'archivo_id'=>'required',
              'tratamiento_datos'=>'required',
              'confirmo_mayorEdad'=>'required',
              'acepto_terminos'=>'required',
              'compartir_informacion'=>'required', 
  
           ]);

           $razon_social = $request->nom_solicitante.' '.$request->ape_solicitante;

      

      if($validator->fails()){
          //devuelve errores a la vista
       return response()->json(['error'=>$validator->errors()->all()]);
      }else{
      
      


      $ultimo_id = EspectaculosPublicos::latest('LoNroLiq')->first();
      // return $ultimo_id;
      if (!$ultimo_id) {
          $idRadicado = 1;
      } else {
          $idRadicado = $ultimo_id->LoNroLiq + 1;
      }

      

      $radicado = date("Ymd") . $idRadicado; // numero radicado

      $adjunto1 = $request->file('archivo_acta_posesion')->storeAs('documentos_LiqEstampillas/' . $radicado, 'Acta-Posesion-' . $radicado . '.pdf');
       
      $adjunto2 = $request->file('archivo_id')->storeAs('documentos_LiqEstampillas/' . $radicado, 'Doc-identificacion-' . $radicado . '.pdf');
      

      if($request->arch_otros == 'null') {    
          $adjunto6 = false;              
      }else{            
      $adjunto6 = $request->file('arch_otros')->storeAs('documentos_LiqEstampillas/' . $radicado, 'OTROS-ADJUNTOS-' . $radicado . '.pdf');
     
     
      }

       
      if ($adjunto1 && $adjunto2  || $adjunto6) {

           //rutas de guardado
      $AdjActPos = 'storage/documentos_LiqEstampillas/' . $radicado . '/Acta-Posesion-' . $radicado . '.pdf';      
      $AdjNumIde= 'storage/documentos_LiqEstampillas/' . $radicado . '/Doc-identificacion-' . $radicado . '.pdf';

      if($adjunto6){
      $AdjCertSal = 'storage/documentos_LiqEstampillas/' . $radicado . '/OTROS-ADJUNTOS-' . $radicado . '.pdf';
      }else{
      $AdjCertSal = null;
      }

      $request->request->add([

          'LoNombre' => $razon_social,
          'LoRadicado' => $radicado,
          'AdjActPos' => $AdjActPos,            
          'AdjNumIde' => $AdjNumIde,
          'AdjCertSal'=> $AdjCertSal,
          'LoEstSol' => 'ENVIADA',            
      ]);

      $solicitud = $request->all();
        // return $solicitud;
        $saveSolicitud = LOEstampi::create($solicitud);
        $liquidacion_id = $saveSolicitud->LoNroLiq;

      /*
      $detalleCorreo_fun = [
          'nombres' => ' Funcionario de Secretaría de Hacienda',
          'radicado' => $radicado,
          'Subject' => 'Solicitud pendiente de Espectaculo publico con Radicado No'.$radicado,
          'documento'=> 'NO',
          'fecha_pendiente' => null,            
          'estado' => 'FUNCIONARIO',
          'mensaje'=> 'Tiene una solicitud de Espectáculos Públicos radicada en la plataforma pendiente por revisar'
      ];
      // $correo_funcionario = 'ojrincon@bucaramanga.gov.co';
      $correo_funcionario = 'secretariahacienda@bucaramanga.gov.co';
      $solicitud = $request->all();
      // return $solicitud;
      $saveSolicitud = EspectaculosPublicos::create($solicitud);
      $espectaculo_id = $saveSolicitud->id;

      $detalleCorreo = [
          'nombres' => $razon_social,
          'radicado' => $radicado,
          'Subject' => 'Envió de Solicitud de Espectaculo Publico',
          'documento'=> 'NO',
          'fecha_pendiente' => null,            
          'estado' => null,
          'mensaje'=> null,
          'id'=> Crypt::encrypt($espectaculo_id)
      ];*/


      

      }else{
          return response()->json(['validaciones'=>'Error al cargar los documentos en el sistema']);
      }

          // return response()->json(['success'=>'Validacacion paso']);

      } 
   
    }


    public function updateDocs(Request $request){

        
      $solicitud = LOEstampi::FindOrFail($request->LoNroLiq);
      $contador = 0;
      if($request->archivo_acta_posesion){
          $adjunto1 = $request->file('archivo_acta_posesion')->storeAs('documentos_LiqEstampillas/' . $solicitud->radicado, 'Acta-Posesion-' . $solicitud->radicado . '.pdf');
          $contador++;
      }else{
          $adjunto1 = false;
      }

      if($request->archivo_id){
          $adjunto2 = $request->file('archivo_id')->storeAs('documentos_LiqEstampillas/' . $solicitud->radicado, 'Doc-identificacion-' . $solicitud->radicado . '.pdf');
          $contador++;
      }else{
          $adjunto2 = false;
      }


      if($request->arch_otros){
          $adjunto6 = $request->file('arch_otros')->storeAs('documentos_LiqEstampillas/' . $solicitud->radicado, 'OTROS-ADJUNTOS-' . $solicitud->radicado . '.pdf');
          $solicitud->adj_otros = 'storage/documentos_LiqEstampillas/' . $solicitud->radicado . '/OTROS-ADJUNTOS-' . $solicitud->radicado . '.pdf';
          $contador++;

      }else{
          $adjunto6 = false;
      }


      

    
  }



}
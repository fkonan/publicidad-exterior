<?php

namespace App\Http\Controllers;
use App\Inhumacion;
use App\Experiencia;
use App\AuditoriaInhumaciones;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InhumacionesController extends Controller
{
    public function index(){        
      
        return view('tramites.inhumaciones.index');

    }

    public function search(Request $request){

        $this->validate($request, [
           "nom_solicitante"=>"required",
           "ape_solicitante"=>"required",
           "identificacion_solicitante"=>"required",
           "email_solicitante"=>"required",
           "tipo_consulta"=>"required",
           "numero_busqueda"=>"required",
           "tratamiento_datos"=>"required",
           "acepto_terminos"=>"required",
           "confirmo_mayorEdad"=>"required",
           "compartir_informacion"=>"required"    

       ],[
        "tratamiento_datos.required" =>'Aprobar el tratamiento de datos es obligatorio',
        "acepto_terminos.required"=>'Aceptar los terminos y condiciones es obligatorio',
        "confirmo_mayorEdad.required"=>'Confirmar que es mayor de edad es obligatorio',
        "compartir_informacion.required"=>'Responder si acepta compartir su informacion es obligatorio'
     ]);

       $consulta = Inhumacion::where($request->tipo_consulta, 'LIKE', '%'.$request->numero_busqueda)->get();
       
       if($consulta->count() > 0){
        
        $auditoria = $request->all();
        AuditoriaInhumaciones::create($auditoria);
        return view('tramites.inhumaciones.detalle', compact('consulta'));

           
       }else{

        Alert::warning('No hay resultados', 'No se ha encontrado ningún resultado para esta consulta');
        return redirect()->route('inhumaciones.index');        
        
      }
        
    }

    public function experiencia(Request $request){

        $experiencia = new Experiencia;
        $experiencia->valor = $request->valor;
        $experiencia->tramite = 'CONSULTA DE INHUMACIONES';
        if ($request->sugerencias == null) {
            $experiencia->sugerencias = "SIN SUGERENCIAS";
        } else {
            $experiencia->sugerencias = $request->sugerencias;
        }
        if ($experiencia->save()) {
            $resp = ["success" => true];
            return response()->json($resp);
        } else {
            $resp = ["success" => false];
            return response()->json($resp);
        }


    }


}

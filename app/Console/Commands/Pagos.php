<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Prueba;
use App\Parqueadero;
use App\Evento;
use App\EspacioPublico;
use App\EspectaculosPublicos;
use App\Auditoria;
use App\NitEspectaculos;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificacionEspectaculos;
use App\Mail\EnvioNotificacion;
use App\Mail\NotificacionEventos;
use App\Mail\NotificacionParqueaderos;

class Pagos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pagos:realizados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando sirve para cambiar el estado de los pagos realizados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $date= date('Y-m-d');    
        $solicitudes = NitEspectaculos::where('estado' ,'PAGADO')->select('espectaculo_id',DB::raw('count(id) as total'))->groupBy('espectaculo_id')->get();     
          if($solicitudes){
          foreach($solicitudes as $solicitud){
           $contador = NitEspectaculos::where('espectaculo_id', $solicitud->espectaculo_id)->count();

           if($contador==$solicitud->total){
            $espectaculo = EspectaculosPublicos::FindOrFail($solicitud->espectaculo_id);

            $auditoria = Auditoria::create([
    
                "usuario" => 'SISTEMA',
                "proceso_afectado" => 'Radicado-'.$espectaculo->radicado,
                "accion"=> 'Update a ESTADO PAGO_REALIZADO',
                "tramite"=>'ESPECTACULOS PUBLICOS',
                "radicado" => $espectaculo->radicado,
                "observacion" => 'Solicitud No '.$espectaculo->radicado. ' se aplico el pago correctamente el estado de la solicitud avanza a la siguiente etapa'    
    
            ]);

            $detalleCorreo = [
                'nombres' => $espectaculo->nombre_o_razon,
                'mensaje' => 'Su Solicitud No '.$espectaculo->radicado. ' se aplico el pago correctamente el estado de la solicitud avanza a la siguiente etapa',
                'Subject' => 'Pago Aplicado Solicitud Espectaculos Publicos No-' . $espectaculo->radicado,
                'documento' => 'NO',                
                'fecha_pendiente' => null,
                'radicado'  => $espectaculo->radicado,
                'estado' => 'PAGO APLICADO',
                'id'=> Crypt::encrypt($espectaculo->id) 
            ];

            $detalleCorreo_fun = [
                'nombres' => ' Funcionario',
                'radicado' => $espectaculo->radicado,
                'Subject' => 'Pago Aplicado Solicitud Espectaculos Publicos No-'.$espectaculo->radicado,
                'documento'=> 'NO',
                'fecha_pendiente' => null,            
                'estado' => 'FUNCIONARIO',
                'mensaje'=> 'En La solicitud No -'. $espectaculo->radicado.' se aplico el pago correctamente'
            ];
            $correo_funcionario = 'lcerquera@bucaramanga.gov.co';
    
            Mail::to($espectaculo->email_responsable)->send(new NotificacionEspectaculos($detalleCorreo));
            Mail::to($correo_funcionario)->send(new NotificacionEspectaculos($detalleCorreo_fun));

            $espectaculo->observaciones ='Se aplico el pago correctamente el estado de la solicitud avanza a la siguiente etapa' ;
            $espectaculo->fecha_actuacion = $date;
            $espectaculo->estado_solicitud = 'PAGO_REALIZADO';                 
            $espectaculo->save(); 

           $updateNit= NitEspectaculos::where("espectaculo_id", $solicitud->espectaculo_id)->update(["estado" => "PAGO-FINALIZADO"]);
              
            
           }
           

        }
      }
        
    }
}

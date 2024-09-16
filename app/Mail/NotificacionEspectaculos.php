<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionEspectaculos extends Mailable
{
    use Queueable, SerializesModels;
    public $detalleCorreo;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalleCorreo)
    {
        $this->detalleCorreo = $detalleCorreo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->detalleCorreo['documento'] == 'NO'){
            return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_espectaculos');
            }else if($this->detalleCorreo['documento'] == 'SI'){
                $path = public_path('storage/documentos_espectaculos/'.$this->detalleCorreo['radicado'].'/ACTO-ADMINISTRATIVO-RAD-'.$this->detalleCorreo['radicado'].'.pdf');
                return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_espectaculos')->attach($path);
            }else if($this->detalleCorreo['documento'] == 'SI-DEVOLUCION'){
                $path = public_path('storage/documentos_espectaculos/'.$this->detalleCorreo['radicado'].'/DEVOLUCION-GARANTIA-'.$this->detalleCorreo['radicado'].'.pdf');
                return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_espectaculos')->attach($path);
            }else{
                $path = public_path('storage/documentos_espectaculos/'.$this->detalleCorreo['radicado'].'/ACTO-ADMINISTRATIVO-REVOCADO-RAD-'.$this->detalleCorreo['radicado'].'.pdf');
                return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_espectaculos')->attach($path);

            }
    }
}

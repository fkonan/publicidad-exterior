<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnvioNotificacion extends Mailable
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
        return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion');
        }else{
            $path = public_path('storage/Respuestas/'.$this->detalleCorreo['radicado'].'/Respuesta_Solicitud-'.$this->detalleCorreo['radicado'].'.pdf');
            return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion')->attach($path);

        }
    }
}

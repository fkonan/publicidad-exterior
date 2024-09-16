<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionesRITA extends Mailable
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
            return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_rita');
            }else{
                $email =   $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_rita');
                foreach ($this->detalleCorreo['files'] as $documento) {
                    $email->attach(public_path('storage/documentos_RITA/'.$this->detalleCorreo['radicado'].'/'.$documento));
                }
                return  $email;
                    
    
            }
    }
}

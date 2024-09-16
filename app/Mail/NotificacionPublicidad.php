<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionPublicidad extends Mailable
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
      if ($this->detalleCorreo['documento'] == 'NO')
         return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_publicidad');
      //   }else if($this->detalleCorreo['documento'] == 'RT'){
      //       $path = public_path('storage/documentos_parqueaderos/'.$this->detalleCorreo['radicado'].'/Concepto_Tecnico-'.$this->detalleCorreo['radicado'].'.pdf');
      //       return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_parqueaderos')->attach($path);
      //   }else{
      //       $path = public_path('storage/documentos_parqueaderos/'.$this->detalleCorreo['radicado'].'/Acto_Administrativo_solicitiud_No-'.$this->detalleCorreo['radicado'].'.pdf');
      //       return  $this->subject($this->detalleCorreo['Subject'])->view('emails.notificacion_parqueaderos')->attach($path);

      //   }
   }
}

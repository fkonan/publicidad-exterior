<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotificacion extends Mailable
{
   use Queueable, SerializesModels;
   public $detalleCorreo;
   public $vista;

   /**
    * Create a new message instance.
    *
    * @return void
    */
   public function __construct($detalleCorreo, $vista)
   {
      $this->detalleCorreo = $detalleCorreo;
      $this->vista = $vista;
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
      $Solicitud = $this->detalleCorreo['Solicitud'];
      $Solicitud['liquidacion'] = $this->detalleCorreo['liquidacion'];
      $Solicitud['radicado'] = $this->detalleCorreo['radicado'];
      $Solicitud['PerNombre'] = $this->detalleCorreo['nombres'];
      if ($this->detalleCorreo['documento'] == 'NO') {
         return  $this->subject($this->detalleCorreo['Subject'])->view($this->vista, compact('Solicitud'));
      } else {
         $path = public_path($this->detalleCorreo['documento']);
         return  $this->subject($this->detalleCorreo['Subject'])->view($this->vista, compact('Solicitud'))->attach($path);
      }
   }
}

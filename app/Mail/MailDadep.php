<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDadep extends Mailable
{
    use Queueable, SerializesModels;
    public $detalleCorreo;
    public $vista;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detalleCorreo,$vista)
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
        $Cs = $this->detalleCorreo['Cs'];
        if($this->detalleCorreo['documento'] == 'NO'){
            return  $this->subject($this->detalleCorreo['Subject'])->view($this->vista, compact('Cs'));
		}else{
			$path = public_path($this->detalleCorreo['documento']);
			return  $this->subject($this->detalleCorreo['Subject'])->view($this->vista, compact('Cs'))->attach($path);
		}
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoDeEliminacion extends Mailable
{
    use Queueable, SerializesModels;

    
    public $subjet = 'Eliminacion de reserva';

    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.avisoEnviado'); 
    }
}
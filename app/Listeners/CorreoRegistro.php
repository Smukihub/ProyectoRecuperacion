<?php

namespace App\Listeners;

use App\Events\UsuarioRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\UnUsuarioRegistrado;
use Illuminate\Support\Facades\Mail;

class CorreoRegistro
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsuarioRegistrado  $event
     * @return void
     */
    public function handle(UsuarioRegistrado $event)
    {
        // Mail::to('correo@destino.com')->send(new UnUsuarioRegistrado());
    }
}

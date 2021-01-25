<?php

namespace App\Listeners;

use App\Events\UsuarioRegistrado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Bitacora;

class AuditarRegistro
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
        $regisro = Bitacora::create([
            'quien'  => $event->usuario->nombre,
            'accion' => 'Se registro',
            'que'    => $event->ip
        ]);        
    }
}

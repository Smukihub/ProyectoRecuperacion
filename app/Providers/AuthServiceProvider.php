<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Usuario;
use App\Models\Pregunta;
use App\Models\Producto;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Producto' => 'App\Policies\ProductoPolicy',
        'App\Models\Pregunta' => 'App\Policies\PreguntaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('comprar', function ($user, Producto $producto) {
            return $user->rol == "Cliente" && $producto->usuario_id != $user->id;
        });



    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre','descripcion','imagen','activa'];
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
    public function concesionados()
    {
        return $this->hasMany('App\Models\Producto')->where('concesionado',1);
    }

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
     //   'saved' => UserSaved::class,
     //   'deleted' => UserDeleted::class,
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $whit = ['producto'];
    protected $fillable = ['producto_id','usuario_id','referencia'];
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
    public function comprador(){
        return $this->belongsTo('App\Models\Usuario','usuario_id','id');
    }
}

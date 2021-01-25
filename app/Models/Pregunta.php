<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pregunta extends Model
{
    public $timestamps = false;
    protected $fillable = ['producto_id', 'pregunta', 'hora_p', 'quien_p', 'p_autorizada', 'respuesta', 'r_autorizada'];

    public function quien(){
        return $this->hasOne('App\Models\Usuario','id','quien_p');
    }
    public function producto(){
        return $this->hasOne('App\Models\Producto','id','producto_id');
    }

}

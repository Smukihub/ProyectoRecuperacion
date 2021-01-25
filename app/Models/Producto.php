<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre','descripcion','precio','imagen','usuario_id','categoria_id','concesionado','motivo'];

    public function propietario(){
        return $this->hasOne('App\Models\Usuario','id','usuario_id');
    }

    public function preguntas(){
        return $this->hasMany('App\Models\Pregunta');//,'id','producto_id');
        //whereNotNull('p_autorizada')
    }
    public function categoria(){
        return $this->hasMany('App\Models\Categoria','id','categoria_id');
    }

    public function estaConcesionado(){
        if($this->concesionado)
            return "SI";
        else
            return "No";
    }

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');
    }
    public function fotos(){
        return $this->hasMany('App\Models\Foto');
    }
    public function ventas(){
        return $this->hasMany('App\Models\Venta');
    }
}

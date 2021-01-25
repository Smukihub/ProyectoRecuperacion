<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable

{
    public $timestamps = false;
    protected $fillable = ['nombre','a_paterno','a_materno','imagen','rol','activo','password'];

    public function preguntas_sin(){
        return DB::table('preguntas')->whereNotNull('p_autorizada')
        ->whereNull('respuesta')
        ->whereIn('producto_id', DB::table('productos')->select('id')->where('usuario_id',$this->id)->get()->pluck('id'))
        ->get();
    }
    public function preguntas_ya(){
        return DB::table('preguntas')->whereNotNull('p_autorizada')
        ->whereNotNull('respuesta')
        ->whereIn('producto_id', DB::table('productos')->select('id')->where('usuario_id',$this->id)->get()->pluck('id'))
        ->get();
    }

    public function respuetas_recibidas(){
        return DB::table('preguntas')
        ->where('quien_p',$this->id)
        ->whereNotNull('r_autorizada')
        ->get();
    }

    //Quien pago (Cliente comprador)
    public function pagos(){
        return $this->hasMany('App\Models\Pago','paga_id', 'id');
    }

    //a quien se le va a pagar (Cliente vendedor)
    public function cobros(){
        return $this->hasMany('App\Models\Pago','recibe_id', 'id');
    }

    //Todos los articulos que se involucran
    public function compras(){
        return $this->hasMany('App\Models\Venta');
    }
}

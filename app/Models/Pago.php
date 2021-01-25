<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = ['total','referencia','entregado','recibe_id','paga_id'];
    public function ventas(){
        return Venta::with(['producto'])->where('referencia',$this->referencia)->get();
    }
    
    //sacar todos los productos de la referencia para calcular el pago total
    public function calcularTotal(){
        $total = Producto::select('precio')->whereIn('id', function($query){
            // buscas los id de los productos en las ventas donde la referencia sea igual al del pago 
            $query
            ->from('ventas')
            ->select('producto_id')
            ->where('referencia',$this->referencia)
            ->get();
        })->sum('precio');
        $this->update([
            'total'=>$total
        ]);
    }
    public function comprador(){
        return $this->belongsTo('App\Models\Usuario','paga_id','id');
    }
    public function cobrador(){
        return $this->belongsTo('App\Models\Usuario','recibe_id','id');
    }
}


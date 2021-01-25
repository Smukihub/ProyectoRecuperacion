<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $fillable = ['imagen','producto_id'];
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}

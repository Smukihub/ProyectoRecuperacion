<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Categoria;


class ExploracionControler extends Controller
{
    public function listar_por($categoria_id){
        //procesamos la cadena buscar
        $categoria = Categoria::find($categoria_id);
        if (is_null($categoria)){
            $productos = array();
            $mensaje = "Categoria no encontrada";
        }else{
            $productos = $categoria->concesionados;
            $mensaje = "Categoria:" . $categoria->nombre;
        }
        $cad = "";
        return view('Exploracion.listar',compact('mensaje','productos','cad'));
    }

    public function busqueda(Request $request){
        $cad = $request->input('cad');
        $productos = DB::table('productos')
        ->where('nombre', 'like', "%$cad%")
        ->orWhere('descripcion', 'like', "%$cad%")
        ->where('concesionado',1)
        ->get();
        $mensaje ="";
        return view('Exploracion.listar',compact('mensaje','productos','cad'));
        

    }

}

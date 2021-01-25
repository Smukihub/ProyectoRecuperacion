<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revision;
use App\Models\Producto;


class RevisarControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $productos = Revision::all();
        $productos = Producto::where('concesionado','=',NULL)->get();
        /*Aqui podemos hacer algunas cosas, como seleccionar que productos son los que cumplen cierta 
        condicion y los listaremos por ejemplo*/

        return view('Revisiones.index',compact('productos'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Revision::find($id);
        return view('Revisiones.show',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valores = $request->all();
        if (!isset($valores['motivo'])) $valores['concesionado']=1;
        else $valores['concesionado']=0;
        $registro= Revision::find($id);
        $registro->fill($valores);
        $registro->save();
        return redirect("/Revisiones")->with('mensaje','Revision realizada');
    }
}

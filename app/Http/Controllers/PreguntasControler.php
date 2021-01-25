<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Producto;
use App\Models\Pregunta;

class PreguntasControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null(Auth::user())) die;
        switch (Auth::user()->rol) {
            case 'Encargado':
                $query="(
                    SELECT preguntas.id, imagen, 'PREGUNTA' as tipo, pregunta as cuestion 
                    FROM preguntas JOIN productos ON preguntas.producto_id = productos.id 
                    WHERE p_autorizada IS NULL
                )UNION(
                    SELECT preguntas.id, imagen, 'RESPUESTA' as tipo, respuesta as cuestion 
                    FROM preguntas JOIN productos ON preguntas.producto_id = productos.id 
                    WHERE respuesta IS NOT NULL and r_autorizada IS NULL
                )";
                break;

            case 'Cliente':
                $id= Auth::id();
                $query="(
                    SELECT preguntas.id, imagen, 'PREGUNTA' as tipo, pregunta as cuestion 
                    FROM preguntas JOIN productos ON preguntas.producto_id = productos.id 
                    WHERE p_autorizada IS NOT NULL and productos.usuario_id = $id
                )UNION(
                    SELECT preguntas.id, imagen, 'RESPUESTA' as tipo, respuesta as cuestion 
                    FROM preguntas JOIN productos ON preguntas.producto_id = productos.id 
                    WHERE respuesta IS NOT NULL and r_autorizada IS NULL and preguntas.quien_p = $id
                )";
                break;
        }
        $comentarios = DB::select($query);         

        return view('Preguntas.index',compact('comentarios'));
    }


    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $producto = Producto::find($id);
        if(is_null($producto) ) return "UPSS, PRODUCTO NO ENCONTRADO.";
        return view('Preguntas.create',compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request->all();
        $valores['quien_p']=Auth::id();
        $registro = new Pregunta();
        $registro->fill($valores);
        $registro->save();

        return redirect("/");
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //moderar
    {
        $pregunta = Pregunta::find($id);
        return view('Preguntas.edit',compact('pregunta'));
    }
 
    public function show($id) //responder
    {
        $pregunta = Pregunta::find($id);
        return view('Preguntas.responder',compact('pregunta'));
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

        $registro = Pregunta::find($id);
        if ($request->user()->rol == "Encargado")
            if (is_null($registro->p_autorizada))
                $valores['p_autorizada']= date('Y-m-d  H:i:s');
            else 
                $valores['r_autorizada']= date('Y-m-d  H:i:s');


        $registro->fill($valores);
        $registro->save();

        return redirect("/Preguntas")->with('mensaje','Cuestion actualizada correctamente');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //podemos hacer validaciones para borrar o no
        try {
            $registro = Pregunta::find($id);
            $registro->delete();
            return redirect("/Preguntas")->with('mensaje','Pregunta modificado correctamente');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect("/Preguntas")->with('error',$e->getMessage());
        }
       
    }

}
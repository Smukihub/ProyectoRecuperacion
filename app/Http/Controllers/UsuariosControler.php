<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;


class UsuariosControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = Usuario::all();

        /*Aqui podemos hacer algunas cosas, como seleccionar que usuarios son los que cumplen cierta
        condicion y los listaremos por ejemplo*/

        return view('Usuarios.index',compact('usuarios'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Usuarios.create');
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
        if ($valores['password']!=$valores['password2'])
            return redirect()->back()->with('error','El password no esta bien confirmado');

        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino, $nombre_de_archivo);
            $valores['imagen']=$nombre_de_archivo;
        }

        $valores['password']=Hash::make( $valores['password'] );

        $registro = new Usuario();
        $registro->fill($valores);
        $registro->save();

        return redirect("/Usuarios")->with('mensaje','Usuario agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);
        return view('Usuarios.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        return view('Usuarios.edit',compact('usuario'));
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

        if(isset($valores['password2']))
            if ($valores['password']!=$valores['password2'])
                return redirect()->back()->with('error','El password no esta bien confirmado');


        if(isset($valores['password']))
        //si el password esta en blanco no lo actualizaremos
        if( is_null($valores['password']))
            unset($valores['password']);
        else
            $valores['password']=Hash::make( $valores['password'] );

        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino, $nombre_de_archivo);
            $valores['imagen']=$nombre_de_archivo;
        }

        $registro = Usuario::find($id);
        $registro->fill($valores);
        $registro->save();


        return redirect("/Usuarios")->with('mensaje','Usuario modificado correctamente');

    }
   //    return;

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
            $registro = Usuario::find($id);
            $registro->delete();
            return redirect("/Usuarios")->with('mensaje','Usuario modificado correctamente');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect("/Usuarios")->with('error',$e->getMessage());
        }

    }
    public function historial(){
        $user = auth()->user();
        return view('Productos.historial',[
            'ventas'=> $user->compras
        ]);
    }
}

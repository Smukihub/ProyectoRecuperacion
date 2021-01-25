<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Foto;
use App\Models\Venta;
use Carbon\Carbon;

class ProductosControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->rol=="Supervisor") $productos = Producto::all();
        else $productos = Producto::where('usuario_id',Auth::id())->get();

        /*Aqui podemos hacer algunas cosas, como seleccionar que productos son los que cumplen cierta
        condicion y los listaremos por ejemplo*/

        return view('Productos.index',compact('productos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('Productos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request->except(['imagen']);

        $valores['usuario_id']=Auth::id();
        $producto = Producto::create($valores);

        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            foreach ($imagen as $img) {
                $ruta_destino = public_path('prods/');
                $nombre_de_archivo = $img->getClientOriginalName();
                $img->move($ruta_destino, $nombre_de_archivo);
                // $valores['imagen']=$nombre_de_archivo;
                Foto::create([
                    'imagen'=>$nombre_de_archivo,
                    'producto_id'=>$producto->id
                ]);
            }
        }
        return redirect("/Productos")->with('mensaje','Producto agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('Productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('Productos.edit',compact('producto','categorias'));
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
        $valores['usuario_id']=Auth::id();
        $registro = Producto::find($id);

        $valores = $request->except(['imagen','concesionado']);
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            foreach ($imagen as $img) {
                $ruta_destino = public_path('fotos/');
                $nombre_de_archivo = $img->getClientOriginalName();
                $img->move($ruta_destino, $nombre_de_archivo);
                $valores['imagen']=$nombre_de_archivo;
                Foto::create([
                    'imagen'=>$nombre_de_archivo,
                    'producto_id'=>$registro->id
                ]);
            }
        }
        $registro->update($valores);

        if($registro->concesionado==0)
        {
            $registro->update(['concesionado'=>NULL]);
        }
        // $registro->fill($valores);
        // $registro->save();


        return redirect("/Productos")->with('mensaje','Producto modificado correctamente');

    }

    public function updateImagen(Request $request, Foto $foto){
        if($foto->producto->concesionado == NULL || $foto->producto->concesionado == 0){
            $img = $request->file('imagen');
            $ruta_destino = public_path('prods/');
            $nombre_de_archivo = $img->getClientOriginalName();
            $img->move($ruta_destino, $nombre_de_archivo);
            $foto->update([
                'imagen'=>$nombre_de_archivo
            ]);
            if($registro->concesionado==0)
            {
                $registro->update(['concesionado'=>NULL]);
            }
            return redirect('/Productos')->with('mensaje','Imagen Actualizada');
        } else {
            return redirect('/Productos')->with('mensaje','Producto concesionado no se puede actualizar!');
        }
    }
    public function deleteImagen(Foto $foto){
        if($foto){
            $foto->delete();
            return redirect('/Productos')->with('mensaje','Foto Eliminada');
        }else{
            return redirect('/Productos')->with('mensaje','Foto NO Existe');
        }
    }
    public function createImagen(Request $request){
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            foreach ($imagen as $img) {
                $ruta_destino = public_path('prods/');
                $nombre_de_archivo = $img->getClientOriginalName();
                $img->move($ruta_destino, $nombre_de_archivo);
                // $valores['imagen']=$nombre_de_archivo;
                Foto::create([
                    'imagen'=>$nombre_de_archivo,
                    'producto_id'=>$request->producto_id
                ]);
            }
            return redirect('/Productos')->with('mensaje','Fotos Agregadas');
        }else {
            return redirect('/Productos')->with('mensaje','Error al agregar las fotos');
        }

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
            $registro = Producto::find($id);
            $registro->delete();
            return redirect("/Productos")->with('mensaje','Producto modificado correctamente');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect("/Productos")->with('error',$e->getMessage());
        }

    }
    public function comprar(Producto $producto){
        Venta::create([
            'usuario_id'=>auth()->user()->id,
            'referencia'=>Carbon::now()->format('Ymd').'-'.auth()->user()->id.'-'.$producto->propietario->id,
            'producto_id'=>$producto->id
        ]);
        return redirect("Productos/historial")->with('mensaje','Se agrego a la lista de compras');
    }
}

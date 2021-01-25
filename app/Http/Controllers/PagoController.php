<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pagos.index',[
            'pagos'=>Pago::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Funcion para manejar los pagos del contador, Punto 3
    public function entregado(Request $request)
    {
        $pago = Pago::find($request->pago_id);
        $pago->update([
            'entregado'=> !$pago->entregado
        ]);
        return response()->json([
            'pago'=>$pago,
            'pagos'=>Pago::with(['cobrador','comprador'])->get(),
            'mensaje'=>'Pago actualizado'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //funcion para que el contador guarde los pagos, Punto 2
        // return response()->json(['referencia'=> $request->referenica]);
        $request['total'] = 0;
        $request['entregado'] = false;
        $pago = Pago::create($request->all());
        $pago->calcularTotal();
        $ventas = $pago->ventas();
        return response()->json([
            'mensaje'=>'Realizado',
            'pago'=> $pago,
            'ventas'=>$ventas,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}

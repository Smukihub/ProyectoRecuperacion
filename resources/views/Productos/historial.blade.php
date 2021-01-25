@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active">Historial de Compras</li>
@endsection


@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Vendedor</th>
                <th>Comprador</th>
                <th>Referencia</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td scope="row">
                        {{$venta->producto->nombre}}
                    </td>
                    <td scope="row">
                        {{$venta->producto->propietario->nombre}}
                    </td>
                    <td>
                        {{$venta->comprador->nombre}}
                    </td>
                    <td>
                        {{$venta->referencia}}
                    </td>
                    <td>
                        {{$venta->producto->precio}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

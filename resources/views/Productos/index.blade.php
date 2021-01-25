@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Listar</li>
@endsection


@section('content')
@if (session('mensaje'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@can('create', App\Models\Producto::class)
   <a href="Productos/create" class="btn btn-primary form-control" >Proponer</a>
@endcan

<table border="1" class="table table-striped">
<thead class="thead-dark">
        <th>Producto</th>
        <th>Precio</th>
        <th>Acciones</th>
</thead>
<tbody class="thead-light">
    @forelse ($productos as $producto)
        <tr @if (is_null($producto->concesionado))
                class="bg-dark text-white"
            @else
                @if ($producto->concesionado==0)
                    class="text-warning"
                @else
                    class="text-success"
                @endif
            @endif
        >
            <td>
                {{$producto->nombre}}
                @foreach($producto->fotos as $foto)
                    <img src="/prods/{{$foto->imagen}}" width="50">
                @endforeach
            </td>
            <td style="text-align:right">$ {{$producto->precio}}</td>
            <td>
                <a href="/Productos/{{$producto->id}}/edit" class="btn btn-success">Editar</a>
                <a href="/Productos/{{$producto->id}}" class="btn btn-warning">Mostrar</a>
                @can('delete', $producto)
                <form action="/Productos/{{$producto->id}}" method="post" style="display: inline;"  onsubmit="return confirm('Desea eliminar');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endcan
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Sin productos registrados</td>
        </tr>
    @endforelse
</tbody>
</table>

<table border="1">
    <tr>
        <td>NOMENCLATURA</td>
    </tr>

    <tr class="bg-dark text-white">
        <td>producto nuevo que fue propuesto pero no ha sido revisado</td>
    </tr>
    <tr class="text-warning">
        <td>Producto que fue rechazado, pero tiene observaciones</td>
    </tr>
    <tr class="text-success">
        <td>Prodcuto que fue aceptado.</td>
    </tr>
</table>
@endsection

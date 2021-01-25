@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Revisiones">Revisiones</a></li>
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

<table border="1" class="table table-striped">
<thead class="thead-dark">
        <th>Producto</th>
        <th>Precio</th>
        <th>Acciones</th>
</thead>
<tbody class="thead-light">
    @forelse ($productos as $producto)
        <tr>
            <td>{{$producto->nombre}} 
                @if ($producto->fotos)     
                    @foreach ($producto->fotos as $foto)
                        <img src="/prods/{{$foto->imagen}}" width="50" >
                    @endforeach
                @endif
            </td>
            <td style="text-align:right">$ {{$producto->precio}}</td>
            <td>
                <a href="/Revisiones/{{$producto->id}}" class="btn btn-warning">Revisar</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Sin propuestas para revisar</td>
        </tr>
    @endforelse
</tbody> 
</table>
@endsection
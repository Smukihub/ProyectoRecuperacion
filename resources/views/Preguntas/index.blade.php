@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Preguntas">Preguntas o Respuestas</a></li>
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
        <th>Comentario</th>
        <th>Acciones</th>
</thead>
<tbody class="thead-light">

@forelse ($comentarios as $comentario)
        <tr 
            @if ($comentario->tipo=="PREGUNTA")
                class="text-info"
            @else
                class="text-warning"                
            @endif
        >
            <td>
                 <img src="/prods/{{$comentario->imagen}}" width="50" >
            </td>
            <td>
                {{$comentario->tipo}}:{{$comentario->cuestion}}                
            </td>
            <td>
                @can('moderar', App\Models\Pregunta::class)
                <a href="/Preguntas/{{$comentario->id}}/edit" class="btn btn-success">Moderar</a>
                @endcan

                @can('responder', App\Models\Pregunta::find($comentario->id))
                <a href="/Preguntas/{{$comentario->id}}" class="btn btn-success">Responder</a>
                @endcan
             
                @can('delete', App\Models\Pregunta::class)
                <form action="/Preguntas/{{$comentario->id}}" method="post" style="display: inline;"  onsubmit="return confirm('Desea eliminar');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endcan
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Sin comentarios registradas</td>
        </tr>
    @endforelse
 </tbody> 
</table>
@endsection
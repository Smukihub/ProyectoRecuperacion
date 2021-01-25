@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Mostrar</li>
@endsection

@section('content')
<div class="row">
    <div class="col">Nombre:</div>
    <div class="col bg-light">{{$producto->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Descripcion:</div>
    <div class="col bg-light">{{$producto->descripcion}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Precio:</div>
    <div class="col bg-light">${{$producto->precio}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Imagen:</div>
    @foreach($producto->fotos as $foto)
        <div class="col bg-light"><img src="/prods/{{$foto->imagen}}" alt="" class="img-thumnail" width="200px"></div>
    @endforeach
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Propietario:</div>
    <div class="col bg-light">{{$producto->propietario->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Categoria:</div>
    <div class="col bg-light">{{$producto->categoria[0]->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div><div class="row">
    <div class="col">Concesionado:</div>
    <div class="col bg-light">{{$producto->estaConcesionado()}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
@if (!is_null($producto->concesionado) && $producto->concesionado==0)
<div class="alert alert-danger" role="alert">
  Motivo por el cual no fue aceptado: {{$producto->motivo}}
</div>
@endif

@forelse ($producto->preguntas as $pregunta)
{{" "}}
    @if (!is_null($pregunta->p_autorizada))
        <div class="alert alert-info" role="alert">
            {{$pregunta->quien->nombre}} pregunto <small class="text-muted initialism">{{$pregunta->hora_p}}</small> : {{$pregunta->pregunta}}
            @if (!is_null($pregunta->r_autorizada))
                <div class="alert alert-warning" role="alert">
                    {{$pregunta->respuesta}}
                </div>
            @endif
        </div>
    @endif
@empty
    Se el primero en preguntar....
@endforelse

<div class="d-flex justify-content-between align-items-center">
    <div class="btn-group">
        @if (Gate::allows('comprar',$producto))
            <a class="btn btn-lg btn-outline-success"  href="/Comprar/{{$producto->id}}">Comprar</a>
        @endif

        @if (Gate::allows('preguntar',$producto))
            <a class="btn btn-lg btn-outline-success"  href="/Preguntar/{{$producto->id}}">Preguntar</a>
        @endif
    </div>
</div>
@endsection

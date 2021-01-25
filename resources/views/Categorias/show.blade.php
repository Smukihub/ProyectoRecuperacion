@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Categorias">Categorias</a></li>
<li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')

<div class="row">
    <div class="col">Nombre de la categoria:</div>
    <div class="col bg-light">{{$categoria->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Descripcion de la categoria:</div>
    <div class="col bg-light">{{$categoria->descripcion}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Imagen:</div>
    <div class="col bg-light"><img src="/secciones/{{$categoria->imagen}}" alt="" class="img-thumnail" width="200"></div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Activa:</div>
    <div class="col bg-light">
    @if ($categoria->activa == 1 )
        SI
    @else
        NO
    @endif    
    </div>
    <div class="col"></div>
    <div class="col"></div>
</div>





  

@endsection
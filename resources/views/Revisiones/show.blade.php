@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Revisiones">Revisiones</a></li>
<li class="breadcrumb-item active" aria-current="page">Revisar</li>
@endsection

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/Revisiones/{{$producto->id}}" method="post" enctype="multipart/form-data" style="display: inline;" >
    @csrf
    @method('PUT')

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
    <div class="col bg-light"><img src="/prods/{{$producto->imagen}}" alt="" class="img-thumnail"></div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Propietario:</div>
    <div class="col bg-light">{{$producto->propietario->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div><div class="row">
    <div class="col">Categoria:</div>
    <div class="col bg-light">{{$producto->categoria[0]->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="alert alert-info" role="alert">
   Motivo si se rechaza: <textarea name="motivo" class="form-control" rows="2"></textarea>
</div>
  <button type="submit" class="btn btn-danger">Rechazar</button>

</form>
<form action="/Revisiones/{{$producto->id}}" method="post" enctype="multipart/form-data" style="display: inline;" >
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">Concesionar</button>
  </form>
  
@endsection 
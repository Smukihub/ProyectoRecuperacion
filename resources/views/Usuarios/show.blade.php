@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Usuarios">Usuarios</a></li>
<li class="breadcrumb-item active" aria-current="page">Mostrar</li>
@endsection

@section('content')
<div class="row">
    <div class="col">Nombre del usuario:</div>
    <div class="col bg-light">{{$usuario->nombre}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Apellido paterno:</div>
    <div class="col bg-light">{{$usuario->a_paterno}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Apellido materno:</div>
    <div class="col bg-light">{{$usuario->a_materno}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Imagen:</div>
    <div class="col bg-light"><img src="/fotos/{{$usuario->imagen}}" alt="" class="img-thumnail"></div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<div class="row">
    <div class="col">Tipo de usuario:</div>
    <div class="col bg-light">{{$usuario->rol}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
@endsection 
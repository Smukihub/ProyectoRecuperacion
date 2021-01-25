@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Preguntas">Preguntas</a></li>
<li class="breadcrumb-item active" aria-current="page">Moderar</li>
@endsection

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/Preguntas/{{$pregunta->id}}" method="post" enctype="multipart/form-data" style="display: inline;" >
    @csrf
    @method('PUT')

    <div class="row">
      <div class="col">Descripcion:</div>
      <div class="col bg-light">{{$pregunta->producto->descripcion}}</div>
      <div class="col"></div>
      <div class="col"></div>
  </div>
  <div class="row">
      <div class="col">Precio:</div>
      <div class="col bg-light">${{$pregunta->producto->precio}}</div>
      <div class="col"></div>
      <div class="col"></div>
  </div>
  <div class="row">
      <div class="col">Imagen:</div>
      <div class="col bg-light"><img src="/prods/{{$pregunta->producto->imagen}}" alt="" class="img-thumnail"></div>
      <div class="col"></div>
      <div class="col"></div>
  </div>
  <div class="row">
      <div class="col">Propietario:</div>
      <div class="col bg-light">{{$pregunta->producto->propietario->nombre}}</div>
      <div class="col"></div>
      <div class="col"></div>
  </div>

    <div class="alert alert-info" role="alert">
      {{$pregunta->quien->nombre}} pregunto <small class="text-muted initialism">{{$pregunta->hora_p}}</small> : {{$pregunta->pregunta}}
      <div class="alert alert-warning" role="alert">
        Respuesta:
        <textarea name="respuesta" class="form-control" rows="3">{{$pregunta->respuesta}}</textarea>
      </div>  
    </div>        
    <input type="submit" class="btn btn-success" value="Responder">    
</form>
@endsection
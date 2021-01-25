@extends('layout.general')
@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Preguntas">Preguntas</a></li>
<li class="breadcrumb-item active">Preguntar</li>
@endsection
@section('content')
<form action="/Preguntas" method="post" enctype="multipart/form-data" >
  @csrf
  <div class="row">
      <div class="col">Imagen:</div>
      <div class="col bg-light"><img src="/prods/{{$producto->imagen}}" alt="" class="img-thumnail"></div>
      <div class="col"></div>
      <div class="col"></div>
  </div>
  <div class="row">
    <div class="col">Precio:</div>
    <div class="col bg-light">${{$producto->precio}}</div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<input type="hidden" name="producto_id" value="{{$producto->id}}">
<div class="form-group">
  <label>Pregunta:</label>
  <textarea name="pregunta" class="form-control" rows="2"></textarea>
</div>
<input type="submit" class="btn btn-primary" value="Preguntar">
</form>
@endsection
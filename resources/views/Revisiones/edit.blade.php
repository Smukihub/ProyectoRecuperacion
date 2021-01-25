@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/Productos/{{$producto->id}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nombre:</label>
     <input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}">
    </div>
      <div class="form-group">
        <label>Descripcion: </label>
        <textarea class="form-control" name="descripcion" rows="3">{{$producto->descripcion}}</textarea>
      </div>
      <div class="input-group">
        <label >Precio:</label>
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input type="text" name="precio" class="form-control" value="{{$producto->precio}}">
        <div class="input-group-append">
          <span class="input-group-text">.00</span>
        </div>
      </div>
  
      <div class="form-group">
          <label for="imagen">Imagen:</label>
          <img src="/prods/{{$producto->imagen}}" alt=""  width="200" class="img-thumnail">
          <input type="file" name="imagen" id="imagen">
      </div>
      <input type="hidden" name="usuario_id" value="{{Auth::id()}}">
      <div class="form-group">
        <label>Categoria:</label>
        <select name="categoria_id">
          @foreach ($categorias as $categoria)
              <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
          @endforeach
        </select>
    </div>  
    @if (!is_null($producto->concesionado) && $producto->concesionado==0)
    <div class="alert alert-danger" role="alert">
      Motivo por el cual no fue aceptado: {{$producto->motivo}}
    </div>
    @endif
  
    <input type="submit" class="btn btn-primary" value="Enviar">    
</form>
@endsection
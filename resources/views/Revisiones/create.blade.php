@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Productos">Productos</a></li>
<li class="breadcrumb-item active">Proponer</li>
@endsection


@section('content')

<form action="/Productos" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
      <label>Nombre:</label>
      <input type="text" name="nombre" class="form-control">
    </div>
    <div class="form-group">
      <label>Descripcion: </label>
      <textarea class="form-control" name="descripcion" rows="5"></textarea>
    </div>
    <div class="input-group">
      <label >Precio:</label>
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="text" name="precio" class="form-control">
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen">
    </div>


    <div class="form-group">
      <label>Categoria:</label>
      <select name="categoria_id">
        @foreach ($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
        @endforeach
      </select>
  </div>  



    <input type="submit" class="btn btn-primary" value="Enviar">
</form>

  

@endsection
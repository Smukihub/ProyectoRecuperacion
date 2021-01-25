@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Categorias">Categorias</a></li>
<li class="breadcrumb-item active">Crear</li>
@endsection


@section('content')

<form action="/Categorias" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
      <label >Nombre de la sección:</label>
      <input type="text" name="nombre" class="form-control">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Descripcion de la sección: </label>
      <textarea class="form-control" name="descripcion" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen de la seccion:</label>
        <input type="file" name="imagen" id="imagen">
    </div>

    <input type="submit" class="btn btn-primary" value="Enviar">
</form>

  

@endsection
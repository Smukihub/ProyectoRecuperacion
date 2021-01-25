@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Categorias">Categorias</a></li>
<li class="breadcrumb-item active"  >Editar</li>
@endsection

@section('content')
<form action="/Categorias/{{$categoria->id}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre de la categoria:</label>
        <input id="nombre" type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}">
    </div>

    <div class="form-group">
        <label for="a_materno">Descripcion de la categoria:</label>
        <textarea class="form-control" name="descripcion" rows="5">{{$categoria->descripcion}}</textarea>        
    </div>
    <div class="form-group">
        <label for="imagen">Imagen de la categoria:</label>
        <img src="/secciones/{{$categoria->imagen}}" alt="" width="200" class="img-thumnail">
        <input type="file" name="imagen" id="imagen">
    </div>
    <div class="form-group">
        <label >Activa:</label>
        <select name="activa">
            @if ($categoria->activa == 0 )
                <option selected value="0">NO</option>
            @else
                <option value="0">NO</option>
            @endif
            @if ($categoria->activa == 1 )
                <option selected value="1">SI</option>
            @else
                <option value="1">SI</option>
            @endif
        </select>
    </div>  
    <input type="submit" class="btn btn-primary" value="Enviar">
</form>

  

@endsection
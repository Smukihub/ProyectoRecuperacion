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

    @can('cambios', $producto)
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
    @else
        <div class="form-group">
            Descripcion: {{$producto->descripcion}}
        </div>

        <div class="input-group">
        Precio: ${{$producto->precio}}.00
        </div>
    @endcan

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
@can('cambios', $producto)
    @if($producto->fotos)
        @foreach ($producto->fotos as $foto)
            <form action="/Productos/fotos/{{$foto->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        Imagen
                    </div>
                    <div class="body">
                        <img src="/prods/{{$foto->imagen}}" alt=""  width="200" class="img-thumnail">
                        <div class="form-group">
                            <label for="imagen">Nueva imagen:</label>
                            <input type="file" name="imagen" id="imagen">
                        </div>
                    </div>
                    <div class="footer">
                        <button class="btn btn-primary" type="submit">
                            Actualizar
                        </button>
                    </div>
                </div>
            </form>
            <form action="/Productos/fotos/{{$foto->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">X</button>
            </form>
        @endforeach
    @endif
@else
    <div class="card">
        <div class="card-header">
            Imagenes Del Producto
        </div>
        <div class="card-body">
            @foreach ($producto->fotos as $foto)
                <img src="/prods/{{$foto->imagen}}" alt=""  width="200" class="img-thumnail">
            @endforeach
        </div>
    </div>
@endcan
<form action="/Productos/fotos" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            Agregar Imagen
        </div>
        <div class="body">
            <div class="form-group">
                <label for="imagen">Nueva imagen:</label>
                <input type="file" name="imagen[]" multiple id="imagen">
            </div>
            <input type="text" name="producto_id" hidden value="{{$producto->id}}">
        </div>
        <div class="footer">
            <button class="btn btn-primary" type="submit">
                Subir nueva imagen
            </button>
        </div>
    </div>
</form>
@endsection

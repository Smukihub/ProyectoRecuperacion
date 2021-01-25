@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Usuarios">Usuarios</a></li>
<li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/Usuarios/{{$usuario->id}}" method="post" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre del usuario:</label>
        <input id="nombre" type="text" name="nombre" class="form-control" value="{{$usuario->nombre}}">
    </div>
    <div class="form-group">
        <label for="a_paterno">Apellido paterno del usuario:</label>
        <input id="a_paterno" type="text" name="a_paterno" class="form-control" value="{{$usuario->a_paterno}}">
    </div>
    <div class="form-group">
        <label for="a_materno">Apellido materno del usuario:</label>
        <input id="a_materno" type="text" name="a_materno" class="form-control" value="{{$usuario->a_materno}}">
    </div>
    <div class="form-group">
        <label for="imagen">Imagen del usuario:</label>
        <img src="/fotos/{{$usuario->imagen}}" alt="" class="img-thumnail">
        <input type="file" name="imagen" id="imagen">
    </div>
    <div class="form-group">
        <label for="rol">Tipo de usuario:</label>
        <select name="rol" id="rol">
            @if ($usuario->rol =="Supervisor")
                <option selected>Supervisor</option>
            @else
                <option>Supervisor</option>
            @endif
            @if ($usuario->rol=="Encargado")
                <option selected>Encargado</option>
            @else
                <option>Encargado</option>
            @endif
            @if ($usuario->rol=="Contador")
                <option selected>Contador</option>
            @else
                <option>Contador</option>
            @endif
            @if ($usuario->rol=="Cliente")
                <option selected>Cliente</option>
            @else
                <option>Cliente</option>
            @endif
        </select>
    </div>  
    <div class="form-group">
        <label for="password">Password del usuario:</label>
        <input id="password" type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password2">Repita el password:</label>
        <input id="password2" type="password" name="password2" class="form-control">
    </div>
    <input type="submit" class="btn btn-primary" value="Enviar">    
</form>
@endsection
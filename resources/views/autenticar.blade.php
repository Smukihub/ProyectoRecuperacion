@extends('layout.general')

    
@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
@endif
<br>
<form action="/validar" method="post">
    @csrf
    Usuario:   <input type="text" name="usuario"><br>
    Contraseña:<input type="password" name="password"><br>
    <input type="submit" value="Enviar">
</form>
@endsection

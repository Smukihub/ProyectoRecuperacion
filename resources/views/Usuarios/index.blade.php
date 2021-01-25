@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="/Usuarios">Usuarios</a></li>
<li class="breadcrumb-item active" aria-current="page">Listar</li>
@endsection


@section('content')
@if (session('mensaje'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<a href="Usuarios/create" class="btn btn-primary form-control" >Agregar Usuario</a>
<table border="1" class="table table-striped">
<thead class="thead-dark">
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Acciones</th>
</thead>
<tbody class="thead-light">
    @forelse ($usuarios as $usuario)
        <tr id="{{$usuario->id}}">
            <td>{{$usuario->nombre}} {{$usuario->apellido_paterno}} {{$usuario->apellido_paterno}}</td>
            <td class="tipo" data-original="{{$usuario->rol}}">{{$usuario->rol}}</td>
            <td>
                <a href="/Usuarios/{{$usuario->id}}/edit" class="btn btn-success">Editar</a>
                <a href="/Usuarios/{{$usuario->id}}" class="btn btn-warning">Mostrar</a>
                <form action="/Usuarios/{{$usuario->id}}" method="post" style="display: inline;"  onsubmit="return confirm('Desea eliminar');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>    
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Sin usuarios registrados</td>
        </tr>
    @endforelse
</tbody> 
</table>
@endsection

@section('escripts')
<script>
var mostrandoInput = false;
$().ready( function(){
    $(".tipo").dblclick(function() {
        if (mostrandoInput) return;
        original = this.innerText;
        var opciones = '<select name="rol" data="">';
            if (original == "Supervisor")
                opciones+='    <option selected>Supervisor</option>';
            else
                opciones+='    <option>Supervisor</option>';

            if (original == "Encargado")
                opciones+='    <option selected>Encargado</option>';
            else
                opciones+='    <option>Encargado</option>';

            if (original == "Contador")
                opciones+='    <option selected>Contador</option>';
            else
                opciones+='    <option>Contador</option>';

            if (original == "Cliente")
                opciones+='    <option selected>Cliente</option>';
            else
                opciones+='    <option>Cliente</option>';
            opciones+='</select>';
            this.innerHTML = opciones;
            mostrandoInput = true;
    });

    $(".tipo").keydown(function( event ) {
        if ( event.which == 27 ) {
            this.innerText = this.dataset["original"];
            mostrandoInput = false;
       }
        if ( event.which == 13 ) {
            var rol = this.children[0].value;
            this.innerText = "";
            axios.put('/_Usuarios/' + this.parentElement.id  , {
                _token: '{{ csrf_token() }}',
                rol: rol ,
            })
            .then(function (response) {                
                td = $("tr#" + response.data.id + ">td.tipo").text(response.data.rol);
                //.text(response.data.equipo);
                console.log(response);
            })
            .catch(function (error) {
                if(error.response.status==401)alert("Usted no ha iniciado en el sistema");
                if(error.response.status==500)alert(error.response.data.message);
                else alert(error.response.data.error);
                console.log(error);
            });
        }
    });
} );
</script>
@endsection

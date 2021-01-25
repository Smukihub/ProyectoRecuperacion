@extends('layout.general')


@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
<li class="breadcrumb-item"><a href="Categorias">Categorias</a></li>
<li class="breadcrumb-item active">Listar</li>
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

<a href="Categorias/create" class="btn btn-primary form-control" >Agregar Categoria</a>
<table border="1" class="table table-striped" id="tbl_categorias">
<thead class="thead-dark">
        <th>Nombre</th>
        <th>Productos</th>
        <th>Acciones</th>
</thead>
<tbody class="thead-light">
@forelse ($categorias as $categoria)
    <tr id="{{$categoria->id}}">
        <td>{{$categoria->nombre}}</td>
        <td>{{$categoria->concesionados->count()}}</td>
        <td>
            <a href="/Categorias/{{$categoria->id}}/edit" class="btn btn-success">Editar</a>
            <a href="/Categorias/{{$categoria->id}}" class="btn btn-warning">Mostrar</a>
            <form action="/Categorias/{{$categoria->id}}" method="post" style="display: inline;"  onsubmit="return confirm('Desea eliminar');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>    
            <button type="button" class="btn btn-danger btndel">Borrar</button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3">Sin categorias registradas</td>
    </tr>
@endforelse
</tbody> 
</table>
<form class="form-inline">
    <label class="sr-only" for="nuevo_nombre">Name</label>
    <input type="text" class="form-control mb-2 mr-sm-2" id="nuevo_nombre" placeholder="Nueva categoria....">
    <button type="button" class="btn btn-primary mb-2" id="btnadd">AGREGAR</button>
</form>

@endsection

@section('escripts')
<script>
$().ready( function(){
    $("#btnadd").click(function() {
        axios.post('/_Categorias/' , {
                _token: '{{ csrf_token() }}',
                nombre: $("#nuevo_nombre").val(),
                descripcion:".",
        })
        .then(function (response) {
            var token = '{{ csrf_token() }}';
            var fila = '';
            fila += '    <tr id="' + response.data.id + '">';
            fila += '        <td>' + response.data.nombre + '</td>';
            fila += '        <td>0</td>';
            fila += '        <td>';
            fila += '            <a href="/Categorias/' + response.data.id + '/edit" class="btn btn-success">Editar</a>';
            fila += '            <a href="/Categorias/' + response.data.id + '" class="btn btn-warning">Mostrar</a>';
            fila += '            <form action="/Categorias/' + response.data.id + '" method="post" style="display: inline;"  onsubmit="return confirm(\'Desea eliminar\');">';
            fila += '                <input type="hidden" name="_token" value="' + token + '">';
            fila += '                <input type="hidden" name="_method" value="DELETE">';
            fila += '                <button type="submit" class="btn btn-danger">Eliminar</button>';
            fila += '            </form>';
            fila += '           <button type="button" class="btn btn-danger btndel">Borrar</button>';
            fila += '        </td>';
            fila += '    </tr>';
            tabla = $("#tbl_categorias").append(fila);
            //.text(response.data.equipo);
            console.log(response);
        })
        .catch(function (error) {
            if(error.response.status==401)alert("Usted no ha iniciado en el sistema");
            if(error.response.status==500)alert(error.response.data.message);
            else alert(error.response.data.error);
            console.log(error);
        });
    });

    $("#tbl_categorias").on('click','.btndel',function() {
        if(confirm('Desea eliminar la categoria llamada ' + this.parentElement.parentElement.firstElementChild.innerText )){
            axios.delete( '/_Categorias/' + this.parentElement.parentElement.id , {
                _token: '{{ csrf_token() }}'
            })
            .then(function (response) {                
                $("tr#" + response.data.id ).remove();
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
});
</script>
@endsection


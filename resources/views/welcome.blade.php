@extends('layout.general')


@section('content')
<div class="text-center py-5">
  <div class="container">
    <div class="row my-5 justify-content-center">
      <div class="col-md-9">
        <h1>Mercado ITTG</h1>
        <p class="lead text-muted">Bienvenido a este sitio que permite realizar compras en linea, si quieres vender crea una cuenta con nostros, si quieres comprar tambien. Tenemos muchos productos en diversas categorias...</p>
      </div>

      <div class="col-12">
        @guest
          <p class="lead text-muted">Buscar.
            <div class="form-check form-check-inline">
              <form action="/busqueda" method="POST">
                  @csrf
                  <input type="search" class="form-control" name="cad" placeholder="Buscar..."  autocomplete="off" spellcheck="false" role="combobox">
              </form>
            </div>
          </p>
        @endguest
      </div>

  </div>
  </div>
</div>

<div class="py-4 bg-light" >
  <div class="container">
    <div class="row">
@foreach ($categorias as $categoria)
      <div class="col-md-4 p-3">
        <div class="card box-shadow">
          
          <img class="card-img-top" 
          @if (is_null($categoria->imagen))
            src="https://pingendo.com/assets/photos/wireframe/photo-1.jpg"
          @else
            src="/secciones/{{$categoria->imagen}}" 
          @endif          
          >
          
          <div class="card-body">
            <p class="card-text">
              <p>{{$categoria->nombre}}</p>
              <p>{{$categoria->descripcion}}</p>
              
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="/listar_por_categoria/{{$categoria->id}}" class="btn btn-lg btn-block btn-outline-secondary">Ver productos...</a>   
              </div>  
            </div>
          </div>
        </div>
      </div>
@endforeach
    </div>
  </div>
</div>
<footer class="text-muted py-5">
  <div class="container">
    <p class="float-right">
      <a href="#">Volver arriba</a>
    </p>
    <p>Sitio que usa bootstrap, jquery y LARAVE.&nbsp;
  </p>
  </div>
</footer>

@endsection
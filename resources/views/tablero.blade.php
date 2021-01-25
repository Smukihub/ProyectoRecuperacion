@extends('layout.general')

@section('breadcumb')
<li class="breadcrumb-item" ><a href="/tablero">Tablero</a></li>
@endsection
@section('content')

@switch(Auth::user()->rol)
    @case( 'Supervisor' )
    <div class="card-columns">
        <div class="card">
          <a href="/Usuarios">
            <img class="card-img-top" src="/fotos/usuarios.png" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Usuarios registrados</h5>
              <p class="card-text">Clientes: {{$clientes ?? ''}} </p>
              <p class="card-text">Empleados: {{$empleados}}</p>
            </div>
        </div>

        <div class="card">
          <a href="/Productos">
            <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Productos</h5>
              <p class="card-text">Registrados: {{$productos}}</p>
              <p class="card-text">Concesionados: {{$concesionados}}</p>
            </div>
          </div>

          <div class="card">
            <a href="/Categorias">
            <img class="card-img-top" src="/secciones/categorias.png"  height="300" alt="Card image cap">
            </a>
            <div class="card-body">
              <h5 class="card-title">Categorias</h5>
              <p class="card-text">Registradas: {{$categorias}} </p>
            </div>
          </div>
      </div>
        @break
    @case('Encargado')
    <div class="card-columns">
      <div class="card">
        <a href="/Revisiones">
          <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Propuestas</h5>
            <p class="card-text">
              A revisar: {{$propuestas ?? ''}}
            </p>
          </div>
      </div>

      <div class="card">
        <a href="/Preguntas">
          <img class="card-img-top" src="/prods/preguntas.png"  height="300" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Dudas</h5>
            <p class="card-text">
              Preguntas por revisar: {{$preguntas ?? '' ?? ''}}
            </p>
            <p class="card-text">
              Respuestas por revisar: {{$respuestas ?? ''}}
            </p>
          </div>
      </div>

    </div>
      @break
    @case('Contador')
        <div class="container">
          <div class="card shadow-sm">
            <div class="card-header">
              Registro de Pagos
            </div>
            <div class="card-body">
              <div class="form-group">
                  <select name="referencia" id="referencia" class="form-control">
                    <option selected value="0">Seleccione la referencia de la venta</option>
                    @foreach ($ventas as $venta)   
                      <option value="{{$venta->referencia}}">{{$venta->referencia}}</option>
                    @endforeach
                  </select>
                </div>
              <div class="form-group">
                <select name="paga_id" id="paga_id" class="form-control">
                  <option selected value="0"> Seleccione al Cliente</option>
                  @foreach ($compradores as $comprador)
                    <option value="{{$comprador->id}}">{{$comprador->nombre}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                  <select name="recibe_id" id="recibe_id" class="form-control">
                    <option selected value="0"> Seleccione al Vendedor</option>
                    @foreach ($vendedores as $vendedor)
                    <option value="{{$vendedor->id}}">{{$vendedor->nombre}}</option>
                  @endforeach
                  </select>
              </div>
              <hr class="py-2"> 
              <div class="form-group">
                <div class="row" id="ticket">
              </div>  
              <div class="form-group">
                <label for="">Total</label>
                <input type="number" name="total" id="total" class="form-control" disabled> 
              </div>      
            </div>
            <button class="btn btn-primary float-right my-5" id="calcular_total">Calcular</button>
            <div class="text-center text-white w-100 bg-info rounded" id="feedback"></div>
          </div>
        </div>

        //para hacer asincrono la vista de registro de pagos
          <script>
            document.addEventListener('DOMContentLoaded',()=>{
              document.getElementById('referencia').addEventListener('change',()=>{
                let referencia =  document.getElementById('referencia').value;
                let comprador_id = referencia.split('-')[1];
                let vendedor_id = referencia.split('-')[2];
                document.getElementById("paga_id").value = comprador_id;
                document.getElementById("recibe_id").value = vendedor_id;
              
              });
              document.getElementById('calcular_total').addEventListener('click',async()=>{
                let referencia =  document.getElementById('referencia').value;
                let paga =  document.getElementById('paga_id').value;
                let recibe =  document.getElementById('recibe_id').value;
                let datos = {
                  referencia : referencia,
                  paga_id: paga,
                  recibe_id: recibe,
                };
                //Peticion http
                if( referencia != 0 && paga != 0 && recibe != 0){
                  
                  // pedir a /Pagos
                  // respuesta http
                  const respuesta = await fetch('/Pagos',{
                    method:'POST',
                    body: JSON.stringify(datos),
                    headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json",
                      "X-Requested-With": "XMLHttpRequest",
                      "X-CSRF-Token": document.querySelector('input[name="_token"]').value
                    },
                  });
                  // respuesta convertida a json, se ve en consola
                  const data = await respuesta.json();
                  // respuesta en Json
                  document.getElementById('total').value = data.pago.total;
                  document.getElementById('feedback').innerText = data.mensaje;
                  // Genera el ticket
                  document.getElementById('ticket').innerHTML = vista(data);

                  //regenerar registro de pago 8) 
                  setTimeout(()=>{
                    location.reload();
                  },'5000');

                }
                else{
                  document.getElementById('feedback').innerText = 'Seleccione todos los campos';
                }
              });
            });

            //traduce la información - Ticket
            function vista(data){
              let vista = [];
                data.ventas.forEach(venta => {
                  vista.push(`
                    <div class="col-12 text-center">
                      ${venta.producto.nombre} - ${venta.producto.precio}
                    </div>
                  `);
                });
                return vista.join('');
            }
          </script>
        </div>
        @break
    @case('Cliente')
    <div class="card-columns">

      <div class="card">
        <a href="/Productos">
          <img class="card-img-top" src="/prods/productos.png" alt="Card image cap">
        </a>
          <div class="card-body">
            <h5 class="card-title">Productos</h5>
            <p class="card-text">Registrados: {{$productos ?? ''}}</p>
            <p class="card-text">Concesionados: {{$concesionados ?? ''}}</p>
          </div>
        </div>

        <div class="card">
          <a href="/Preguntas">
            <img class="card-img-top" src="/prods/preguntas.png"  height="300" alt="Card image cap">
          </a>
            <div class="card-body">
              <h5 class="card-title">Dudas</h5>
              <p class="card-text">
                Preguntas por contestar: {{$preguntas ?? ''}}
              </p>
              <p class="card-text">
                Respuestas recibidas: {{$respuestas ?? ''}}
              </p>
            </div>
        </div>


    </div>
      @break

@endswitch



@endsection

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
  <script>
   document.addEventListener('DOMContentLoaded',function(){

   });
   function entregado(id){
      $.ajax({
        url:'{{route("pagos.entrega")}}',
        method:"POST",
        data:{
          entregado:true,
          pago_id:id,
          _token:'{{csrf_token()}}'
        },
        success: (result)=>{
          if(result.pago){
            document.getElementById('feedback').innerText = result.mensaje;
            if(result.pagos){
              let vista = [];
              // console.log(result.pagos);
              result.pagos.forEach(pago => {
                vista.push(`
                <tr id="${pago.id}">
                  <td>${pago.id}</td>
                  <td>${pago.referencia}</td>
                  <td>${pago.comprador.nombre}</td>
                  <td>${pago.cobrador.nombre}</td>
                  <td><b>${pago.total}</b></td>
                  <td id="entregado-${pago.id}">
                    <button id="btn${pago.id}}" onclick="entregado('${pago.id}}');" class="btn btn-info">${pago.entregado?'Entregado':'Entregar'}</button>
                  </td>
                </tr>
                `);
              });
              // console.log(vista);
              document.getElementById('pagos-tabla').innerHTML = vista.join('');
            }
            // document.getElementById(`entregado-${id}`).classList.add('bg-succes text-white');
          }else{
            document.getElementById('feedback').innerText = 'Error al entregar';
            // document.getElementById(`entregado-${id}`).classList.add('bg-danger text-white');
          }
        },
        error:(e)=>{
          console.log(e);
        }
      });
    }
  </script>  
  <div class="card">
    <div class="card-header">
      Pagos
    </div>
    <div class="card-body">

    </div>
    <div class="card-footer">
      <span class="w-100 bg-info text-white" id="feedback"></span>
    </div>
  </div>
  <table border="1" class="table table-striped">
    <thead class="thead-dark">
            <th>ID</th>
            <th>Referencia</th>
            <th>Comprador</th>
            <th>Vendedor</th>
            <th>Total</th>
            <th>Entregado</th>
    </thead>
    <tbody class="thead-light" id="pagos-tabla">
        @forelse ($pagos as $pago)
            <tr id="{{$pago->id}}">
                <td>{{$pago->id}}</td>
                <td>{{$pago->referencia}}</td>
                <td>{{$pago->comprador->nombre}}</td>
                <td>{{$pago->cobrador->nombre}}</td>
                <td><b>{{$pago->total}}</b></td>
                <td id="entregado-{{$pago->id}}">
                  <button id="btn{{$pago->id}}" onclick="entregado('{{$pago->id}}');" class="btn btn-info">{{$pago->entregado?'Entregado':'Entregar'}}</button>
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

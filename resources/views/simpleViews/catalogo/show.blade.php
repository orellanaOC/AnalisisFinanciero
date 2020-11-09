@extends('layouts.app', ['pageSlug' => 'catalogo'])

@section('content')
<!--incluir el css de la barra de loading (está en style.css) sino llega a servir la importación-->
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li class="alerta-error">
                        {{ $error }}&nbsp;&nbsp;<i class="tim-icons icon-alert-circle-exc"></i>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <h2 class="card-title">Catálogo de cuentas</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table tablesorter" id="tabla_catalogo_cuentas">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Padre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                <tr id="{{$cuenta->id}}" onMouseOver="ResaltarFila({{$cuenta->id}});" onMouseOut="RestablecerFila({{$cuenta->id}}, '')">
                                    <td>{{$cuenta->codigo}}</td>                                    
                                    @if ($cuenta->padre_id==null)
                                        <td><p class="text-danger">{{$cuenta->nombre}}</p></td>
                                    @else
                                        <td>{{$cuenta->nombre}}</td> 
                                    @endif
                                    <td>{{$cuenta->tipo->nombre}}</td>
                                    <td>
                                        @if ($cuenta->padre_id==null)
                                            -
                                        @else
                                            @foreach ($cuentas as $cuenta2)
                                               @if ($cuenta->padre_id==$cuenta2->id)
                                                    {{$cuenta2->codigo}}
                                               @endif
                                            @endforeach

                                        @endif


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

        </div>
        <div class="modal-body">
            <h6 class="text-center">Cargando...</h6>
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
        </div>

      </div>
    </div>
  </div>

@endsection

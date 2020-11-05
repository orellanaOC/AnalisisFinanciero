@extends('layouts.app', ['pageSlug' => 'catalogo'])

@section('content')
<style>


.loader {
  text-align: center;
  vertical-align: middle;
  position: relative;
  display: flex;
  background: white;
  padding: 150px;
  box-shadow: 0px 40px 60px -20px rgba(0, 0, 0, 0.2);
}

.loader span {
  display: block;
  width: 20px;
  height: 20px;
  background: #eee;
  border-radius: 50%;
  margin: 0 5px;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
}

.loader span:nth-child(2) {
  background: #f07e6e;
}

.loader span:nth-child(3) {
  background: #84cdfa;
}

.loader span:nth-child(4) {
  background: #5ad1cd;
}

.loader span:not(:last-child) {
  animation: animate 1.5s linear infinite;
}

@keyframes animate {
  0% {
    transform: translateX(0);
  }

  100% {
    transform: translateX(30px);
  }
}

.loader span:last-child {
  animation: jump 1.5s ease-in-out infinite;
}

@keyframes jump {
  0% {
    transform: translate(0, 0);
  }
  10% {
    transform: translate(10px, -10px);
  }
  20% {
    transform: translate(20px, 10px);
  }
  30% {
    transform: translate(30px, -50px);
  }
  70% {
    transform: translate(-150px, -50px);
  }
  80% {
    transform: translate(-140px, 10px);
  }
  90% {
    transform: translate(-130px, -10px);
  }
  100% {
    transform: translate(-120px, 0);
  }
}
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="card-title">Catálogo de cuentas</h2>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_auto">+ Catálogo</i></button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_manual" onclick="ejecutarBuscador({{$tipoCuenta}})">+ Cuenta</i></button>
                        </div>
                        <!-- Modal de ingreso automatica -->
                        <div class="modal fade" id="aniadir_auto" tabindex="-1" role="dialog" aria-labelledby="auto_label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="auto_label">Ingresar catálogo completo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                <a href="{{URL::signedRoute('catalogo.download')}}" class="btn btn-primary">Presione aqui para descargar plantila</a>
                                <p>Formato admitido: xlsx</p>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('catalogo.upload')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input class="form-control-file" type="file" name="archivo" accept=".xlsx">
                                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                                </div>

                                </div>
                            </div>
                        </div>
                        <!-- Modal de ingreso manual -->
                        <div class="modal fade" id="aniadir_manual" tabindex="-1" role="dialog" aria-labelledby="manual_label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('cuenta_store')}}" method="post" id="formCuenta">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="manual_label">Registrar una cuenta nueva</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="ml-auto col-md-5">
                                                    <input class="form-control" placeholder="Código" name="codigo">
                                                </div>
                                                <div class="col-md-5 mr-auto">
                                                    <input class="form-control" placeholder="Nombre de la cuenta" name="nombre">
                                                </div>
                                            </div>
                                            <p><br></p>
                                            <div class="row">
                                                <!--Seleccionador de tipo de cuenta-->
                                                <div class="ml-auto col-md-5">
                                                    <select class="form-control" name="tipoCuenta">
                                                        <option value="-1" class="selectorCorreccion">--Seleccionar un tipo--</option>
                                                        @foreach ($tipoCuenta as $tipo)
                                                        <option value="{{$tipo->id}}" class="selectorCorreccion">{{$tipo->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mr-auto col-md-5">
                                                    <!--buscador con autocompletado-->
                                                    <form autocomplete="off" action="" name="padre">
                                                        <div>
                                                            <input id="buscador" class="form-control" type="text" name="cuenta_padre" placeholder="Cuenta padre">
                                                        </div>
                                                        <input id="index_buscador" name="id_cuenta_padre" hidden>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary" form="formCuenta">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                    <!--listado de todas las cuentas registradas-->
                    <!--TODO se debe tener un seeder de las cuentas mas basicas, comunes a todas las empresas-->
                        <table class="table tablesorter" id="tabla_catalogo_cuentas">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Padre</th>
                                    <th>Acciones</th>
                                    <!--th class="text-center">
                                        Salary
                                    </th-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                <tr>
                                    <td>{{$cuenta->codigo}}</td>
                                    <td>{{$cuenta->nombre}}</td>
                                    <td>{{$cuenta->tipo->nombre}}</td>
                                    <td>
                                        @if ($cuenta->padre_id==null)
                                            Cuenta Padre
                                        @else
                                            @foreach ($cuentas as $cuenta2)
                                               @if ($cuenta->padre_id==$cuenta2->id)
                                                    {{$cuenta2->codigo}}
                                               @endif
                                            @endforeach

                                        @endif


                                    </td>
                                    <form id="formulario" method="POST" action=""><!--agregar ruta-->
                                        @csrf
                                        @method('DELETE')
                                        <!--td class="text-right"-->
                                        <td>
                                            <input hidden name="" value=""/>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-success btn-sm btn-round btn-icon" >
                                                    <i class="tim-icons icon-pencil"></i>
                                                </button>
                                                <!--boton de eliminar-->
                                                <button type="button" class="btn btn-sm btn-warning btn-round btn-icon" onclick="confirmar('')">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </div>

                                        </!--td>
                                    </form>
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

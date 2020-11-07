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
                        <div class="col-md-7">
                            <form action="" method="post">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descarte">- Descartar todo</i></button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_auto">+ Catálogo</i></button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_manual">+ Cuenta</i></button>
                            </form>

                        </div>
                        <!-- Modal descarte Catalogo -->
                        <div class="modal fade" id="descarte" tabindex="-1" role="dialog" aria-labelledby="auto_label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="auto_label">Descarte del catalogo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>¿Esta Seguro de descartar el catalogo de cuentas?</h3>
                                        <p>Recuerda que esta acción no podrá revertirse </p>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <form action="{{route('cuenta.deleteall')}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary " >SI</button>
                                    </form>

                                </div>
                                </div>
                            </div>
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
                                                    <input id="codigoCatalogo" class="form-control" placeholder="Código" name="codigo" onclick="ejecutarBuscador({{$cuentas}},'codigo', 'codigoCatalogo')">
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
                                                            <input id="buscador" class="form-control" type="text" name="cuenta_padre" placeholder="Codigo de cuenta padre" onclick="ejecutarBuscador({{$cuentas}},'codigo', 'buscador')">
                                                        </div>
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
                                            -
                                        @else
                                            @foreach ($cuentas as $cuenta2)
                                               @if ($cuenta->padre_id==$cuenta2->id)
                                                    {{$cuenta2->codigo}}
                                               @endif
                                            @endforeach

                                        @endif


                                    </td>
                                    <form id="formulario{{$cuenta->id}}" action="{{route('cuenta.destroy', $cuenta->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <!--td class="text-right"-->
                                        <td>
                                            <!--input hidden name="id_cuenta" value=""/-->
                                            <div class="btn-group" role="group">
                                                <!--boton de editar-->
                                                <button type="button" class="btn btn-success btn-sm btn-round btn-icon" data-toggle="modal" data-target="#editar_cuenta{{$cuenta->id}}">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </button>
                                                <!--boton de eliminar-->
                                                <button type="button" class="btn btn-sm btn-warning btn-round btn-icon" onclick="confirmar('formulario{{$cuenta->id}}')">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </div>

                                        </td>
                                    </form>
                                    <!--Modal de editar cuenta-->
                                    <div class="modal fade" id="editar_cuenta{{$cuenta->id}}" tabindex="-1" role="dialog" aria-labelledby="editar_label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <form id="actualizar{{$cuenta->id}}" action="{{route('cuenta_update', $cuenta->id)}}" method="post" >
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editar_label">Editar cuenta</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="ml-auto col-md-5">
                                                                <input value="{{$cuenta->codigo}}" id="codigoCatalogo{{$cuenta->id}}" class="form-control" placeholder="Código" name="codigo" onclick="ejecutarBuscador({{$cuentas}},'codigo', 'codigoCatalogo{{$cuenta->id}}')">
                                                            </div>
                                                            <div class="col-md-5 mr-auto">
                                                                <input value="{{$cuenta->nombre}}" class="form-control" placeholder="Nombre de la cuenta" name="nombre">
                                                            </div>
                                                        </div>
                                                        <p><br></p>
                                                        <div class="row">
                                                            <!--Seleccionador de tipo de cuenta-->
                                                            <div class="ml-auto col-md-5">
                                                                <select class="form-control" name="tipoCuenta">
                                                                    <option value="-1" class="selectorCorreccion">--Seleccionar un tipo--</option>
                                                                    @foreach ($tipoCuenta as $tipo)
                                                                        @if ($tipo->id==$cuenta->tipo_id)
                                                                            <option selected value="{{$tipo->id}}" class="selectorCorreccion">{{$tipo->nombre}}</option>
                                                                        @else
                                                                            <option value="{{$tipo->id}}" class="selectorCorreccion">{{$tipo->nombre}}</option>
                                                                        @endif

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @if ($cuenta->padre_id==null)
                                                            <div class="mr-auto col-md-5">
                                                                <!--buscador con autocompletado-->
                                                                    <form autocomplete="off" action="" name="padre">
                                                                        <div>
                                                                        <input id="buscadorCuenta{{$cuenta->id}}" class="form-control" type="text" name="cuenta_padre" placeholder="Codigo de cuenta padre" onclick="ejecutarBuscador({{$cuentas}},'codigo', 'buscadorCuenta{{$cuenta->id}}')">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                @foreach ($cuentas as $cuenta2)
                                                                @if ($cuenta->padre_id==$cuenta2->id)
                                                                    <div class="mr-auto col-md-5">
                                                                        <!--buscador con autocompletado-->
                                                                        <form autocomplete="off" action="" name="padre">
                                                                            <div>
                                                                                <input value="{{$cuenta2->codigo}}" id="buscadorEditarCuenta" class="form-control" type="text" name="cuenta_padre" placeholder="Codigo de cuenta padre" onclick="ejecutarBuscador({{$cuentas}},'codigo', 'buscadorEditarCuenta')">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary" form="actualizar{{$cuenta->id}}">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($cuentas)>0)
                            @if (!($empresa->catalogo_listo))
                                <form action="{{route('catalogo.confirmar')}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Confirmar Catalogo</button>
                                </form>
                            @endif


                        @endif

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

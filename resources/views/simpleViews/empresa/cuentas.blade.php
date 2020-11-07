@extends('layouts.app', ['pageSlug' => 'vincular_cuenta'])

@section('content')
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
                        <div class="col-md-12">
                            <h2 class="card-title">Vinculación de catálogo de la empresa</h2>

                        </div>
                        <div class="col-md-12">
                            <h4 class="card-title">Para realizar los análisis respectivos a tus cuentas, primero debes vincularlas a nuestra base de datos.</h4>
                            @if (!($empresa->vinculacion_listo))
                            <form action="{{route('cuenta.vinculacion')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Confirmar Vinculacion de Catalogo</button>
                            </form>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div>
                    <!--listado de todas las cuentas registradas-->
                        <table class="table tablesorter" id="tabla_catalogo_cuentas">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Establecer vínculo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                <tr>
                                    <td>{{$cuenta->nombre}}</td>
                                    <td>{{$cuenta->descripcion}}</td>
                                    <td>
                                        <!--buscador con autocompletado-->
                                        <form autocomplete="off" action="" name="padre">
                                            <div>
                                                <input id="buscador{{$cuenta->id}}" class="form-control" type="text" name="cuenta_empresa" placeholder="Cuenta de la empresa" onclick="ejecutarBuscador({{$cuentasEmpresa}}, 'nombre' , 'buscador{{$cuenta->id}}')">
                                            </div>
                                        </form>
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
@endsection

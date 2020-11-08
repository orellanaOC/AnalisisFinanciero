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
                                    <th>Guardar/Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                <tr>                                    
                                    <td>{{$cuenta->nombre}}</td>
                                    <td>{{$cuenta->descripcion}}</td>
                                    <td>
                                        <form id="vinculacion{{$cuenta->id}}" action="{{route('cuenta_sistema.vinculacion',$cuenta->id)}}" method="POST">
                                        @csrf
                                        @method('post')
                                            <!--buscador con autocompletado--> 
                                            @if ($cuenta->vinculada)
                                                <div class="mr-auto col-md-12">
                                                    <input value="{{$cuenta->cuentaCatalogo}}" id="buscador{{$cuenta->id}}" class="form-control" name="cuenta" placeholder="Cuenta de la empresa" onclick="ejecutarBuscador({{$cuentasEmpresa}},'nombre' ,'buscador{{$cuenta->id}}')">
                                                </div>
                                            @else
                                                <div class="mr-auto col-md-12">
                                                    <input id="buscador{{$cuenta->id}}" class="form-control" name="cuenta" placeholder="Cuenta de la empresa" onclick="ejecutarBuscador({{$cuentasEmpresa}},'nombre' ,'buscador{{$cuenta->id}}')">
                                                </div>
                                            @endif  
                                        </form>                                                                                
                                    </td>                                        
                                    <td>                                    
                                        <div class="btn-group" role="group">
                                        <!--boton de guardar-->
                                            <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="vinculacion{{$cuenta->id}}" >
                                                <i class="tim-icons icon-check-2"></i>
                                            </button>
                                            
                                        <!--boton de eliminar-->
                                            <button type="button" class="btn btn-warning btn-sm btn-round btn-icon" onclick="confirmar('eliminarVinculacion{{$cuenta->id}}')">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </div>
                                        <form id="eliminarVinculacion{{$cuenta->id}}" action="{{route('vinculacion.destroy',$cuenta->id)}}" method="post">
                                            @csrf
                                            @method('delete')         
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

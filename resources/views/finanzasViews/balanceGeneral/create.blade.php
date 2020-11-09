@extends('layouts.app', ['pageSlug' => 'balance_general_create'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="card-title">Registrar balance general</h2>
                            <!--TODO mostrar correlativo-->
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">Ingresa tu estado de resultados manualmente</p><br>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <!--Tabla para activos-->
                            <table class="table tablesorter tablaCustom">
                                @foreach ($cuentasEmpresa as $cuenta)
                                    @if ($cuenta->padre_id==$activo[0]->id)
                                        @foreach ($cuentasEmpresa as $cuenta2)
                                        @if ($cuenta2->padre_id==$cuenta->id)
                                        <tr>
                                            <form id="insertar{{$cuenta2->id}}" action="{{route('cuenta_periodo.store', [$periodo, $cuenta2->id])}}" method="POST">
                                                @csrf                                                
                                                <td>{{$cuenta2->codigo}}</td>
                                                <th>{{$cuenta2->nombre}}</th>
                                                <td><input value="{{$cuenta2->total}}" name="cuenta" class="form-control" type="number"></td>
                                            </form>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta2->id}}" >
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
                                        @endif
                                        @endforeach
                                        <tr>
                                            <form id="insertar{{$cuenta->id}}" action="{{route('cuenta_periodo.storePadre', [$periodo, $cuenta->id])}}" method="post">
                                                @csrf
                                                <td>{{$cuenta->codigo}}</td>
                                                <th class="text-primary">Total {{$cuenta->nombre}}</th>
                                                <td><input value="{{$cuenta->total}}" name="cuenta"  class="form-control" type="number"></td>
                                                <td>
                                            </form>                                                
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta->id}}" >
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
                                    @endif
                                    @if ($cuenta->id==$activo[0]->id)
                                    <tr>
                                        <td>{{$cuenta->codigo}}</td>
                                        <th class="text-danger">Total {{$cuenta->nombre}}</th>
                                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach                                                                    
                            </table> 
                        </div>
                            <div class="col-md-6">
                                <!--Tabla para pasivos-->
                                <table class="table tablesorter tablaCustom">
                                    @foreach ($cuentasEmpresa as $cuenta)
                                    @if ($cuenta->padre_id==$pasivo[0]->id)
                                        @foreach ($cuentasEmpresa as $cuenta2)
                                        @if ($cuenta2->padre_id==$cuenta->id)
                                        <tr>
                                            <form id="insertar{{$cuenta2->id}}" action="{{route('cuenta_periodo.store', [$periodo, $cuenta2->id])}}" method="POST">
                                                @csrf                                                
                                                <td>{{$cuenta2->codigo}}</td>
                                                <th>{{$cuenta2->nombre}}</th>
                                                <td><input value="{{$cuenta2->total}}" name="cuenta" class="form-control" type="number"></td>
                                            </form>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta2->id}}" >
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
                                        @endif
                                        @endforeach
                                        <tr>
                                            <form id="insertar{{$cuenta->id}}" action="{{route('cuenta_periodo.storePadre', [$periodo, $cuenta->id])}}" method="post">
                                                @csrf
                                                <td>{{$cuenta->codigo}}</td>
                                                <th class="text-primary">Total {{$cuenta->nombre}}</th>
                                                <td><input value="{{$cuenta->total}}" name="cuenta"  class="form-control" type="number"></td>
                                                <td>
                                            </form>                                                
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta->id}}" >
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
                                    @endif
                                    @if ($cuenta->id==$pasivo[0]->id)
                                    <tr>
                                        <td>{{$cuenta->codigo}}</td>
                                        <th class="text-danger">Total {{$cuenta->nombre}}</th>
                                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach                                                       
                                </table>
                                <!--Tabla para capital-->
                                <table class="table tablesorter tablaCustom">
                                    @foreach ($cuentasEmpresa as $cuenta)
                                    @if ($cuenta->padre_id==$capital[0]->id)
                                        @foreach ($cuentasEmpresa as $cuenta2)
                                        @if ($cuenta2->padre_id==$cuenta->id)
                                        <tr>
                                            <form id="insertar{{$cuenta2->id}}" action="{{route('cuenta_periodo.store', [$periodo, $cuenta2->id])}}" method="POST">
                                                @csrf                                                
                                                <td>{{$cuenta2->codigo}}</td>
                                                <th>{{$cuenta2->nombre}}</th>
                                                <td><input value="{{$cuenta2->total}}" name="cuenta" class="form-control" type="number"></td>
                                            </form>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta2->id}}" >
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
                                        @endif
                                        @endforeach
                                        <tr>
                                            <form id="insertar{{$cuenta->id}}" action="{{route('cuenta_periodo.storePadre', [$periodo, $cuenta->id])}}" method="post">
                                                @csrf
                                                <td>{{$cuenta->codigo}}</td>
                                                <th class="text-primary">Total {{$cuenta->nombre}}</th>
                                                <td><input value="{{$cuenta->total}}" name="cuenta"  class="form-control" type="number"></td>
                                                <td>
                                            </form>                                                
                                                <div class="btn-group" role="group">
                                                    <!--boton de guardar-->
                                                        <button type="submit" class="btn btn-success btn-sm btn-round btn-icon" form="insertar{{$cuenta->id}}" >
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
                                    @endif
                                    @if ($cuenta->id==$capital[0]->id)
                                    <tr>
                                        <td>{{$cuenta->codigo}}</td>
                                        <th class="text-danger">Total {{$cuenta->nombre}}</th>
                                        <td><input value="{{$cuenta->total}}" name="cuenta" class="form-control" type="number" disabled></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach                                                                                           
                                </table>
                            </div>
                                                
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br><p class="text-center">O puedes subir tu archivo .xlsx y cargar de una tu estado de resultados</p><br>
                        </div>
                    </div>
                    <!-- input de archivos normalito feo- name="cuenta"->
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control-file" type="file">                        
                        </div>
                    </div>

                    <!--input de archivos con estilo>
                    <div-- class="form-group form-file-upload form-file-multiple">
                        <input type="file" multiple="" class="inputFileHidden">
                        <div class="input-group">
                            <input type="text" class="form-control inputFileVisible" placeholder="Seleccionar archivo">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-fab btn-round btn-primary">
                                    <i class="tim-icons icon-attach-87"></i>
                                </button>
                            </span>
                        </div>
                    </div-->


                    <br><br>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <button class="btn btn-primary"> Guardar </button>                          
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

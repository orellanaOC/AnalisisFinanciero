@extends('layouts.app', ['pageSlug' => 'estado_de_resultados_create'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="card-title">Registrar estado de resultados</h2>
                        </div>
                    </div>
                </div>
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">Ingresa tu estado de resultados manualmente</p><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table tablesorter">
                                <form id="ERGuardar" action="{{route('estado_resultado.store', $periodo)}}" method="post">
                                    @csrf
                                    <tr>
                                        <th>+&nbsp; &nbsp; &nbsp;{{$vinculos[0][0]->nombre}}</th>
                                        <td><input value="{{$ER->ventas ?? '0'}}" name="ventas"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[1][0]->nombre}}</th>
                                        <td><input value="{{$ER->devolucion_ventas ?? '0'}}" name="devolucion_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr> 
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[2][0]->nombre}}</th>
                                        <td><input value="{{$ER->descuento_ventas ?? '0'}}" name="descuento_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr> 
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Ventas netas</th>
                                        <td><input value="{{$ER->ventas_netas ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr> 
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[3][0]->nombre}}</th>
                                        <td><input value="{{$ER->costo_ventas ?? '0'}}" name="costos_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad Bruta</th>
                                        <td><input value="{{$ER->utilidad_bruta ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[4][0]->nombre}}</th>
                                        <td><input value="{{$ER->gastos_operacion ?? '0'}}" name="gastos_operacion"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad operativa</th>
                                        <td><input value="{{$ER->utilidad_operativa ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>+&nbsp; &nbsp; &nbsp;{{$vinculos[5][0]->nombre}}</th>
                                        <td><input value="{{$ER->otros_ingresos ?? '0'}}" name="otros_ingresos"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[6][0]->nombre}}</th>
                                        <td><input value="{{$ER->otros_gastos ?? '0'}}" name="otros_gastos"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad antes de impuestos</th>
                                        <td><input value="{{$ER->utilidad_antes_de_i ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr> 
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;Impuestos sobre la renta</th>
                                        <td><input value="{{$ER->impuestos ?? '0'}}" name="impuestos"  class="form-control form-control-sm" type="number"></td>
                                    </tr> 
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilida neta</th>
                                        <td><input value="{{$ER->utilidad_neta ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                </form>                                
                            </table>                        
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br><p class="text-center">O puedes subir tu archivo .xlsx y cargar de una tu estado de resultados</p><br>
                        </div>
                    </div>
                    <!-- input de archivos normalito feo-->
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
                            <button type="submit" class="btn btn-primary" form="ERGuardar"> Guardar </button>                          
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

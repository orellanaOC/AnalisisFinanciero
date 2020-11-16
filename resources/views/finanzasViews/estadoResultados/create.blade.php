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
                                        <th>+&nbsp; &nbsp; &nbsp;{{$vinculos[0][0]->nombre ?? 'Ventas'}}</th>
                                        <td><input step="0.01" value="{{$ER->ventas ?? '0'}}" name="ventas"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[1][0]->nombre ?? 'Devolucion sobre ventas'}}</th>
                                        <td><input step="0.01" value="{{$ER->devolucion_ventas ?? '0'}}" name="devolucion_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[2][0]->nombre ?? 'Descuento sobre ventas'}}</th>
                                        <td><input step="0.01" value="{{$ER->descuento_ventas ?? '0'}}" name="descuento_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Ventas netas</th>
                                        <td><input step="0.01" value="{{$ER->ventas_netas ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[3][0]->nombre ?? 'Costo de ventas'}}</th>
                                        <td><input step="0.01" value="{{$ER->costo_ventas ?? '0'}}" name="costos_venta"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad Bruta</th>
                                        <td><input step="0.01" value="{{$ER->utilidad_bruta ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[4][0]->nombre ?? 'Gastos de operación'}}</th>
                                        <td><input step="0.01" value="{{$ER->gastos_operacion ?? '0'}}" name="gastos_operacion"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad operativa</th>
                                        <td><input step="0.01" value="{{$ER->utilidad_operativa ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>+&nbsp; &nbsp; &nbsp;{{$vinculos[5][0]->nombre ?? 'Otros ingresos'}}</th>
                                        <td><input step="0.01" value="{{$ER->otros_ingresos ?? '0'}}" name="otros_ingresos"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;{{$vinculos[6][0]->nombre ?? 'Otros gastos'}}</th>
                                        <td><input step="0.01" value="{{$ER->otros_gastos ?? '0'}}" name="otros_gastos"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilidad antes de impuestos</th>
                                        <td><input step="0.01" value="{{$ER->utilidad_antes_de_i ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                    <tr>
                                        <th>-&nbsp; &nbsp; &nbsp;Impuestos sobre la renta</th>
                                        <td><input step="0.01" value="{{$ER->impuestos ?? '0'}}" name="impuestos"  class="form-control form-control-sm" type="number"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">=&nbsp; &nbsp; &nbsp;Utilida neta</th>
                                        <td><input step="0.01" value="{{$ER->utilidad_neta ?? '0'}}" class="form-control form-control-sm" type="number" readonly></td>
                                    </tr>
                                </form>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <br><br>
                            <p >O puedes subir tu archivo .xlsx y cargar de una tu estado de resultados</p>
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_auto">+ Subir</i></button>
                        </div>
                    </div>
                     <!-- Modal de ingreso automatica -->
                     <div class="modal fade" id="aniadir_auto" tabindex="-1" role="dialog" aria-labelledby="auto_label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="auto_label">Ingresar el el estado de resultado </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <a href="{{URL::signedRoute('estado_resultado.download')}}" class="btn btn-primary">Presione aqui para descargar plantila</a>
                            <p>Formato admitido: xlsx</p>

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('estado_resultado.upload',['id_periodo'=>$periodo])}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input class="form-control-file" id="archivo" type="file" name="archivo" accept=".xlsx" required>
                                        <button disabled type="submit" class="btn btn-primary" id="botonarchivo" data-toggle="modal" data-target="#exampleModal">Guardar</button>
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
                    <!-- input step="0.01" de archivos normalito feo
                    <div class="row">
                        <div class="col-md-12">
                            <input step="0.01" class="form-control-file" type="file">
                        </div>
                    </div>-->

                    <!--input step="0.01" de archivos con estilo>
                    <div-- class="form-group form-file-upload form-file-multiple">
                        <input step="0.01" type="file" multiple="" class="input step="0.01"FileHidden">
                        <div class="input step="0.01"-group">
                            <input step="0.01" type="text" class="form-control input step="0.01"FileVisible" placeholder="Seleccionar archivo">
                            <span class="input step="0.01"-group-btn">
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
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $("#archivo").change(function(){

        $("#botonarchivo").prop("disabled", this.files.length == 0);
    });
</script>
@endsection

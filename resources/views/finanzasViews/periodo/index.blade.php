@extends('layouts.app', ['pageSlug' => 'periodo'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2 class="card-title">Períodos</h2>
                        </div>
                        <div class="col-md-2">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#aniadir_periodo">+ Período</i></button>
                        </div>
                    </div>
                    <!-- Modal de registro de nuevo periodo -->
                    <div class="modal fade" id="aniadir_periodo" tabindex="-1" role="dialog" aria-labelledby="manual_label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <!--cambiar el route -->
                                    <form action="{{route('periodo.create')}}" method="post" id="formPeriodo">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="manual_label">Agregar un nuevo período</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mr-auto ml-auto col-md-6">
                                                    <input required min="2000" id="año" type="number" class="form-control" placeholder="Año" name="anio">
                                                </div>
                                                <div class="mr-auto ml-auto col-md-6">
                                                    <input required min="1" id="acciones" type="number" class="form-control" placeholder="Cantidad de acciones" name="acciones">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="mr-auto ml-auto col-md-6">
                                                    <input step="0.01" required id="gastos_financieros" type="number" class="form-control" placeholder="Gastos financieros" name="gastos_financieros">
                                                </div>
                                                <div class="mr-auto ml-auto col-md-6">
                                                    <input step="0.01" required id="inversion" type="number" class="form-control" placeholder="Inversión inicial" name="inversion">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary" form="formPeriodo">Agregar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('error') }}
                        </div>
                    @endif
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Año</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periodos ?? '' as $periodo)
                                <tr>
                                    <td>{{$periodo->year}}</td>
                                    <td>
                                        <div class="btn-group">
                                        <!--agregar al id del formulario el id del periodo y el route-->
                                            <form id="formulario" action="{{route('periodo.delete',$periodo->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <!--Todo agregar id del periodo-->
                                                <a class="btn btn-info btn-sm" href="{{ route('balance_general_create',$periodo->id) }}">+ Balance general</a>
                                                <a class="btn btn-info btn-sm" href="{{ route('estado_resultado_create',$periodo->id) }}">+ Estado de resultados</a>
                                                <a class="btn btn-info btn-sm" href="{{ route('analisis_vertical.show', $periodo->id) }}">+ Analisis vertical</a>
                                                <button class="btn btn-danger btn-sm" type="submit">- Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection

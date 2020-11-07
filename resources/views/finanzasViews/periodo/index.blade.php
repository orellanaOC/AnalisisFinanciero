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
                                    <form action="{{route('cuenta_store')}}" method="post" id="formPeriodo">
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
                                                    <input id="año" type="number"  class="form-control" placeholder="Año" name="año">
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
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Año</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2016</td>
                                    <td>
                                        <div class="btn-group">
                                        <!--agregar al id del formulario el id del periodo y el route-->
                                            <!--form id="formulario" action="" method="post">
                                            @csrf
                                            @method('delete')-->
                                                <a class="btn btn-info btn-sm" href="{{ route('balance_general_create') }}">+ Balance general</a>
                                                <a class="btn btn-info btn-sm" href="{{ route('estado_resultado_create') }}">+ Estado de resultados</a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmar('formulario')">- Eliminar</button>
                                            <!--/form-->
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>2016</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info btn-sm btn-round">+ Balance general</button>
                                            <button class="btn btn-info btn-sm btn-round">+ Estado de resultados</button>
                                            <button class="btn btn-danger btn-sm btn-round">- Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td>2016</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">+ Balance general</button>
                                        <button class="btn btn-info btn-sm">+ Estado de resultados</button>
                                        <button class="btn btn-danger btn-sm">- Eliminar</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
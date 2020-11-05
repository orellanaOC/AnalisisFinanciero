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
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Padre</th>
                                    <th>&nbsp;</th>
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
                                    <td>
                                        <select class="form-control" name="" id="">
                                            <option class="selectorCorreccion" value="-1">--Vincular con algo--</option>
                                            <option class="selectorCorreccion" value="-1">--algo1</option>
                                            <option class="selectorCorreccion" value="-1">--algo2</option>
                                        </select>
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

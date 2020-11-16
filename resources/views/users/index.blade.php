@extends('layouts.app',['pageSlug' => 'dashboard'])
@section('title')
    Usuarios
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header ">
                <div class="row">
                    <div class="col-sm-9 text-left">
                        <h2 class="card-title"><b>Administración de Usuarios</b></h2>
                    </div>
                    <div class="col-sm-3 text-right">
                        <a role="button" class="btn btn-primary" href="{{ route('users.create')  }}">
                            <i class="tim-icons icon-simple-add"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container list-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $use) 
                                <tr>                     
                                    <td id="{{$use->id}}" onMouseOver="ResaltarFila({{$use->id}});" onMouseOut="RestablecerFila({{$use->id}}, '')" onClick="CrearEnlace('{{ route('users.show', $use->id)}}');">
                                        {{$use->email}}
                                    </td>
                                    <form method="POST" id="formulario{{$use->id}}" action="{{route('users.destroy', $use->id)}}" >
                                        <td width="15%">
                                            <div class="btn-group" role="group">
                                                <a title="Configurar permisos" type="button" href="{{ route('permission.index', $use->id)}}" class="btn btn-default btn-sm btn-icon btn-round">
                                                    <i class="tim-icons icon-key-25"></i>
                                                </a>
                                                <a type="button" href="{{ route('users.edit', $use->id)}}" class="btn btn-success btn-sm btn-sm btn-icon btn-round">
                                                    <i class="tim-icons icon-pencil"></i>
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onClick="confirmar('formulario{{$use->id}}')" class="btn btn-warning btn-sm btn-icon btn-round confirmar">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button> 
                                            </div>
                                        </td>
                                    </form>
                                    <td width="5%">
                                        @isset($user)
                                            @if ($user->id == $use->id)
                                                <i class="tim-icons icon-double-right"></i>
                                            @endif
                                        @endisset
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
    @yield('opcion')
</div>
@endsection
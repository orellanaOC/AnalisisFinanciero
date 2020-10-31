@extends('users.index')  
@section('title')
    Editar usuario
@endsection
@section('opcion')
	<div class="col-6">
        <div class="card">
            <div class="card-header ">
                <div class="row">
                    <div class="col-sm-8 text-left">
                        <h2 class="card-title"><b>{{ $user->name }} </b></h2>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <body>
                        <tr>
                            <td class="font-weight-bold">Nombre</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Institucion</td>
                            <td>{{ $user->institucion }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Descripcion</td>
                            <td>{{ $user->descripcion }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Fecha Nac.</td>
                            <td>{{ $user->fecha_nac }}</td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection    
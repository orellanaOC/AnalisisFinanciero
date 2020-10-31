@extends('simpleViews.roles.index')  
@section('title')
	Role
@endsection
@section('opcion')
<div class="col-5">
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-sm-8 text-left">
                    <h2 class="card-title"><b>{{ $role->name }} </b></h2>
                </div> 
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <body>
                    <tr>
                        <td class="font-weight-bold">Nombre</td>
                        <td>{{ $role->name }}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Tipo</td>
                        <td>{{ $role->slug }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
	

@endsection

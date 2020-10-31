@extends('simpleViews.roles.index')  
@section('title')
	Nuevo Role
@endsection
@section('opcion')
<div class="col-5">
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h2 class="card-title"><b>Nuevo rol</b></h2>
                </div> 
                <div class="col-md-6 text-right">
                    <p style="color:red">Datos requeridos: *</p><br>
                </div> 
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.store')}}">
            @csrf 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="tim-icons icon-pencil"></i>
                        </div>
                    </div>
                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre del Role *') }}">
                    @include('alerts.feedback', ['field' => 'name'])
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="tim-icons icon-pencil"></i>
                        </div>
                    </div>
                    <input type="text" name="slug" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre de dominio slug *') }}">
                    @include('alerts.feedback', ['field' => 'modelo'])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Crear') }}</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection
	


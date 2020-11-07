@extends('layouts.app', ['class' => 'register-page', 'page' => __('Register Page'), 'contentClass' => 'register-page'])

@section('content')
<form class="form" method="post" action="{{ route('register') }}">
    <div class="row">
        @csrf
        <div class="ml-auto col-md-6 mr-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Datos personales</h3>
                </div>
                <div class="card-body">
                    <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-single-02"></i>
                            </div>
                        </div>
                        <input required type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}">
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input required type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo electrónico') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input required type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input required type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirmar contraseña') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-auto col-md-6 mr-auto">
            <div class="card text-right">
                <div class="card-header text-center">
                    <h3>Datos de la empresa</h3>
                </div>
                <div class="card-body">
                    <div class="input-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-bank"></i>
                            </div>
                        </div>
                        <input required name="empresa" class="form-control" placeholder="{{ __('Nombre de la empresa') }}">
                        @include('alerts.feedback', ['field' => 'empresa'])
                    </div>
                    <div class="input-group {{ $errors->has('sector') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-minimal-down"></i>
                            </div>
                        </div>
                        <select required class="form-control selectorWapis" id="sector" name="sector">
                            <option value="" selected disabled hidden>Seleccione un sector *</option>
                            @foreach ($sectores as $sector)
                                @if (old('sector')==$sector->id)                                     
                                    <option style="color: black !important;" value="{{$sector->id}}" selected>{{ $sector->nombre }}</option>
                                @else
                                    <option style="color: black !important;" value="{{$sector->id}}">{{ $sector->nombre }}</option>
                                @endif                                
                            @endforeach
                        </select>                             
                    </div>
                    <div class="input-group{{ $errors->has('nit') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-badge"></i>
                            </div>
                        </div>
                        <input required pattern="[0-9]{14}" maxlength="14" name="nit" class="form-control" placeholder="{{ __('Número de Identificación Tributaria') }}">
                        @include('alerts.feedback', ['field' => 'nit'])
                    </div>
                    <div class="input-group{{ $errors->has('nrc') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-badge"></i>
                            </div>
                        </div>
                        <input required pattern="[0-9]{14}" maxlength="14" name="nrc" class="form-control" placeholder="{{ __('Número de Registro de Contribuyentes') }}">
                        @include('alerts.feedback', ['field' => 'nrc'])
                    </div>
                    <button type="submit" class="btn btn-primary btn-round">{{ __('Registrarme') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

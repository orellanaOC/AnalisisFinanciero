@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div id="card1"class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Actualizar información personal') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div id="card2" class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Contraseña') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div id="card3" class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Empresa') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.empresa') }}" autocomplete="off">
                    @csrf
                    @method('put')
                    
                    <div class="card-body">
                        @include('alerts.success', ['key' => 'empresa_status'])
                        <div class="input-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-bank"></i>
                                </div>
                            </div>
                        <input required name="empresa" class="form-control" placeholder="{{ __('Nombre de la empresa') }}" value="{{$empresa->nombre}}">
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
                                    @if (old('sector') == $sector->id || $empresa->sector_id == $sector->id)                                     
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
                            <input required pattern="[0-9]{14}" maxlength="14" name="nit" class="form-control" placeholder="{{ __('Número de Identificación Tributaria') }}" value="{{$empresa->nit}}">
                            @include('alerts.feedback', ['field' => 'nit'])
                        </div>
                        <div class="input-group{{ $errors->has('nrc') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-badge"></i>
                                </div>
                            </div>
                            <input required pattern="[0-9]{14}" maxlength="14" name="nrc" class="form-control" placeholder="{{ __('Número de Registro de Contribuyentes') }}" value="{{$empresa->nrc}}">
                            @include('alerts.feedback', ['field' => 'nrc'])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

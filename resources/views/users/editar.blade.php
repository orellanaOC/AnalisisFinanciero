@extends('users.index')  
@section('title')
    Editar usuario
@endsection
@section('opcion')
	<div class="col-6">
        <div class="card">
            <div class="card-header ">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 class="card-title"><b>Editar usuario</b></h2>
                    </div> 
                    <div class="col-md-6 text-right">
                        <p style="color:red">Datos requeridos: *</p><br>
                    </div> 
                </div>
            </div>
            <div class="card-body col-12">
                <form class="form" method="post" action="{{route('users.update', $user->id)}}">
                    @csrf
                    @method('PUT') 
                    <div class="card-body">
                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre completo *') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"></i>
                                </div>
                            </div>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo electrónico *') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password" value="" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}">
                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" name="password_confirmation" value="" class="form-control" placeholder="{{ __('Confirmar contraseña') }}">
                                </div>
                            </div>
                        </div>
                        <div class="input-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-bank"></i>
                                </div>
                            </div>
                            <input type="text" name="institucion" value="{{$user->institucion}}" class="form-control{{ $errors->has('institucion') ? ' is-invalid' : '' }}" placeholder="{{ __('Institución de procedencia *') }}">
                            @include('alerts.feedback', ['field' => 'institucion'])
                        </div>
                        <div class="input-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-align-left-2"></i>
                                </div>
                            </div>
                            <input type="text" name="descripcion" value="{{$user->descripcion}}" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción personal *') }}">
                            @include('alerts.feedback', ['field' => 'descripcion'])
                        </div>
                        <div class="input-group{{ $errors->has('fecha_nac') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-birthday-cake" aria-hidden="true"> *</i>
                                </div>
                            </div>
                            <input type="date" max="2002-01-01" value="{{$user->fecha_nac}}" name="fecha_nac" class="form-control {{ $errors->has('fecha_nac') ? ' is-invalid' : '' }}" placeholder="{{ __('Fecha de nacimiento *') }}">
                            @include('alerts.feedback', ['field' => 'fecha_nac'])
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-minimal-down"></i>
                                </div>
                            </div>
                            <select class="form-control selectorWapis" value="" id="rol" name="rol">
                                <option value="" selected disabled hidden >Seleccione un rol *</option>
                                @foreach ($roles as $rol)
                                    @if($roleuser->role_id==$rol->id)
                                        <option style="color: black !important;" selected>{{ $rol->name }}</option>
                                    @endif
                                    <option style="color: black !important;">{{ $rol->name }}</option>
                                @endforeach
                            </select>                            
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-minimal-down"></i>
                                </div>
                            </div>
                            <select class="form-control selectorWapis" value="{{$user->sexo}}" id="sexo" name="sexo">
                            	<option value="" selected disabled hidden>Sexo *</option>
                                    @if($user->sexo)
                                        <option style="color: black !important;"selected>Masculino</option>
                                        <option style="color: black !important;">Femenino</option>
                                    @else
                                        <option style="color: black !important;">Masculino</option>
                                        <option style="color: black !important;"selected>Femenino</option>
                                    @endif
                            </select>                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Actualizar') }}</button>
                    </div>
                    <br/>
                </form>
            </div>
        </div>
    </div>

@endsection

<script src="sweetalert2.all.min.js"></script>
<script langiage="javascript" type="text/javascript">
    // RESALTAR LAS FILAS AL PASAR EL MOUSE
    function ResaltarFila(id_fila) {
    document.getElementById(id_fila).style.backgroundColor = '#9c9c9c';
    }
    // RESTABLECER EL FONDO DE LAS FILAS AL QUITAR EL FOCO
    function RestablecerFila(id_fila, color) {
    document.getElementById(id_fila).style.backgroundColor = color;
    }
    // CONVERTIR LAS FILAS EN LINKS
    function CrearEnlace(url) {
    location.href=url;
    }
    require("sweetalert");
    function confirmar(valor){
        //ruta.concat(variable,")}}");
        swal({
          title: "¿Eliminar registro?",
          text: "Esta acción es irreversible.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Registro eliminado", {
              icon: "success",
            });
            document.getElementById("formulario"+valor).submit();
          } else {
            swal("Eliminación cancelada");
          }
        });
    }

    
</script>
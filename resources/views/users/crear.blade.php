@extends('users.index')  
@section('title')
    Crear Usuario
@endsection
@section('opcion')
	<div class="col-6">
        <div class="card">
            <div class="card-header ">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2 class="card-title"><b>Nuevo usuario</b></h2>
                    </div> 
                    <div class="col-md-6 text-right">
                        <p style="color:red">Datos requeridos: *</p><br>
                    </div> 
                </div>
            </div>
            <div class="card-body col-12">
                <form class="form" method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-single-02"></i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre completo *') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-email-85"></i>
                                </div>
                            </div>
                            <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo electrónico *') }}">
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
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña *') }}">
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
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirmar contraseña *') }}">
                                </div>
                            </div>
                        </div>
                       
                        <div class="input-group{{ $errors->has('rol') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-minimal-down"></i>
                                </div>
                            </div>
                            <select class="form-control selectorWapis" id="rol" name="rol">
                                <option value="" selected disabled hidden>Seleccione un rol *</option>
                                @foreach ($roles as $rol)
                                <option style="color: black !important;">{{ $rol->name }}</option>
                                @endforeach
                            </select>    
                            @include('alerts.feedback', ['field' => 'rol'])                        
                        </div>

                        <div class="input-group{{ $errors->has('empresa') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-bank"></i>
                                </div>
                            </div>
                            <input required name="nombre" class="form-control" placeholder="{{ __('Nombre de la empresa') }}">
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

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">{{ __('Crear') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!---script src="sweetalert2.all.min.js"></!---script>
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

    
</script>-->
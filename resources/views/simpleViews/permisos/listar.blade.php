@extends('users.index')  
@section('title')
    Permisos por usuario
@endsection
@section('opcion')
    <div class="col-3">
        <div>
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title text-center"><b>Permisos del usuario</b></h4>
                </div>
                <div class="card-body"> 
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                        @foreach ($tablas as $tb)
                            @foreach ($permisos_usuario as $permiso)
                                @if($permiso->id_tabla==$tb->id)
                                    <table class="table-sm"  width='100%'>
                                        <tr class="list-group-item py-1 list-group-flush" data-toggle="collapse" data-toggle="collapse" data-target="#listaA{{$tb->id}}" aria-expanded="false" aria-controls="listaA{{$tb->id}}">
                                            <td width='95%'>
                                                {{$tb->nombre}}
                                            </td>
                                            <td>
                                                <i class="tim-icons icon-minimal-down"></i>
                                            </td>
                                        </tr>
                                    </table>
                                    @break
                                @endif
                            @endforeach
                                <div id="listaA{{$tb->id}}" class="collapse" aria-labelledby="rec{{$tb->id}}" data-parent="#accordion">
                                    <table width='100%' class="table">
                                        @foreach ($permisos_usuario as $permiso)
                                            @if($permiso->id_tabla==$tb->id)  
                                                <tr id="p{{$permiso->id}}" onMouseOver="ResaltarFila('p{{$permiso->id}}');" onMouseOut="RestablecerFila('p{{$permiso->id}}', '')" onClick="eliminarPermiso({{ $permiso->id }});" >   
                                                    <td>
                                                    </td>                  
                                                    <td id="$permiso->id">
                                                        <form id="eliminarPermiso{{$permiso->id}}" method="post" action="{{route('permission.destroy')}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input hidden name="id_permiso" value="{{$permiso->id}}">
                                                            <input hidden name="id_usuario" value="{{$user->id}}">
                                                            &nbsp;&nbsp;{{$permiso->name}}
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <i class="tim-icons icon-key-25"></i>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div> 
                                                     
                        @endforeach
                        <br>
                        <!--fin de dropdown-->                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div>
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title text-center"><b>Permisos disponibles</b></h4>
                </div>
                <div class="card-body">
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                        @foreach ($tablas as $tb)
                            @foreach ($permisos as $permiso)
                                @if($permiso->id_tabla==$tb->id)
                                    <table class="table-sm"  width='100%'>
                                        <tr class="list-group-item py-1 list-group-flush" data-toggle="collapse" data-toggle="collapse" data-target="#listaB{{$tb->id}}" aria-expanded="false" aria-controls="listaB{{$tb->id}}">
                                            <td width = "95%">
                                                {{$tb->nombre}}
                                            </td>
                                            <td>
                                                <i class="tim-icons icon-minimal-down"></i>
                                            </td>
                                        </tr>
                                    </table>
                                    @break
                                @endif
                            @endforeach 
                                <div id="listaB{{$tb->id}}" class="collapse" aria-labelledby="rec{{$tb->id}}" data-parent="#accordion">
                                    <table width='100%' class="table">
                                        @foreach ($permisos as $permiso)
                                            @if($permiso->id_tabla==$tb->id)  
                                            <tr  id="p{{$permiso->id}}" onMouseOver="ResaltarFila('p{{$permiso->id}}');" onMouseOut="RestablecerFila('p{{$permiso->id}}', '')" onClick="añadirPermiso({{ $permiso->id }});" >
                                                <td></td>
                                                <td>
                                                    <form id="añadirPermiso{{$permiso->id}}" method="post" action="{{route('permission.store')}}">
                                                        @csrf
                                                        <input hidden name="id_permiso" value="{{$permiso->id}}">
                                                        <input hidden name="id_usuario" value="{{$user->id}}">
                                                        &nbsp;&nbsp;{{$permiso->name}}
                                                    </form>
                                                </td>
                                                <td>
                                                    <i class="tim-icons icon-simple-add "></i>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>                    
                        @endforeach
                        <br>
                        <!--fin de dropdown-->                  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
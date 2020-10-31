@extends('layouts.app',['pageSlug' => 'dashboard'])
@section('title')
	Panel de control de usuarios 
@endsection
@section('content')
<div class="row">
	<div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-8 text-left">
                            <h2 class="card-title"><b>Panel de control de usuarios</b></h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <a role="button"class="btn btn-primary col-sm-5 animation-on-hover" href="{{ route('recursos.create')  }}">
                            <i class="tim-icons icon-single-02"></i>&nbsp;&nbsp;
                            Usuarios
                        </a>
                        <a role="button"class="btn btn-danger col-sm-5 animation-on-hover" href="{{ route('recursos.create')  }}">
                            <i class="tim-icons icon-spaceship"></i>&nbsp;&nbsp;
                            Proyectos & Permisos
                        </a> 
                        <a role="button"class="btn btn-warning col-sm-5 animation-on-hover" href="{{ route('recursos.create')  }}">
                            <i class="tim-icons icon-key-25"></i>&nbsp;&nbsp;
                            Permisos
                        </a>
                        <a role="button"class="btn btn-default col-sm-5 animation-on-hover" href="{{ route('recursos.create')  }}">
                            <i class="tim-icons icon-bulb-63"></i>&nbsp;&nbsp;
                            Roles & Permisos
                        </a> 
                        <a role="button"class="btn btn-success col-sm-5 animation-on-hover" href="{{ route('recursos.create')  }}">
                            <i class="tim-icons icon-shape-star"></i>&nbsp;&nbsp;
                            Roles
                        </a> 
                        
                         
                    </div> 
                </div>
                <div class="card-footer"><br></div>
            </div>
        </div>
</div>
@endsection
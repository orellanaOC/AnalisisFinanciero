@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'analisis_vertical'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Análisis Vertical</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="ml-auto col-md-4 mr-auto">
                        <select id="AverticalPeriodo" class="form-control">
                            <option value=-1>--Seleccionar un período--</option>
                            @foreach ($periodos as $periodo)                            
                            <option value="{{$periodo->id}}">{{$periodo->year}}</option>                            
                            @endforeach
                        </select>                        
                    </div>                    
                </div>
            </div>            
        </div>
        @yield('cuerpo_analisis')
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection

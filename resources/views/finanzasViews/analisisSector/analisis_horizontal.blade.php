@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'analisis_horizontal'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Análisis Horizontal</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control">
                            <option value=-1>--Seleccionar un período 1--</option>
                            <option>fdfdsf</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control">
                            <option value=-1>--Seleccionar un período 2--</option>
                            <option>fdfdsf</option>
                        </select>
                    </div>
                    @yield('cuerpo_analisis')
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
</div>			  		

@endsection

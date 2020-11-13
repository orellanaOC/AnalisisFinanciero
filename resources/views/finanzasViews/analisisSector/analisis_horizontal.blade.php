@extends('finanzasViews.analisisSector.layout_analisis', ['pageSlug' => 'analisis_horizontal'])

@section('contenido_navbar')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="card-title">Análisis Horizontal</h2>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="selector1" onchange="activarSelector()">
                    <option value=-1>Seleccionar el período A...</option>
                    @foreach ($periodos as $periodo)                            
                        <option value="{{$periodo->id}}">{{$periodo->year}}</option>                            
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" id="selector2" style="display:none" onchange="analisisHorizontal()">
                    <option value=-1>Seleccionar el período B...</option>
                    @foreach ($periodos as $periodo)                            
                        <option value="{{$periodo->id}}">{{$periodo->year}}</option>                            
                    @endforeach
                </select>
            </div>                    
        </div>
    </div>
    <div class="card-body">
        @yield('cuerpo_analisis')
    </div>
    <div class="card-footer">
        
    </div>
</div>			  		

@endsection

<script>
    function activarSelector(){
        let selector2 = $("#selector2");
        selector2.show();
    }
    function analisisHorizontal(){
        let selector1 = $("#selector1");
        let selector2 = $("#selector2");
        //selector2.show();
        if(selector1!=-1 && selector2!=-1){
            window.location= "/" + selector1.val() + "/" + selector2.val() + "/analisis_horizontal";
        }
    }
</script>
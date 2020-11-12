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
//añadir permiso al usuario
function añadirPermiso(valor){
    document.getElementById("añadirPermiso"+valor).submit();
}
function eliminarPermiso(valor){
    document.getElementById("eliminarPermiso"+valor).submit();   
}
//editar indicador vista OAI
function editarIndicador(id_indicador, descripcion){
    //console.log(id_indicador);
    //console.log(descripcion);
    var detalle=$('#editarDetalleIndicador');
    var id=$('#editarIdIndicador');    
    detalle.text(descripcion);
    id.val(id_indicador);
}
//editar catalogo
function editarCuenta(id_cuenta , cod,  nom, tipo, cpadre){
    let id=$('#idCatalogoEditar');
    let codigo=$('#codigoCatalogoEditar');
    let nombre=$('#nombreCatalogoEditar');
    let tipoCuenta=$('#tipoCuentaEditar');
    let padre=$('#buscadorCuentaPadreEditar');
    id.val(id_cuenta);
    codigo.val(cod);
    nombre.val(nom);
    tipoCuenta.val(tipo);
    padre.val(cpadre);
    //console.log("si se ejecuta esta mierda")
    //detalle.text(descripcion);

}


//editar objetivo vista OAI
function editarObjetivo(id_objetivo, descripcion){
    var detalle=$('#editarDetalleObjetivo');
    var id=$('#editarIdObjetivo');    
    detalle.text(descripcion);
    id.val(id_objetivo);
}
//editar rol de miembro vista Index controlador: UsuarioEquipoRol
function editarRolMiembro(id_miembro, id_rol){
    var rol=$('#rolMiembroEditar');
    var miembro=$('#id_miembro');
    miembro.val(id_miembro);
    console.log(miembro);
    //rol.removeAttr('selected').filter(['value='+id_rol+']']).attr('selected', true);
    //rol.val(id_rol)
    rol.each(function() {
        if($(this).val() == id_rol) {
            $(this).attr('selected', 'selected');
        }
    });
    console.log(rol);
}
function bloquearRecurso(valor){
    var btnrecurso=$('btnAñadirRec'+valor);
    btnrecurso.disabled=true;
    console.log="llega aqui";
}

//vista evaluacion
function agregarComentario(){
    $('#comentario').val($('#coment').val());
    $('#comentario1').val($('#coment').val());
}

function displayRadioValue() { 
    var ele = document.getElementsByName('rad'); 
              
    for(i = 0; i < ele.length; i++) { 
        if(ele[i].checked) 
            $('#resultado').val(ele[i].value);
    } 
} 
/*****************Analisis horizontal************************************************/
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
/****************Fin Analisis horizontal********************************************/

//Dentro de aquí se pueden cargar funciones que necesitan que el html se carguen primero
$(document).ready(function(){//lo que este dentro de aquí se cargara hasta que la pagina este totalmente cargada
    let cartitas1=document.querySelector('#card1');
    let cartitas2=document.querySelector('#card2');        
    let cartitas3=document.querySelector('#card3');
    //let alto1=cartitas1.offsetHeight;
    //let alto2=cartitas2.offsetHeight;       
    let alto3=cartitas3.offsetHeight;
    console.log("alto3:"+alto3);

    $('#card1').css("height", +alto3+"px");
    $('#card2').css("height", +alto3+"px");;
    
    $('#selector1').change(function () {
        $('#selector2').show();
        $('#prepend').show();
        $('#selector2').val("");
        var idFiltro = $(this).val();
        if (idFiltro !="") {
            $("#selector2 > option").each(function () {
                if ($(this).hasClass(idFiltro)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
});
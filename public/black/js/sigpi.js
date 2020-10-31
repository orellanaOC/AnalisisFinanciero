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
//editar alcance vista OAI
function editarAlcance(id_alcance, descripcion){
    var detalle=$('#editarDetalleAlcance');
    var id=$('#editarIdAlcance');    
    detalle.text(descripcion);
    id.val(id_alcance);
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

//Dentro de aquí se pueden cargar funciones que necesitan que el html se carguen primero
$(document).ready(function(){//lo que este dentro de aquí se cargara hasta que la pagina este totalmente cargada
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
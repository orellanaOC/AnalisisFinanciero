/*
Archivo para funciones de la libreria SWEETALERT 
tomar en cuenta que es la versión 1 de la librería, no la 2
*/
//require("sweetalert"); //creo que no lo necesita porque la libreria se importa en el archivo app.blade.php
    function confirmar(valor){
      //valor es el nombre completo del formulario de eliminacion
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
            //console.log(valor);
            //console.log(document.getElementById(valor));
            document.getElementById(valor).submit();
            
          } else {
            swal("Eliminación cancelada");
          }
        });
    }
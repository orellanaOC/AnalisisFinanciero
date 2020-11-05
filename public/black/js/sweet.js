/*
Archivo para funciones de la libreria SWEETALERT 
tomar en cuenta que es la versión 1 de la librería, no la 2
*/
//require("sweetalert"); //creo que no lo necesita porque la libreria se importa en el archivo app.blade.php
    function confirmar(valor){
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
            console.log(valor)
            document.getElementById("formulario"+valor).submit();
            
          } else {
            swal("Eliminación cancelada");
          }
        });
    }
    function confirmarTipo(valor){
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
            document.getElementById("formularioTipo"+valor).submit();
          } else {
            swal("Eliminación cancelada");
          }
        });
    }
    function confirmarEnvio(valor){
      swal({
        title: "¿Está seguro de enviar la solicitud?",
        text: "Esta acción es irreversible.",
        icon: "warning",
        buttons: true,
        dangerMode: false,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Solicitud enviada", {
            icon: "success",
          });
          document.getElementById("formulario"+valor).submit();
        } else {
          swal("Envío cancelado");
        }
      });
  }
$(function () {
  $("#example1")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
});

function mydelete(id, name, ruta) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: name,
      text: "No podrás revertir esto.!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "¡Sí, bórralo!",
      cancelButtonText: "No, cancelar!",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire(
          "Eliminado!",
          "Su archivo ha sido eliminado.",
          "success"
          );
        
        setTimeout(() => {
            eliminar(id,ruta);
          }, 1000);

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          "Cancelado",
          "Tu archivo " + name + " está seguro :)",
          "error"
        );
      }
    })
    ;
  // document.getElementById("demo").style.color = "red";
}
function eliminar(id,ruta) {
  const http = new XMLHttpRequest();
  var ruta = ruta + "?id=" + id;
  http.open("GET", ruta, true);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        location.reload();
    }
  };
  console.log(http.status);
  http.send();
}

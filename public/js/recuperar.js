
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })

    function mydelete(id,name,ruta) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: name,
      text: "Revertir esto.!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: '¡Sí, Recuperar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire(
          'Recuperal!',
          'Su archivo ha sido recuperado.',
          'success'
        );
        setTimeout(() => {
            recuperar(id,ruta);
          }, 1000);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'Tu archivo '+ name +' está seguro :)',
          'error'
        )
      }
    })
  }
  function recuperar(id,ruta) {
    const http = new XMLHttpRequest();
    
    var ruta = ruta + "?id=" + id;
    console.log(ruta);
    http.open("GET", ruta, true);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          location.reload();
      }
    };
    console.log(http.status);
    http.send();
  }

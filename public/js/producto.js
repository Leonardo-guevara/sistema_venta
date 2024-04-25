$(function() {
    $('.select2').select2();
    $('#summernote').summernote();
    select_presentacion();
  })

  function cien() {
    var x = document.getElementById("mySelect").value;
    const input = document.getElementById('cobertura');
    input.addEventListener('input', e => {
      const value = parseInt(e.currentTarget.value);
      if (value <= parseInt(x)) {
        porcentaje = (parseInt(x) * 0.30);
        input.value = parseInt(x) + porcentaje;
        alert('Por favor ingresa un mayor : ' + x);
      }
    });
  }

  function select_presentacion() {
    const x = document.getElementById("unidad").value;
    var presentacion = document.getElementById('presentacion');
    ruta = hostname+"producto/json?code=" + x;
    var http = new XMLHttpRequest();
    http.open('GET', ruta);
    http.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var resultado = (this.responseText);

        if (resultado.indexOf("\n") > 2) {
          index = resultado.indexOf("\n");
          cut = resultado.substring(index);
          final = resultado.replace(cut, "");
          resultado = final;
        }
        var guardar = JSON.parse(resultado);
        console.log(resultado);
        presentacion.innerHTML = '<option value="">Seleccione una presentacion...</option>'
        guardar.forEach(element => {
          var option = document.createElement("option");
          option.value = element.idpresentacion;
          option.text = element.name;
          presentacion.appendChild(option);
        });
      }
    }
    http.send();
    document.getElementById("envunidadx").value= x;

  }
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  function modalAgregarCategoria(ruta) {
    var barcode = document. ("delete_barcode").value;
    var cantidad = document.getElementById("quitar").value;;
    var ruta = hostname + "venta/delete_barcode?venta=" + venta + "&code=" + barcode +"&cantidad=" + cantidad;
    var http = new XMLHttpRequest();
    var venta = idventas;
    http.open('GET', ruta, true);

    http.send()
  }
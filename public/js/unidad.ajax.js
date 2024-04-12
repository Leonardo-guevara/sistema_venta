
function get_all() {
  var http = new XMLHttpRequest();
  var ruta =  "../unidad/view_ajax";
  http.open("GET", ruta, true);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var resultado = this.responseText;
      if (resultado.indexOf("\n") > 2) {
        index = resultado.indexOf("\n");
        cut = resultado.substring(index);
        final = resultado.replace(cut, "");
        resultado = final;
      }
      var datos = JSON.parse(resultado);
      console.log(resultado);
    }
  };
  http.send();
}

function insert_ajax() {
  var ruta = "../unidad/insert_ajax";
  (async () => {
    const { value: data } = await Swal.fire({
      input: "text",
      inputLabel: "Agregar Unidad",
      inputPlaceholder: "Ingresar unidad",
      inputAttributes: {
        maxlength: "20",
        minlength: "3",
      },
    });
    if (data) {
      Swal.fire(`Ingreso : ${data}`);
      enviar_ajax(ruta,data);
    }
  })();

}
function enviar_ajax(ruta,data){
  var http = new XMLHttpRequest();
  var ruta = ruta + '?data='+data;
  http.open("GET", ruta, true);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      
      console.log(ruta);
    }
  };
  http.send();
}
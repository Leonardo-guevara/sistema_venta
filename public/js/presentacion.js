function get_all() {
    var http = new XMLHttpRequest();
    var ruta = "../presentacion/view_ajax";
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
    var ruta = "../presentacion/insert_ajax";
    var unidad = get_unidad();
    (async () => {
        const { value: formValues } = await Swal.fire({
            title: "Ingresar Presentacion",
            html: `
            <input id="swal-input1" class="swal2-input">
            <select id="swal-input2" class="swal2-input" name="select">
            guardar.forEach(element => {
                var option = document.createElement("option");
                option.value = element.idpresentacion;
                option.text = element.name;
                presentacion.appendChild(option);
            });
            </select>
          `,
            focusConfirm: false,
            preConfirm: () => {
                return [
                    document.getElementById("swal-input1").value,
                    document.getElementById("swal-input2").value,
                ];
            },
        });
        if (formValues) {
            Swal.fire(JSON.stringify(formValues));
            console.log(formValues);
        }
    })();

    // enviar_ajax(ruta,data);
}
function enviar_ajax(ruta, data) {
    var http = new XMLHttpRequest();
    var ruta = ruta + "?data=" + data;
    http.open("GET", ruta, true);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(ruta);
        }
    };
    http.send();
}
function get_unidad() {
    var http = new XMLHttpRequest();
    var ruta = "../unidad/view_ajax";
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
            return datos;
        }
    };
    http.send();
}

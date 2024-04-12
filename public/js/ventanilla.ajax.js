
$(function() {
    // select2
    $('.select2').select2();
    document.getElementById('publico').innerHTML = 'Público en General ';
    suma_precio();
    actualizar_venta();
    select_cliente();
    listar_produto(); 
    $("#example2").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
})

// area de impresion
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
// #TODO: Cliente
function select_cliente() {
    optionName = document.getElementById("fk_persona").options[document.getElementById("fk_persona").selectedIndex]
        .getAttribute('name');
    optionCedula = document.getElementById("fk_persona").options[document.getElementById("fk_persona").selectedIndex]
        .getAttribute('cedula');
    var cod = document.getElementById("fk_persona").value;
    var venta = idventas;
    var http = new XMLHttpRequest();
    var ruta = hostname+"venta/chage_user?user=" + cod + "&venta=" + venta;
    http.open('GET', ruta, true);
    http.send();
    document.getElementById('publico').innerHTML = optionName;
    document.getElementById('cedula').innerHTML = optionCedula;
    // alert(cod);
}
//#TODO:  mostral hora actual
function mostra_hora() {
    var now = new Date();
    const mesActual = now.getMonth() + 1;
    var time =
        now.getDate() + "/" +
        mesActual + "/" +
        now.getFullYear() + "  " +
        now.getHours() + ":" +
        now.getMinutes() + ":" +
        now.getSeconds();
    document.getElementById('display-time').innerHTML = time;
}
setInterval(mostra_hora, 1000);
// TODO:  producto barcode clip
var input = document.getElementById("barcode");
input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("myBtn").click();
        suma_precio();
        actualizar_venta();
    }
});
// TODO: borrar producto barcode clip
var delete_barcode = document.getElementById("delete_barcode");
delete_barcode.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("delete_producto").click();
        suma_precio();
        actualizar_venta();
    }
});
// TODO: buscar producto y registar
function buscar_producto() {
    var http = new XMLHttpRequest();
    var barcode = document.getElementById("barcode").value;
    var venta =idventas;
    var ruta = hostname+"venta/ajax?venta=" + venta + "&code=" + barcode;
    http.open('GET', ruta, true);
    actualizar_venta();
    suma_precio();
    document.getElementById("barcode").value = "";
    http.send();
}
// TODO:  eliminar_producto
function eliminar_producto() {
    var http = new XMLHttpRequest();
    var barcode = document.getElementById("delete_barcode").value;
    var venta =idventas;
    var ruta = hostname+"venta/delete_barcode?venta=" + venta + "&code=" + barcode;
    http.open('GET', ruta, true);
    suma_precio();
    actualizar_venta();
    document.getElementById("delete_barcode").value = "";
    http.send();
}
// TODO: actualizar venta
function actualizar_venta() {
    var http = new XMLHttpRequest();
    var venta =idventas;
    const ruta = hostname+"venta/json?venta=" + venta;
    http.open('GET', ruta, true);
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = (this.responseText);
            if (resultado.indexOf("\n") > 2) {
                index = resultado.indexOf("\n");
                cut = resultado.substring(index);
                final = resultado.replace(cut, "");
                resultado = final;
            }
            tabla = document.getElementById('tabla'),
                tabla.innerHTML = '<tr><th>Cant.</th><th>Producto</th><th>Prec. Uni.</th><th>Subtotal</th></tr>';
            var datos = JSON.parse(resultado);
            datos.forEach(recibo => {
                var elemento = document.createElement("tr");
                elemento.innerHTML += ("<td>" + recibo.cantidad + "</td>");
                elemento.innerHTML += ("<td>" + recibo.fk_producto + "</td>");
                elemento.innerHTML += ("<td>" + recibo.subtotal + "</td>");
                elemento.innerHTML += ("<td>" + recibo.total + "</td>");
                document.getElementById("tabla").appendChild(elemento);
            });
        }
    }
    http.send();
}
// TODO:  ver total
function suma_precio() {
    var http = new XMLHttpRequest();
    var venta = idventas ;
    var ruta = hostname+"venta/suma_precio?venta=" + venta;
    http.open('GET', ruta, true);
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = (this.responseText);
            if (resultado.indexOf("\n") > 2) {
                index = resultado.indexOf("\n");
                cut = resultado.substring(index);
                final = resultado.replace(cut, "");
                resultado = final;
            }
            var datos = JSON.parse(resultado);
            document.getElementById("total_precio").innerHTML = datos.resultado;
        }
    }
    http.send();
}
// TODO: finalizra venta
function finalizar_venta() {
    var http = new XMLHttpRequest();
    var venta =idventas;
    var ruta = hostname+"venta/finalizar_venta?venta=" + venta;
    http.open('GET', ruta, true);
    http.send();
    location.reload();
}
// TODO: listar
function listar_produto(){
    var http = new XMLHttpRequest();
    var ruta = hostname+"venta/view_producto";
    http.open('GET', ruta, true);
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = (this.responseText);
            if (resultado.indexOf("\n") > 2) {
                index = resultado.indexOf("\n");
                cut = resultado.substring(index);
                final = resultado.replace(cut, "");
                resultado = final;
            }
            var datos = JSON.parse(resultado);
            console.log(datos); 
        }
    }
    http.send();
}

$(function () {
    // select2
    $('.select2').select2();
    document.getElementById('publico').innerHTML = 'Público en General ';
    actualizar_venta();
    select_cliente();       
    table;

})

var table = new DataTable("#example2", {
    ajax: hostname + "venta/view_producto",
    columns: [
        {  data: 'stocks' },
        {data: 'codigo' },
        { data: 'name'    },
        { data: 'precio_venta'    },

        {
            data: null,
            defaultContent: '<button class="btn btn-primary btn-sm btn-flat"><i class="fas fa-cart-plus fa-lg mr-2"></i></button>',
            targets: -1
        },
        {   
            data: null,
            render: function (data, type, row) {
                return '<img src="'+ hostname + data.foto + '",width=60px, height=60px />'
            },
            orderable: false
        },

    ],
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,

});

table.on('click', 'button', function (e) {
    let data = table.row(e.target.closest('tr')).data();
    buscar_producto(data['codigo']);
});

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
    var ruta = hostname + "venta/chage_user?cliente=" + cod + "&venta=" + venta;
    http.open('GET', ruta, true);
        // console.log(ruta);
    http.send();
    document.getElementById('publico').innerHTML = optionName;
    document.getElementById('cedula').innerHTML = optionCedula; 
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
input.addEventListener("keypress", function (event) {
    // if (event.key == "Enter"  ) {
        buscar_producto(input.value);
    // }
});
// TODO: buscar producto y registar
function  buscar_producto(barcode = null ) {
    var http = new XMLHttpRequest();
    var venta = idventas;
    var cantidad = document.getElementById("agregar").value;;
    if ( barcode == null) {
        barcode = document.getElementById("barcode").value;
    }
    var ruta = hostname + "venta/ajax?venta=" + venta + "&code=" + barcode +"&cantidad=" + cantidad ;
    http.open('GET', ruta, true);
    console.log(ruta);
    actualizar_venta();
    // location.reload();
    http.send();
}

// TODO: borrar producto barcode clip
var delete_barcode = document.getElementById("delete_barcode");
delete_barcode.addEventListener("keypress", function (event) {
    if (event.key == "Enter") {
        eliminar_producto()
    }
});

// TODO:  eliminar_producto
function eliminar_producto() {
    var http = new XMLHttpRequest();
    var barcode = document.getElementById("delete_barcode").value;
    var venta = idventas;
    var cantidad = document.getElementById("quitar").value;;
    var ruta = hostname + "venta/delete_barcode?venta=" + venta + "&code=" + barcode +"&cantidad=" + cantidad;
    http.open('GET', ruta, true);
    actualizar_venta();
    // location.reload();
    http.send();
}

// TODO: actualizar venta
function actualizar_venta() {
    var http = new XMLHttpRequest();
    var venta = idventas;
    const ruta = hostname + "venta/json?venta=" + venta;
    http.open('GET', ruta, true);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resultado = (this.responseText);
            if (resultado.indexOf("\n") > 2) {
                index = resultado.indexOf("\n");
                cut = resultado.substring(index);
                final = resultado.replace(cut, "");
                resultado = final;
            }
            myObj = JSON.parse(resultado);
            datos = (myObj.detalle_venta);
            tabla = document.getElementById('tabla'),
                tabla.innerHTML = '<tr><th>Cant.</th><th>Producto</th><th>Prec. Uni.</th><th>Subtotal</th></tr>';
            datos.forEach(recibo => {
                var elemento = document.createElement("tr");
                elemento.innerHTML += ("<td>" + recibo.cantidad + "</td>");
                elemento.innerHTML += ("<td>" + recibo.fk_producto + "</td>");
                elemento.innerHTML += ("<td>" + recibo.subtotal + "</td>");
                elemento.innerHTML += ("<td>" + recibo.total + "</td>");
                document.getElementById("tabla").appendChild(elemento);
            });
            datos = (myObj.suma_precio);
            document.getElementById("total_precio").innerHTML = datos.resultado;    
        }
    }
    http.send();
    document.getElementById("delete_barcode").value = "";
    document.getElementById("barcode").value = "";
}

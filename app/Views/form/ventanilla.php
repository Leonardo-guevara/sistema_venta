  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Select2 -->
  <script src="<?=base_url('public')?>/plugins/select2/js/select2.full.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
            <br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>"><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?></a></li>
              <li class="breadcrumb-item active"> <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?> </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Barcode:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        <input type="text" class="form-control" id="barcode" mane="barcode">
                        <span class="input-group-append">
                          <button type="button" id="myBtn" onclick="buscar_producto()" class="btn bg-success"><i class="fas fa-barcode"> Agregar</i> </button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cliente</label>
                      <div class="input-group-prepend">
                      <?php //php code generator
                        if  (isset($_POST['fk_persona']) and !empty($_POST['fk_persona'])){
                          $fk_persona = $_POST['fk_persona'];
                        }elseif (isset($datos['fk_persona']) and !empty($datos['fk_persona'])) {
                          $fk_persona = $datos['fk_persona'];
                        }else { $fk_persona = '';}
                      ?>
                      <select class="form-control select2"  id="fk_persona" onchange="select_cliente()" name="fk_persona" style="width: 100%;">
                      <?php
                        foreach ($persona as $key => $value) {
                 
                            echo '<option cedula="'.$value['cedula'].'" name="'.$value['nombre'].'" value="'.$value['idpersona'].'">'.$value['nombre'].'</option>';
                          
                        }
                      ?>
                      </select>
                      <div class="input-group-append">
                        <a href="<?=base_url()?>persona/insert" target="_blank" class="btn btn-app bg-success">
                          <i class="fas fa-users"></i> Nuevo
                        </a>
                      </div>
                      </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- Main content -->
            <div id="printableArea" class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-university"> - </i><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?>
                    <small class="float-right" id="display-time">Date: </small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="tabla" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Cant.</th>
                      <th>Producto</th>
                      <th>Prec. Uni.</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <b><?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '0000';}else{echo 'N.- '.$datos['idventas'];}?></b><br>
                    <b> Vendendor: </b><td><?php if(!isset($data['usuario']) and empty($data['usuario'])){echo '';}else{echo $data['usuario'];}?></td> <br>
                    <!-- <b id="publico" > CLiente :</b><td >Publico General</td>  -->
                    <p id="publico"></p>
                    <p id="cedula"></p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td id="total_precio">0.00</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="row no-print">
                <div class="col-12">
                  <hr>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        <input type="text" class="form-control" id="delete_barcode" mane="delete_barcode">
                        <span class="input-group-append">
                          <button type="button" id="delete_producto" onclick="eliminar_producto()" class="btn bg-danger"><i class="fas fa-barcode"> Quitar</i> </button>
                        </span>
                      </div>
                    </div>
                  <button type="button" onclick="printDiv('printableArea')"  rel="noopener" target="_blank" class="btn btn-default" ><i class="fas fa-print"></i> Imprimir</button>

                  <button type="button" onclick="finalizar_venta()" class="btn btn-success float-right">
                    <i class="far fa-credit-card"></i> Finalizar Venta
                  </button>
                  <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Finalizar y Enviar
                  </button> -->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
  <script>
    // iniciar al inicio
    $(function () {
      // select2
      $('.select2').select2();
      document.getElementById('publico').innerHTML =  'Público en General ';
      suma_precio();
      actualizar_venta();
      select_cliente();
    })
    // area de impresion
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    // Cliente
    function select_cliente() {

      optionName = document.getElementById("fk_persona").options[document.getElementById("fk_persona").selectedIndex].getAttribute('name');
      optionCedula = document.getElementById("fk_persona").options[document.getElementById("fk_persona").selectedIndex].getAttribute('cedula');
      var cod = document.getElementById("fk_persona").value;
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      var http  = new XMLHttpRequest(); 

      var ruta  = "<?=base_url()?>venta/chage_user?user="+cod+"&venta="+venta;
      http.open('GET',ruta,true);
      http.send(); 
      document.getElementById('publico').innerHTML =  optionName;
      document.getElementById('cedula').innerHTML =  optionCedula;
      // alert(cod);
    }
    // mostral hora actual
    function mostra_hora()  {
        var now = new Date();
        
      const mesActual = now.getMonth() + 1; 
        var time =  
            now.getDate() + "/" + 
            mesActual + "/" + 
            now.getFullYear() + "  " + 
            now.getHours() + ":" + 
            now.getMinutes() + ":" + 
            now.getSeconds();
        document.getElementById('display-time').innerHTML = time ;
    }
    setInterval(mostra_hora, 1000);
    // producto barcode clip
    var input = document.getElementById("barcode");
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("myBtn").click();
        suma_precio();
      actualizar_venta();
      }
    });
    // borrar producto barcode clip
    var delete_barcode = document.getElementById("delete_barcode");
    delete_barcode.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("delete_producto").click();
        suma_precio();
      actualizar_venta();
      }
    });
    // buscar producto y registar
    function buscar_producto() {

      var http  = new XMLHttpRequest();
      var barcode = document.getElementById("barcode").value;
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      var ruta  = "<?=base_url()?>venta/ajax?venta="+venta+"&code="+barcode;
      http.open('GET', ruta,true);
      actualizar_venta();
      suma_precio();
      document.getElementById("barcode").value = "";
      http.send();  
    }
    // eliminar_producto
    function eliminar_producto() {
      var http  = new XMLHttpRequest();
      var barcode = document.getElementById("delete_barcode").value;
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      var ruta  = "<?=base_url()?>venta/delete_barcode?venta="+venta+"&code="+barcode;
      http.open('GET',ruta,true);
      suma_precio();
      actualizar_venta();
      document.getElementById("delete_barcode").value = "";
      http.send();  
    }
        // borrar producto
    // actualizar venta
    function actualizar_venta() {
      var http = new XMLHttpRequest();
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      
      const ruta = "<?=base_url()?>venta/json?venta="+venta;
      http.open('GET',ruta,true);
      http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var resultado = (this.responseText);
          // const index = resultado.indexOf("\n");
          // const cut = resultado.substring(index);
          // const final = resultado.replace(cut, "");
	        tabla = document.getElementById('tabla'),
          tabla.innerHTML = '<tr><th>Cant.</th><th>Producto</th><th>Prec. Uni.</th><th>Subtotal</th></tr>';
          // var datos  = JSON.parse(final);
          var datos  = JSON.parse(resultado);
            datos.forEach(recibo => {
              var elemento = document.createElement("tr");
              elemento.innerHTML += ("<td>" + recibo.cantidad + "</td>");
              elemento.innerHTML += ("<td>" + recibo.fk_producto + "</td>");
              elemento.innerHTML += ("<td>" + recibo.subtotal + "</td>");
              elemento.innerHTML += ("<td>" + recibo.total + "</td>");
              document.getElementById("tabla").appendChild(elemento);
            });
            console.log(datos);
          } 
        }
        http.send();
    }
    // ver total
    function suma_precio(){
      var http  = new XMLHttpRequest();
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      var ruta  = "<?=base_url()?>venta/suma_precio?venta="+venta;
      http.open('GET', ruta,true);
      http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var resultado = (this.responseText);
          // const index = resultado.indexOf("\n");
          // const cut = resultado.substring(index);
          // const final = resultado.replace(cut, "");
          // var datos  = JSON.parse(final);
          var datos  = JSON.parse(resultado);
          document.getElementById("total_precio").innerHTML = datos.resultado;
        }
      }
      http.send();  
    }
    function finalizar_venta() {
      var http  = new XMLHttpRequest();
      var venta = "<?php if(!isset($datos['idventas']) and empty($datos['idventas'])){echo '';}else{echo $datos['idventas'];}?>";
      var ruta  = "<?=base_url()?>venta/finalizar_venta?venta="+venta;
      http.open('GET',ruta,true);
      http.send();  
      location.reload();
    }
    
  </script>



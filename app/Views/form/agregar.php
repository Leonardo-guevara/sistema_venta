
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


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
              </div>
              <div class="card-body">
                <form action="<?='';?>" enctype="multipart/form-data"  method="post">
                <?= csrf_field() ?>  
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Codigo</label>
                        <?php //php code generator
                          if  (isset($_POST['code']) and !empty($_POST['code'])){
                            $code = $_POST['code'];
                          }else { $code = '';}
                        ?>
                        <input type="text"  name="code"  id="mySelect" class="form-control" value ='<?=$code;?>' placeholder="Ingrese codigo">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombre del producto</label><br>
                        <p  id="producto">Nombre de producto</p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Agregar</label>
                        <input type="number" name="stockt"  id="campoNumerico"  onclick="myFunction()"  class="form-control" >
                      </div>
                      <div class="form-group"  id="myDIV1" style='display: none;'>
                        <label>Precio de compra</label>
                        <?php //php code generator
                          if  (isset($_POST['precio_compra']) and !empty($_POST['precio_compra'])){
                            $precio_compra = $_POST['precio_compra'];
                          }else { $precio_compra = '';}
                        ?>
                        <input type="number" id="mySelectPrecio"  name="precio_compra" class="form-control"  placeholder="Precio de compra" value="<?=$precio_compra; ?>">
                      </div>
                      <div class="form-group"  id="myDIV2" style='display: none;' >
                        <label  id="demo">Precio de venta</label>
                        <?php //php code generator
                          if  (isset($_POST['precio_venta']) and !empty($_POST['precio_venta'])){
                            $precio_venta = $_POST['precio_venta'];
                          }else { $precio_venta = '';}
                        ?>
                        <input type="number" step="0.01" id="cobertura" name="precio_venta" class="form-control"  placeholder="valor"  value="<?=$precio_venta;?>" onkeydown="cien()" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cantidad</label><br>
                        <p  id="cantidad">Cantidad actual de producto</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <?php //php code generator
                        if (!empty($_POST)) {
                          echo \Config\Services::validation()->listErrors();
                           if(!isset($error) and empty($error)){echo '';}else{echo $error;}
                        }
                      ?>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div   class="form-group">
                          <button type="submit" value="submit" class="btn btn-primary"  id="myDIV" style='display: none;' >Agregar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

  </div>
  <script>
    function cien() {
      var x = document.getElementById("mySelectPrecio").value;
        const input = document.getElementById('cobertura');
        input.addEventListener('input', e => {
            const value = parseInt(e.currentTarget.value);
            if (value <= parseInt(x)) {
                porcentaje =  (parseInt(x) * 0.30);
                input.value = parseInt(x) + porcentaje;
                alert('Por favor ingresa un mayor : '+x);
            }
        });
   }

    function myFunction() {

      var http  = new XMLHttpRequest();
      var x = document.getElementById("mySelect").value;
      var ruta  = "<?=base_url()?>Inventario/json?code="+x;
      var boton = document.getElementById("myDIV");
      var imput1 = document.getElementById("myDIV1");
      var imput2 = document.getElementById("myDIV2");

        http.open('GET', ruta,true);
        http.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            var resultado = (this.responseText);
            const index = resultado.indexOf("\n");
            const cut = resultado.substring(index);
            const final = resultado.replace(cut, "");
            const arr = new Array(http);
            var guardar  = JSON.parse(final);
            
            // var guardar  = JSON.parse(resultado);
            if (guardar != null) {
              document.getElementById("producto").innerHTML = guardar.name;
              document.getElementById("cantidad").innerHTML = guardar.stocks;
              document.getElementById("mySelectPrecio").value = guardar.precio_compra;
              document.getElementById("cobertura").value = guardar.precio_venta;
              boton.style.display = "block";
                imput1.style.display = "block";
                imput2.style.display = "block";
                console.log(guardar);
            }else{

            }

          }
          else {
                  boton.style.display = "none";
                  imput1.style.display = "none";
                  imput2.style.display = "none";
                  document.getElementById("producto").innerHTML = 'EL producto no existe';
                  document.getElementById("cantidad").innerHTML = 'Cantidad actual es 0';
              }
        } 
        http.send(); 
    }

</script>
<!-- 
          // campo numerico
        // const campoNumerico = document.getElementById('campo-numerico');
    // campoNumerico.addEventListener('keydown', function(evento) {
    //   const teclaPresionada = evento.key;
    //   const teclaPresionadaEsUnNumero =
    //     Number.isInteger(parseInt(teclaPresionada));
    //   const sePresionoUnaTeclaNoAdmitida = 
    //     teclaPresionada != 'ArrowDown' &&
    //     teclaPresionada != 'ArrowUp' &&
    //     teclaPresionada != 'ArrowLeft' &&
    //     teclaPresionada != 'ArrowRight' &&
    //     teclaPresionada != 'Backspace' &&
    //     teclaPresionada != 'Delete' &&
    //     teclaPresionada != 'Enter' &&
    //     !teclaPresionadaEsUnNumero;
    //   const comienzaPorCero = 
    //     campoNumerico.value.length === 0 &&
    //     teclaPresionada == 0;
    //   if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
    //     evento.preventDefault(); 
    //   }
    // });
 -->


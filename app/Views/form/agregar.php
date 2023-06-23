
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
                          <button id="myDIV" type="submit" value="submit" class="btn btn-primary" style='display: none;' >Agregar</button>
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


    function myFunction() {

      var http  = new XMLHttpRequest();
      var x = document.getElementById("mySelect").value;
      var ruta  = "<?=base_url()?>Inventario/json?code="+x;
      var boton = document.getElementById("myDIV");

        http.open('GET', ruta,true);
        http.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            var resultado = (this.responseText);
            // alert(JSON.parse(resultado))
            const index = resultado.indexOf("\n");
            const cut = resultado.substring(index);
            const final = resultado.replace(cut, "");
            const arr = new Array(http);
            var guardar  = JSON.parse(final);
            document.getElementById("producto").innerHTML = guardar.name;
            document.getElementById("cantidad").innerHTML = guardar.stocks;
              if (boton.style.display === "none") {
                boton.style.display = "block";
              } 
          }
          else {
                  x.style.display = "none";
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


    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Select2 -->
    <script src="<?=base_url('public')?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/summernote/summernote-bs4.min.css">
    <!-- Summernote -->
    <script src="<?=base_url('public')?>/plugins/summernote/summernote-bs4.min.js"></script>

  <div class="content-wrapper">

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
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
              </div>
              <form action="<?='';?>" enctype="multipart/form-data"  method="post"> 
                <?= csrf_field() ?>
                <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Codigo</label>
                      <?php 
                        if  (isset($_POST['codigo']) and !empty($_POST['codigo'])){
                          $codigo = $_POST['codigo'];
                        }elseif (isset($datos['codigo']) and !empty($datos['codigo'])) {
                          $codigo = $datos['codigo'];
                        }else { $codigo = '';}
                      ?>
                      <input type="text" name="codigo" class="form-control"  placeholder="Ingrese codigo" value="<?=$codigo;?>">
                    </div>
                    <div class="form-group">
                      <label>Detalle</label>
                      <?php 
                        if  (isset($_POST['description']) and !empty($_POST['description'])){
                          $description = $_POST['description'];
                        }elseif (isset($datos['description']) and !empty($datos['description'])) {
                          $description = $datos['description'];
                        }else { $description = '';}
                      ?>
                      <textarea id="summernote" name="description" >
                        <?=$description; ?>
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label>Fotografia</label>
                      <?php //php code generator
                        if  (isset($_POST['file']) and !empty($_POST['file'])){
                          $file = $_POST['file'];
                        }elseif (isset($datos['foto']) and !empty($datos['foto'])) {
                          $file = $datos['foto'];
                        }else { $file = '';}
                        ?>
                      <img  src="<?=base_url()?><?=$file?>" id="output" width="100px"/>
                      <input type="file" accept="image/*" 
                       name="file" class="form-control" 
                       value="<?=$file;?>" 
                       onchange="loadFile(event)">
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <?php //php code generator
                        if  (isset($_POST['name']) and !empty($_POST['name'])){
                          $name = $_POST['name'];
                        }elseif (isset($datos['name']) and !empty($datos['name'])) {
                          $name = $datos['name'];
                        }else { $name = '';}
                      ?>
                      <input type="text" name="name" class="form-control"  placeholder="Ingrese Nombre" value="<?=$name; ?>">
                    </div>
                    <div class="form-group">
                      <label>Unidad</label>
                      <div class="loader" id="loader"></div>
                      <?php //php code generator
                        if  (isset($_POST['fk_unidad']) and !empty($_POST['fk_unidad'])){
                          $fk_unidad = $_POST['fk_unidad'];
                        }elseif (isset($datos['fk_unidad']) and !empty($datos['fk_unidad'])) {
                          $fk_unidad = $datos['fk_unidad'];
                        }else { $fk_unidad = '';}
                      ?>
                      <select id="unidad" onchange="select_presentacion()" class="form-control select2" name="fk_unidad">
                      <?php
                        foreach ($unidad as $key => $value) {
                          if ( $value['idunidad'] ==($fk_unidad)) {
                            echo '<option value="'.$value['idunidad'].'" selected="selected">'.$value['name'].'</option>';
                          }else{
                            echo '<option value="'.$value['idunidad'].'">'.$value['name'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Marca</label>
                      <?php //php code generator
                        if  (isset($_POST['fk_marca']) and !empty($_POST['fk_marca'])){
                          $fk_marca = $_POST['fk_marca'];
                        }elseif (isset($datos['fk_marca']) and !empty($datos['fk_marca'])) {
                          $fk_marca = $datos['fk_marca'];
                        }else { $fk_marca = '';}
                      ?>
                      <select  class="form-control select2" name="fk_marca" style="width: 100%;">
                      <?php
                        foreach ($marca as $key => $value) {
                          if ( $value['idmarca'] ==($fk_marca)) {
                            echo '<option value="'.$value['idmarca'].'" selected="selected">'.$value['name'].'</option>';
                          }else{
                            echo '<option value="'.$value['idmarca'].'">'.$value['name'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Presentacion</label>
                      <?php //php code generator
                        if  (isset($_POST['fk_presentacion']) and !empty($_POST['fk_presentacion'])){
                          $fk_presentacion = $_POST['fk_presentacion'];
                        }elseif (isset($datos['fk_presentacion']) and !empty($datos['fk_presentacion'])) {
                          $fk_presentacion = $datos['fk_presentacion'];
                        }else { $fk_presentacion = '';}
                      ?>
                      <select class="form-control select2" id="presentacion" name="fk_presentacion" style="width: 100%;">
                      <?php
                        foreach ($presentacion as $key => $value) {
                            if ( $value['idpresentacion'] == ($fk_presentacion)) {
                              echo '<option   value="'.$value['idpresentacion'].'" selected="selected" style="display:none">'.$value['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label>Categoria</label>
                      <?php //php code generator
                        if  (isset($_POST['fk_categoria']) and !empty($_POST['fk_categoria'])){
                          $fk_categoria = $_POST['fk_categoria'];
                        }elseif (isset($datos['fk_categoria']) and !empty($datos['fk_categoria'])) {
                          $fk_categoria = $datos['fk_categoria'];
                        }else { $fk_categoria = '';}
                      ?>
                      <select class="form-control select2" name="fk_categoria"  value="<?=$fk_categoria; ?>" style="width: 100%;">
                        <?php
                        foreach ($categoria as $key => $value) {
                          if ( $value['idcategoria'] ==($fk_categoria)) {
                            echo '<option value="'.$value['idcategoria'].'" selected="selected">'.$value['name'].'</option>';
                          }else{
                            echo '<option value="'.$value['idcategoria'].'">'.$value['name'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cantidad de Producto</label>
                      <?php //php code generator
                        if  (isset($_POST['stocks']) and !empty($_POST['stocks'])){
                          $stocks = $_POST['stocks'];
                        }elseif (isset($datos['stocks']) and !empty($datos['stocks'])) {
                          $stocks = $datos['stocks'];
                        }else { $stocks = '';}
                      ?>
                      <input type="number" name="stocks" class="form-control"  placeholder="Cantidad de stocks" value="<?=$stocks; ?>">
                    </div>
                    <div class="form-group">
                      <label>Cantidad Minima</label>
                      <?php //php code generator
                        if  (isset($_POST['minimo']) and !empty($_POST['minimo'])){
                          $minimo = $_POST['minimo'];
                        }elseif (isset($datos['minimo']) and !empty($datos['minimo'])) {
                          $minimo = $datos['minimo'];
                        }else { $minimo = '';}
                      ?>
                      <input type="number" name="minimo" class="form-control"  placeholder="Cantidad de minimo" value="<?=$minimo; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Precio de compra</label>
                      <?php //php code generator
                        if  (isset($_POST['precio_compra']) and !empty($_POST['precio_compra'])){
                          $precio_compra = $_POST['precio_compra'];
                        }elseif (isset($datos['precio_compra']) and !empty($datos['precio_compra'])) {
                          $precio_compra = $datos['precio_compra'];
                        }else { $precio_compra = '';}
                      ?>
                      <input type="number" id="mySelect"  name="precio_compra" class="form-control"  placeholder="Precio de compra" value="<?=$precio_compra; ?>"step="0.01" >
                    </div>
                    <div class="form-group">
                      <label  id="demo">Precio de venta</label>
                      <?php //php code generator
                        if  (isset($_POST['precio_venta']) and !empty($_POST['precio_venta'])){
                          $precio_venta = $_POST['precio_venta'];
                        }elseif (isset($datos['precio_venta']) and !empty($datos['precio_venta'])) {
                          $precio_venta = $datos['precio_venta'];
                        }else { $precio_venta = '';}
                      ?>
                      <input type="number" step="0.01" id="cobertura" name="precio_venta" class="form-control"  placeholder="valor"  value="<?=$precio_venta;?>" onkeydown="cien()" />
                      <!-- <input type="number" onkeydown="cien()" name="precio_venta" class="form-control"  placeholder="Precio de Venta" value="<?=$precio_venta;?>"> -->
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                   
                  </div>
                  <div class="form-group">
                    <?php if (!empty($_POST)): ?>
                      <?=\Config\Services::validation()->listErrors(); ?>
                    <?php endif ?>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


  </div>
  <!-- /.content-wrapper -->

<script>
    $(function () {
      $('.select2').select2()
      $('#summernote').summernote()
    })

    function cien() {
      var x = document.getElementById("mySelect").value;
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
    function select_presentacion() {
      const x = document.getElementById("unidad").value;
      var presentacion = document.getElementById('presentacion');
      ruta = "<?=base_url()?>producto/json?code="+x ;
      var http = new XMLHttpRequest();
      http.open('GET',ruta);
      http.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
            var resultado = (this.responseText);
            // const index = resultado.indexOf("\n");
            // const cut = resultado.substring(index);
            // const final = resultado.replace(cut, "");
            // var guardar  = JSON.parse(final);
            var guardar  = JSON.parse(resultado);

            
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
    }
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    };

</script>
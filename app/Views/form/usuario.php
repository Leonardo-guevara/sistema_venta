    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Select2 -->
    <script src="<?=base_url('public')?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="<?=base_url('public')?>/plugins/summernote/summernote-bs4.min.css">
    <!-- Summernote -->
    <script src="<?=base_url('public')?>/plugins/summernote/summernote-bs4.min.js"></script>

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
              <form action="<?='';?>" enctype="multipart/form-data"  method="post"> 
                <?= csrf_field() ?>
                <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Usuario</label>
                      <?php 
                        if  (isset($_POST['usuario']) and !empty($_POST['usuario'])){
                          $usuario = $_POST['usuario'];
                        }elseif (isset($datos['usuario']) and !empty($datos['usuario'])) {
                          $usuario = $datos['usuario'];
                        }else { $usuario = '';}
                      ?>
                      <input type="text" name="usuario" class="form-control"  placeholder="Ingrese usuario" value="<?=$usuario;?>">
                    </div>
                    <div class="form-group">
                      <label>Detalle</label>
                      <?php 
                        if  (isset($_POST['detalle']) and !empty($_POST['detalle'])){
                          $detalle = $_POST['detalle'];
                        }elseif (isset($datos['detalle']) and !empty($datos['detalle'])) {
                          $detalle = $datos['detalle'];
                        }else { $detalle = '';}
                      ?>
                      <textarea id="summernote" name="detalle" >
                        <?=$detalle; ?>
                      </textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
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
                      value="<?=$file; ?>" 
                      onchange="loadFile(event)">
                    </div>  
                    <div class="form-group">
                      <label>Cliente</label>
                      <?php //php code generator
                        if  (isset($_POST['fk_persona']) and !empty($_POST['fk_persona'])){
                          $fk_persona = $_POST['fk_persona'];
                        }elseif (isset($datos['fk_persona']) and !empty($datos['fk_persona'])) {
                          $fk_persona = $datos['fk_persona'];
                        }else { $fk_persona = '';}
                      ?>
                      <select class="form-control select2" id='Cliente' name="fk_persona" onchange="select_presentacion()" style="width: 100%;">
                      <?php
                        foreach ($persona as $key => $value) {
                          if ( $value['idpersona'] ==($fk_persona)) {
                            echo '<option value="'.$value['idpersona'].'" selected="selected">'.$value['email'].'</option>';
                          }else{
                            echo '<option value="'.$value['idpersona'].'">'.$value['email'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Roles  </label>
                      <?php //php code generator
                        if  (isset($_POST['fkroles']) and !empty($_POST['fkroles'])){
                          $fkroles = $_POST['fkroles'];
                        }elseif (isset($datos['fkroles']) and !empty($datos['fkroles'])) {
                          $fkroles = $datos['fkroles'];
                        }else { $fkroles = '';}
                      ?>
                      <select class="form-control select2" name="fkroles" style="width: 100%;">
                      <?php
                        foreach ($roles as $key => $value) {
                          if ( $value['idroles'] ==($roles)) {
                            echo '<option value="'.$value['idroles'].'" selected="selected">'.$value['name'].'</option>';
                          }else{
                            echo '<option value="'.$value['idroles'].'">'.$value['name'].'</option>';
                          }
                        }
                        ?>
                      </select>
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
                  <button type="submit" value="submit" class="btn btn-primary">Agregar</button>
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
      // select2
      $('.select2').select2()
      // Summernote
      $('#summernote').summernote()
    })
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    };
</script>
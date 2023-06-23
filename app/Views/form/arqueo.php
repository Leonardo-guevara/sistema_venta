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
                    <div class="form-group">
                      <label>Usuario</label>
                      <?php //php code generator
                        if  (isset($_POST['fk_usuario']) and !empty($_POST['fk_usuario'])){
                          $fk_usuario = $_POST['fk_usuario'];
                        }elseif (isset($datos['fk_usuario']) and !empty($datos['fk_usuario'])) {
                          $fk_usuario = $datos['fk_usuario'];
                        }else { $fk_usuario = '';}
                      ?>
                      <select class="form-control select2" name="fk_usuario"value ="<?=$fk_usuario; ?> style="width: 100%;">
                      <?php
                        foreach ($usuario as $key => $value) {
                          if ( $value['idusuario'] == ($fk_usuario)) {
                            echo '<option value="'.$value['idusuario'].'" selected="selected">'.$value['usuario'].'</option>';
                          }else{
                            echo '<option value="'.$value['idusuario'].'">'.$value['usuario'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Cajas</label>
                      <?php //php code generator
                        if  (isset($_POST['fkcaja']) and !empty($_POST['fkcaja'])){
                          $fkcaja = $_POST['fkcaja'];
                        }elseif (isset($datos['fkcaja']) and !empty($datos['fkcaja'])) {
                          $fkcaja = $datos['fkcaja'];
                        }else { $fkcaja = '';}
                      ?>
                      <select class="form-control select2" name="fkcaja" value ="<?=$fkcaja; ?>style="width: 100%;">
                      <?php
                        foreach ($caja as $key => $value) {
                          if ( $value['idcaja'] == ($fkcaja)) {
                            echo '<option value="'.$value['idcaja'].'" selected="selected">'.$value['name'].'</option>';
                          }else{
                            echo '<option value="'.$value['idcaja'].'">'.$value['name'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label >Monto Inicial</label>
                      <?php //php code generator
                        if  (isset($_POST['monto_inicial']) and !empty($_POST['monto_inicial'])){
                          $monto_inicial = $_POST['monto_inicial'];
                        }elseif (isset($datos['name']) and !empty($datos['name'])) {
                          $monto_inicial = $datos['name'];
                        }else { $monto_inicial = 100;}
                      ?>
                      <input type="number" name="monto_inicial" class="form-control"  
                      placeholder="Ingrese monto inicial" value ="<?=$monto_inicial; ?>">
                    </div>
                    <div class="form-group">
                        <?= \Config\Services::validation()->listErrors(); ?>
                        <?php if(!isset($error) and empty($error)){echo '';}else{echo $error;}?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" value="submit" class="btn btn-primary">INICIAR ARQUEO</button>
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


</script>
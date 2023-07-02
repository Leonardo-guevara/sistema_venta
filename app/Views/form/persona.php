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
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?='';?>" enctype="multipart/form-data"  method="post"> 
                <?= csrf_field() ?>
                <div class="card-body">
                  <div class="form-group">
                    <label >Persona</label>
                    <?php //php code generator
                      if  (isset($_POST['persona']) and !empty($_POST['persona'])){
                        $persona = $_POST['persona'];
                      }elseif (isset($datos['nombre']) and !empty($datos['nombre'])) {
                        $persona = $datos['nombre'];
                        // $persona = 'datos';
                      }else { $persona = '';}
                    ?>
                    <input type="text" name="persona" class="form-control"  placeholder="Ingrese persona" value="<?=$persona; ?>">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <?php //php code generator
                      if  (isset($_POST['email']) and !empty($_POST['email'])){
                        $email = $_POST['email'];
                      }elseif (isset($datos['email']) and !empty($datos['email'])) {
                        $email = $datos['email'];
                      }else { $email = '.@gmail.com';}
                    ?>
                    <input type="email" name="email" class="form-control"  placeholder="Ingrese email" value="<?=$email; ?>">
                  </div>
                  <div class="form-group">
                    <label >Telefono</label>
                    <?php //php code generator
                      if  (isset($_POST['telefono']) and !empty($_POST['telefono'])){
                        $telefono = $_POST['telefono'];
                      }elseif (isset($datos['telefono']) and !empty($datos['telefono'])) {
                        $telefono = $datos['telefono'];
                        // $persona = 'datos';
                      }else { $telefono = '';}
                    ?>
                    <div class="input-group">

                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                    <input type="text" name="telefono" class="form-control"  
                    placeholder="Ingrese telefono" value="<?=$telefono; ?>">
                    </div>

                    
                  </div>
                  <div class="form-group">
                    <label >Carnet</label>
                    <?php //php code generator
                      if  (isset($_POST['cedula']) and !empty($_POST['cedula'])){
                        $cedula = $_POST['cedula'];
                      }elseif (isset($datos['cedula']) and !empty($datos['cedula'])) {
                        $cedula = $datos['cedula'];
                      }else { $cedula = '';}
                    ?>
                    <input type="text" name="cedula" class="form-control"  placeholder="Ingrese cedula" value="<?=$cedula; ?>">
                  </div>
                  <div class="form-group">
                    <?php if (!empty($_POST)): ?>
                      <?=\Config\Services::validation()->listErrors(); ?>
                    <?php endif ?>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" value="submit" class="btn btn-primary">Enviar</button>
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

  
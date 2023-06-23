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
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?='';?>" enctype="multipart/form-data"  method="post"> 
                <?= csrf_field() ?>
                <div class="card-body">
                  <div class="form-group">
                    <label >Caja</label>
                    <!-- <input type="text" name="" id=""> -->
                    <?php //php code generator
                      if  (isset($_POST['caja']) and !empty($_POST['caja'])){
                        $caja = $_POST['caja'];
                      }elseif (isset($datos['name']) and !empty($datos['name'])) {
                        $caja = $datos['name'];
                      }else { $caja = '';}
                    ?>
                      
                    <input type="text" name="caja" class="form-control"  
                    placeholder="Ingrese caja" value ="<?=$caja; ?>">
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
      // select2
      $('.select2').select2()
      // Summernote
      $('#summernote').summernote()
    })

</script>
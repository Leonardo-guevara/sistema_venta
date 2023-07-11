
<!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?=base_url('public')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url('public')?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url('public')?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
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
        <div class="card-body">
            <hr>
            <form action="" method="post">
            <div class="row">
                <div class="col-sm-3">
                    <label for="Hora Inicio">Fecha de inicio</label><br>
                    <?php //php code generator
                      if  (isset($_POST['date_inicio']) and !empty($_POST['date_inicio'])){
                        $date_inicio = $_POST['date_inicio'];
                      }else { $date_inicio = '';}
                    ?>
                    <input type="date" name="date_inicio" id="date_inicio"  value="<?=$date_inicio;?>" >
                </div>
                <div class="col-sm-3">
                    <label for="Hora Final">Fecha Final</label><br>
                    <?php //php code generator
                      if  (isset($_POST['date_final']) and !empty($_POST['date_final'])){
                        $date_final = $_POST['date_final'];
                      }else { $date_final = '';}
                    ?>
                    <input type="date" name="date_final" id="date_final" value="<?=$date_final;?>">
                </div>
                <div class="col-sm-3">
                <label>Usuario</label>
                      <?php //php code generator
                        if  (isset($_POST['usuario']) and !empty($_POST['usuario'])){
                          $usuario = $_POST['usuario'];
                        }else { $usuario = '';}
                      ?>
                      <select class="form-control select2"  id="usuario"  name="usuario" value="<?=$usuario;?>" style="width: 100%;">
                        <!-- <option value="true">todos los usuario</option> -->
                        <?php
                            foreach ($listausuario as $key => $value) {
                              if ( $value['idusuario'] ==($usuario)) {
                                echo '<option value="'.$value['idusuario'].'" selected="selected">'.$value['usuario'].'</option>';
                              }else{
                                echo '<option value="'.$value['idusuario'].'">'.$value['usuario'].'</option>';
                                // echo '<option name="'.$value['usuario'].'" value="'.$value['idusuario'].'">'.$value['usuario'].'</option>';
                              }
                            }
                        ?>
                      </select>
                </div>
                <div class="col-sm-2">
                <label>General reporte</label>
                    <button type="submit" value="submit" class="btn btn-primary">Ejecutar</button>
                </div>
                </form>

            </div>
            <hr>
            <?php if (!empty($_POST)): ?>
                      <?=\Config\Services::validation()->listErrors(); ?>    
            <?php endif ?>
        </div>

            <?php if (!empty($data)): ?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Cod. Arqueo</th>
                    <th>Cod. Recibo</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($data as $news_item): ?>
                    <tr>
                    <td><?= esc($news_item['created_at']); ?></td>
                    <td><?= esc($news_item['idarqueo_caja']); ?></td>
                    <td><?= esc($news_item['idventas']); ?></td>
                    <td><?= esc($news_item['usuario']); ?></td>
                    <td><?= esc($news_item['nombre']); ?></td>
                    <td><?= esc($news_item['total']); ?>
                      <a href="<?=base_url()?>venta/view_recibo?view=<?= esc($news_item['idventas']); ?>" ><i class="fas fa-file"></i></a>  
                    </td>
                    </tr>
                    <?php  endforeach; ?>
                    </tbody>
                  <tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Cod. Arqueo</th>
                    <th>Cod. Recibo</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Total</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            <?php endif ?>
      </section>
  </div>

  
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })
</script>

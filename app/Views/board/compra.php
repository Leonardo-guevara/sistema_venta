
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
            <br>
            <form action="" method="post">
                <div class="row">
                  <div class="col-sm-4">
                      <label for="Hora Inicio">Fecha de inicio</label><br>
                      <?php //php code generator
                        if  (isset($_POST['date_inicio']) and !empty($_POST['date_inicio'])){
                          $date_inicio = $_POST['date_inicio'];
                        }else { $date_inicio = '';}
                      ?>
                      <input type="date" name="date_inicio" id="date_inicio"  value="<?=$date_inicio;?>" >
                  </div>
                  <div class="col-sm-4">
                      <label for="Hora Final">Fecha Final</label><br>
                      <?php //php code generator
                        if  (isset($_POST['date_final']) and !empty($_POST['date_final'])){
                          $date_final = $_POST['date_final'];
                        }else { $date_final = '';}
                      ?>
                      <input type="date" name="date_final" id="date_final" value="<?=$date_final;?>">
                  </div>
                  <div class="col-sm-4">
                    <label>Buscar</label><br>
                      <button type="submit" value="submit" class="btn btn-primary">
                        Buscar
                      </button>
                  </div>
                  </div>
                </form>
          </div>
          <div class="col-sm-5">
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
      <?php if (!empty($_POST)): ?>
            <?=\Config\Services::validation()->listErrors(); ?>    
        <?php endif ?>
      <?php if (!empty($data)): ?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio de Compra</th>                    
                    <th>Precio de Venta</th>
                    <th>Usuario</th>
                    <th>Fecha de Creacion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data as $news_item): ?>
                  <tr>
                    <td><?= esc($news_item['codigo']); ?></td>
                    <td><?= esc($news_item['producto']); ?></td>
                    <td><?= esc($news_item['name']); ?></td>
                    <td><?= esc($news_item['cantidad']); ?></td>
                    <td><?= esc($news_item['precio_compra']); ?></td>
                    <td><?= esc($news_item['precio_venta']); ?></td>
                    <td><?= esc($news_item['usuario']); ?></td>
                    <td><?= esc($news_item['created_at']); ?></td>
                  </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio de Compra</th>                    
                    <th>Precio de Venta</th>
                    <th>Usuario</th>
                    <th>Fecha de Creacion</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
      <?php endif ?>

      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<script>
  $(function () {
    $("#example1").DataTable({
      "order": [[ 6, "asend" ]],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  })

 
</script>

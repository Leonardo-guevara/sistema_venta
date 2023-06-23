 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="<?=base_url('public')?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<script src="<?=base_url('public')?>/plugins/sweetalert2/sweetalert2.min.js"></script>
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
              <p>
                <a href="<?=base_url()?>arqueo/insert" class="btn btn-app">
                  <span class="badge bg-success">Nuevo</span>
                  <i class="fas fa-barcode"></i> Arqueo
                </a>
                <a  href="<?=base_url()?>arqueo/historial" class="btn btn-app">
                  <i class="fas fa-inbox"></i> Historial
                </a>
              </p>
          
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Folio</th>
                    <th>Caja</th>
                    <th>Usuario</th>
                    <th>Monto  inicial</th>
                    <th>Monto final</th>
                    <th>Total ventas</th>
                    <th>Horario Inicio</th>
                    <th>Cerrar arqueo</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data as $news_item): ?>
                  <tr>
                    <td><?= esc($news_item['idarqueo_caja']); ?></td>
                    <td><?= esc($news_item['fkcaja']); ?></td>
                    <td><?= esc($news_item['fk_usuario']); ?></td>
                    <td><?= esc($news_item['monto_inicial']); ?></td>
                    <td><?= esc($news_item['monto_final']); ?></td>
                    <td><?= esc($news_item['total_ventas']); ?></td>
                    <td><?= esc($news_item['horario_inicio']); ?></td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <a onclick="mydelete('<?= esc($news_item['idarqueo_caja']); ?>','<?= esc($news_item['fkcaja']); ?>')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>    
                    </td>
                  </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Folio</th>
                    <th>Caja</th>
                    <th>Usuario</th>
                    <th>Monto  inicial</th>
                    <th>Monto final</th>
                    <th>Total ventas</th>
                    <th>Horario Inicio</th>
                    <th>Cerrar arqueo</th>
                  </tr>
                  </tfoot>
                </table>
              </div>

      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })

    function mydelete(id,name) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: name,
      text: "No podrás revertir esto.!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: '¡Sí, Cerrar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        location.href='<?=base_url()?>arqueo/Close?id='+id
        // swalWithBootstrapButtons.fire(
        //   'Eliminado!',
        //   'Su archivo ha sido eliminado.',
        //   'success'
        // )
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'Tu caja '+ name +' sigue abierta :)',
          'error'
        )
      }
    })
        // document.getElementById("demo").style.color = "red";
  }
</script>

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
                    <th>ID</th>
                    <th>UNIDAD</th>
                    <th>NOMBRE</th>
                    <th>Aciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data as $news_item): ?>
                  <tr>
                    <td><?= esc($news_item['idpresentacion']); ?></td>
                    <td><?= esc($news_item['name']); ?></td>
                    <td><?= esc($news_item['unidad']); ?></td>
                    <td>
                      <div class="btn-group btn-group-sm">
                        <button type="button" onclick="mydelete('<?= esc($news_item['idpresentacion']); ?>','<?= esc($news_item['name']); ?>')" class="btn btn-app"><i class="fas fa-trash-alt"></i> Recuperar</button>
                      </div>

                    </td>
                  </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>UNIDAD</th>
                    <th>NOMBRE</th>
                    <th>Aciones</th>
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
      text: "Revertir esto.!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: '¡Sí, Recuperar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        location.href='<?=base_url()?>presentacion/recovery_mode?id='+id
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
          'Tu archivo '+ name +' está seguro :)',
          'error'
        )
      }
    })
        // document.getElementById("demo").style.color = "red";
  }
</script>

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
                         <a href="<?=base_url()?>presentacion/insert" class="btn btn-app">
                             <span class="badge bg-success">Nuevo</span>
                             <i class="fas fa-barcode"></i> Presentacion
                         </a>
                         <a href="<?=base_url()?>presentacion/recovery" class="btn btn-app bg-danger">
                             <span class="badge bg-danger">Recuperar</span>
                             <i class="fas fa-barcode"></i>Presentacion
                         </a>
                     </p>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a
                                 href="<?=base_url()?><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>"><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?></a>
                         </li>
                         <li class="breadcrumb-item active">
                             <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?> </li>
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
                                 <a
                                     href="<?=base_url()?>presentacion/update?id=<?= esc($news_item['idpresentacion']); ?>"><button
                                         type="button" class="btn btn-warning"> <i class="fas fa-edit"></i>
                                         Editar</button></a>
                                 <button type="button"
                                     onclick="mydelete('<?= esc($news_item['idpresentacion']); ?>','<?= esc($news_item['name']); ?>','./presentacion/delete')"
                                     class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
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


 <script src="<?=base_url();?>public/js/delete.js"></script>
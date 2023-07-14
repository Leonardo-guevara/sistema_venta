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
      <div class="error-page">
        <h2 class="headline text-danger">Sin <br> Caja</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> ¡Ups! Algo no tienes caja asignada.</h3>

          <p>
            Trabajaremos para solucionarlo de inmediato. 
            Mientras tanto, puedes volver a recargar la pagina <br>
            <a href="<?=base_url('Venta')?>">Actulizar la pagina</a> 
            o intente llamar admistrador.
          </p>


        </div>
      </div>
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

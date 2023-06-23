  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=base_url('public')?>/dist/img/marker.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Minimarker</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php if(!isset($_SESSION['foto']) and empty($_SESSION['foto'])){$foto = 'public/dist/img/user2-160x160.jpg';}else{$foto = $_SESSION['foto'];}?>
          <img src="<?=base_url().$foto ;?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?php if(!isset($principal) and empty($principal)){echo '';}else{echo $principal;}?>
          </a> 
          
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>  
      </div>
      <?php  
       if(!isset($_SESSION['permiso']) and empty($_SESSION['permiso'])){
        $array = [];
      }else {
        # code...
        $array =$_SESSION['permiso']; 
      }
      
      ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Sitema de venta</li>
          <?php 
          		$vista = array_search('1', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>venta" class="nav-link">
              <i class="nav-icon fa fa-cart-arrow-down" aria-hidden="true"></i>
              <p>
                Ventanilla  
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php 
          		$vista = array_search('2', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>venta/recibo" class="nav-link">
            <i class="nav-icon fa fa-book" ></i>
              <p>
                recibo
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php 
          		$vista = array_search('3', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>reporte" class="nav-link">
              <i class="nav-icon  fa fa-file-excel" aria-hidden="true"></i>
              <p>
                Reporte
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php 
          		$vista = array_search('4', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>inventario" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Inventario
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php 
          		$vista = array_search('5', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>persona " class="nav-link">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i>
              <p>
                Persona - Cliente
              </p>
            </a>
          </li>
          <?php endif ?>
 
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-barcode"> </i>
              <p>
                PRODUCTO
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php 
          		$vista = array_search('6', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>producto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Producto</p>
                </a>
              </li>
              <?php endif ?>
              <?php 
          		$vista = array_search('7', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              
              <li class="nav-item">
                <a href="<?=base_url()?>unidad" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unidad</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('8', array_column($array, 'fk_permiso'));
          		if ($vista  != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>presentacion" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presentacion</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('9', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>marca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marca</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('10', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>              
              <li class="nav-item">
                <a href="<?=base_url()?>categoria" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categoria</p>
                </a>
              </li>
              <?php endif ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Adminstracion
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php   
          		$vista = array_search('11', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>Usuario" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuario</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('12', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>Roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('13', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>Caja" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Caja</p>
                </a>
              </li>
              <?php endif ?>
              <?php   
          		$vista = array_search('14', array_column($array, 'fk_permiso'));
          		if ($vista != ''): ?>
              <li class="nav-item">
                <a href="<?=base_url()?>Arqueo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Arqueo Caja</p>
                </a>
              </li>
              <?php endif ?>
            </ul>
          </li>

          <li class="nav-header">Funciones extra</li>
          <li class="nav-item">
            <a href="<?=base_url()?>barcode" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>Crear Codigo Barra</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://barcodetopc.com/" class="nav-link">
              <!-- <i class="nav-icon fa-barcode"></i> -->
              <i class="nav-icon fas fa-download"></i>
              <p>app de lector de barra</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

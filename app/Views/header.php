<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=base_url()?><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>" class="nav-link"><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?=base_url()?>home/change_password" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?=base_url()?>public/dist/img/seguridad.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Cambiar Contrasenha
                </h3>
                <p class="text-sm">cambiar contrasenha de usuario.</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>close" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?=base_url()?>public/dist/img/cerrar.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Cerar Seccion
                </h3>
                <p class="text-sm">Cerrar seccion </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
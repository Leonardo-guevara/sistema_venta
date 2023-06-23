<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('/public')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('/public')?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('/public')?>/dist/css/adminlte.min.css">
</head>
<body style='background-image: url("<?=base_url('/public')?>/assets/img/logistics.jpg");
background-size: cover;' 

class="hold-transition login-page" >

<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url('/public')?>"><b>Iniciar - </b>Sesión </a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión para iniciar tu sesión</p>
      <form action="<?=base_url('login');?>" enctype="multipart/form-data"  method="post">
        <?= csrf_field() ?>  
        <div class="input-group mb-3">
            <?php 
              if  (isset($_POST['user']) and !empty($_POST['user'])){
                $user = $_POST['user'];
              }else { $user = '';}
            ?>
          <input type="text" name="user" value="<?=$user;?>" class="form-control" placeholder="Ingrese su Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <?php 
              if  (isset($_POST['password']) and !empty($_POST['password'])){
                $password = $_POST['password'];
              }else { $password = '';}
            ?>
          <input type="password" name="password" value="<?=$password;?>" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <?php //php code generator
            if (!empty($_POST)) {
              echo \Config\Services::validation()->listErrors();
               if(!isset($error) and empty($error)){echo '';}else{echo $error;}
            }
          ?>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
        </div>
      </form>
      <hr>
      <p class="mb-1">
        <a href="<?=base_url()?>recover_password">Olvide mi contrasenha</a>
      </p>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="<?=base_url('/public')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('/public')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('/public')?>/dist/js/adminlte.min.js"></script>
</body>
</html>


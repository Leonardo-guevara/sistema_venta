
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?>
            </h1>
            <br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="<?=base_url()?><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>">
                        <?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>
                    </a>
                </li>
                <li class="breadcrumb-item active"> 
                    <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?> 
                </li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
              </div>
              <!-- <div class="login-logo"> -->
        </div>
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">
                Estás todo listo puedes crear nueva contraseña, <br>    
                cambiar tu contraseña ahora. <br>
            </p>
            <?= form_open('') ?>
              <div class="input-group mb-3">
                    <?php //php code generator
                        if  (isset($_POST['contrasenha']) and !empty($_POST['contrasenha'])){
                          $contrasenha = $_POST['contrasenha'];
                        }else{
                            $contrasenha = '';
                        }
                    ?>
                <input type="password" class="form-control" 
                    name="contrasenha" placeholder="Antigua Password" value="<?=$contrasenha?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <hr>
              <div class="input-group mb-3">
                    <?php //php code generator
                        if  (isset($_POST['password']) and !empty($_POST['password'])){
                          $password = $_POST['password'];
                        }else{
                            $password = '';
                        }
                    ?>
                <input type="password" class="form-control"  
                    name="password" placeholder="Password" value="<?=$password?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <?php //php code generator
                    if  (isset($_POST['passconf']) and !empty($_POST['passconf'])){
                      $passconf = $_POST['passconf'];
                    }else{
                        $passconf = '';
                    }
                ?>
                <input type="password" class="form-control" 
                    name="passconf" placeholder="Confirm Password" value="<?=$passconf?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <?php if (!empty($_POST)): ?>
                  <?=\Config\Services::validation()->listErrors(); ?>
                  
                  <?php if(!isset($error) and empty($error)){echo '';}else{echo $error;}?>
                <?php endif ?>
                  

              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Confirmar</button>
                </div>
              </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </section>
  </div>


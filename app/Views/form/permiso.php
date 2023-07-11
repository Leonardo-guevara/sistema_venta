xml_parse  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
            <br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?>"><?php if(!isset($home) and empty($home)){echo '';}else{echo $home;}?></a></li>
              <li class="breadcrumb-item active"> <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?> </li>
            </ol>
          </div>
        </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
              </div>
              <form action="<?='';?>" enctype="multipart/form-data"  method="post"> 
                <?= csrf_field() ?>
                <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <?php 
                        // $asignado[] = '' ;
                        foreach ($datos as $key => $value) {
                          $asignado[$value['fk_permiso']] = $value['fk_permiso'];
                        } 
                        ?>
                      <!-- Menu Producto -->
                      <h2>Menu Sistema</h2>
                      <!-- Ventanilla -->
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input type="checkbox" name="value[]" value="1" <?php echo isset($asignado[1]) ? 'checked' : '';  ?> > 
                          &nbsp;&nbsp;&nbsp;&nbsp; Ventanilla
                        </label>
                      </div>
                      <!-- Venta -->
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input type="checkbox" name="value[]" value="2"<?php echo isset($asignado[2]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Venta
                        </label>
                      </div>
                      <!-- Reporte -->
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input type="checkbox" name="value[]" value="3"<?php echo isset($asignado[3]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Reporte
                        </label>
                      </div>
                      <!-- Inventario -->
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input type="checkbox" name="value[]" value="4" <?php echo isset($asignado[4]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Inventario
                        </label>
                      </div>
                      <!-- Cliente -->
                      <div class="custom-control custom-checkbox">
                        <label>
                          <input type="checkbox" name="value[]" value="5" <?php echo isset($asignado[5]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Cliente
                        </label>
                      </div>
                      <!-- Menu Producto -->
                      <h4>Menu Producto</h4>
                        <!-- Cliente -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="6" <?php echo isset($asignado[6]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Producto
                          </label>
                        </div>
                        <!-- Cliente -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="7" <?php echo isset($asignado[7]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Unidad
                          </label>
                        </div>
                        <!-- Cliente -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="8" <?php echo isset($asignado[8]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Presentacion
                          </label>
                        </div>
                        <!-- Cliente -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="9" <?php echo isset($asignado[9]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Marca
                          </label>
                        </div>
                        <!-- Cliente -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="10" <?php echo isset($asignado[10]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Categoria
                          </label>
                        </div>
                        <h3>Menu Administracion</h3>
                        <!-- Usuario -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="11" <?php echo isset($asignado[11]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Usuario
                          </label>
                        </div>
                        <!-- Roles -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="12"<?php echo isset($asignado[12]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Roles
                          </label>
                        </div>
                        <!-- Caja -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="13" <?php echo isset($asignado[13]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Caja
                          </label>
                        </div>
                        <!-- Logs de Acesso -->
                        <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="14" <?php echo isset($asignado[14]) ? 'checked' : '';  ?>> &nbsp;&nbsp;&nbsp;&nbsp; Arqueo de Caja
                          </label>
                        </div>
                        <!-- Logs de Acesso -->
                    </div>
                    <div class="custom-control custom-checkbox">
                          <label>
                            <input type="checkbox" name="value[]" value="15" <?php echo isset($asignado[14]) ? 'checked' : '';  ?>>  Historico Compra
                          </label>
                        </div>
                  </div>
                </div>
                  <div class="form-group">       
                    <?php
                    //  \Config\Services::validation()->listErrors(); 
                    ?>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" value="submit" class="btn btn-primary"> Guardar </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>

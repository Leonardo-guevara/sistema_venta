xml_parse <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
                    <br>
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
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
                        </div>
                        <form action="<?='';?>" enctype="multipart/form-data" method="post">
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
                                            <!-- #TODO: modulo de producto -->
                                            <h3>Menu Producto</h3>
                                            <!-- Getionar Unidad -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="1"
                                                        <?php echo isset($asignado[1]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Getionar Unidad
                                                </label>
                                            </div>
                                            <!-- Gestionar Presentacion -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="2"
                                                        <?php echo isset($asignado[2]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Presentacion
                                                </label>
                                            </div>
                                            <!-- Gestionar Marca -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="3"
                                                        <?php echo isset($asignado[3]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Marca
                                                </label>
                                            </div>
                                            <!-- Gestionar categoria -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="4"
                                                        <?php echo isset($asignado[4]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar categoria
                                                </label>
                                            </div>
                                            <!-- Gestinar Producto -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="5"
                                                        <?php echo isset($asignado[5]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestinar Producto
                                                </label>
                                            </div>
                                            <!-- #TODO: Modulo de Compra -->
                                            <h3>Modulo de Compra</h3>
                                            <!-- Agregar producto -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="6"
                                                        <?php echo isset($asignado[6]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Agregar producto
                                                </label>
                                            </div>
                                            <!-- Ajustar producto -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="7"
                                                        <?php echo isset($asignado[7]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Ajustar producto
                                                </label>
                                            </div>
                                            <!-- #TODO: Modulo de Administración -->
                                            <h3>Modulo de Administración</h3>
                                            <!-- Gestionar Usuario -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="8"
                                                        <?php echo isset($asignado[8]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Usuario
                                                </label>
                                            </div>
                                            <!-- Gestionar Roles -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="9"
                                                        <?php echo isset($asignado[9]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Roles
                                                </label>
                                            </div>
                                            <!-- Gestionar caja -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="10"
                                                        <?php echo isset($asignado[10]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar caja
                                                </label>
                                            </div>
                                            <!-- Gestionar Arqueo -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="11"
                                                        <?php echo isset($asignado[11]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Arqueo
                                                </label>
                                            </div>
                                            <!-- #TODO: Modulo de Ventas -->
                                            <h3>Modulo de Ventas</h3>
                                            <!-- Gestionar Ventanilla -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="12"
                                                        <?php echo isset($asignado[12]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Ventanilla
                                                </label>
                                            </div>
                                            <!-- Gestionar Cliente -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="13"
                                                        <?php echo isset($asignado[13]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Cliente
                                                </label>
                                            </div>
                                            <!-- Gestionar Recibo -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="14"
                                                        <?php echo isset($asignado[14]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Gestionar Recibo
                                                </label>
                                            </div>
                                            <!-- #TODO: Modulo de Reporte -->
                                            <h3>Modulo de Reporte</h3>
                                            <!-- Reporte de ventas -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="15"
                                                        <?php echo isset($asignado[15]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Reporte de ventas
                                                </label>
                                            </div>
                                            <!-- Historial de Arqueo -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="16"
                                                        <?php echo isset($asignado[16]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Historial de Arqueo
                                                </label>
                                            </div>
                                            <!-- Kardex de movimiento -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="17"
                                                        <?php echo isset($asignado[17]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Kardex de movimiento
                                                </label>
                                            </div>
                                            <!-- Historico de Compra -->
                                            <div class="custom-control custom-checkbox">
                                                <label>
                                                    <input type="checkbox" name="value[]" value="18"
                                                        <?php echo isset($asignado[18]) ? 'checked' : '';  ?>>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; Historico de Compra
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  
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
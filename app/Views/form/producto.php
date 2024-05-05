    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Select2 -->
    <script src="<?= base_url('public') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('public') ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- Summernote -->
    <script src="<?= base_url('public') ?>/plugins/summernote/summernote-bs4.min.js"></script>

    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php if (!isset($title) and empty($title)) {
                    echo '';
                  } else {
                    echo $title;
                  } ?></h1>
              <br>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <?php if (!isset($home) and empty($home)) {
                  $home  = '';
                } ?>
                <?php if (!isset($title) and empty($title)) {
                  $title =  '';
                } ?>
                <li class="breadcrumb-item">
                  <a href="<?= base_url() . $home ?>"><?= $home ?></a>
                </li>
                <li class="breadcrumb-item active">
                  <?= $title ?>
                </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">
                    <?php if (!isset($title) and empty($title)) {
                      echo '';
                    } else {
                      echo $title;
                    } ?></h3>
                </div>
                <form action="<?= ''; ?>" enctype="multipart/form-data" method="post">
                  <?= csrf_field() ?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Codigo</label>
                          <?php
                          if (isset($_POST['codigo']) and !empty($_POST['codigo'])) {
                            $codigo = $_POST['codigo'];
                          } elseif (isset($datos['codigo']) and !empty($datos['codigo'])) {
                            $codigo = $datos['codigo'];
                          } else {
                            $codigo = '';
                          }
                          ?>
                          <input type="text" name="codigo" class="form-control" placeholder="Ingrese codigo" value="<?= $codigo; ?>">
                        </div>
                        <div class="form-group">
                          <label>Nombre</label>
                          <?php //php code generator
                          if (isset($_POST['name']) and !empty($_POST['name'])) {
                            $name = $_POST['name'];
                          } elseif (isset($datos['name']) and !empty($datos['name'])) {
                            $name = $datos['name'];
                          } else {
                            $name = '';
                          }
                          ?>
                          <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre" value="<?= $name; ?>">
                        </div>
                        <div class="form-group">
                          <label>Detalle</label>
                          <?php
                          if (isset($_POST['description']) and !empty($_POST['description'])) {
                            $description = $_POST['description'];
                          } elseif (isset($datos['description']) and !empty($datos['description'])) {
                            $description = $datos['description'];
                          } else {
                            $description = '';
                          }
                          ?>
                          <textarea id="summernote" name="description">
                        <?= $description; ?>
                      </textarea>
                        </div>
                        <div class="form-group">
                          <label>Fotografia</label>
                          <?php //php code generator
                          if (isset($_POST['file']) and !empty($_POST['file'])) {
                            $file = $_POST['file'];
                          } elseif (isset($datos['foto']) and !empty($datos['foto'])) {
                            $file = $datos['foto'];
                          } else {
                            $file = '';
                          }
                          ?>
                          <img src="<?= base_url() ?><?= $file ?>" id="output" width="100px" />
                          <input type="file" accept="image/*" name="file" class="form-control" value="<?= $file; ?>" onchange="loadFile(event)">
                        </div>


                      </div>
                      <div class="col-md-6">

                        <div class="form-group">
                          <label>Unidad</label>
                          <div class="input-group-prepend">
                            <?php if (isset($_POST['fk_unidad']) and !empty($_POST['fk_unidad'])) {
                              $fk_unidad = $_POST['fk_unidad'];
                            } elseif (isset($datos['fk_unidad']) and !empty($datos['fk_unidad'])) {
                              $fk_unidad = $datos['fk_unidad'];
                            } else {
                              $fk_unidad = '';
                            } ?>
                            <select id="unidad" onchange="select_presentacion()" class="form-control select2" name="fk_unidad">
                              <?php
                              foreach ($unidad as $key => $value) {
                                if ($value['idunidad'] == ($fk_unidad)) {
                                  echo '<option value="' . $value['idunidad'] . '" selected="selected">' . $value['name'] . '</option>';
                                } else {
                                  echo '<option value="' . $value['idunidad'] . '">' . $value['name'] . '</option>';
                                }
                              }
                              ?>
                            </select>
                            <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUnidad">
                              Agregar Unidad
                            </span>                          
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Marca</label>
                          <div class="input-group-prepend">
                          <?php //php code generator
                          if (isset($_POST['fk_marca']) and !empty($_POST['fk_marca'])) {
                            $fk_marca = $_POST['fk_marca'];
                          } elseif (isset($datos['fk_marca']) and !empty($datos['fk_marca'])) {
                            $fk_marca = $datos['fk_marca'];
                          } else {
                            $fk_marca = '';
                          }
                          ?>
                          <select class="form-control select2" name="fk_marca" style="width: 100%;">
                            <?php
                            foreach ($marca as $key => $value) {
                              if ($value['idmarca'] == ($fk_marca)) {
                                echo '<option value="' . $value['idmarca'] . '" selected="selected">' . $value['name'] . '</option>';
                              } else {
                                echo '<option value="' . $value['idmarca'] . '">' . $value['name'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMarca">
                              Agregar Marca
                          </span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Categoria</label>
                          <div class="input-group-prepend">
                          <?php //php code generator
                          if (isset($_POST['fk_categoria']) and !empty($_POST['fk_categoria'])) {
                            $fk_categoria = $_POST['fk_categoria'];
                          } elseif (isset($datos['fk_categoria']) and !empty($datos['fk_categoria'])) {
                            $fk_categoria = $datos['fk_categoria'];
                          } else {
                            $fk_categoria = '';
                          }
                          ?>
                          <select class="form-control select2" name="fk_categoria" value="<?= $fk_categoria; ?>" style="width: 100%;">
                            <?php
                            foreach ($categoria as $key => $value) {
                              if ($value['idcategoria'] == ($fk_categoria)) {
                                echo '<option value="' . $value['idcategoria'] . '" selected="selected">' . $value['name'] . '</option>';
                              } else {
                                echo '<option value="' . $value['idcategoria'] . '">' . $value['name'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <span class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                              Agregar categoría
                          </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Cantidad de Producto</label>
                          <?php //php code generator
                          if (isset($_POST['stocks']) and !empty($_POST['stocks'])) {
                            $stocks = $_POST['stocks'];
                          } elseif (isset($datos['stocks']) and !empty($datos['stocks'])) {
                            $stocks = $datos['stocks'];
                          } else {
                            $stocks = '';
                          }
                          ?>
                          <input type="number" name="stocks" class="form-control" placeholder="Cantidad de stocks" value="<?= $stocks; ?>">
                        </div>
                        <div class="form-group">
                          <label>Cantidad Minima</label>
                          <?php //php code generator
                          if (isset($_POST['minimo']) and !empty($_POST['minimo'])) {
                            $minimo = $_POST['minimo'];
                          } elseif (isset($datos['minimo']) and !empty($datos['minimo'])) {
                            $minimo = $datos['minimo'];
                          } else {
                            $minimo = '';
                          }
                          ?>
                          <input type="number" name="minimo" class="form-control" placeholder="Cantidad de minimo" value="<?= $minimo; ?>">
                        </div>
                        <div class="form-group">
                          <label>Precio de compra</label>
                          <?php //php code generator
                          if (isset($_POST['precio_compra']) and !empty($_POST['precio_compra'])) {
                            $precio_compra = $_POST['precio_compra'];
                          } elseif (isset($datos['precio_compra']) and !empty($datos['precio_compra'])) {
                            $precio_compra = $datos['precio_compra'];
                          } else {
                            $precio_compra = '';
                          }
                          ?>
                          <input type="number" id="mySelect" name="precio_compra" class="form-control" placeholder="Precio de compra" value="<?= $precio_compra; ?>" step="0.01">
                        </div>
                        <div class="form-group">
                          <label id="demo">Precio de venta</label>
                          <?php //php code generator
                          if (isset($_POST['precio_venta']) and !empty($_POST['precio_venta'])) {
                            $precio_venta = $_POST['precio_venta'];
                          } elseif (isset($datos['precio_venta']) and !empty($datos['precio_venta'])) {
                            $precio_venta = $datos['precio_venta'];
                          } else {
                            $precio_venta = '';
                          }
                          ?>
                          <input type="number" step="0.01" id="cobertura" name="precio_venta" class="form-control" placeholder="valor" value="<?= $precio_venta; ?>" onkeydown="cien()" />
                          <!-- <input type="number" onkeydown="cien()" name="precio_venta" class="form-control"  placeholder="Precio de Venta" value="<?= $precio_venta; ?>"> -->
                        </div>  
                      </div>

                    </div>
                    <div class="form-group">

                    </div>
                      <div class="form-group">
                        <?php if (!empty($_POST)) : ?>
                          <?= \Config\Services::validation()->listErrors(); ?>
                        <?php endif ?>
                      </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <!-- /.content-wrapper -->

    <script>
      hostname = '<?= base_url() ?>';
    </script>
    <script src="<?= base_url() ?>public\js\producto.js"></script>


<!--=====================================
MODAL UNIDAD 
======================================-->
<div id="modalAgregarUnidad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url()?>producto/insertunidad"role="form" method="get">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Unidad</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="unidad" placeholder="Ingresar unidad" required>
              </div>
            </div>
  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--=====================================
MODAL marca 
======================================-->
<div id="modalAgregarMarca" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url()?>producto/insertmarca"role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Marca</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="marca" placeholder="Ingresar marca" required>
              </div>
            </div>
  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL categoria 
======================================-->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url()?>producto/insertcategoria"role="form" method="get">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Categoria</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="categoria" placeholder="Ingresar categoria" required>
              </div>
            </div>
  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Select2 -->
<script src="<?= base_url('public') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url('public') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('public') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('public') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('public') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('public') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('public') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?><?php if (!isset($home) and empty($home)) {
                              echo '';
                          } else {
                              echo $home;
                          } ?>"><?php if (!isset($home) and empty($home)) {
                               echo '';
                           } else {
                               echo $home;
                           } ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?php if (!isset($title) and empty($title)) {
                                echo '';
                            } else {
                                echo $title;
                            } ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Stock</th>
                                    <th>codigo</th>
                                    <th>descripcion</th>
                                    <th>Add</th>
                                    <th>imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12</td>
                                    <td>123</td>
                                    <td>name</td>
                                    <td><button class="btn btn-primary btn-sm btn-flat"><i
                                                class="fas fa-cart-plus fa-lg mr-2"></i></button></td>
                                    <td><img src="https://help.rangeme.com/hc/article_attachments/360006928633/what_makes_a_good_product_image.jpg"
                                            width="150px" srcset=""></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="callout callout-info">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Barcode:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="barcode" mane="barcode">
                                            <span class="input-group-append">
                                                <button type="button" id="myBtn" onclick="buscar_producto()"
                                                    class="btn bg-success"><i class="fas fa-barcode"> Agregar</i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <div class="input-group-prepend">
                                            <?php //php code generator
                                            if (isset($_POST['fk_persona']) and !empty($_POST['fk_persona'])) {
                                                $fk_persona = $_POST['fk_persona'];
                                            } elseif (isset($datos['fk_persona']) and !empty($datos['fk_persona'])) {
                                                $fk_persona = $datos['fk_persona'];
                                            } else {
                                                $fk_persona = '';
                                            }
                                            ?>
                                            <select class="form-control select2" id="fk_persona"
                                                onchange="select_cliente()" name="fk_persona" style="width: 100%;">
                                                <?php
                                                foreach ($persona as $key => $value) {
                                                    echo '<option cedula="' . $value['cedula'] . '" name="' . $value['nombre'] . '" value="' . $value['idpersona'] . '">' . $value['nombre'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <div class="input-group-append">
                                                <a href="<?= base_url() ?>persona/insert" target="_blank"
                                                    class="btn btn-app bg-success">
                                                    <i class="fas fa-users"></i> Nuevo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>

                    <!-- Main content -->
                    <div id="printableArea" class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-university"> -
                                    </i><?php if (!isset($title) and empty($title)) {
                                        echo '';
                                    } else {
                                        echo $title;
                                    } ?>
                                    <small class="float-right" id="display-time">Date: </small>
                                </h4>
                            </div>

                            <!-- /.col -->
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table id="tabla" class="table table-striped">
                  
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-12">

                                <b><?php if (!isset($datos['idventas']) and empty($datos['idventas'])) {
                                    echo '0000';
                                } else {
                                    echo 'N.- ' . $datos['idventas'];
                                } ?></b><br>
                                <b> Vendendor: </b> <?php if (!isset($data['usuario']) and empty($data['usuario'])) {
                                    echo 'Vendendor';
                                } else {
                                    echo $data['usuario'];
                                } ?> <br>
                                <p>  <b> Cliente : </b> <span  id="publico"></span > - <span  id="cedula"></span ></p>
                                <hr>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total:</th>
                                            <td id="total_precio">0.00</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row no-print">
                            <div class="col-12">
                                <hr>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="delete_barcode"
                                            mane="delete_barcode">
                                        <span class="input-group-append">
                                            <button type="button" id="delete_producto" onclick="eliminar_producto()"
                                                class="btn bg-danger"><i class="fas fa-barcode"> Quitar</i> </button>
                                        </span>
                                    </div>
                                </div>
                                <button type="button" onclick="printDiv('printableArea')" rel="noopener" target="_blank"
                                    class="btn btn-default"><i class="fas fa-print"></i>
                                    Imprimir</button>

                                <button type="button" onclick="finalizar_venta()" class="btn btn-success float-right">
                                    <i class="far fa-credit-card"></i> Finalizar Venta
                                </button>

                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    var hostname = "<?= base_url() ?>";
    <?php if (isset($datos['idventas']) and !empty($datos['idventas'])) { ?>
        var idventas = "<?= $datos['idventas'] ?>";
    <?php } ?>
</script>
<script src="public\js\ventanilla.ajax.js"></script>
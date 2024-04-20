<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Select2 -->
<script src="<?= base_url('public') ?>/plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('public') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<script src="<?= base_url('public') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
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


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if (!isset($title) and empty($title)) {
                        $title = '';
                    } ?>
                    <h1><?= $title ?></h1>
                    <br>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php if (!isset($home) and empty($home)) {
                            $home = '';
                        } ?>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() . $home ?>"> <?= $home ?></a>
                        </li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card-body">
                        <table id="example2" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Stock</th>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="callout callout-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Barcode:</label>
                                    <div class="input-group">
                                        <div style="margin: 20px"></div>
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="barcode" mane="barcode">
                                        <div style="margin: 20px"></div>
                                        <input type="number" class="form-control " id="agregar" mane="agregar"
                                            min="00.00" value="1">
                                        <span class="input-group-append">
                                            <span id="myBtn" onclick="buscar_producto()" class="btn bg-success"><i
                                                    class="fas fa-barcode"> Agregar</i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>CLIENTE</label>
                                    <div class="input-group-prepend">
                                        <?php if (isset($datos['fk_persona']) and !empty($datos['fk_persona'])) {
                                            $fk_persona = $datos['fk_persona'];
                                        } else {
                                            $fk_persona = 1;
                                        }
                                        ?>
                                        <select class="form-control select2" style="width: 100%;"
                                            onchange="select_cliente()" id="fk_persona">
                                            <?php
                                            foreach ($persona as $key => $value) {
                                                if ($fk_persona == $value['idpersona']) {
                                                    echo '<option value="' . $value['idpersona'] . '" cedula="' . $value['cedula'] . '" name="' . $value['nombre'] . '" >' . $value['nombre'] . ' - ' . $value['cedula'] . ' </option>';
                                                } else {
                                                    echo '<option value="' . $value['idpersona'] . '" cedula="' . $value['cedula'] . '" name="' . $value['nombre'] . '" >' . $value['nombre'] . ' - ' . $value['cedula'] . ' </option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-addon ">
                                            <button type="button" class="btn btn-default btn-xs btn btn-app bg-success "
                                                data-toggle="modal" data-target="#modalAgregarCliente"
                                                data-dismiss="modal"><i class="fas fa-users"></i>
                                                Agregar cliente
                                            </button>
                                        </span>

                                        <!-- <button class="btn btn-app bg-success" onclick="create_user()"><i class="fas fa-users"></i> <br> Nuevo</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main content -->
                        <div id="printableArea" class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-university"> -
                                        </i><?php if (!isset($title) and empty($title)) {
                                            $title = '';
                                        } ?>
                                        <small class="float-right" id="display-time">Date: </small>
                                    </h4>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table id="tabla" class="table table-striped">
                                </div>
                            </div>
                            <div class="row">
                                <form action="<?= base_url(); ?>venta/finalizar_venta" enctype="multipart/form-data"
                                    method="post">

                                    <div class="col-12">

                                        <b><?php if (!isset($datos['idventas']) and empty($datos['idventas'])) {
                                            $idventas = '0000';
                                        } else {
                                            $idventas = $datos['idventas'];
                                        } ?>
                                            <span>N.-<?= $idventas ?></span>
                                            <input type="hidden" id="idventas" name="idventas" value="<?= $idventas ?>">
                                        </b><br>
                                        <?php if (!isset($data['usuario']) and empty($data['usuario'])) {
                                            $usuario = 'Vendendor';
                                        } else {
                                            $usuario = $data['usuario'];
                                        }
                                        ?>
                                        <b> Vendendor: </b> <span><?= $usuario ?></span>
                                        <br>
                                        <p> <b> Cliente : </b> <span id="publico"></span> - <span id="cedula"></span>
                                        </p>
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
                                            <div style="margin: 20px"></div>
                                            <input type="number" class="form-control " id="quitar" mane="quitar" min="1"
                                                value="1">
                                            <span class="input-group-append">
                                                <span id="delete_producto" onclick="eliminar_producto()"
                                                    class="btn bg-danger"><i class="fas fa-barcode"> Quitar</i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <span onclick="printDiv('printableArea')" rel="noopener" target="_blank"
                                        class="btn btn-default"><i class="fas fa-print"></i>
                                        Imprimir</span>

                                    <button type="submit" class="btn btn-success float-right">
                                        <i class="far fa-credit-card"></i> Finalizar Venta
                                    </button>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    var hostname = "<?= base_url() ?>";
    <?php if (isset($datos['idventas']) and !empty($datos['idventas'])) { ?>
        var idventas = "<?= $datos['idventas'] ?>";
    <?php } ?>
</script>
<script src="<?= base_url() ?>public\js\ventanilla.ajax.js"></script>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form name="cliente" action="<?= base_url() ?>venta/cliente" method="get">


                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <h4 class="modal-title">Agregar cliente</h4>
                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">
                    <div class="box-body">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Persona</label>
                                <?php //php code generator
                                if (isset($_POST['persona']) and !empty($_POST['persona'])) {
                                    $persona = $_POST['persona'];
                                } else {
                                    $persona = '';
                                }
                                ?>
                                <input type="text" name="persona" class="form-control" placeholder="Ingrese persona"
                                    value="<?= $persona; ?>">
                            </div>
                            <div class="form-group">
                                <label>Carnet</label>
                                <?php
                                if (isset($_POST['cedula']) and !empty($_POST['cedula'])) {
                                    $cedula = $_POST['cedula'];
                                } else {
                                    $cedula = '';
                                }
                                ?>
                                <input type="text" name="cedula" class="form-control" placeholder="Ingrese cedula"
                                    value="<?= $cedula; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <?php //php code generator
                                if (isset($_POST['email']) and !empty($_POST['email'])) {
                                    $email = $_POST['email'];
                                } else {
                                    $email = '';
                                }
                                ?>
                                <input type="email" name="email" class="form-control" placeholder="Ingrese email"
                                    value="<?= $email; ?>">
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <?php
                                if (isset($_POST['telefono']) and !empty($_POST['telefono'])) {
                                    $telefono = $_POST['telefono'];
                                } else {
                                    $telefono = '';
                                }
                                ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="telefono" class="form-control"
                                        placeholder="Ingrese telefono" value="<?= $telefono; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if (!empty(\Config\Services::validation()->listErrors())): ?>
                                    <?= \Config\Services::validation()->listErrors(); ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>

                    <!--=====================================
        PIE DEL MODAL
        ======================================-->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary" onclick="create_user()">Guardar cliente</button>
                    </div>
            </form>
        </div>
    </div>
</div>
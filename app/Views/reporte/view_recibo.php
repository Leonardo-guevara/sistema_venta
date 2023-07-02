  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <!-- Main content -->
            <div id="printableArea" class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-university"> - </i><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?>
                    <small class="float-right"> 
                        <?php if(!isset($data["created_at"]) and empty($data["created_at"])){echo 'fecha';}else{echo $data["created_at"];}?>
                    </small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="tabla" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Cant.</th>
                      <th>Producto</th>
                      <th>Prec. Uni.</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data["detalle"] as $news_item): ?>
                  <tr>
                    <td><?= esc($news_item['cantidad']); ?></td>
                    <td><?= esc($news_item['producto']); ?></td>
                    <td><?= esc($news_item['subtotal']); ?></td>
                    <td><?= esc($news_item['total']); ?></td>
                  </tr>
                  <?php  endforeach; ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <b><?php if(!isset($data['idventas']) and empty($data['idventas'])){echo '0000';}else{echo 'N.- '.$data['idventas'];}?></b><br>
                    <b> Vendendor: </b><td><?php if(!isset($data['usuario']) and empty($data['usuario'])){echo '';}else{echo $data['usuario'];}?></td> <br>
                    <!-- <b id="publico" > CLiente :</b><td >Publico General</td>  -->
                    <p id="publico"> <?php if(!isset($data["nombre"]) and empty($data["nombre"])){echo 'publico general';}else{echo $data["nombre"];}?></p>
                    <p><?php if(!isset($data["cedula"]) and empty($data["cedula"])){echo '';}else{echo $data["cedula"];}?></p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td id="total_precio">
                        <?php if(!isset($data["total"]) and empty($data["total"])){echo '0.00';}else{echo $data["total"];}?>
                        </td>
                      </tr>
                    </table>
                  </div>
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
  window.addEventListener("load", window.print());
</script>
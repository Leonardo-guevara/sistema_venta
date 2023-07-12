
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
            <hr>
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

    <!-- Main content -->
    <section class="content">
      
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Ir <br>Ventanilla</h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?=base_url()?>venta" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>ir <br> Producto</h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?=base_url()?>producto" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Ir <br>usuario</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=base_url()?>usuario" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Historial <br> Arqueo</h3>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?=base_url()?>arqueo/historial" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <div class="row">
          <div class="col-md-12">
 
            <!-- /.card -->
            <div class="row">


              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Trabajadores o usuario</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      <?php foreach ($usuario as $news_item): ?>
                        <li>
                        <img src="<?=base_url();?><?= esc($news_item['foto']); ?>"  width="100" alt="User Image">
                        <a class="users-list-name" href="#"><?= esc($news_item['usuario']); ?></a>
                        <span class="users-list-date"><?= esc($news_item['email']); ?></span>
                      </li>
                      <?php  endforeach; ?>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>CANTIDAD</th>
                      <th>PRODUCTO</th>
                      <th>PROCESO</th>
                      <th>FECHA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($movimiento as $news_item): ?>
                    <tr>
                      <td><?= esc($news_item['cantidad']); ?></td>
                      <td><?= esc($news_item['producto']); ?></td>
                      <?php if (esc($news_item['name']) == "nuevo"): ?>
                        <td><span class="badge badge-success">
                          <?= esc($news_item['name']); ?>
                        </span></td>
                      <?php elseif (esc($news_item['name']) == "actualizo"): ?>
                        <td><span class="badge badge-danger">
                          <?= esc($news_item['name']); ?>
                        </span></td>
                      <?php elseif (esc($news_item['name']) == "agregar"): ?>
                        <td><span class="badge badge-info">
                          <?= esc($news_item['name']); ?>
                        </span></td>
                      <?php else: ?>
                        <td><span class="badge badge-warning">
                          <?= esc($news_item['name']); ?>
                        </span></td>
                      <?php  endif; ?>
                      <td><?= esc($news_item['fecha']); ?></td>
                    </tr>
                    <?php  endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->



<!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('public')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?=base_url('public')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('public')?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url('public')?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url('public')?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('public')?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h1>
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
        <div class="card-body">
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <label for="Hora Inicio">Fecha de inicio</label><br>
                    <input type="date" name="date_inicio" id="date_inicio" >
                </div>
                <div class="col-sm-3">
                    <label for="Hora Final">Fecha Final</label><br>
                    <input type="date" name="date_final" id="date_final" >
                </div>
                <div class="col-sm-3">
                <label>Usuario</label>
                      <?php //php code generator
                        if  (isset($_POST['usuario']) and !empty($_POST['usuario'])){
                          $usuario = $_POST['usuario'];
                        }elseif (isset($datos['usuario']) and !empty($datos['usuario'])) {
                          $usuario = $datos['usuario'];
                        }else { $usuario = '';}
                      ?>
                      <select class="form-control select2"  id="usuario"  name="usuario" style="width: 100%;">
                        <option value="true">todos los usuario</option>
                        <?php
                            foreach ($listausuario as $key => $value) {
                                echo '<option name="'.$value['usuario'].'" value="'.$value['idusuario'].'">'.$value['usuario'].'</option>';
                            }
                        ?>
                      </select>
                </div>
                <div class="col-sm-2">
                <label>General reporte</label>
                    <button type="button"  onclick="ajax_reporte()" class="btn btn-block bg-gradient-primary ">
                        Ejecutar
                    </button>
                </div>
            </div>
            <hr>
        </div>

      <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Cod. Arqueo</th>
                    <th>Cod. Recibo</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Fecha</th>
                    <th>Cod. Arqueo</th>
                    <th>Cod. Recibo</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Total</th>
                  </tr>
                  </tfoot>
                </table>
              </div>

      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('.select2').select2();
    })

    function ajax_reporte() {
        
        var date_inicio = document.getElementById("date_inicio").value;
        var date_final = document.getElementById("date_final").value;
        var usuario = document.getElementById("usuario").value;
        var now = new Date();
        const mesActual = now.getMonth() + 1; 
        const time =  now.getFullYear()+ "-" + mesActual + "-" + now.getDate() ;
        if (!date_inicio) {
            date_inicio = time;
        }
        if (!date_final) {
            date_final = time;
        }  
        var http  = new XMLHttpRequest(); 
        const ruta = "<?=base_url()?>reporte/ajax_reporte?usuario="+usuario+"&date_final="+date_final+"&date_inicio="+date_inicio;
        http.open('GET',ruta,true);
        http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var resultado = (this.responseText);
          const index = resultado.indexOf("\n");
          const cut = resultado.substring(index);
          const final = resultado.replace(cut, "");
	        tabla = document.getElementById('example1'),
            tabla.innerHTML = '<thead><tr><th>Fecha</th><th>Cod. Arqueo</th><th>Cod. Recibo</th><th>Usuario</th><th>Cliente</th><th>Total</th></tr></thead>';
            var datos  = JSON.parse(final);
            datos.forEach(recibo => {
              var elemento = document.createElement("tr");
              elemento.innerHTML += ("<td>" + recibo.created_at + "</td>");
              elemento.innerHTML += ("<td>" + recibo.idarqueo_caja + "</td>");
              elemento.innerHTML += ("<td>" + recibo.idventas + "</td>");
              elemento.innerHTML += ("<td>" + recibo.vendedor + "</td>");
              elemento.innerHTML += ("<td>" + recibo.nombre + "</td>");
              elemento.innerHTML += ("<td>" + recibo.total + "</td>");
              document.getElementById("example1").appendChild(elemento);
            });
            console.log(ruta);
          } 
        }
        
        http.send();
    
    }
</script>

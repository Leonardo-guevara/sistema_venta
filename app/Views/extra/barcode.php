<script src="<?=base_url()?>codigo-barras/js/html2canvas.js"></script><!--Script para descargar el código de barras-->



<div class="content-wrapper">


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


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php if(!isset($title) and empty($title)){echo '';}else{echo $title;}?></h3>
          </div>
          <div class="row">
        <div class="card col-md-4 mt-5 mr-5">
          <div class="card-body">
            <div class="form-group">
              <label for="" class="control-label ">Código</label>
              <input type="text" id="code" class="form-control">
            </div>
            <div class="form-group">
              <label for="" class="control-label">Etiqueta</label>
              <input type="text" id="label" class="form-control">
            </div>
            <div class="form-group">
              <label for="" class="control-label">Tipo de Código de Barras</label>
              <select class="browser-default custom-select" id="type">
                <option value="C39">Code 39</option>
                <option value="C93">Code 93</option>
                <option value="C128">Code 128</option>
                <option value="C128A">Code 128 A</option>
                <option value="C128B">Code 128 B</option>
              </select>
            </div>
            <button type="button" class="col-md-2 btn-block float-right btn btn-primary btn-sm" id="generate">Generar</button>
          </div>
        </div>
        <div class=" card col-md-6 ml-5 mt-5" id='bcode-card'>
          <div class="card-body">
            <div id="display">
              <center>Código de Barras</center>
            </div>

          </div>
          <div class="card-footer" style="display:none">
            <center>
              <button type="button" class="btn-block btn btn-primary btn-sm" id="save">Descargar</button>
              <button type="button" class="btn-block btn btn-success btn-sm" id="print">Imprimir</button>
            </center>

          </div>
        </div>

      </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

</div>


<script>
  $('#generate').on('click', function() {
    if ($('#code').val() != '') {
      $.ajax({
        url: './codigo-barras/barcode.php',
        // url: '<?=base_url()?>home/ajax_barcode',
        method: "POST",
        data: {
          code: $('#code').val(),
          type: $('#type').val(),
          label: $('#label').val()
        },
        error: err => {
          console.log(err)
        },
        success: function(resp) {
          $('#display').html(resp)
          $('#bcode-card .card-footer').show('slideUp')
        }
      })
    }
  })

  $('#save').click(function() {
    html2canvas($('#field'), {
      onrendered: function(canvas) {
        var img = canvas.toDataURL("image/png"); /* Tipo de imagen a generar */

        var uri = img.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

        var link = document.createElement('a');
        if (typeof link.download === 'string') {
          document.body.appendChild(link);
          link.download = 'codigoBarras_' + $('#code').val() + '.png'; /* Nombre del archivo a descargar */
          link.href = uri;
          link.click();
          document.body.removeChild(link);
        } else {
          location.replace(uri);
        }

      }
    });
  })
  $('#print').click(function() {
    var openWindow = window.open("", "", "_blank");
    openWindow.document.write($('#display').parent().html());
    openWindow.document.write('<style>' + $('style').html() + '</style>');
    openWindow.document.close();
    openWindow.focus();
    openWindow.print();
    setTimeout(function() {
      openWindow.close();
    }, 100)
  })
</script>
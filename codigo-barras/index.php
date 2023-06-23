<!DOCTYPE html>
<html lang="es">

<head>
  <title>Generador de Código de Barras</title>
  <meta charset="utf-8" />
  <meta http-equiv="content-language" content="es">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="icon" type="image/jpg" href="./img/favicon.ico"/>
</head>

<body class="alert-info">

  <div class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="card-body text-center">
          <h4>Generador de Código de Barras</h4>
        </div>
      </div>
      <div class="row">
        <div class="card col-md-6 mt-5 mr-5">
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
        <div class=" card col-md-5 ml-5 mt-5" id='bcode-card'>
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

</body>

</html>
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/html2canvas.js"></script><!--Script para descargar el código de barras-->
<script>
  $('#generate').on('click', function() {
    if ($('#code').val() != '') {
      $.ajax({
        url: 'barcode.php',
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
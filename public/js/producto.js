$(function() {
    $('.select2').select2();
    $('#summernote').summernote();
    // select_presentacion();
  })

  function cien() {
    var x = document.getElementById("mySelect").value;
    const input = document.getElementById('cobertura');
    input.addEventListener('input', e => {
      const value = parseInt(e.currentTarget.value);
      if (value <= parseInt(x)) {
        porcentaje = (parseInt(x) * 0.30);
        input.value = parseInt(x) + porcentaje;
        alert('Por favor ingresa un mayor : ' + x);
      }
    });
  }


  
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


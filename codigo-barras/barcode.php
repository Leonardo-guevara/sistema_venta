<?php
require 'vendor/autoload.php';
extract($_POST);

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$codes ='';

foreach(str_split($code) as $key => $i){
	$codes .=$i;
	if(count(str_split($code)) != $key)
	$codes .=' ';

}
?>

<div id="field">
<center><large><b><?php echo $label ?></b></large></center>
<img src="data:image/png;base64,<?php echo base64_encode($generator->getBarcode($code, $type)) ?>" alt="<?php echo $label?>" />
<div id="code"><?php echo $codes ?></div>
</div>
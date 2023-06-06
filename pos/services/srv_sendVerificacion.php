<?php require ('../../includes/function.php'); ?>
<?php
if($_GET['codigo'] && $_GET['codigo'] != "" && $_GET['tel'] && $_GET['tel'] != ""){
		$_verificacion = checkVerificador($_GET['codigo'], $_GET['tel']);
		if($_verificacion){
			echo $_verificacion;
		}else{
			$_html = "Transacci&oacute;n rechazada: <br>El c&oacute;digo no es v&aacute;lido o ha sido usado anteriormente";
		}
	}
?>
<?php require ('../../includes/function.php'); ?>

<?php  noCache();?>

<?php

$usuario =$_POST['username'];

$clave = $_POST['clave'];

if($usuario != "" && $clave != ""){

	$valido = validaUser($usuario, $clave);
	echo "Válido: ".$valido;
	if($valido){

			echo "1";

		}else{

			include("../includes/loginFormError.php");

		}

}

?>
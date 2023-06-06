<?php require ('../../includes/function.php'); ?>
<?php
	//join('',file(dirname(__FILE__).'/archivo.ser')
//// Funcion que envia el mensaje
	if($_GET['msisdn'] && $_GET['smscid'] && $_GET['sender'] && $_GET['client_id'] && $_GET['content']){
			/* -------------- SE TRATA DE UN MENSAJE DE VALIDACION -------------- */
			$mensaje = "";
			$urlString = $_SERVER['REQUEST_URI'];
			if($_GET['content']){
				/*BUSCA MENSAJE DE RESPUESTA Y VALIDACION*/
				$mensaje = insertResponse($_GET['msisdn'], $urlString ,$_GET['content']);
			}
			//die($mensaje);
			insertLogPulls($_GET['msisdn'], $_GET['content'], $urlString);
			//sendSms($_GET['msisdn'], $_GET['smscid'], $mensaje, 2);		
	}else{
		logError();
	}
?>
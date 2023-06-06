<?php require ('../../includes/function.php'); ?>
<?php
	if($_GET['numero_tarjeta'] && $_GET['comando']){
			$_telefono = $_GET['numero_tarjeta'];
			$_monto    = $_GET['monto'];
			$_id_operacion = $_GET['comando'];
			$_operador = $_GET['operador'];
			switch($_id_operacion){
				case "1": // DEPOSITO : Ingresa operacion de suma de monto a determinado merchant, envia SMS,
					$_mensaje = doDeposito($_telefono,$_monto,$_operador);
					$_mensaje = " Deposito ";
					break;
				case "2": // COMPRA: revisa monto suma en merchant, si es suficiente, ingresa la operarion de resta fondo en merchant!
					$_userData      = getMerchantData();
					$_saldo = monto($_userData[0] , $_telefono);
					if( $_saldo >= $_monto){
						$_peticion = sendPeticion($_userData[0] , $_telefono, $_monto);
						//$_mensaje = doRetiro($_telefono,$_monto);
						
					}else{
						$_mensaje = " Lo sentimo tu saldo no es suficiente (".$_saldo .")";
					}
					
					
					
					break;
				case "3": // CONSULTA: revisa sumas y resta agrupadas por merchant de cierto telefono
					$_userData      = getMerchantData();
					//$_montoSuma  = monto(1, $_userData[0] , $_telefono);
					//$_montoResta = monto(2, $_userData[0] , $_telefono);
					$_saldo = monto($_userData[0] , $_telefono);
					$_mensaje = "El saldo es: ".amoneda($_saldo, pesos);
					/*
					if(){
						$_mensaje = " Saldo ";
					}else{
						$_mensaje = " Saldo";
					}
					*/
					//echo "-> ". $_userData[0].", ".$_montoSuma . " , ".$_montoResta ;
					break;
				default:
					$_mensaje = " Error en la operaci&oacute;n  ";
			}
			echo $_mensaje;
			//doOperacion( $_GET['numero_tarjeta'] && $_GET['operador'] && $_GET['monto'] && $_GET['numero_tarjeta']);
			//$mensaje = "SE HAN DEPOSITADO ".$_GET['monto']." EN REGALOS PARA CONSUMIRSE EN";
			//insertLogPulls($_GET['numero_tarjeta'], $_GET['content'], $urlString);
			//echo sendSms($_GET['numero_tarjeta'], $_GET['operador'], $mensaje, 2, 0);
	}
?>
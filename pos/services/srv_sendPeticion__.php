<?php require ('../../includes/function.php'); ?>
<?php
	if($_GET['numero_tarjeta'] && $_GET['comando']){
			$_telefono     = $_GET['numero_tarjeta'];
			$_monto        = $_GET['monto'];
			$_id_operacion = $_GET['comando'];
			$_operador = $_GET['operador'];
			$_mensaje  = $_GET['nombre'];
			switch($_id_operacion){
				case "1": // DEPOSITO : Ingresa operacion de suma de monto a determinado merchant, envia SMS,
					$_mensaje = doDeposito($_telefono,$_monto,$_operador, $_mensaje);
						$_html = "<div id=\"ticket\">";
						$_html .= "<table align=\"center\" width=\"70%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">No de Tel&eacute;fono: </td><td class=\"textItemGris\">".$_telefono."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Fecha: </td><td class=\"textItemGris\">".date('d-m-Y')."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Num. de Ticket: </td><td class=\"textItemGris\">".$_mensaje."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Monto:  </td><td class=\"textItemGris\">$".$_monto."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td colspan=\"2\" align=\"center\"><a class=\"btn_operacion\" href=\"javascript:CallPrint('ticket')\">Imprime Ticket</a></td></tr>\n";
						$_html .= "</tbody>\n</table>\n";
						$_html .= "</div>";
						$_mensaje = $_html;
						
					break;
				case "2": // COMPRA: revisa monto suma en merchant, si es suficiente, ingresa la operarion de resta fondo en merchant!
					$_userData      = getMerchantData();
					$_saldo = monto($_userData[0] , $_telefono);
					if( $_saldo >= $_monto){
						$_peticion = sendPeticion($_userData[0] , $_telefono, $_monto);
						if($_peticion){
							include ('../../includes/pos_confirmation_interface.php'); 
						}
					}else{
						$_mensaje = " Lo sentimo tu saldo no es suficiente (".$_saldo .")";
					}
					break;
				case "3": // CONSULTA: revisa sumas y resta agrupadas por merchant de cierto telefono
					$_userData      = getMerchantData();
					$_saldo = monto($_userData[0] , $_telefono);
					$_mensaje = "El saldo es: ".amoneda($_saldo, pesos);
					break;
				default:
					$_mensaje = " Error en la operaci&oacute;n  ";
			}
			echo $_mensaje;
	}
?>
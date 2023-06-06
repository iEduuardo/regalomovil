<?php require ('../../includes/function.php'); ?>

<?php  noCache();?>

<?php

	//$sql = "SELECT ROWNUM, STORE_NUMBER, AUTH_DATETIME,  TO_CHAR(STATUS), MERCHANT_ID, STORE_NUMBER,CRYPTO.DECRYPT(ACCOUNT_NUMBER) as tarjeta, TO_CHAR(UPC) as UPC , AMOUNT as monto, TO_CHAR(SYS_AUDIT_TRACE_NUMBER) autorizacion, TERMINALID FROM GC_TXLOG  WHERE (AUTH_DATETIME >'20-OCT-10') AND (AUTH_DATETIME <'21-OCT-10');";

	$_paginacion = 20;

	$sql = "";

	$_sql_base = "SELECT id_registro, dt_fecha, dt_hora, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado, int_estatus, str_folio, str_tarjeta, str_num_vendedor, str_num_pedido, id_merchant, id_pos FROM mvl_transaction_log ";

	//20-OCT-10

	//-----------------------------

	if($_GET['fecha'] && $_GET['fecha']!= ''){

		$sql_where = " (dt_fecha >= '".date('Y-m-d',strtotime($_GET['fecha']))."') ";// AND ROWNUM < ".$_paginacion;

		if($_GET['fecha_final'] && $_GET['fecha_final']!= ''){

			$_nextDay = date('Y-m-d', strtotime($_GET['fecha_final'])) ;

			$sql_where .= " AND (dt_fecha <= '".$_nextDay."') ";

		}else{

			$_nextDay = date('Y-m-d', strtotime('+1 day', strtotime($_GET['fecha']))) ;

			$sql_where .= " AND (dt_fecha < '".$_nextDay."') ";

		}

		//echo "<br>--> ".$_GET['fecha']. " -- " .$_GET['fecha_final']. " - " .$_nextDay . "<br>";

	}else{

		$sql_where = " (dt_fecha > '".date('Y-m-d')."') "; //AND ROWNUM < ".$_paginacion; //20-OCT-10

	}





	//-----------------------------

	if($_GET['ordenado'] && $_GET['ordenado']!= ''){

		$sql_where .= " ORDER BY ".$_GET['ordenado'];	

	}else{

		$sql_where .= " ORDER BY dt_fecha";	

	}

	/*----------------------------*/

	//$db = conexion();

	/*----------------------------*/

		if( strlen($sql_where) >5){

				$sql = $_sql_base. " WHERE " .$sql_where;

		}else{

				$sql  = $_sql_base;

		}

	//die();

	//die($sql);

	//echo "<br>".$sql."<br>";

	/*----------------------------*/

	$RSCpn = getRecordSet($sql);

		if($RSCpn){

			$_vuelta = 1;

			$_suma   = 0;

			$html = "";

			$html .= "<table colspan='0' border='0'>\n";

			$html .= "<tr>";

			$html .= "<td colspan=\"10\" class=\"reportXLS\"><a href=\"#\" onclick=\"javascript:getReporteXLS();\" class=\"btn_reportsXLS\">Reporte XLS</a></td>";

			$html .= "</tr>\n";

			$html .= "<tr>";

			$html .= "<td class=\"reportRowTitle\">Registro</td>";

			$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('str_num_vendedor');\"> No. Vendedor</a></td>";

			$html .= "<td class=\"reportRowTitle\">Compra</td>";	

			$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('dt_fecha');\">Fecha</a></td>";

			$html .= "<td class=\"reportRowTitle\">Hora</td>";

			$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('str_operacion');\">Actividad</a></td>";

			//$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('STATUS');\">Resultado</a></td>";

			$html .= "<td class=\"reportRowTitle\">Tarjeta</td>";

			//$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('UPC');\">UPC</a></td>";

			$html .= "<td class=\"reportRowTitle\"><a class=\"btn_reportsOrder\" href=\"javascript:ordenarResultado('str_monto');\">Monto</a></td>";

			//$html .= "<td class=\"reportRowTitle\">Autorizaci&oacute;n</td>";

			$html .= "</tr>\n";

			$html .= "<tr><td class='separador' colspan='10'></td></tr>\n";

	while ($datos = mysql_fetch_row($RSCpn)) {

		$html .= "<tr>\n";

			$html .= "<td class=\"reportRow\">". $_vuelta ."</td>\n";

			$html .= "<td class=\"reportRow\">";

			if($datos[3]!= ""){

				$html .=  getUserDatum($datos[3]) ;

			}else{

				$html .=  "&nbsp;";

			}

			$html .= "</td>\n";

			$html .= "<td class=\"reportRow\">" ;

				if($datos[7] != 0){

					$html .= amoneda($datos[7],pesos);

				}else{

					$html .=  "na";

				}

			$html .= "</td>\n";

			$html .= "<td class=\"reportRow\">". $datos[1] ."</td>\n";

			$html .= "<td class=\"reportRow\">". substr($datos[2],10) ."</td>\n";

			$html .= "<td class=\"reportRow\">". getOperacion($datos[5])." </td>\n";

			$html .= "<td class=\"reportRow\">". $datos[4] ."</td>\n";

			$html .= "<td class=\"reportRow\">\n";

				if(is_numeric($datos[4]) && $datos[5]=='1'){ 

					$_descuento = $datos[7];

					$html .= amoneda($_descuento,pesos);

					$_total_regalo += intval($_descuento) ;

				}else{

					$html .= "na";

				}

			$html .= "</td>\n";

		$html .= "</tr>\n";

		//--------------------

		if($datos[7] != '0' && $datos[5] == '3' && $datos[9] == '3' ){

			$_suma += intval($datos[7]) ;

		}

		if(  $datos[5] == '1' ){

			$_totalActivaciones++ ;

		}

		//--------------------

		$_vuelta++;

	}

	//-----------------------------------

	/* AREA DE RESULTADOS */

	//-----------------------------------

	$html .= "<tr>";

		$html .= "<td class=\"reportRowTitle\" align=\"center\">".$_vuelta."</td>";

		$html .= "<td class=\"reportRowTitle\">&nbsp;</td>";

		$html .= "<td class=\"reportRowTitle\" align=\"center\">".amoneda($_suma, pesos) ."</td>";

		$html .= "<td class=\"reportRowTitle\">&nbsp;</td>";

		$html .= "<td class=\"reportRowTitle\">&nbsp;</td>";

		$html .= "<td class=\"reportRowTitle\" align=\"center\">".$_totalActivaciones." </td>";

		$html .= "<td class=\"reportRowTitle\">&nbsp;</td>";

		$html .= "<td class=\"reportRowTitle\">".amoneda($_total_regalo, pesos)."</td>";

	$html .= "</tr>\n";

	//-----------------------------------

	//-----------------------------------

	$html .= "</table>\n";

			//---------------------------

		}

		echo $html;



?>
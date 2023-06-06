<?php require ('bdd_operation.php'); ?>

<?php
#-----------------------------------------------------------------
## NO CACHE ##
#-----------------------------------------------------------------
#-----------------------------------------------------------------
function getMes(){
	$mes=date("F");
		if ($mes=="January") $mes="Enero";
		if ($mes=="February") $mes="Febrero";
		if ($mes=="March") $mes="Marzo";
		if ($mes=="April") $mes="Abril";
		if ($mes=="May") $mes="Mayo";
		if ($mes=="June") $mes="Junio";
		if ($mes=="July") $mes="Julio";
		if ($mes=="August") $mes="Agosto";
		if ($mes=="September") $mes="Setiembre";
		if ($mes=="October") $mes="Octubre";
		if ($mes=="November") $mes="Noviembre";
		if ($mes=="December") $mes="Diciembre";
	return $mes;
}

#-----------------------------------------------------------------
## NO CACHE ##
#-----------------------------------------------------------------
function noCache() {
  header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
}
#-----------------------------------------------------------------
## NO CACHE ##
#-----------------------------------------------------------------
function validaUser($usuario, $clave){
	$MM_redirectLoginSuccess = "index.php";
	$MM_redirectLoginFailed = "index_error.php";
	return isUserValid($usuario, $clave);
}

#-----------------------------------------------------------------
function isUserValid($usuario, $clave){
	//DEFINICION DE VARIABLES
	$accesstime = date("H:i:s");
	$loginUsername = $usuario;
	$password = md5($clave);//$MD5_PREFIX.
	$MM_fldUserAuthorization = "tipo";
	$MM_redirecttoReferrer = false;
	$validacion;
	$SQLLog = "SELECT A.id_usuario, A.str_username, A.int_tipodeusuario FROM "._PREPOS."tbl_usuarios as A WHERE  A.str_username='".$loginUsername."' AND A.str_password='".$password."'";
	// PROCESO DE VALIDACION
	//-----------------------
	conexion();
	//-----------------------
	if (!($result = mysql_query($SQLLog))) {
		die("No es posible realizar la operaci&oacute;n\n<br> Favor intentar m&aacute;s tarde."); //.$SQLLog
  		$validacion = false;
  	}
	if (mysql_num_rows($result) > 0) {
			if ($user=mysql_fetch_array($result)) {
				if (!isset($_SESSION)) {
					session_start();
				}
				$_SESSION['validado'] = true;
				$_SESSION['MM_Username'] = $loginUsername;
				$_SESSION['MM_UserGroup'] = $user["int_tipodeusuario"];
				$_SESSION['MM_UserID'] = $user["id_usuario"];
				$_SESSION['Access_Time'] = $accesstime;
				$_COOKIE['username'] = $loginUsername;
				putLog($user["id_usuario"]);
				$validacion = true;
			}else{
				$validacion = false;	
			}
   	}else{
		$validacion = false;	
  	}
	return $validacion;
	
}


#-----------------------------------------------------------------
#-----------------------------------------------------------------
function putLog($id_usuario){
	$_date = date('Y-m-d');
	$_time = date('H:i:s');
	$sql_log = "INSERT INTO "._PREPOS."tbl_log_usuarios (id_usuario, dt_fecha, dt_hora) VALUES('".$id_usuario."','".$_date."','".$_time ."')";	
	$idLog = executeQuery($sql_log);
	return $idLog; 
}
/* 
* FUNCIONES
* version 1.0 Jorge Eduardo Pineda (jorgepineda at jorgepineda.com.mx)
* para Regalo Movil www.regalomovil.com.mx
*/
/*BORRA VARIABLES DE SESSION */
#-----------------------------------------------------------------
#-----------------------------------------------------------------
function vaciaVariablesSession(){
				$_SESSION['validado'] = "";
				$_SESSION['MM_Username'] = "";
				$_SESSION['MM_UserGroup'] = "";
				$_SESSION['MM_UserID'] = "";
				$_SESSION['Access_Time'] = "";
				$_SESSION['MM_allowed']= "";
				$_SESSION['MM_push_allowed'] = "";
				session_destroy();
	}
#-----------------------------------------------------------------
#-----------------------------------------------------------------	
function  userValidado(){
	session_start();
	if($_SESSION['MM_UserID'] == ""){
		 header("Location: validacion.php" );
		}
}
#-----------------------------------------------------------------
#-----------------------------------------------------------------	
function  userValidado_admon(){
	session_start();
	if($_SESSION['MM_UserID'] == ""){
		 header("Location: validacion.php" );
		}else{
			if($_SESSION['MM_UserGroup'] != "1"){
		 		header("Location: permission.php" );
			}
		}
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function havePermission($idUsuario, $idSeccion){
	$name = "";
	$_sql = "SELECT id_privilegios FROM "._PREPOS."tbl_privilegios WHERE id_usuario =".$idUsuario." AND int_area =".$idSeccion;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$dato = mysql_fetch_row($RSVal);
			if($dato[0] != ""){
				$datos = true;
			}else{
				$datos = false;
			}
		}else{
			$datos = false;
		}
	return $datos;	
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getUserNameData($idUser){
	$name = "";
	$_sql = "SELECT str_username, str_nombre, str_apellidoP FROM "._PREPOS."tbl_usuarios WHERE id_usuario =".$idUser;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos;
	}
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getMerchantName($_idMerchant){
	$name = "";
	$_sql = "SELECT str_descripcion FROM "._PREPOS."ctl_merchants WHERE id_merchant =".$_idMerchant;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos[0];
	}
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getUserDatum($idUser){
	$name = "";
	$_sql = "SELECT str_username, str_nombre, str_apellidoP FROM "._PREPOS."tbl_usuarios WHERE id_usuario =".$idUser;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos[1]." ".$datos[2]."(".$datos[0].")";
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getMerchantData(){
	if (!isset($_SESSION)) {
					session_start();
				}
	$idUser = $_SESSION['MM_UserID'];
	$_sql = "SELECT A.id_merchant, A.id_store_number, A.id_terminal, B.`str_intern_storenumber` FROM mvl_transaction_datum as A , mvl_ctl_merchants as B WHERE A.id_merchant=B.id_merchant AND A.id_usuario=".$idUser;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function monto($_id_merchant, $_telefono){
	$_sql_consulta = "SELECT num_saldo FROM "._PREPOS."tbl_edo_cuenta WHERE str_telefono ='".$_telefono."' AND id_merchant = '".$_id_merchant."'";
	$RSVal = getRecordSet($_sql_consulta);
		if($RSVal){
			$_datos = mysql_fetch_row($RSVal);
			$_dato = $_datos[0];
		}else{
			$_dato = 0;
		}	
		return $_dato;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
//7731225764,200,,JORGE
function doDeposito($_telefono,$_monto, $_operador, $_mensaje){
		if (!isset($_SESSION)) {
			session_start();
		}
		$idUser         = $_SESSION['MM_UserID'];
		$_userData      = getMerchantData();
		$_sql_insert    = "INSERT INTO "._PREPOS."transaction_log (dt_fecha, id_merchant, id_pos, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado) VALUES('".date('Y-m-d')."', '".$_userData[0]."','".$_userData[2]."','".$idUser."' ,'".$_telefono."','1','Deposito ','".$_monto."','1')";
		$id_insert      = executeQuery($_sql_insert);
			if($id_insert){
				$_sql_update_saldo = "UPDATE  "._PREPOS."tbl_edo_cuenta  SET num_saldo = num_saldo + ".$_monto." WHERE str_telefono = '".$_telefono."' AND id_merchant = '".$_userData[0]."'";
				if(executeQueryNumRows($_sql_update_saldo) ==0){
						$_sql_insert_saldo = "INSERT INTO "._PREPOS."tbl_edo_cuenta (str_telefono, id_merchant, num_saldo, str_operador) VALUES('$_telefono','".$_userData[0]."','$_monto','$_operador')";
						$_id_insert_saldo = executeQuery($_sql_insert_saldo);
				}
				//$_mensajeSMS = "Felicidades has recibido un RegaloMovil de $".$_monto." por parte de ".$_mensaje." para que lo utilices en: ".$_userData[3];
				$template= "e1b62588-446d-4303-b156-1ba63bccf06b";
				$_sms_enviado = sendWtsReturn($_telefono, $_userData[0], $template, $_monto, $_mensaje, $_userData[3], 0);
				// echo "userData[3] ".$_userData[3];
				$_mensaje = $id_insert;
			}else{
				$_mensaje = false;
			}
			return $_mensaje;
	}

	function doDepositoSMS($_telefono,$_monto, $_operador, $_mensaje){
		if (!isset($_SESSION)) {
			session_start();
		}
		$idUser         = $_SESSION['MM_UserID'];
		$_userData      = getMerchantData();
		$_sql_insert    = "INSERT INTO "._PREPOS."transaction_log (dt_fecha, id_merchant, id_pos, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado) VALUES('".date('Y-m-d')."', '".$_userData[0]."','".$_userData[2]."','".$idUser."' ,'".$_telefono."','1','Deposito ','".$_monto."','1')";
		$id_insert      = executeQuery($_sql_insert);
			if($id_insert){
				$_sql_update_saldo = "UPDATE  "._PREPOS."tbl_edo_cuenta  SET num_saldo = num_saldo + ".$_monto." WHERE str_telefono = '".$_telefono."' AND id_merchant = '".$_userData[0]."'";
				if(executeQueryNumRows($_sql_update_saldo) ==0){
						$_sql_insert_saldo = "INSERT INTO "._PREPOS."tbl_edo_cuenta (str_telefono, id_merchant, num_saldo, str_operador) VALUES('$_telefono','".$_userData[0]."','$_monto','$_operador')";
						$_id_insert_saldo = executeQuery($_sql_insert_saldo);
				}
				$_mensajeSMS = "Felicidades has recibido un RegaloMovil de $".$_monto." por parte de ".$_mensaje." para que lo utilices en: ".$_userData[3];
				$_sms_enviado = sendSmsReturn($_telefono, $_operador, $_mensajeSMS, 1, 1);
				$_mensaje = $id_insert;
			}else{
				$_mensaje = false;
			}
			return $_mensaje;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	

function doRetiro($_telefono, $_monto){
		if (!isset($_SESSION)) {
			session_start();
		}
		$idUser         = $_SESSION['MM_UserID'];
		$_userData      = getMerchantData();
		$_sql_insert    = "INSERT INTO "._PREPOS."transaction_log (dt_fecha, id_merchant, id_pos, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado) VALUES('".date('Y-m-d')."', '".$_userData[0]."','".$_userData[2]."','".$idUser."' ,'".$_telefono."','2','Redencion ','".$_monto."','1')";
		$id_insert      = executeQuery($_sql_insert);
			if($id_insert){
				$_sql_update_saldo = "UPDATE  "._PREPOS."tbl_edo_cuenta  SET num_saldo = num_saldo - ".$_monto." WHERE str_telefono = '".$_telefono."' AND id_merchant = '".$_userData[0]."'";
				if(executeQueryNumRows($_sql_update_saldo) == 1){
					$_mensaje = "La compra ha sido solicitada.";
				}else{
					$_mensaje = "Existe alguna anomalia, favor de intentar mas tarde.";
				}
				
			}else{
				$_mensaje = "Existe alguna anomalia, favor de intentar mas tarde.";
			}
			return $_mensaje;
	}


/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function sendPeticion($_id_merchant, $_telefono, $_monto){
			if (!isset($_SESSION)) {
			session_start();
		}
		$idUser         = $_SESSION['MM_UserID'];
		$_userData      = getMerchantData();
		$_tipoSms       = 2;
		$_logitudTkn    = 6;
		$_token   = generateCode( $_logitudTkn );
		$_operador = getOperador($_id_merchant, $_telefono);
		$_sql_insert    = "INSERT INTO "._PREPOS."transaction_log (dt_fecha, id_merchant, id_pos, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado, int_estatus, str_folio) VALUES('".date('Y-m-d')."', '".$_userData[0]."','".$_userData[2]."','".$idUser."' ,'".$_telefono."','3','Peticion ','".$_monto."','1','2','".$_token."')";
		$id_retiro      = executeQuery($_sql_insert);				
				   /*---------------------------------------*/
				   if($id_retiro){
					   	//$_mensaje  = "Se esta haciendo un cargo por ".amoneda($_monto, 'pesos')." en RegaloMovil a tu celular, por favor confirma respondiendo con un SMS con un SI o un NO y un espacio seguido de ".$id_retiro;
						$_template  = "dd5fad7e-a6c5-4c00-9e36-cec1cdc519f7";
						$_sms_enviado = sendWtsReturn($_telefono, $idCampana, $_template, $_monto, $_token, null, 1);
						//if($_sms_enviado){
								return $_sms_enviado;
								
								$_mensaje = "La solicitud ha sido enviada, por favor solicita el n&uacute;mero de confirmaci&oacute;n:";
							//}
					
					}
}
function sendPeticionSMS($_id_merchant, $_telefono, $_monto){
	if (!isset($_SESSION)) {
	session_start();
}
echo "SendPeticion";
$idUser         = $_SESSION['MM_UserID'];
$_userData      = getMerchantData();
$_tipoSms       = 2;
$_logitudTkn    = 6;
$_token   = generateCode( $_logitudTkn );
$_operador = getOperador($_id_merchant, $_telefono);
$_sql_insert    = "INSERT INTO "._PREPOS."transaction_log (dt_fecha, id_merchant, id_pos, id_usuario, str_telefono, int_operacion, str_operacion, str_monto, str_resultado, int_estatus, str_folio) VALUES('".date('Y-m-d')."', '".$_userData[0]."','".$_userData[2]."','".$idUser."' ,'".$_telefono."','3','Peticion ','".$_monto."','1','2','".$_token."')";
$id_retiro      = executeQuery($_sql_insert);				
		   /*---------------------------------------*/
		   if($id_retiro){
				   //$_mensaje  = "Se esta haciendo un cargo por ".amoneda($_monto, 'pesos')." en RegaloMovil a tu celular, por favor confirma respondiendo con un SMS con un SI o un NO y un espacio seguido de ".$id_retiro;
				$_mensaje  = "Se esta haciendo un cargo por ".amoneda($_monto, 'pesos')." en RegaloMovil. El folio de compra es: ".$_token;
				$_sms_enviado = sendSmsReturn($_telefono, $_operador, $_mensaje, $_tipoSms, $idCampana);
				echo "Token ".$_token;
				//if($_sms_enviado){
						return $_sms_enviado;
						
						$_mensaje = "La solicitud ha sido enviada, por favor solicita el n&uacute;mero de confirmaci&oacute;n:";
					//}
			
			}
}
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function getOperador($_id_merchant, $_telefono){
	$_sql = "SELECT str_operador FROM "._PREPOS."tbl_edo_cuenta WHERE str_telefono = '".$_telefono."' AND id_merchant = '".$_id_merchant."'";
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos[0];
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
//$_GET['msisdn'], $urlString ,$_GET['content']
function insertResponse($_msid, $_urlString, $_respuesta){
		$_arrRespuesta = explode(" ", strtolower(trim($_respuesta)));
		if(($_arrRespuesta[0] == "si" || $_arrRespuesta[0] == "ok") && $_arrRespuesta[1] != ''){
			   	$_sql_insert    = "UPDATE "._PREPOS."transaction_log SET int_estatus = 1 WHERE str_telefono=$_msid AND id_registro=".$_arrRespuesta[1];
				$id_retiro      = executeQuery($_sql_insert);				
 
			}
	}
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getMerchantDataForOutput(){
	if (!isset($_SESSION)) {
					session_start();
				}
	$idUser = $_SESSION['MM_UserID'];
	//$_sql = "SELECT str_merchant_id, str_store_number, str_terminal_id FROM "._PREPOS."transaction_datum WHERE id_usuario =".$idUser;
	$_sql = "SELECT B.str_intern_storenumber, C.str_nombre, D.str_descripcion FROM "._PREPOS."transaction_datum as A,  "._PREPOS."ctl_merchants as B,  "._PREPOS."tbl_sucursal as C,  "._PREPOS."tbl_pos as D WHERE A.id_store_number = B.id_merchant AND A.id_sucursal = C.id_sucursal AND A.id_terminal=D.id_pos AND id_usuario = ".$idUser;
	//echo $_sql;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getUserName(){
	if (!isset($_SESSION)) {
					session_start();
				}
	$idUser = $_SESSION['MM_UserID'];
	$name = "";
	$_sql = "SELECT str_username, str_nombre, str_apellidoP FROM "._PREPOS."tbl_usuarios WHERE id_usuario =".$idUser;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos[1]." ".$datos[2];
	}
	
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getDefault($_value){
	if (!isset($_SESSION)) {
					session_start();
	}
	$idUser = $_SESSION['MM_UserID'];
	$_sql = "SELECT str_valor FROM "._PREPOS."tbl_usuarios_opciones WHERE id_usuario =".$idUser." AND str_variable='".$_value."'" ;
	$RSVal = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
	return $datos[0];
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getProfileData(){
	if (!isset($_SESSION)) {
					session_start();
				}
	$_idUser = $_SESSION['MM_UserID'];
	$_sql = "SELECT A.id_usuario, A.int_tipodeusuario, A.str_nombre, A.str_apellidoP, A.str_username, B.str_descripcion, C.str_nombre, D.str_descripcion FROM "._PREPOS."tbl_usuarios AS A, "._PREPOS."ctl_merchants AS B, "._PREPOS."tbl_sucursal AS C, "._PREPOS."tbl_pos AS D WHERE A.id_usuario = ".$_idUser." AND A.id_merchant = B.id_merchant AND A.id_sucursal = C.id_sucursal AND A.id_pos = D.id_pos";
	$RSVal = getRecordSet($_sql);
	if($RSVal){
		 return $RSVal;
	}else{
		return false;
		}
	
	
	}
	
/*-----------------------------------------------------------------*/	
function getCombo($_inputName, $_verifierInput, $_sql, $_selected, $_script = false){
		$_verifierScript = "";
		$_verifier = "";
		$_comboName = "cmb_".$_inputName;
		$RSCpn = getRecordSet($_sql);
		if($RSCpn){
			if($_verifierInput){
				$_verifierScript = " onChange=\"document.getElementById('".$_inputName."').value=this.value;".$_script."\"";
				$_verifier = "\n<input type='hidden' id='".$_inputName."' name='".$_inputName."' value='".$_selected."'>\n";
			}
			$html  = " <SELECT class='inputText' id=\"".$_comboName."\" name=\"".$_comboName."\"".$_verifierScript." >\n";
			$html  .= " <OPTION value=''>Selecciona</OPTION>\n";
			while ($datosCampaingUsers = mysql_fetch_row($RSCpn)){
				if($datosCampaingUsers[0] == $_selected){
					$_CHECKED = " SELECTED " ;
				}else{
					$_CHECKED = "";
				}
				$html  .= " <OPTION value='".$datosCampaingUsers[0]."' ".$_CHECKED.">".$datosCampaingUsers[1]."</OPTION>\n";
			}
			$html .= "</SELECT>\n";
			$html .= $_verifier;
		}else{
			$html = "No tienes ningun env&iacute;o previo";
		}
		return $html;
	}

/*-----------------------------------------------------------------*/
/* TIPOS DE USUARIO */

function getListaTiposUsuario($_inputName, $_verifierInput, $_selected){
		$_sql  = "SELECT id_tipo, str_descripcion FROM "._PREPOS."ctl_tiposusuario ORDER BY str_descripcion ASC";
		$_html = getCombo($_inputName, $_verifierInput, $_sql, $_selected, "isUsuario('".$_inputName."')");
		return $_html;	
	}

/*-----------------------------------------------------------------*/
function getListaMerchants($_inputName, $_verifierInput, $_selected){
		$_sql = "SELECT id_merchant, str_descripcion FROM "._PREPOS."ctl_merchants ORDER BY str_descripcion ASC";
		$_html = getCombo($_inputName, $_verifierInput, $_sql, $_selected, "getTipoUsuarios()");
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getListaMerchantsUser($_inputName, $_verifierInput, $_selected){
		$_sql = "SELECT id_merchant, str_descripcion FROM "._PREPOS."ctl_merchants ORDER BY str_descripcion ASC";
		$_html = getCombo($_inputName, $_verifierInput, $_sql, $_selected, false);//"getSucursales(this.value);"
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getListaSucursales($_id_merchant){
		$_sql = "SELECT id_sucursal, str_nombre FROM "._PREPOS."tbl_sucursal WHERE id_merchant = ".$_id_merchant." ORDER BY str_nombre ASC";
		$_html = getCombo("id_sucursal", true, $_sql, $_selected,"getPOSCombo(".$_id_merchant.")");
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getListaSucursalesUser($_id_merchant,$_selected){
		$_sql = "SELECT id_sucursal, str_nombre FROM "._PREPOS."tbl_sucursal WHERE id_merchant = ".$_id_merchant." ORDER BY str_nombre ASC";
		$_html = getCombo("id_sucursal", true, $_sql, $_selected, false);
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getListaPDVs($_id_merchant, $_id_sucursal){
		$_sql = "SELECT id_pos, str_descripcion FROM "._PREPOS."tbl_pos WHERE id_merchant = ".$_id_merchant." AND id_sucursal =".$_id_sucursal." ORDER BY str_descripcion ASC";
		$_html = getCombo("id_pos", true, $_sql, 1,"getPOSTypeCombo()");//"getPOSTypeCombo()"
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getListaPDVsUser($_id_merchant, $_id_sucursal, $_selected){
		$_sql = "SELECT id_pos, str_descripcion FROM "._PREPOS."tbl_pos WHERE id_merchant = ".$_id_merchant." AND id_sucursal =".$_id_sucursal." ORDER BY str_descripcion ASC";
		$_html = getCombo("id_pos", true, $_sql, $_selected, false);
		return $_html;
	}
/*-----------------------------------------------------------------*/
function getComboTypoPDVs(){
			$_html  = " <SELECT class='inputText' id=\"cmb_posType\" name=\"cmb_posType\" onChange=\"document.getElementById('posType').value=this.value;\">\n";
				$_html .= " <OPTION value='1' SELECTED>C&oacute;digo de Barras</OPTION>\n";
				$_html .= " <OPTION value='2'>Banda Magn&eacute;tica</OPTION>\n";
			$_html .= "</SELECT>\n";
			$_html .= "<input type='hidden' id=\"posType\" name=\"posType\" value=\"1\"/>\n";

		return $_html;
	}
/*
*******************************************************************************************************
FUNCIONES DE USUARIO
*******************************************************************************************************
*/

function getUserList($opt){
		$sql = "SELECT id_usuario, id_pos, id_merchant, id_sucursal, id_terminal, str_username, str_password, str_nombre, str_apellidoP, int_tipodeusuario, dt_fechadecreacion, str_email FROM "._PREPOS."tbl_usuarios ORDER BY str_apellidoP, str_nombre ASC";
		$html = "";
		$RSVal = getRecordSet($sql);
		if (!isset($_SESSION)) {
					session_start();
				}
		$_tipoUsuario = $_SESSION['MM_UserGroup'];
		$_x = 1;
			$html .= "<table width=\"100%\">\n";
			$html .= "<tr class=\"rowTitle\"><td class=\"colTitle\">Nombre</td><td class=\"colTitle\">Usuario</td><td class=\"colTitle\">Tipo</td><td class=\"colTitle\">Fecha de creaci&oacute;n</td><td class=\"colTitle\">Operaciones</td></tr>";
				while ($datos=mysql_fetch_row($RSVal)){
					$html .= "<tr id='row_".$_x."'>";
					$html .= "<td class=\"textItemgris\">".$datos[7]." ".$datos[8]."</td>\n";
					$html .= "<td class=\"textItemgris\">".$datos[5]."</td>\n";
					$html .= "<td class=\"textItemgris\">".getTipoUsuario($datos[9])."</td>\n";
					$html .= "<td class=\"textItemgris\">".$datos[10]."</td>\n";
					$html .= "<td class=\"operaciones\">";
					//if($opt == 2){
						$html .= "<a href=\"#\" onClick=\"getUserInfo(".$datos[0].");\"><img alt=\"informacion\" src=\"images/icons/view_icon.png\" border='0'></a>";
					//}
					if($_tipoUsuario == 1 && $opt == 1){
						$html .= "<a href=\"#\" onClick=\"getUserEditForm(".$datos[0].");\"><img alt=\"editar\" src=\"images/icons/edit_icon.png\" border='0'></a>";
					}
					if($_tipoUsuario == 1 && $opt == 1){
						$html .= "&nbsp;<a href=\"#\" onClick=\"doDeleteUser(".$datos[0].",'row_".$_x."');\"><img alt=\"borrar\" src=\"images/icons/delete_icon.png\" border='0'></a></td>\n";
					}
					$html .= "</tr>";
					$_x++;
				}
			$html .= "</table>\n";
		echo $html;
	}
	
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getComerceList(){
		$sql = "SELECT * FROM "._PREPOS."ctl_merchants ORDER BY str_descripcion ASC";
		$html = "";
		$RSVal = getRecordSet($sql);
		if (!isset($_SESSION)) {
					session_start();
				}
		$_tipoUsuario = $_SESSION['MM_UserGroup'];
		$_x = 1;
			$html .= "<table width=\"100%\">\n";
			$html .= "<tr class=\"rowTitle\"><td class=\"colTitle\">Nombre</td><td class=\"colTitle\">Operaciones</td></tr>";
				while ($datos=mysql_fetch_row($RSVal)){
					$html .= "<tr id='row_".$_x."'>";
					$html .= "<td class=\"textItemgris\">".$datos[2]."</td>\n";
					$html .= "<td class=\"operaciones\">";
						if($_tipoUsuario == 1 && $opt != 2){
							$html .= "<a title=\"Editar informacion\" href=\"#\" onClick=\"getMerchantEditForm(".$datos[0].");\"><img alt=\"editar\" src=\"images/icons/edit_icon.png\" border='0'></a>";
						}
						if($_tipoUsuario == 1 && $opt != 2){
							$html .= "&nbsp;<a title=\"Borrar comercio\" href=\"#\" onClick=\"doDeleteMerchant(".$datos[0].",'row_".$_x."','".$id_merchant."');\"><img alt=\"borrar\" src=\"images/icons/delete_icon.png\" border='0'></a>\n";
						}
						if($_tipoUsuario == 1 && $opt != 2){
							$html .= "<a title=\"Crear nueva sucursal\" href=\"#\" onClick=\"getListadoSucursales(".$datos[0].");\"><img alt=\"sucursales\" src=\"images/icons/sucursal_icon.png\" border='0'></a>";
						}
					$html .= "</tr>";
					$_x++;
				}
			$html .= "</table>\n";
		echo $html;
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getBranchList($id_merchant){
		$sql = "SELECT * FROM "._PREPOS."tbl_sucursal WHERE id_merchant=".$id_merchant." ORDER BY str_nombre ASC";
		$html = "";
		$RSVal = getRecordSet($sql);
		if (!isset($_SESSION)) {
					session_start();
				}
		$_tipoUsuario = $_SESSION['MM_UserGroup'];
		$_x = 1;
			$html .= "<table width=\"80%\" align=\"center\">\n";
			$html .= "<tr class=\"rowTitle\"><td class=\"colTitle\">Nombre</td><td class=\"colTitle\">Operaciones</td></tr>";
				while ($datos=mysql_fetch_row($RSVal)){
					$html .= "<tr id='row_".$_x."'>";
					$html .= "<td class=\"textItemgris\">".$datos[2]."</td>\n";
					$html .= "<td class=\"operaciones\">";
					if($_tipoUsuario == 1 && $opt != 2){
						$html .= "<a title=\"Editar sucursal\" href=\"#\" onClick=\"getSucursalEditForm(".$datos[0].",".$id_merchant.");\"><img alt=\"editar\" src=\"images/icons/edit_icon.png\" border='0'></a>";
					}
					if($_tipoUsuario == 1 && $opt != 2){
						$html .= "&nbsp;<a title=\"Borrar sucursal\" href=\"#\" onClick=\"doDeleteSucursal(".$datos[0].",'row_".$_x."','".$id_merchant."');\"><img alt=\"borrar\" src=\"images/icons/delete_icon.png\" border='0'></a>\n";
					}
					if($_tipoUsuario == 1 && $opt != 2){
						$html .= "<a title=\"Crear nuevo PDV\" href=\"#\" onClick=\"getNewPos(".$datos[0].",".$id_merchant.");\"><img alt=\"pos\" src=\"images/icons/pos_icon.png\" border='0'></a>";
					}

					$html .= "</td>\n";
					$html .= "</tr>\n";
					$_x++;
				}
			$html .= "</table>\n";
		echo $html;
	}


/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getTipoUsuario($currentTipoUsuario){
	$idUser = $_SESSION['MM_UserID'];
	$_sql   = "SELECT str_descripcion FROM "._PREPOS."ctl_tiposusuario WHERE id_tipo =".$currentTipoUsuario ;
	$RSVal  = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);			
		}
		return $datos[0];			
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getComando($_actividad, $_upc){
	if(strlen($_upc) >= 5){
		$sql = "SELECT str_comando FROM "._PREPOS."ctl_commands as A, "._PREPOS."ctl_productos as B WHERE B.id_emisor = A.id_emisor AND A.str_accion = '".$_actividad."' AND B.str_upc ='".$_upc."'";
	}else{
		$sql = "SELECT str_comando FROM "._PREPOS."ctl_commands as A WHERE  A.str_accion = '".$_actividad."' AND A.id_emisor = 2";
	}
		$_comando = "";
		$RSVal = getRecordSet($sql);
		while ($datos=mysql_fetch_row($RSVal)){
			$_comando = $datos[0];
		}
		return $_comando;
	}


/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getMenuReports(){
		if (!isset($_SESSION)) {
					session_start();
		}
		$_tipoUsuario = $_SESSION['MM_UserGroup'];
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getMerchantOption(){
		$_html = "";
		$_sql = "SELECT str_intern_storenumber, str_descripcion FROM "._PREPOS."ctl_merchants ORDER BY str_descripcion";
		$RSVal = getRecordSet($_sql);
		/*----------------------------*/
		$_html = "<select class=\"selects_reports\" name=\"id_merchant\" id=\"id_merchant\">";
		$_html .= "<option value=\"0\" >Todos</option>";
		while ($datos=mysql_fetch_row($RSVal)){
			$_html .= "<option value=\"". $datos[0] ."\" ".$selected.">". $datos[1] ."</option>";
		}
		$_html .= "</select>";
		/*----------------------------*/
		return $_html;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function desmiembraInfo($_datum){
		$_chars = array("--","B", "&", "$", "�", "_", "�");
		$_onlyData = str_replace($_chars, "-", $_datum);
		$_arregloDato = explode("-",$_onlyData);
		return $_arregloDato;
	}
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/		
function getRadiosPermisos(){
		$_html = "";
		$_vueltas = 1;
		$_columnas = 3;
		$x = 0;
		$_sql_areas = "SELECT id_seccion, str_descripcion, bool_script, str_script FROM "._PREPOS."ctl_secciones ORDER BY str_descripcion ";
		$RS = getRecordSet($_sql_areas);
		if($RS){
			$_html .= "<table align=\"center\" width=\"85%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
			while ($datosArea=mysql_fetch_row($RS)){
				if($_vueltas == 1){
					$_html .= "<tr>\n";
				}
				
				$_html .= "<td class=\"textItem\">";
				if($datosArea[2] == 1){
					$_script = $datosArea[3];
				}else{
					$_script = "";
				}
					
				$_html .= "<input ".$_script." type=\"checkbox\" id=\"permisos[".$x."]\" name=\"permisos[".$x."]\" value=\"".$datosArea[0]."\">".$datosArea[1]."</td>\n";
				
					if($_vueltas == $_columnas){
						$_html .= "</tr>\n";
						$_vueltas = 1;
					}else{
						$_vueltas++;
					}
				$x++;	
			}
			$_html .= "</tbody>\n</table>\n";
			}
		return $_html;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/		
function getRadiosPuestosUsuario($id_usuario){
		$_html = "";
		$_vueltas = 1;
		$_columnas = 3;
		$x = 0;
		$_sql_areas = "(SELECT A.id_seccion, A.str_descripcion, B.id_usuario FROM "._PREPOS."ctl_secciones AS A, "._PREPOS."tbl_privilegios as B WHERE A.id_seccion = B.int_area AND B.id_usuario = ".$id_usuario.") UNION (SELECT C.id_seccion, C.str_descripcion, 0 FROM "._PREPOS."ctl_secciones AS C WHERE C.id_seccion NOT IN (SELECT int_area FROM  "._PREPOS."tbl_privilegios WHERE id_usuario = ".$id_usuario.")) ORDER BY id_seccion";
		$RS = getRecordSet($_sql_areas);
		if($RS){
			$_html .= "<table align=\"center\" width=\"95%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
			while ($datosArea=mysql_fetch_row($RS)){
				if($_vueltas == 1){
					$_html .= "<tr>\n";
				}
				$_html .= "<td class=\"candidatoInfo10\">";
				if($datosArea[2] != 0){
					$_isChecked = " CHECKED";
				}else{
					$_isChecked = "";
				}
				$_html .= "<input type=\"checkbox\" id=\"areasInteres[".$x."]\" name=\"areasInteres[".$x."]\" value=\"".$datosArea[0]."\" ".$_isChecked." >";
				$_html .= $datosArea[1];
				$_html .= "</td>\n";
					if($_vueltas == $_columnas){
						$_html .= "</tr>\n";
						$_vueltas = 1;
					}else{
						$_vueltas++;
					}
				$x++;	
			}
			$_html .= "</tbody>\n</table>\n";
			}
		return $_html;
	
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function getAreaUsuario($_idUsuario){
		$_html = "";
		//$_sql_areas = "SELECT B.str_descripcion FROM rh_tbl_usuario_areas as A , rh_ctl_puestos as B WHERE A.`id_puesto`=B.id_puesto AND  A.id_usuario =".$_idUsuario;
		$_sql_areas = "SELECT A.id_seccion, A.str_descripcion, B.id_usuario FROM "._PREPOS."ctl_secciones AS A, "._PREPOS."tbl_privilegios as B WHERE A.id_seccion = B.int_area AND B.id_usuario = ".$_idUsuario;
		$RS = getRecordSet($_sql_areas);
		if($RS){
			while ($datosArea=mysql_fetch_row($RS)){
				$_html .= $datosArea[1].", ";
				}
			}
		$returned = substr(trim($_html), 0, -1) . ".";
		return $returned;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function getOperacion($_id_operacion){
		switch($_id_operacion){
				case "0":
					$_respuesta = "Sin Operaci&oacute;n";
					break;
				case "1":
					$_respuesta = "Activaci&oacute;n";
					break;
				case "2":
					$_respuesta = "Desactivaci&oacute;n";
					break;
				case "3":
					$_respuesta = "Consulta";
					break;
				case "4":
					$_respuesta = "Redenci&oacute;n";
					break;
				default:
					$_respuesta = " Error - " ;//.$_comando;
		}
	   return $_respuesta;	
	
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getEstados($_id_estado){
				switch($_id_estado){
				case "0":
					$_respuesta = "Inactiva";
					break;
				case "1":
					$_respuesta = "Activa";
					break;
				case "2":
					$_respuesta = "Redimida";
					break;
				default:
					$_respuesta = " Error - " ;//.$_comando;
		}
	   return $_respuesta;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function getErrors($_id_error){
				switch($_id_error){
				case "0":
					$_respuesta = "NA";
					break;
				case "1":
					$_respuesta = "Exito";
					break;
				case "2":
					$_respuesta = "Error";
					break;
				default:
					$_respuesta = " Error - " ;//.$_comando;
		}
	   return $_respuesta;
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function actualizarErrorEnLog($_id_registro, $_card, $_valorError){
			$_sql_ErrorLog = " UPDATE "._PREPOS."transaction_log SET str_resultado = ".$_valorError." WHERE (str_tarjeta = ".$_card.") AND (id_registro = ".$_id_registro.")";
			$_logError = executeQueryNumRows($_sql_ErrorLog);
	}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/		
function sendTransaction($_comando, $_card, $_monto, $_idvendedor, $_idpedido){
	if (!isset($_SESSION)) {
			session_start();
		}
	$_idUser = $_SESSION['MM_UserID'];
	$_sql_log = " INSERT INTO "._PREPOS."transaction_log (dt_fecha, dt_hora, id_usuario, str_tarjeta, int_operacion, str_operacion, str_monto, str_num_vendedor, str_num_pedido) VALUES ('".date('Y-m-d')."',NOW(),'".$_idUser."','".$_card."',".$_comando.",'".getOperacion($_comando)."','".$_monto."','".$_idvendedor."','".$_idpedido."')";
	switch($_comando){
		case "1": // ACTIVAR: GENERA ID_DE_TRASACCION, INSERTA LOG, ACTUALIZA EDO DE TARJETA.
				$_sql         = " UPDATE "._PREPOS."ctl_tarjetas SET bool_estado = 1 WHERE (str_codigo = ".$_card.") AND NOT (bool_estado = 2)";
				$_mensaje_ok  = " La tarjeta num.".$_card." ha sido activada.";
				$_mensaje_not = " La tarjeta num.".$_card." NO ha sido activada. Puede deberse a que haya sido redimida o no exista.";
			break;
		case "2": // DESACTIVAR
				$_sql         = " UPDATE "._PREPOS."ctl_tarjetas SET bool_estado = 0 WHERE str_codigo = ".$_card." AND bool_estado = 1";
				$_mensaje_ok  = " La tarjeta num.".$_card." ha sido desactivada.";
				$_mensaje_not = " La tarjeta num.".$_card." NO ha sido desactivada. Puede deberse a que haya sido redimida o no est&eacute; activada";
			break;
		case "3": // CONSULTA
				$_sql         = " SELECT * FROM "._PREPOS."ctl_tarjetas WHERE str_codigo = ".$_card;
				$_sql_ops     = " SELECT id_registro, id_merchant, dt_hora, id_usuario, str_telefono, int_operacion, str_resultado, str_monto, str_resultado, dt_fecha, int_estatus, str_folio, dt_hora, str_tarjeta, str_num_vendedor, str_num_pedido FROM "._PREPOS."transaction_log WHERE str_tarjeta = ".$_card." ORDER BY id_registro";
			break;
		case "4": // REDENCION
				$_sql         = " UPDATE "._PREPOS."ctl_tarjetas SET bool_estado = 2 WHERE str_codigo = ".$_card." AND bool_estado = 1";
				
				$_html = "<div id=\"ticket\">";
				$_html .= "<table align=\"center\" width=\"70%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">No de Tarjeta: </td><td class=\"textItemGris\">".$_card."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Num. de Vendedor: </td><td class=\"textItemGris\">".$_idvendedor."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Num. de Pedido: </td><td class=\"textItemGris\">".$_idpedido."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Monto:  </td><td class=\"textItemGris\">$".$_monto."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Descuento:   </td><td class=\"textItemGris\">$".getDescuento($_card)."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td colspan=\"2\" align=\"center\"><a class=\"btn_operacion\" href=\"javascript:CallPrint('ticket')\">Imprime Ticket</a></td></tr>\n";
				$_html .= "</tbody>\n</table>\n";
				$_html .= "</div>";				
				
				$_mensaje_ok  = " La tarjeta num.".$_card." ha sido redimida.<br>".$_html;
				$_mensaje_not = " La tarjeta num.".$_card." NO ha sido redimida. Revise que la tarjeta se encuentre activa y no haya sido previamente redimida.";
			break;
	}
	//-----------------------------------
	if($_comando == "3"){
		$_log = executeQuery($_sql_log);
		if($_log){
			$_rs = getRecordSet($_sql);
			if($_rs){
				$datos=mysql_fetch_row($_rs);
				$_html = "<div id=\"ticket\">";
				$_html .= "<table align=\"center\" width=\"70%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">No de Tarjeta: </td><td class=\"textItemGris\">".$datos[1]."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Descripci&oacute;n: </td><td class=\"textItemGris\">".$datos[2]."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Monto:  </td><td class=\"textItemGris\">$".$datos[5]."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Estado:   </td><td class=\"textItemGris\">".getEstados($datos[6])."</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\" colspan=\"2\">Operaciones:   </td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\" colspan=\"2\">\n";
				$RS = getRecordSet($_sql_ops);
				if($RS){
					$_html .= "<ul class=\"transLog\">";
					while ($datosTransac=mysql_fetch_row($RS)){
						$_html .= "<li>".getUserDatum($datosTransac[3]).",\t ".getOperacion($datosTransac[5]).", ".getErrors($datosTransac[6]).", ".$datosTransac[2]."</li>\n";	
					}
					$_html .= "</ul>";
				}
				$_html .= "</td></tr>\n";
				$_html .= "<tr class=\"rowTitle\"><td colspan=\"2\" align=\"center\"><a class=\"btn_operacion\" href=\"javascript:CallPrint('ticket')\">Imprime Ticket</a></td></tr>\n";
				$_html .= "</tbody>\n</table>\n";
				$_html .= "</div>";
			}
		}else{
					$_html = "<p class=\"notificacion\"> Existe alg&uacute;n problema, favor de intentar de nuevo.</p>".$_sql_log;
			}
		
	}else{
			$_log = executeQuery($_sql_log);
			if($_sql_log){
				$_operacion = executeQueryNumRows($_sql);
				if($_operacion){
					$_html = "<p class=\"notificacion\"> ".$_mensaje_ok ."</p>";
					actualizarErrorEnLog($_log, $_card, 1); // ACTUALIZA CON EL RESULTADO DE LA OPERACION
				}else{
					$_html = "<p class=\"notificacion\"> ".$_mensaje_not."</p>";
					actualizarErrorEnLog($_log, $_card, 2); // ACTUALIZA CON EL RESULTADO DE LA OPERACION
				}
			}else{
					$_html = "<p class=\"notificacion\"> Existe alg&uacute;n problema, favor de intentar de nuevo.</p>";
			}

	}
	return $_html;
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/		
function getPOSList($_idMerchant, $_idSucursal){
		$sql = "SELECT * FROM "._PREPOS."tbl_pos  WHERE id_merchant = ".$_idMerchant." and id_sucursal = ".$_idSucursal." ORDER BY str_descripcion ASC";
		$html = "";
		$RSVal = getRecordSet($sql);
		if (!isset($_SESSION)) {
					session_start();
				}
		$_tipoUsuario = $_SESSION['MM_UserGroup'];
		$_x = 1;
			$html .= "<table width=\"100%\">\n";
			$html .= "<tr class=\"rowTitle\"><td class=\"colTitle\">Nombre</td><td class=\"colTitle\">Operaciones</td></tr>";
				while ($datos=mysql_fetch_row($RSVal)){
					$html .= "<tr id='row_".$_x."'>";
					$html .= "<td class=\"textItemgris\">".$datos[3]."</td>\n";
					$html .= "<td class=\"operaciones\">";
					if($_tipoUsuario != 2 && $opt != 2){
						$html .= "&nbsp;<a href=\"#\" onClick=\"doDeletePOS(".$datos[0].",'row_".$_x."',".$_idMerchant.", ".$_idSucursal.");\"><img alt=\"borrar\" src=\"images/icons/delete_icon.png\" border='0'></a></td>\n";
					}
					$html .= "</tr>";
					$_x++;
				}
			$html .= "</table>\n";
		echo $html;
	}

/*-----------------------------------------------------------------*/
/* SMS SENDER SPACE */
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/

function sendSms($numeroCelular, $operador, $mensaje, $tipoSms, $idCampana){
		$numeroCelular = trim($numeroCelular);
		$operador = trim($operador);
		//$mensaje = urlencode(trim($mensaje));
		$opciones = array(
		  'http'=>array(
			'm?todo'=>"GET",
			'cabecera'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
		);
		//-----------------------------------------
		$contexto = stream_context_create($opciones);
		// Abre el archivo usando las cabeceras HTTP establecidas arriba
		// $_url = "http://sms.ideassms.com:8080/smp/servlet/SendTextMessage?msisdn=".$numeroCelular."&smscid=".$operador."&sender=27362&client_id=bnm3x&content=".$mensaje;
		$_url = "https://somosredcompanies.azurewebsites.net/api/zenvia/sendsms";
		envioSms($_url, $numeroCelular, $mensaje);
		$archivo = file_get_contents($_url, false, null);
		if($idCampana == ""){
			$idCampana = 0;
		}
		if (is_bool($archivo) && $archivo == false){
			insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 2, 0, $idCampana);
			return "Error";//.$_url
						
		}else{
			insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 2, 1, $idCampana);
			return $archivo;			
		}	
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function sendSmsReturn($numeroCelular, $operador, $mensaje, $tipoSms, $idCampana){
		$numeroCelular = trim($numeroCelular);
		$operador = trim($operador);
		//$mensaje = urlencode(trim($mensaje));
		$opciones = array(
		  'http'=>array(
			'm?todo'=>"GET",
			'cabecera'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
		);
		//-----------------------------------------
		$contexto = stream_context_create($opciones);
		// Abre el archivo usando las cabeceras HTTP establecidas arriba
		//$_url = "http://sms.ideassms.com:8080/smp/servlet/SendTextMessage?msisdn=".$numeroCelular."&smscid=".$operador."&sender=27362&client_id=bnm3x&content=".$mensaje;
		$_url = "https://somosredcompanies.azurewebsites.net/api/zenvia/sendsms";
		envioSms($_url, $numeroCelular, $mensaje);
		$archivo = file_get_contents($_url, false, null);
		if (is_bool($archivo) && $archivo == false){
			insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 1, 0, $idCampana);
			return false;//.$_url
		}else{
			insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 1, 1, $idCampana);
			return true;
		}	
}

function envioSms($url, $numero, $mensaje)
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => '{"to": "'.$numero.'","contents": [{"text": "' .$mensaje.'"}]}',
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
	),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	//echo $response;
}
function sendWtsReturn($numeroCelular, $idCampana, $template, $variable1, $variable2, $variable3, $origen){
	$numeroCelular = trim($numeroCelular);
	//-----------------------------------------
	// Abre el archivo usando las cabeceras HTTP establecidas arriba
	envioWtsReturn($template, $numeroCelular, $variable1, $variable2, $variable3, $origen);
	$archivo = file_get_contents($_url, false, null);
	if (is_bool($archivo) && $archivo == false){
		insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 1, 0, $idCampana);
		return false;//.$_url
	}else{
		insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, 1, 1, $idCampana);
		return true;
	}	
}
function envioWtsReturn($template, $numero, $variable1, $variable2, $variable3, $origen)
{

	$curl = curl_init();
	// echo 'Origen: '.$origen;
	if($origen==1)
	{
		$body= '{"from": "5215589202800","to": "521'.$numero.'","contents": [{"type": "template","templateId": "'.$template.'","fields": {"monto": "'.$variable1.'","folio": "'.$variable2.'"}}]}';
	}
	else
	{
		if($variable3 =="")
		{
			$variable3='Prueba';
		}
		$body= '{"from": "5215589202800","to": "521'.$numero.'","contents": [{"type": "template","templateId": "'.$template.'","fields": {"name_variable_0": "'.$variable1.'","name_variable_1": "'.$variable2.'","name_variable_2": "'.$variable3.'"}}]}';
	}
	//  echo 'Body: '.$body;
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.zenvia.com/v2/channels/whatsapp/messages",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	//CURLOPT_POSTFIELDS => '{"to": "'.$numero.'","contents": [{"text": "' .$mensaje.'"}]}',
	CURLOPT_POSTFIELDS => $body,
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'X-API-TOKEN: 1KU7_96h5C8YEFFvo9tfDpJFQ3_Jopd7RRGq',
	),
	));

	$response = curl_exec($curl);
	// echo 'Response: '.$response;
	
	curl_close($curl);
	//echo $response;
}

/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function insertLogPulls($idCliente, $mensaje, $url){
	 	$sqlLog = "INSERT INTO "._PREPOS."tbl_log_solicitud_pull(str_id_cliente, str_mensaje, dt_fecha, str_url) VALUES('".$idCliente."', '".strtoupper($mensaje)."','".date('Y-m-d')."', '". $url."')";
		$EXECUTED = executeQueryNoId($sqlLog);
	}
	
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/
function putIncidencia($str_noCelular, $urlString, $mensaje){
	 	$sqlIncidencias = "INSERT INTO "._PREPOS."tbl_incidencias(str_noCelular, txt_string, str_mensaje, dt_fecha) VALUES('".$str_noCelular."', '".$urlString."', '". $mensaje."', '".date('Y-m-d')."')";
		$EXECUTED = executeQueryNoId($sqlIncidencias);
	}	
/*-----------------------------------------------------------------*/
/*-----------------------------------------------------------------*/	
function insertLogEnvios($numeroCelular, $operador, $mensaje, $archivo, $tipoSms, $intStatus, $idCampana){
	 	$sqlLog = "INSERT INTO "._PREPOS."tbl_log_envios(str_numeroCelular, str_operador, str_mensaje, str_respuesta, int_tipoSMS, int_status, dt_fecha, id_campana) VALUES('".$numeroCelular."', '".$operador."', '".$mensaje."', '".$archivo."', '".$tipoSms."', '". $intStatus."','".date('Y-m-d')."', '". $idCampana."')";
		$EXECUTED = executeQueryNoId($sqlLog);
		
	}

function changeStatusRegistro($status, $register,$numCelular){
	 	$sqlLog = "UPDATE "._PREPOS."tbl_lista_codigos SET  bool_validado ='".$status."', dt_fecha='".date('Y-m-d')."', str_telefonoValido  = '".$numCelular."' WHERE id_registro = '".$register."'";
		$EXECUTED = executeQueryNoId($sqlLog);	
	}

//-----------------------------------------------------------
//-----------------------------------------------------------
function generateCode ($length = 6)
{
  // start with a blank password
  $securityChart = rand  (1, 9);
  $largoAdicional = strlen($id_campana);
  $password = "";
  // define possible characters
  $possible = "01234567899876543210"; 
  // set up a counter
  $i = 0; 
  // add random characters to $password until $length is reached
  while ($i < $length) { 
    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }
  }
  //--------------------------
  return $password;
}


/* FORMATO DE MONEDA */
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
function amoneda($numero, $moneda){
		$longitud = strlen($numero);
		$punto = substr($numero, -1,1);
		$punto2 = substr($numero, 0,1);
		$separador = ".";
		if($punto == "."){
		$numero = substr($numero, 0,$longitud-1);
		$longitud = strlen($numero);
		}
		if($punto2 == "."){
		$numero = "0".$numero;
		$longitud = strlen($numero);
		}
		$num_entero = strpos ($numero, $separador);
		$centavos = substr ($numero, ($num_entero));
		$l_cent = strlen($centavos);
		if($l_cent == 2){$centavos = $centavos."0";}
		elseif($l_cent == 3){$centavos = $centavos;}
		elseif($l_cent > 3){$centavos = substr($centavos, 0,3);}
		$entero = substr($numero, -$longitud,$longitud-$l_cent);
		if(!$num_entero){
			$num_entero = $longitud;
			$centavos = ".00";
			$entero = substr($numero, -$longitud,$longitud);
		}
		
		$start = floor($num_entero/3);
		$res = $num_entero-($start*3);
		if($res == 0){$coma = $start-1; $init = 0;}else{$coma = $start; $init = 3-$res;}
		$d= $init; $i = 0; $c = $coma;
			while($i <= $num_entero){
				if($d == 3 && $c > 0){$d = 0; $sep = ","; $c = $c-1;}else{$sep = "";}
				$final .=  $sep.$entero[$i];
				$i = $i+1; // todos los digitos
				$d = $d+1; // poner las comas
			}
			if($moneda == "pesos")  {$moneda = "$";
			return $moneda." ".$final.$centavos;
			}
			elseif($moneda == "dolares"){$moneda = "USD";
			return $moneda." ".$final.$centavos;
			}
			elseif($moneda == "euros")  {$moneda = "EUR";
			return $final.$centavos." ".$moneda;
			}
}

/* verifica el c�digo de la transaccion */
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
function rand_alphanumeric() {
      $subsets[0] = array('min' => 48, 'max' => 57); // ascii digits
      $subsets[1] = array('min' => 65, 'max' => 90); // ascii lowercase English letters
      $subsets[2] = array('min' => 97, 'max' => 122); // ascii uppercase English letters
      // random choice between lowercase, uppercase, and digits
      $s = rand(0, 2);
      $ascii_code = rand($subsets[$s]['min'], $subsets[$s]['max']);
   
      return chr( $ascii_code );
     }


/* verifica el c�digo de la transaccion */
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
function checkVerificador($_codigo, $_telefono){
	$_sql   = "SELECT int_estatus, str_telefono, str_monto, id_merchant, id_registro FROM "._PREPOS."transaction_log WHERE str_telefono='".$_telefono."' AND str_folio='".$_codigo."' AND dt_fecha ='".date('Y-m-d')."'" ;
	$RSVal  = getRecordSet($_sql);
		if($RSVal){
			$datos = mysql_fetch_row($RSVal);
			$_valor = $datos[0];
				if($_valor == 2){ // si el valor es de espera
					$_html = "";
					$_html = "<div id=\"ticket\">";
						$_html .= "<table align=\"center\" width=\"70%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">\n<tbody>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">No de Tel&eacute;fono: </td><td class=\"textItemGris\">".$datos[1]."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Fecha: </td><td class=\"textItemGris\">".date('d-m-Y')."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Num. de Ticket: </td><td class=\"textItemGris\">".$datos[4]."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td class=\"colTitleLight\">Monto:  </td><td class=\"textItemGris\">$".$datos[2]."</td></tr>\n";
						$_html .= "<tr class=\"rowTitle\"><td colspan=\"2\" align=\"center\"><a class=\"btn_operacion\" href=\"javascript:CallPrint('ticket')\">Imprime Ticket</a></td></tr>\n";
						$_html .= "</tbody>\n</table>\n";
					$_html .= "</div>";
					$_sql_update = "UPDATE "._PREPOS."transaction_log SET int_estatus = 3, str_operacion ='Verificado' WHERE id_registro = ".$datos[4];
					$_actualizacion = executeQuery($_sql_update);
					$_compra = doRetiro($_telefono, $datos[2]);
				}elseif($_valor == 3){
						$_html .= "El ticket ya ha sido utilizado";
				}elseif($_valor == ""){
						$_html .= "No existe la validacion, por favor intente el pago de nueva cuenta.";
				}else{
						$_html .= "Error en la verificacion: ".$_valor ;
				}
		
		}else{
			$_html .= "Error en la verificacion: ".$_valor ;
		}

	return $_html;


	}
?>
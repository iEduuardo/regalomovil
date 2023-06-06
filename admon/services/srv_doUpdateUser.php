<?php require ('../../includes/function.php'); ?>

<?php noCache(); ?>

<?php

$_mensaje = "";

	if($_GET['userName'] && $_GET['do']==1){

		$_error = false;

		$id_usuario = $_GET['idu'] ;

		

		$userNamePropio = $_GET['nombre'] ;

		$userApellidoP = $_GET['apellidoP'];

		$userName = $_GET['userName'];

		//------------------------

		$userCambioPassword = $_GET['cambioUsuario'];

		$userPassword = $_GET['userPassword'];

		//------------------------

		$idTipoUsuario = $_GET['tipoUsuario'];

		if($_GET['id_pos'] != ""){$_userPOS = $_GET['id_pos']; }else{$_userPOS = 0;};

		if($_GET['id_merchant'] != ""){$_userMerchant = $_GET['id_merchant'];}else{ $_userMerchant = 0;}

		if($_GET['id_sucursal'] != ""){$_userSucursal = $_GET['id_sucursal'];}else{ $_userSucursal = 0;}

		if($_GET['id_pos'] != ""){ $_userTerminal = $_GET['id_pos'];}else{ $_userTerminal = 0;}

		//--------------------------

		if($userCambioPassword == 1){

			$sql = "UPDATE "._PREPOS."tbl_usuarios SET str_username='".$userName."', str_password= MD5('".$userPassword."'), str_nombre='".$userNamePropio."', str_apellidoP='".$userApellidoP."',  int_tipodeusuario='".$idTipoUsuario."', id_pos='".$_userPOS."', id_merchant='".$_userMerchant."', id_sucursal='".$_userSucursal."', id_terminal='".$_userTerminal."' WHERE id_usuario = ".$id_usuario;

		}else{

			$sql = "UPDATE "._PREPOS."tbl_usuarios SET str_username='".$userName."',  str_nombre='".$userNamePropio."', str_apellidoP='".$userApellidoP."', int_tipodeusuario='".$idTipoUsuario."', id_pos='".$_userPOS."', id_merchant='".$_userMerchant."', id_sucursal='".$_userSucursal."', id_terminal='".$_userTerminal."' WHERE id_usuario = ".$id_usuario;		

		}



		$idusuario = executeQueryNoId($sql);

		if($idusuario){

					if($_GET['areasInteres']){

						$sql_delete = "DELETE FROM "._PREPOS."tbl_privilegios WHERE id_usuario=".$id_usuario;

						$idExecucion_delete = executeQueryNoId($sql_delete);

						

						foreach ($_GET['areasInteres'] as $k => $value) {

							$sql_2 = "INSERT INTO "._PREPOS."tbl_privilegios(id_usuario,int_area) VALUES('".$id_usuario."','".$value."')";

							$idExecucion = executeQueryNoId($sql_2);

							 if(!$idExecucion){

								 $_error = true;

							 }

						}

					}

					//-----------------------------------	

					$sql_2 = "UPDATE "._PREPOS."transaction_datum SET id_merchant='".$_userMerchant."', id_store_number='".$_userSucursal."', id_terminal='".$_userTerminal."' WHERE id_usuario = '".$id_usuario."'";

					$idusuario2 = executeQueryNoId($sql_2);

					 if(!$idusuario2){

								 $_error = true;

							 }

					//-----------------------------------

					if($_error){

						$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";

					}else{

						$_mensaje = "<span class=\"mensaje\"> El usuario editado.</span>";

					}





		}else{

			$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";

		}

	}else{

		$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";	

	}

?>

                	<table width="100%" border="0" cellpadding="0" cellspacing="2">

                    	<tr><td colspan="2" class="userTitle"> Edici&oacute;n de usuario </td></tr>

                    	<tr><td colspan="2" class="espaciadorAzul"></td></tr>

                        <tr><td colspan="2" class="espaciadorSinColor"><?php echo $_mensaje;?></td></tr>

                        <tr>

                        	<td colspan="2" class="espaciadorSinColor">

								<?php

                                    getUserList(1);

                                ?>

                        	</td>

                        	</tr>

                    </table>

                 <p></p>
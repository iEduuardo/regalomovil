<?php require ('../../includes/function.php'); ?>
<?php noCache(); ?>
<?php
	if (!isset($_SESSION)) {
						session_start();
			}
	$_tipoUsuario = $_SESSION['MM_UserGroup'];
	$_idUsuario   = $_SESSION['MM_UserID'];
?>
<?php 
	if($_GET['user'] && $_GET['do']==1){
		$_email           = $_GET['email'];
		$_userPassword    = $_GET['userPassword'];
		$_userNamePropio  = $_GET['nombre'] ;
		$_userApellido    = $_GET['apellido'];
		$_idTipoUsuario   = $_GET['int_tipodeusuario'];
		$_userName        = $_GET['user'];
		if($_GET['id_pos'] != ""){$_userPOS = $_GET['id_pos']; }else{$_userPOS = 0;};
		if($_GET['id_merchant'] != ""){$_userMerchant = $_GET['id_merchant'];}else{ $_userMerchant = 0;}
		if($_GET['id_sucursal'] != ""){$_userSucursal = $_GET['id_sucursal'];}else{ $_userSucursal = 0;}
		if($_GET['id_pos'] != ""){ $_userTerminal = $_GET['id_pos'];}else{ $_userTerminal = 0;}
		//------------------------------------
		$sql   = "INSERT INTO "._PREPOS."tbl_usuarios(id_pos, id_merchant, id_sucursal, id_terminal, str_username, str_password, str_nombre, str_apellidoP ,int_tipodeusuario, dt_fechadeCreacion) VALUES('".$_userPOS."','".$_userMerchant."', '".$_userSucursal."', '".$_userTerminal."', '".$_userName."', md5('".$_userPassword."'),'".$_userNamePropio."','".$_userApellido."' ,'".$_idTipoUsuario."','".date('Y-m-d')."')";
		$idusuario = executeQuery($sql);
		if($idusuario){
				//-----------------------------------
				/*SI EL USUARIO ES TIPO = 2 (OPERACION)*/
				if($_idTipoUsuario == 2){
					$sql_2 = "INSERT INTO "._PREPOS."transaction_datum(id_usuario, id_merchant, id_store_number, id_terminal) VALUE('".$idusuario."', '".$_userMerchant."','".$_userSucursal."','".$_userPOS."')";
					$idusuario2 = executeQuery($sql_2);
					if($idusuario2){
						$_error = false;
						if($_GET['permisos']){
							foreach ($_GET['permisos'] as $k => $value) {
								$sql_3 = "INSERT INTO "._PREPOS."tbl_privilegios(id_usuario, int_area) VALUES('".$idusuario."','".$value."')";
								$idExecucion = executeQuery($sql_3);
								 if(!$idExecucion){
									 $_error = true;
								 }
							}
						}
						//-----------------------------------	
						if($_GET['posType']){
							$_posTypeValue = $_GET['posType'];
							$sql_4 = "INSERT INTO "._PREPOS."tbl_usuarios_opciones(id_usuario, str_variable, str_valor) VALUE('".$idusuario."','default_pos_device', '".$_posTypeValue."')";
							$idusuario4 = executeQuery($sql_4);
							if(!$idusuario4){
										 $_error = true;
									 }
						}
						//-----------------------------------
						if($_error){
							$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";
						}else{
							$_mensaje = "<span class=\"notificacion\"> Nuevo usuario ingresado.</span>";
						}						
					}else{
						$_mensaje =  "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde..</span>";
					}
				}else{
						$_mensaje =  "<span class=\"notificacion\"> Usuario nuevo ingresado.</span>";
				}
				//-----------------------------------	
		}else{
			$_mensaje =  "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";
			}
	}else{
		$_mensaje =  "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde.</span>";	
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $_mensaje;?></td>
  </tr>
  <tr>
    <td align="right">
        <?php if(havePermission($_idUsuario, 8)){ ?>
        <a class="btn_operacion" href="javascript:getNewUsuario();">Crear Nuevo Usuario</a>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td>
    	<?php
		getUserList($opt);
		?>
    </td>
  </tr>
</table>
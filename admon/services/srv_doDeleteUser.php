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
	if($_GET['id'] && $_GET['do']==1){
		$idUser = $_GET['id'];
		$sql = "DELETE FROM "._PREPOS."tbl_usuarios WHERE id_usuario = ".$idUser;
		$idusuario = executeQueryNoId($sql);
		//----------------------------------
		$sql = "DELETE FROM "._PREPOS."transaction_datum WHERE id_usuario = ".$idUser;
		$idusuario_2 = executeQueryNoId($sql);
		//----------------------------------
		$sql = "DELETE FROM "._PREPOS."tbl_privilegios WHERE id_usuario = ".$idUser;
		$idusuario_3 = executeQueryNoId($sql);
		//----------------------------------
		$sql = "DELETE FROM "._PREPOS."tbl_usuarios_opciones WHERE id_usuario = ".$idUser;
		$idusuario_4 = executeQueryNoId($sql);
		//----------------------------------
		if($idusuario && $idusuario_2 && $idusuario_3 && $idusuario_4){
			$_mensaje = "<span class=\"success\"> El usuario ha sido borrado.</span>";
		}else{
			$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde..</span>";
		}
	}else{
		$_mensaje = "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde.</span>";	
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
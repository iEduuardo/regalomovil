<?php require ('../includes/function.php'); ?>
<?php noCache(); ?>
<?php
	if (!isset($_SESSION)) {
						session_start();
			}
	$_tipoUsuario = $_SESSION['MM_UserGroup'];
	$_idUsuario   = $_SESSION['MM_UserID'];
	
?>
<?php 
	if($_GET['idm'] && $_GET['do']==1){
		$idMerchant  = $_GET['idm'];
		$idSucursal  = $_GET['id'];
		$sql = "DELETE FROM "._PREPOS."tbl_sucursal WHERE id_sucursal = ".$idSucursal;
		$idusuario = executeQueryNoId($sql);
		//----------------------------------
		if($idusuario){
			$_mensaje = "<span class=\"success\"> La sucursal ha sido borrado.</span>";
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
        <a class="btn_operacion" href="javascript:getNewSucursal(<?php echo $idMerchant;?>);">Crear Nueva Sucursal</a>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td>
    	<?php
		getBranchList($idMerchant);
		?>    </td>
  </tr>
</table>
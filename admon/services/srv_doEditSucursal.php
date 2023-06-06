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
	if($_GET['idSucursal'] && $_GET['idMerchant']!="" && $_GET['do']==1){
		$_name		  = $_GET['nombre'] ;
		$_idMerchant  = $_GET['idMerchant'] ;
		$_idSucursal  = $_GET['idSucursal'] ;
		//------------------------------------
		$_sql = "SELECT str_nombre FROM "._PREPOS."tbl_sucursal WHERE id_merchant=".$_idMerchant." AND str_nombre = '".$_name."'";
		$_numRows = executeQueryRowNum($_sql);
		if($_numRows >=1){
			$_mensaje =  "<span class=\"error\"> Un comercio con ese nombre o identificaci&oacute;n ha sido previamente a&ntilde;adida</span>";
		}else{
			$_sql2   = "UPDATE "._PREPOS."tbl_sucursal SET  str_nombre='".$_name."' WHERE id_sucursal = ".$_idMerchant;
			$idSucursal = executeQueryNoId($_sql2);
			if($idSucursal){
				//-----------------------------------
				$_mensaje =  "<span class=\"error\"> El comercio ha sido actualizado</span>";
			}else{
				$_mensaje =  "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde</span>";
			}

		}
	}else{
		$_mensaje =  "<span class=\"error\"> Existe algun error, favor intentar m&aacute;s tarde.</span>";	
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $_mensaje;?></td>
  </tr>
  <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoMerchants();">Lista de Comercios</a> </td></tr>
  <tr>
    <td align="right">
        <?php if(havePermission($_idUsuario, 8)){ ?>
        <a class="btn_operacion" href="javascript:getNewSucursal(<?php echo $_idMerchant;?>);">Crear Nueva Sucursal</a>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td class="userTitle">Sucursales para <?php echo getMerchantName($_idMerchant);?></td>
  </tr>
  <tr>
    <td>
    	<?php
		getBranchList($_idMerchant);
		?>
    </td>
  </tr>

</table>

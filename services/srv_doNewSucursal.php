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
	if($_GET['nombre'] && $_GET['do']==1){
		$_idMerchant  = $_GET['idMerchant']; 
		$_name		  = $_GET['nombre'] ;
		//------------------------------------
		$_sql = "SELECT str_nombre FROM "._PREPOS."tbl_sucursal WHERE str_nombre = '".$_name."'";
		$_numRows = executeQueryRowNum($_sql);
		if($_numRows >=1){
			$_mensaje =  "<span class=\"error\"> Una sucursal con ese nombre ha sido previamente a&ntilde;adida</span>";
		}else{
			$_sql2   = "INSERT INTO "._PREPOS."tbl_sucursal(id_merchant, str_nombre) VALUES('".$_idMerchant."', '".$_name."')";
			$idSucursal = executeQuery($_sql2);
			if($idSucursal){
				//-----------------------------------
				$_mensaje =  "<span class=\"error\"> La sucursal ha sido a&ntilde;adida</span>";
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
  <tr>
    <td align="right">
        <?php if(havePermission($_idUsuario, 8)){ ?>
        <a class="btn_operacion" href="javascript:getNewSucursal(<?php echo $_idMerchant;?>);">Crear Nueva Sucursal</a>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td>
    	<?php
		getBranchList($_idMerchant);
		?>
    </td>
  </tr>
</table>
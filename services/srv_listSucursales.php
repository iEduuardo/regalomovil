<?php require ('../includes/function.php'); ?>
<?php
	if (!isset($_SESSION)) {
						session_start();
			}
	$_tipoUsuario = $_SESSION['MM_UserGroup'];
	$_idUsuario   = $_SESSION['MM_UserID'];
	$_idMerchant  = $_GET['merchant']; 
?>
<?php  noCache();?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
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

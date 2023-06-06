<?php require ('../includes/function.php'); ?>
<?php
	if (!isset($_SESSION)) {
						session_start();
			}
	$_tipoUsuario = $_SESSION['MM_UserGroup'];
	$_idUsuario   = $_SESSION['MM_UserID'];
	$opt          = $_GET['opt'];
?>
<?php  noCache();?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
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

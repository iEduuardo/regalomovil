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
	if($_GET['nombre'] && $_GET['do']==1){
		$_str_intern_storenumber  = $_GET['identificador']; 
		$_name		  = $_GET['nombre'] ;
		//------------------------------------
		$_sql = "SELECT str_descripcion FROM "._PREPOS."ctl_merchants WHERE str_descripcion = '".$_name."' OR str_intern_storenumber = '".$_str_intern_storenumber."'";
		$_numRows = executeQueryRowNum($_sql);
		if($_numRows >=1){
			$_mensaje =  "<span class=\"error\"> Un comercio con ese nombre o identificaci&oacute;n ha sido previamente a&ntilde;adida</span>";
		}else{
			$_sql2   = "INSERT INTO "._PREPOS."ctl_merchants(str_intern_storenumber, str_descripcion) VALUES( '".$_str_intern_storenumber."', '".$_name."')";
			$idSucursal = executeQuery($_sql2);
			if($idSucursal){
				//-----------------------------------
				$_mensaje =  "<span class=\"error\"> El comercio ha sido a&ntilde;adida</span>";
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
        <a class="btn_operacion" href="javascript:getNewSucursal(<?php echo $_idMerchant;?>);">Crear Nuevo Comercio</a>
        <?php } ?>
    </td>
  </tr>
  <tr>
    <td>
    	<?php
		getComerceList();
		?>
    </td>
  </tr>
</table>
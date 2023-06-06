<?php require ('../includes/function.php'); ?>
<?php noCache(); ?>
<?php
	if($arreglo = getProfileData()){
		$datos = mysql_fetch_row($arreglo);
	}
	$_idMerchant  = $_GET['idm'];
	$_idSucursal  = $_GET['ids'];
?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoSucursales(<?php echo $_idMerchant;?>);">Lista de Sucursales</a> </td></tr>
                        <tr>
                          <td colspan="4" class="userTitle"> Creaci&oacute;n de POS en Sucursal</td></tr>
                    	<tr>
                        	<td colspan="3" width="50%" align="left" valign="top" id="formularioNvoPos">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                          <td width="150" class="titleItem">Descripci&oacute;n del POS: </td><td class="textItem"><input class="inputsLargos" type="text" name="descripcion" id="descripcion"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td height="20" colspan="2" align="center">
                                        <input type="hidden" id="idSucursal" name="idSucursal" value="<?php echo $_idSucursal;?>">
                                        <input type="hidden" id="idMerchant" name="idMerchant" value="<?php echo $_idMerchant;?>"> 
                                        <a href="#" onClick="javascript:saveNewPOS(null, 'descripcion');" class="btn_operacion">Guardar Cambios</a></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor" height="30"></td></tr>
                                    </table>
                          </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td class="separadorHorizontal" colspan="4"></td></tr>
                        <tr><td height="20" colspan="4" id="POSList"> <?php  echo getPOSList($_idMerchant, $_idSucursal);?>  </td></tr>
                        <tr><td class="separadorHorizontalBlanco" colspan="4"></td></tr>                        
                    </table>
       
</form>
                 <p></p>
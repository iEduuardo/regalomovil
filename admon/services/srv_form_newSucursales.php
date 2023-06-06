<?php require ('../../includes/function.php'); ?>
<?php noCache(); ?>
<?php
	if($arreglo = getProfileData()){
		$datos = mysql_fetch_row($arreglo);
	}
	$_idMerchant  = $_GET['merchant'];
?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoSucursales(<?php echo $_idMerchant;?>);">Lista de Sucursales</a> </td></tr>
                        <tr>
                          <td colspan="4" class="userTitle"> Creaci&oacute;n de Sucursal</td></tr>
                        <tr><td colspan="4" class="espaciadorAzul"></td></tr>
                    	<tr>
                        	<td class="separadorVertical"></td>
                        	<td width="50%" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                          <td width="150" class="titleItem">Nombre de Sucursal: </td><td class="textItem"><input class="inputsLargos" type="text" name="nombre" id="nombre"></td></tr>
                                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                    </table>
                          </td>
                            <td class="separadorVertical"></td>
                            <td valign="top">&nbsp;</td>
                        </tr>
                        <tr><td class="separadorHorizontal" colspan="4"></td></tr>
                        <tr><td class="separadorHorizontalBlanco" colspan="4"></td></tr>
                        <tr><td height="20" colspan="4" align="center">&nbsp; <input type="hidden" id="idMerchant" name="idMerchant" value="<?php echo $_idMerchant;?>"> <a href="#" onClick="javascript:saveNewSucursal(null, 'nombre');" class="btn_operacion">Guardar Cambios</a></td></tr>
                    </table>
       
</form>
                 <p></p>
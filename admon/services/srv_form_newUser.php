<?php require ('../../includes/function.php'); ?>
<?php noCache(); ?>
<?php
	if($arreglo = getProfileData()){
		$datos = mysql_fetch_row($arreglo);
	}
	
?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoUsuario();">Lista de usuarios</a> </td></tr>
                        <tr><td colspan="4" class="userTitle"> Creaci&oacute;n de usuario </td></tr>
                        <tr><td colspan="4" class="espaciadorAzul"></td></tr>
                    	<tr>
                        	<td class="separadorVertical"></td>
                        	<td width="50%" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                          <td width="150" class="titleItem">Nombre de usuario: </td><td class="textItem"><input type="text" name="user" id="user" onChange="setChanges();"></td></tr>
                                        <tr><td class="titleItem">Clave (<i>password</i>): </td><td class="textItem"><input type="password" name="userPassword" id="userPassword" onChange="setChanges();"></td></tr>
                                        <tr><td class="titleItem">Nombre: </td><td class="textItem"><input type="text" name="nombre" id="nombre" onChange="setChanges();"></td></tr>
                                        <tr><td class="titleItem">Apellido: </td><td class="textItem"><input type="text" name="apellido" id="apellido" onChange="setChanges();"></td></tr>
                                        <tr><td class="titleItem">Email: </td><td class="textItem"><input type="text" name="email" id="email" onChange="setChanges();"></td></tr>
                                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                    </table>
                            </td>
                            <td class="separadorVertical"></td>
                            <td valign="top">
                                   <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td class="titleItem" width="150">Merchant: </td><td class="textItem"><?php echo getListaMerchants("id_merchant", true, 0);?></td></tr>                                 
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                        <td class="titleItem">Tipo de usuario: </td>
                                         <td class="textItem" id="listadoDeTiposUsuarios">&nbsp;  
                                         </td>
                                        </tr>
                                        <tr><td class="titleItem">Sucursal: </td><td class="textItem" id="listadoDeMerchants"></td></tr>
                                        <tr><td class="titleItem">PDV: </td><td class="textItem" id="nombrePDV">&nbsp;</td></tr>
                                        <tr><td class="titleItem">Tipo de PDV: </td><td class="textItem" id="tipoPDV">&nbsp;</td></tr>
                                    </table>
                            </td>
                        </tr>
                        <tr><td class="separadorHorizontal" colspan="4"></td></tr>
                        <tr><td class="separadorHorizontalBlanco" colspan="4"></td></tr>
                        <tr><td colspan="4"><?php echo getRadiosPermisos();?></td></tr>
                        <tr><td height="20" colspan="4" align="center">&nbsp; <input type="hidden" id="id_creator" name="id_creator" value="<?php echo $datos[0];?>"> <a href="#" onClick="javascript:saveNewUser(null, 'user', 'userPassword', 'nombre', 'apellido', 'email', 'id_merchant');" class="btn_operacion">Guardar Cambios</a></td></tr>
                    </table>
           		
           
           
                 </form>
                 <p></p>
<?php require ('../includes/function.php'); ?>

<?php
	if($arreglo = getProfileData()){
		$datos = mysql_fetch_row($arreglo);
	}
?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">

           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:editThisUser();">Cambiar mis datos</a> </td></tr>
                        <tr><td colspan="4" class="userTitle"> Datos de perfil </td></tr>
                        <tr><td colspan="4" class="espaciadorAzul"></td></tr>
                    	<tr>
                        	<td class="separadorVertical"></td>
                        	<td width="50%" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                        <td class="titleItem">Tipo de usuario: </td>
                                         <td class="textItem">
                                            <?php if($datos[1] == 1){ echo " Administrador";}?>
                                            <?php if($datos[1] == 2){ echo " Usuario";}?>
                                            <?php if($datos[1] == 3){ echo " Gerencia";}?>
                                         </td>
                                        </tr>
                                        <tr><td width="150" class="titleItem">Nombre de usuario: </td><td class="textItem"><?php echo $datos[4];?></td></tr>
                                        <tr><td class="titleItem">Nombre: </td><td class="textItem"><?php echo $datos[2];?></td></tr>
                                        <tr><td class="titleItem">Apellido: </td><td class="textItem"><?php echo $datos[3];?></td></tr>
                                        <tr><td class="titleItem">Email: </td><td class="textItem"><?php echo $datos[4];?></td></tr>
                                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                    </table>
                            </td>
                            <td class="separadorVertical"></td>
                            <td valign="top">
                                   <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td class="titleItem" width="150">Merchant: </td><td class="textItem"><?php echo $datos[5];?></td></tr>
                                        <tr><td class="titleItem">Sucursal: </td><td class="textItem"><?php echo $datos[6];?></td></tr>
                                        <tr><td class="titleItem">PDV: </td><td class="textItem"><?php echo $datos[7];?></td></tr>
                                    </table>
                            </td>
                        </tr>
                      	<tr><td height="20" colspan="4">&nbsp;  </td></tr>
                    </table>
            </form>
                 <p></p>
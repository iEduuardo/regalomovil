<?php require ('../../includes/function.php'); ?>
<?php
noCache();
if($_GET['id'] && $_GET['do']==1){
			$_idusuario = $_GET['id'];
			$sql = "SELECT id_usuario, id_pos, id_merchant, id_sucursal, id_terminal, str_username, str_password, str_nombre, str_apellidoP, int_tipodeusuario, dt_fechadecreacion, str_email FROM  "._PREPOS."tbl_usuarios WHERE  id_usuario =".$_idusuario;
			$rs = getRecordSet($sql);
			$datos = mysql_fetch_row($rs);
			//echo $sql."<br>";
			?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoUsuario(1);">Lista de usuarios</a> </td></tr>
                        <tr><td colspan="4" class="userTitle"> Creaci&oacute;n de usuario </td></tr>
                        <tr><td colspan="4" class="espaciadorAzul"></td></tr>
                    	<tr>
                        	<td class="separadorVertical"></td>
                        	<td width="50%" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                          <td width="150" class="titleItem">Nombre de usuario: </td><td class="textItem"><input type="text" name="userName" id="userName" value="<?php echo $datos[5];?>"></td></tr>
                                        <tr><td class="titleItem">Clave (<i>password</i>): </td><td class="textItem"><input type="password" name="userPassword" id="userPassword" onchange="document.getElementById('cambioUsuario').value=1" value="<?php echo $datos[6];?>"/> <input type="hidden" id="cambioUsuario" name="cambioUsuario" /></td></tr>
                                        <tr><td class="titleItem">Nombre: </td><td class="textItem"><input type="text" name="nombre" id="nombre" value="<?php echo $datos[7];?>"></td></tr>
                                        <tr><td class="titleItem">Apellido: </td><td class="textItem"><input type="text" name="apellidoP" id="apellidoP" value="<?php echo $datos[8];?>"></td></tr>
                                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                    </table>
                            </td>
                            <td class="separadorVertical"></td>
                            <td valign="top">
                                   <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td class="titleItem" width="150">Merchant: </td><td class="textItem"><?php echo getListaMerchantsUser("id_merchant", true, $datos[2]);?></td></tr>                                 
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr>
                                        <td class="titleItem">Tipo de usuario: </td>
                                         <td class="textItem" id="listadoDeTiposUsuarios">
                                         <?php echo getListaTiposUsuario('int_tipodeusuario', $_verifierInput, true, $datos[9]);?>
                                         </td>
                                        </tr>
                                        <tr><td class="titleItem">Sucursal: </td><td class="textItem" id="listadoDeMerchants"><?php echo getListaSucursalesUser($datos[2],$datos[3]);?></td></tr>
                                        <tr><td class="titleItem">PDV: </td><td class="textItem" id="nombrePDV"><?php echo getListaPDVsUser($datos[2],$datos[3],$datos[1]) ;?></td></tr>
                                        <tr><td class="titleItem">Tipo de PDV:</td><td class="textItem" id="tipoPDV"><?php echo getComboTypoPDVs(); //$datos[4]?></td></tr>
                                    </table>
                            </td>
                        </tr>
                        <tr><td class="separadorHorizontal" colspan="4"></td></tr>
                        <tr><td class="separadorHorizontalBlanco" colspan="4"></td></tr>
                        <tr><td colspan="4"><?php echo getRadiosPuestosUsuario($_idusuario); ?></td></tr>
                        <tr><td height="20" colspan="4" align="center">
                        		<input type="hidden" value="<?php echo $_idusuario ;?>" id="idu" name="idu" />
                                    <input type="hidden" value="<?php echo $_idusuario ;?>" id="idUsuario" name="idUsuario" />
                        </td></tr>
                    </table>
           		
           
           
                 </form>
                 <p></p>
<?php
	}
?>

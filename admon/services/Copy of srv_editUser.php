<?php require ('../../includes/function.php'); ?>
<?php
noCache();
if($_GET['id'] && $_GET['do']==1){
			$_idusuario = $_GET['id'];
			$sql = "SELECT * FROM  "._PREPOS."tbl_usuarios WHERE  id_usuario =".$_idusuario;
			$rs = getRecordSet($sql);
			$datos = mysql_fetch_row($rs);
			//echo $sql."<br>";
			?>
            <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
                	<table width="100%" border="0" cellpadding="0" cellspacing="2">
                    	<tr><td colspan="2" class="userTitle"> Edici&oacute;n de usuario </td></tr>
                    	<tr><td colspan="2" class="espaciadorAzul"></td></tr>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr>
                          <td class="textItem"><a title="Regresar" class="btn_regresar" href="#" onclick="getListadoUsuario(1);">Regresar</a></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr>
                        <td class="textItem">Tipo de usuario: </td>
                         <td>
                         <select class="inputTextNoSize" id="tipoUsuario" name="tipoUsuario" onchange="checkTipoUsuario(this);">
                         	<option value="1" <?php if($datos[9] == 1){ echo " Selected";}?> >Administrador</option>
                            <option value="2" <?php if($datos[9] == 2){ echo " Selected";}?>>Recursos Humanos</option>
                            <option value="3" <?php if($datos[9] == 3){ echo " Selected";}?>>Seleccionador</option>
                         </select>
                         <input type="hidden" name="idu" id="idu" value="<?php echo $_idusuario ;?>" />
                         </td>
                        </tr>
                    	<tr><td class="textItem">Nombre de usuario: </td><td><input class="inputText" type="text" name="userName" id="userName" value="<?php echo $datos[5];?>"  maxlength="10"/></td></tr>
                        <tr><td class="textItem">Nombre: </td><td><input onkeypress="return restrictCharacters(this, event, alpha);" class="inputText" type="text" name="nombre" id="nombre" maxlength="30" value="<?php echo $datos[7];?>"/></td></tr>
                    	<tr><td class="textItem">Apellido: </td><td><input onkeypress="return restrictCharacters(this, event, alpha);" class="inputText" type="text" name="apellidoP" id="apellidoP" maxlength="35" value="<?php echo $datos[8];?>"/></td></tr>

                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr><td colspan="2" class="textItem" align="left"> Si desea cambiar la contrase&ntilde;a de este usuario favor escribala aqu&iacute;: <input type="hidden" id="cambioUsuario" name="cambioUsuario" /></td></tr>
                        <tr><td class="textItem">Contrase&ntilde;a: </td><td><input class="inputText" type="password" name="userPassword" id="userPassword" onchange="document.getElementById('cambioUsuario').value=1" value="<?php echo $datos[6];?>"/></td></tr>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <?php if($datos[9]!=189){?>
                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                    	<tr>
                    	  <td class="textItem">Permisos: </td><td>&nbsp;</td></tr>

                        <tr>
                        	<td id="areaspermitidasTitle" class="textItem" colspan="2">
                        			 <?php echo getRadiosPuestosUsuario($_idusuario); ?>
                        	</td>
                        </tr>
                        <?php }?>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr><td colspan="2">
                        	<table align="center" width="230" border="0" cellpadding="0" cellspacing="0">
                            	<tr>
                                	<td align="center">
                                    <input type="reset" name="reiniciar" id="reiniciar" value="Reiniciar">
                                    </td>
                                    <td align="center">
                                    <input type="hidden" value="<?php echo $_idusuario ;?>" id="idUsuario" name="idUsuario" />
                                    <input type="button" name="enviar" id="enviar" value="&nbsp;Editar&nbsp;" onClick="checkMinEditUser(null,'userName','nombre','apellidoP','userPassword');">
                                    </td>
                                </tr>
                            </table></td></tr>
                    </table>
</form>
                 <p></p>
<?php
	}
?>

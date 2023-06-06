<?php require ('../includes/function.php'); ?>
<?php
noCache();
if($_GET['id'] && $_GET['do']==1){
			$_idusuario = $_GET['id'];
			$sql = "SELECT * FROM  "._PREPOS."tbl_usuarios WHERE  id_usuario =".$_idusuario;
			$rs = getRecordSet($sql);
			$datos = mysql_fetch_row($rs);
			?>
            <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
                	<table width="80%" border="0" cellpadding="0" cellspacing="2" align="center">
                    	<tr><td colspan="2" class="userTitle"> Edici&oacute;n de usuario </td></tr>
                    	<tr><td colspan="2" class="espaciadorAzul"></td></tr>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr>
                        <td class="textItem">Tipo de usuario: </td>
                         <td class="textItem">
                         	<?php if($datos[6] == 1){ echo " Administrador";}?>
                            <?php if($datos[6] == 2){ echo " Recursos Humanos";}?>
                            <?php if($datos[6] == 3){ echo " Seleccionador";}?>
                         </td>
                        </tr>
                    	<tr><td class="textItem">Nombre de usuario: </td><td class="textItem"><?php echo $datos[1];?></td></tr>
                        <tr><td class="textItem">Nombre: </td><td class="textItem"><?php echo $datos[4];?></td></tr>
                    	<tr><td class="textItem">Apellido: </td><td class="textItem"><?php echo $datos[5];?></td></tr>
                    	<tr><td class="textItem">Email: </td><td class="textItem"><?php echo $datos[2];?></td></tr>
                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <?php if($datos[6]==3){?>
                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                    	<tr><td class="textItem">&Aacute;reas: </td><td>&nbsp;</td></tr>

                        <tr>
                        	<td colspan="2" class="candidatoInfo">
                        			 <?php echo getAreaUsuario($_idusuario); ?>
                        	</td>
                        </tr>
                        <?php }?>
                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                        <tr><td colspan="2" align="center"><a title="Regresar" class="btn_regresar" href="#" onclick="getListadoUsuario();">Regresar</a></td></tr>
                    </table>
                 </form>
                 <p></p>
<?php
	}
?>

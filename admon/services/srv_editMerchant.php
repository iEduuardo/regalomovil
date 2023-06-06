<?php require ('../../includes/function.php'); ?>
<?php noCache(); ?>
<?php
if($_GET['id'] && $_GET['do']==1){
			$_idmerchant = $_GET['id'];
			$sql = "SELECT * FROM  "._PREPOS."ctl_merchants WHERE id_merchant=".$_idmerchant;
			$rs = getRecordSet($sql);
			$datos = mysql_fetch_row($rs);
?>
           <form id="newUserForm" name="newUserForm" method="GET" action="newUser.pgp">
           			<table width="100%">
                        <tr><td height="20" colspan="4">&nbsp;  </td></tr>
                        <tr><td colspan="4" align="right"><a class="btn_operacion" href="#" onclick="javascript:getListadoMerchants();">Lista de Comercios</a> </td></tr>
                        <tr>
                          <td colspan="4" class="userTitle"> Creaci&oacute;n de Comercio</td></tr>
                        <tr><td colspan="4" class="espaciadorAzul"></td></tr>
                    	<tr>
                        	<td class="separadorVertical"></td>
                        	<td width="60%" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td width="150" class="titleItem">Nombre del Comercio: </td><td class="textItem"><input class="inputsLargos" type="text" name="nombre" id="nombre" value="<?php echo $datos[2] ;?>"></td></tr>
                                        <tr><td width="150" class="titleItem">Abreviatura: </td><td class="textItem"><input maxlength="6" class="inputsLargos" type="text" name="identificador" id="identificador" value="<?php echo $datos[1] ;?>"> 
                                        <span class="notas">(hasta 6 caracteres)</span></td></tr>
                                        <tr><td height="15" colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                        <tr><td colspan="2" class="espaciadorSinColor"></td></tr>
                                    </table>
                          </td>
                            <td class="separadorVertical"></td>
                            <td valign="top">&nbsp;<input type="hidden" name="idm" id="idm" value="<?php echo $datos[0] ;?>" /></td>
                        </tr>
                        <tr><td class="separadorHorizontal" colspan="4"></td></tr>
                        <tr><td class="separadorHorizontalBlanco" colspan="4"></td></tr>
                        <tr><td height="20" colspan="4" align="center">&nbsp; <a href="#" onClick="javascript:saveEditMerchant(null, 'nombre','identificador');" class="btn_operacion">Guardar Cambios</a></td></tr>
                    </table>
       
</form>
                 <p></p>
<?php
	}
?>
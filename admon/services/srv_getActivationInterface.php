<?php require ('../../includes/function.php'); ?>

<?php
	if($_GET['opt'] && $_GET['opt']!=""){
		$_opt = $_GET['opt'];
	}else{
		$_opt = 1;
	}
	$_posType = getDefault('default_pos_device');
?>
<form id="formulario" name="formulario" action="consulta.pgp" method="post">
 <?php if( $_posType == 1){?>
    <table width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="right" height="50"><spacer height="50"></spacer></td>
      </tr>
      <tr>
        <td colspan="2" class="subTitle">POS para c&oacute;digo de barras</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <?php if($_opt == 4){?>
      <tr>
        <td width="150" class="descripcion_dato">N&uacute;mero de Vendedor:</td><td>&nbsp;</td>
      </tr>
      <tr>
      	<td><input type="text" class="ingresoCorto" name="numero_vendedor" id="numero_vendedor" onkeypress="return restrictCharacters(this, event, digitsOnly);"  maxlength="6"/></td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td width="150" class="descripcion_dato">Monto de la compra:</td><td>&nbsp;</td>
      </tr>
      <tr>
      	<td><input type="text" class="ingresoCorto" name="monto_tarjeta" id="monto_tarjeta" onkeypress="return restrictCharacters(this, event, digitsOnly);"  maxlength="5"/></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td width="150" class="descripcion_dato">N&uacute;mero de pedido:</td><td>&nbsp;</td>
      </tr>
      <tr>
      	<td><input type="text" class="ingresoCorto" name="numero_pedido" id="numero_pedido" onkeypress="return restrictCharacters(this, event, digitsOnly);"  maxlength="6"/></td>
        <td>&nbsp;</td>
      </tr>      
      
      <?php }?>
      <tr>
        <td width="150" class="descripcion_dato">N&uacute;mero de tarjeta:</td><td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="text" class="ingresoDatos" name="numero_tarjeta" id="numero_tarjeta" onkeypress="return restrictCharacters(this, event, digitsOnly);" /></td>
      	<td class="textoMargenIzquierdo" align="left">
        	<input type="hidden" name="comando" id="comando" value="<?php echo $_opt;?>" />
            <input type="hidden" name="tipoPOS" id="tipoPOS" value="<?php echo $_posType;?>" />
			  <?php if($_opt == 1){?> 
              		<input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Activar" onclick="sendTransaccion(<?php echo $_opt;?>);">
              <?php }elseif($_opt == 2){?>
                    <input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Desactivar" onclick="sendTransaccion(<?php echo $_opt;?>);">
			  <?php }elseif($_opt == 4){?>
                    <input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Redimir" onclick="sendTransaccion(<?php echo $_opt;?>);">
			  <?php }else{?>
                    <input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Consultar" onclick="sendTransaccion(<?php echo $_opt;?>);">
              <?php }?>
      	</td>
      </tr>
       <tr>
        <td valign="top" colspan="2" height="150" id="respuesta">&nbsp;</td>
      </tr>
    </table>
 <?php }elseif($_posType == 2){?>   
       <table width="80%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td colspan="2" align="right"><a href="#" class="btn_operacion" onclick="javascript:getPost(1);">Cambiar Disposit&iacute;vo</a></td>
      </tr>
      <tr>
        <td colspan="2" class="subTitle">POS para tarjeta magn&eacute;tica</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>

      <tr>
        <td class="descripcion_dato">N&uacute;mero de tarjeta:</td><td>&nbsp;</td>
      </tr>
      <tr>
        <td width="150"><input type="text" class="ingresoDatos" name="numero_tarjeta" id="numero_tarjeta" onkeypress="return restrictCharacters(this, event, digitsOnly);" /></td>
      	<td align="left" class="textoMargenIzquierdo" >
        	<input type="hidden" name="comando" id="comando" value="<?php echo $_opt;?>" />
            <input type="hidden" name="tipoPOS" id="tipoPOS" value="<?php echo $_posType;?>" />
			  <?php if($_opt == 1){?> 
              		<input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Activar" onclick="sendTransaccion(<?php echo $_opt;?>);">
              <?php }elseif($_opt == 2){?>
                    <input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Desactivar" onclick="sendTransaccion(<?php echo $_opt;?>);">
			  <?php }else{?>
                    <input type="button" name="btn_consultar" id="btn_consultar" class="btn_consultar" value="Consultar" onclick="sendTransaccion(<?php echo $_opt;?>);">
              <?php }?>
      	</td>
      </tr>
       <tr>
        <td valign="top" colspan="2" height="150" id="respuesta">&nbsp;</td>
      </tr>
    </table>
   <?php }?>
</form>

<form  action="validation.php" method="post" name="form2" id="form2">
<table id="loginTable" width="215" border="0" cellpadding="0" cellspacing="3">
<tr>
  <td colspan="2" class="mensaje_bad_ch">Por favor verifica tu usuario o clave</td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr><td width="75">Usuario:</td><td width="120"><input class="inputText" name="username" id="username"  type="text" size="21" onkeydown="if(event.keyCode=='13'){checkMinLogin(null,'username','clave');}"/></td></tr>
<tr><td>Clave:</td><td><input class="inputText" name="clave" id="clave" type="password" size="21" onkeydown="if(event.keyCode=='13'){checkMinLogin(null,'username','clave');}" /></td></tr>
<tr><td></td>
<td align="center">
                  <input onClick="checkMinLogin(null,'username','clave');" type="button" name="button" id="button" value="Login" />
                  <br />
                  <input type='hidden' name="ip" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" />
</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
</table>

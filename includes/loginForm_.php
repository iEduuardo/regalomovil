<div id="loginTable">
<table border="0" width="700" cellpadding="6" cellspacing="0" align="center">
<tr>
    <td width="350">
     <div id="loginForm">
   	      <table id="loginTable" width="100%" border="0" cellpadding="0" cellspacing="3">
            <tr>
              <td colspan="2" class="mensaje_bad_ch"><?php echo $mensaje;?></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr><td width="75">Usuario:</td><td width="120"><input class="inputText" name="username" id="username"  type="text"size="21" /></td></tr>
            <tr><td>Clave:</td><td><input class="inputText" name="clave" id="clave" type="password" size="21" /></td></tr>
            <tr><td></td>
            <td align="center">
                              <input onClick="checkMinLogin(null,'username','clave');" type="button" name="button" id="button" value="Login" />
                              <br />
                              <input type='hidden' name="ip" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" />
            </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            </table>

     </div>
    </td>
    	<td align="center">
     	<div id="banner_wrapper">           
                <div id="banner" class="pics">
                    
                </div>
            </div>
            
    </td>
</tr>
</table>
</div>
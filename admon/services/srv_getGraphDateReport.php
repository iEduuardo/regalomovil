<?php require ('../../includes/function.php'); ?>
<?php  noCache();?>
<?php 
	if (!isset($_SESSION)) {
			session_start();
		}
	$tipoUsuario = $_SESSION['MM_UserGroup'];
?>
                 <p></p>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="72%">&nbsp;<input id="currentQuery" name="currentQuery" type="hidden" /></td>
                  </tr>
                  <tr>
                    <td id="reportResults" valign="top" align="center">
                    	<iframe id="grafica_1" name="grafica_1" src ="services/graph_1.php" width="600" height="300" frameborder="0" scrolling="no" >
                          <p>Tu browser no soporta los iframes.</p>
                        </iframe>
                    	<br />
                    	<iframe id="grafica_2" name="grafica_2" src ="services/graph_2.php" width="600" height="300" frameborder="0" scrolling="no" >
                          <p>Tu browser no soporta los iframes.</p>
                        </iframe>
                        <br />
                    	<iframe id="grafica_3" name="grafica_3" src ="services/graph_3.php" width="600" height="300" frameborder="0" scrolling="no" >
                          <p>Tu browser no soporta los iframes.</p>
                        </iframe>						
                    </td>
                  </tr>
                </table>
<?php require ('../../includes/function.php'); ?>

<?php  noCache();?>

           			<table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr><td colspan="3" height="20">&nbsp;  </td></tr>

                        <tr><td colspan="3" class="userTitle"> Reportes de Actividad </td></tr>

                        <tr><td colspan="3" class="espaciadorAzul"></td></tr>

                        <tr><td colspan="3" align="left" valign="top"></td></tr>

                        <tr>

                            <td id="reportMenu"><?php include("../../includes/menuReports.php"); ?></td>

                            <td align="left" valign="top" width="1"></td>

                        	<td id="contenidoReports" class="espaciadorAzul">

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

                            </td>

                        </tr>

                        <tr><td colspan="3" class="espaciadorAzul"></td></tr>

                    </table>

                 <p></p>
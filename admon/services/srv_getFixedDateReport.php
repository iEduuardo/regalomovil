<?php require ('../../includes/function.php'); ?>
<?php  noCache();?>
<?php 
	if (!isset($_SESSION)) {
			session_start();
		}
	$tipoUsuario = $_SESSION['MM_UserGroup'];
	$_idUsuario   = $_SESSION['MM_UserID'];
?>
                 <p></p>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                       <table>
           			<tr>
                    <td valign="top" class="report_title_form">
                    	 <label for="date1">Fecha:</label>
							<select class="selects_reports" name="fecha_1_dia" id="fecha_1_dia">
                            	<?php
									for($x=1;$x<=31;$x++){
											if($x <=9){
												 $valor = "0".$x;
											}else{
												$valor = $x;
											}
											if($x == date('d')){
												 $selected = " SELECTED";
											}else{
												$selected = "";
											}
											echo "<option value=\"".$x."\" ".$selected.">".$valor."</option>";	
										}
								?>
                            </select>
                            <select class="selects_reports" name="fecha_1_mes" id="fecha_1_mes">
                            	<option<?php if(date('n') == 1){echo " SELECTED";}?> value="JAN">Enero</option>
								<option<?php if(date('n') == 2){echo " SELECTED";}?>  value="FEB">Febrero</option>
                                <option<?php if(date('n') == 3){echo " SELECTED";}?>  value="MAR">Marzo</option>
                                <option<?php if(date('n') == 4){echo " SELECTED";}?>  value="APR">Abril</option>
                                <option<?php if(date('n') == 5){echo " SELECTED";}?>  value="MAY">Mayo</option>
                                <option<?php if(date('n') == 6){echo " SELECTED";}?>  value="JUN">Junio</option>
                                <option<?php if(date('n') == 7){echo " SELECTED";}?>  value="JUL">Julio</option>
                                <option<?php if(date('n') == 8){echo " SELECTED";}?>  value="AUG">Agosto</option>
                                <option<?php if(date('n') == 9){echo " SELECTED";}?>  value="SEP">Septiembre</option>
                                <option<?php if(date('n') == 10){echo " SELECTED";}?>  value="OCT">Octubre</option>
                                <option<?php if(date('n') == 11){echo " SELECTED";}?>  value="NOV">Noviembre</option>
                                <option<?php if(date('n') == 12){echo " SELECTED";}?>  value="DEC">Diciembre</option>
                            </select>
                            <select class="selects_reports" name="fecha_1_ano" id="fecha_1_ano">
                            	<?php
									for($x=2010;$x<=date('Y');$x++){
											if($x <=9){
												 $valor = "0".$x;
											}else{
												$valor = $x;
											}
											if($x == date('Y')){
												 $selected = " SELECTED";
											}else{
												$selected = "";
											}
											echo "<option value=\"".$x."\" ".$selected.">".$valor."</option>";	
										}
								?>
                            </select>&nbsp;
                    </td>
                    <td valign="top" class="reports_espaciador_forms">|</td>
                    <td valign="top" class="report_title_form">
                    <?php if(havePermission($_idUsuario, 7)){ ?>
                    	Comercio: <?php echo getMerchantOption();?>
					<?php } ?>
                    </td>
                    <td valign="top" class="reports_espaciador_forms">|</td>
                    <td valign="top"><input type="button" name="fecha_1_action" id="fecha_1_action" value="Generar"  onclick="javascript:getReporte(1);"/></td>
                  </tr>
                </table>      
                    </td>
                  </tr>
                  <tr>
                    <td valign="top"><input id="currentQuery" name="currentQuery" type="hidden" /></td>
                  </tr>
                  <tr>
                    <td valign="top" height="20">&nbsp;</td>
                  </tr>
                  <tr>
                    <td id="reportResults" valign="top">&nbsp;</td>
                  </tr>
                </table>
                
           		   

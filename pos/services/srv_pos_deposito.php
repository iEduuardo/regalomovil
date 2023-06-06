<TABLE BORDER=0 align="center" cellpadding="0" cellspacing="2">

                    <tr>

					  <td class="fieldTitle">Monto:</td>

                      <td><input class="pos_corto" id="monto" name="monto" maxlength="4" onfocus="setFocusedObject(this.name);" /></td>

                    </tr>

                     <!-- <tr>

					  <td class="fieldTitle">operador:</td>

                      <td>

                      	<select id="select_operador" name="select_operador" onchange="document.getElementById('operador').value=this.value;">

                        	<option value="0">Seleccione</option>

                        	<option value="Telcel">Telcel</option>

                            <option value="Nextel">Nextel</option>

                            <option value="Movistar">Movistar</option>

                            <option value="Iusacell">Iusacell</option>

                        </select>

                      </td>

                    </tr> -->

                    <tr>

                    	<td class="fieldTitle">No Telef&oacute;nico:</td>

						<td colspan="2">

							<INPUT class="pos_inputText" TYPE="text" NAME="numero_tarjeta" id="numero_tarjeta" onfocus="setFocusedObject(this.name);">

						</td>

					</tr>

                    <tr>

                    	<td class="fieldTitle">Nombre o mensaje del depositante:</td>

						<td colspan="2">

							<INPUT class="pos_inputText" TYPE="text" NAME="nombre" id="nombre">

						</td>

					</tr>

					<tr>

					<td valign="top" align="left">

                    	<table border="0" cellspacing="2" cellpadding="0">

					    <tr>

					      <td><input class="btn_calculadora" type="button" name="one" id="one"  value="  1  " onclick="document.getElementById(objectFocused).value += '1'" /></td>

					      <td><input class="btn_calculadora" type="button" name="two" id="two"   value="  2  " onclick="document.getElementById(objectFocused).value += '2'" /></td>

					      <td><input class="btn_calculadora" type="button" name="three" id="three" value="  3  " onclick="document.getElementById(objectFocused).value += '3'" /></td>

				        </tr>

					    <tr>

					      <td><input class="btn_calculadora" type="button" name="four" id="four"  value="  4  " onclick="document.getElementById(objectFocused).value += '4'" /></td>

					      <td><input class="btn_calculadora" type="button" name="five" id="five"  value="  5  " onclick="document.getElementById(objectFocused).value += '5'" /></td>

					      <td><input class="btn_calculadora" type="button" name="six" id="six"   value="  6  " onclick="document.getElementById(objectFocused).value += '6'" /></td>

				        </tr>

					    <tr>

					      <td><input class="btn_calculadora" type="button" name="seven" id="seven" value="  7  " onclick="document.getElementById(objectFocused).value += '7'" /></td>

					      <td><input class="btn_calculadora" type="button" name="eight" id="eight" value="  8  " onclick="document.getElementById(objectFocused).value += '8'" /></td>

					      <td><input class="btn_calculadora" type="button" name="nine" id="nine"  value="  9  " onclick="document.getElementById(objectFocused).value += '9'" /></td>

				        </tr>

					    <tr>

					      <td><input type="button" class="tecla_pos" id="btn_clear" name="btn_clear" onclick="javascript:clearProcess();"  value="  C  "/></td>

					      <td><input class="btn_calculadora" type="button" name="zero" id="zero"  value="  0  " onclick="document.getElementById(objectFocused).value += '0'" /></td>

					      <td><input type="button" class="tecla_pos" id="btn_ok" name="btn_ok" onclick="javascript:sendTransaccion(1);"  value="  OK  "/></td>

				        </tr>

				      </table>

					  <br>

					  <br>

					</td><td>&nbsp;</td>

					</tr>

					</TABLE>
<?php

session_start();

if($_SESSION['access2'] == true)

{

header("Content-type: text/javascript");



?>



var objectFocused = 'monto';



function setFocusedObject(currentObjeto){

	objectFocused = currentObjeto;

}



function setOperacion(operacion){

			document.getElementById("comando").value = operacion;

            var url;

            switch(operacion){

            	case '1':

                	url = "srv_pos_deposito.php";

                	break;

                case '2':

                	url = "srv_pos_pago.php";

                	break;

                case '3':

                	url = "srv_pos_consulta.php";

                	break;

                default:

                	url = "srv_pos_deposito.php";

            }

            document.getElementById('posMessages').innerHTML ="";

            nombreObjeto = "areaDeTrabajo";

            getData(url, nombreObjeto);    

}



//-------------------------------------------------------------
function getReportes(){

url = "srv_pos_getReport.php";

nombreObjeto = "contenidos";

getData(url, nombreObjeto);

reiniciaToolBar("link_reportes");	

}

//--------------------------------------------------------------------		

function getReporteXLS(){

		var url = document.getElementById("currentQuery").value;

		url =  url.replace("srv_pos_getReportResults.php?", "");

		url = "services/srv_xls_reporte.php?"+url; //

		nombreObjeto = "contenido";

		window.open(url, 'excel');	

	}

function getReporte(tipoReporte){
debugger;
		if(tipoReporte == 1){

			var obj2 = document.getElementById("contenidos").style.height = "auto";

			var fecha = document.getElementById("fecha_1_dia").options[document.getElementById("fecha_1_dia").selectedIndex].value + "-" + document.getElementById("fecha_1_mes").options[document.getElementById("fecha_1_mes").selectedIndex].value + "-" +document.getElementById("fecha_1_ano").options[document.getElementById("fecha_1_ano").selectedIndex].value;
			
			var url = "srv_pos_getReportResults.php?fecha="+fecha;

			var nombreObjeto = "reportResults";

			//-- Current query ----------------

			document.getElementById("currentQuery").value = url;

		}

		if(tipoReporte == 2){

			var obj2 = document.getElementById("contenidos").style.height = "auto";

			var fecha_inicial = document.getElementById("fecha_1_dia").options[document.getElementById("fecha_1_dia").selectedIndex].value + "-" + document.getElementById("fecha_1_mes").options[document.getElementById("fecha_1_mes").selectedIndex].value + "-" +document.getElementById("fecha_1_ano").options[document.getElementById("fecha_1_ano").selectedIndex].value;

			var fecha_final   = document.getElementById("fecha_2_dia").options[document.getElementById("fecha_2_dia").selectedIndex].value + "-" + document.getElementById("fecha_2_mes").options[document.getElementById("fecha_2_mes").selectedIndex].value + "-" +document.getElementById("fecha_2_ano").options[document.getElementById("fecha_2_ano").selectedIndex].value;

			//var comercio = document.getElementById("id_merchant").options[document.getElementById("id_merchant").selectedIndex].value;

			var url = "srv_pos_getReportResults.php?fecha="+fecha_inicial+"&fecha_final="+fecha_final;

			var nombreObjeto = "reportResults";

			

			//if(comercio != ""){

			//	url = url + "&id_cliente="+comercio;

			//} 

			//-- Current query ----------------

			document.getElementById("currentQuery").value = url;

		}

		getData(url, nombreObjeto);

		reiniciaToolBar("link_reportes");

	}




//-----------------------------------------------------------------------------------------

function CallPrint(strid)

{

	var prtContent = document.getElementById(strid);

	var WinPrint =

	window.open('','','left=0,top=0,width=1,height=1,t oolbar=0,scrollbars=0,status=0');

	WinPrint.document.write(prtContent.innerHTML);

	WinPrint.document.close();

	WinPrint.focus();

	WinPrint.print();

	WinPrint.close();

	prtContent.innerHTML=strOldOne;

}



//----------------------------------------------------------

//----------------------------------------------------------

function sendVerificacion(celular){

		var codigoVerificador = "";

		if(document.getElementById('numero_verificador')){

			codigoVerificador = document.getElementById('numero_verificador').value;

        }

		var errors = "";

		var url = "srv_sendVerificacion.php?";

		var nombreObjeto = "posMessages";

		var variables = "";

		//---------------------------------

        if(document.getElementById('numero_verificador').value.length <= 5){

        	errors += "Por favor ingrese el numero verificador\n"

			alert('Necesitamos que complemente:\n\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

			return false;

        }else{

            variables = "codigo="+codigoVerificador+"&tel="+celular;

        	getData(url+variables, nombreObjeto);

            var obj2 = document.getElementById("posMessages").style.height = "auto";

        }

        //---------------------------------

}



//----------------------------------------------------------

//----------------------------------------------------------	

function sendTransaccion(operacion){

		var opt = document.getElementById('comando').value;

		var errors = "";

		var url = "srv_sendPeticion.php?";

		var nombreObjeto = "posMessages";

		var variables = "";

		//---------------------------------

		if(document.getElementById('numero_tarjeta')){

			if(document.getElementById('numero_tarjeta').value==''){

					errors += "Por favor ingrese el numero de la tarjeta\n";

				}

		}else{

			errors = "Existe un problema con la p&aacute;gina que visita\n";	

		}

        //---------------------------------

		if(document.getElementById('comando')){

			if(document.getElementById('comando').value==''){

					errors += "Por favor seleccione la operacion\n";

				}

		}else{

			errors = "Existe un problema con la p&aacute;gina que visita\n";	

		}

		//---------------------------------

		if(document.getElementById('monto')){

			if(document.getElementById('monto').value==''){

					errors += "Por favor ingrese el monto de la compra\n";

				}

		}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

			return false;

		}else{

			//--------------------------------------

			var lists = document.getElementsByTagName("input");

				for (var i = 0; i < lists.length; i++) {

					objectName  = lists[i].id;

					objectValue = lists[i].value;

						if(lists[i].checked){

							variables = variables + objectName +"=" + objectValue + "&";

						}else{

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

						}

				}

            //---------------------------------

            getData(url+variables, nombreObjeto);

            //---------------------------------

            if(document.getElementById('monto')){document.getElementById('monto').value = '';}

            if(document.getElementById('numero_tarjeta')){document.getElementById('numero_tarjeta').value = '';}

            if(document.getElementById('nombre')){document.getElementById('nombre').value = '';}

            //if(document.getElementById('comando')){document.getElementById('comando').value = '';}

			//---------------------------------

            if(document.getElementById('comando').value ==1){ var obj2 = document.getElementById("posMessages").style.height = "auto";}

		}	

	}

//-------------------------------------------------------------

//-------------------------------------------------------------   

function clearProcess(){

			document.getElementById('monto').value = '';

			document.getElementById('numero_tarjeta').value = '';

            document.getElementById('comando').value = '';

}
//----------------------------------------------------------	

function get_pos_ReportFixedDate(){

		url = "srv_pos_getFixedDateReport.php";

		nombreObjeto = "contenidoReports";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_reportes");	

	}

//----------------------------------------------------------

function getMiData(){

		url = "../../services/srv_getMiData.php";

		nombreObjeto = "contenidos";

		var obj2 = document.getElementById("contenidos").style.height = "auto";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_datos");	

	}

//---------------------------------------------------------------
function reiniciaToolBar(objName){

var objNameArr = new Array(7);

objNameArr[0]  = "link_inicial";

objNameArr[1]  = "link_activaciones";

objNameArr[2]  = "link_desactivaciones";

objNameArr[3]  = "link_consultas";

objNameArr[4]  = "link_reportes";

objNameArr[5]  = "link_datos";

objNameArr[6]  = "link_redencion";

objNameArr[7]  = "link_usuarios";

objNameArr[8]  = "link_merchants";



var obj1;

var vueltas = objNameArr.length;

	for (var i = 0; i < vueltas; i++){

		if(document.getElementById(objNameArr[i])){

			obj1 = document.getElementById(objNameArr[i]).className = "";

		}

	}

var obj2 = document.getElementById(objName).className = "current";

}

//----------------------------------------------------------

function editThisUser(){

		var url = "../../services/srv_editMyData.php";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_datos");	

	}

//----------------------------------------------------------

function saveUserChanges(){

		getMiData();

	}

//----------------------------------------------------------

function setChanges(){

	HAY_CAMBIOS = true;

}

//-----------------------------------------------------------------------------------------

function CallPrint(strid)

{

	var prtContent = document.getElementById(strid);

	var WinPrint ;

	window.open('','','left=0,top=0,width=1,height=1,t oolbar=0,scrollbars=0,status=0');

	WinPrint.document.write(prtContent.innerHTML);

	WinPrint.document.close();

	WinPrint.focus();

	WinPrint.print();

	WinPrint.close();

	prtContent.innerHTML=strOldOne;

}

<?php



$_SESSION['access2'] = false;

}

?>
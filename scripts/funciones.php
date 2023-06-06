<?php

session_start();

if($_SESSION['access'] == true)

{

header("Content-type: text/javascript");



?>

//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function objetoAjax(){

	var xmlhttp=false;

	try {

		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

	} catch (e) {

		try {

		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		} catch (E) {

			xmlhttp = false;

  		}

	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {

		xmlhttp = new XMLHttpRequest();

	}

	return xmlhttp;

}

//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function getData(url, nombreObjeto){

	var ajax=objetoAjax();

	var subDir = "services/";

	ajax.open("GET", subDir+url, true);

	ajax.onreadystatechange=function() {

		if (ajax.readyState==4) {

			html=unescape(ajax.responseText);

			document.getElementById(nombreObjeto).innerHTML = html;

		}else{

			document.getElementById(nombreObjeto).innerHTML = '<div style="display:block; height:20px; border:0px;" class="banner_loading" align="center"><img src="images/loading.gif"></div>';

		}

	}

	ajax.send("nombres");

}



//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function getDataNoneLoading(url, nombreObjeto){

	var ajax=objetoAjax();

	ajax.open("GET", "services/"+url, true);

	ajax.onreadystatechange=function() {

		if (ajax.readyState==4) {

			html=unescape(ajax.responseText);

		}

	}

	ajax.send("nombres");



}



//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

// JavaScript Document

function EscribaMes(v1){

  var vmes = v1;

  var vectormeses = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

  fechacompleta=vectormeses[vmes-1];

 return fechacompleta;

 }



//-------------------------------------------------------------------

//-------------------------------------------------------------------	

var digitsOnly = /[1234567890]/g;

var integerOnly = /[0-9\.]/g;

var alphaOnly = /[A-Z]/g;

var alpha = /[a-zA-Z]/g;

//var alpha = /[a-zA-Z � � � � �� �� �� �� ]/g;



function restrictCharacters(myfield, e, restrictionType) {

		if (!e) var e = window.event

		if (e.keyCode) code = e.keyCode;

		else if (e.which) code = e.which;

		var character = String.fromCharCode(code);

		if (code==27) { this.blur(); return false; }

		if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40 && code!=32) {

			if (character.match(restrictionType)) {

				return true;

			} else {

				return false;

			}

		}

	}



//------------------------------------------------------------------------------------------

function checkEnter(e){

		var characterCode;

			if(e && e.which){ 

				e = e;

				characterCode = e.which;

			}

			else{

				e = event;

				characterCode = e.keyCode;

			}

			if(characterCode == 13){ 

				return false;

			}

			else{

				return true;

			}

		

		}



//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function echeck(str) {

		var at="@"

		var dot="."

		var lat=str.indexOf(at)

		var lstr=str.length

		var ldot=str.indexOf(dot)

		if (str.indexOf(at)==-1){

		   return false;

		}



		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){

		   return false;

		}



		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){

		    return false;

		}



		 if (str.indexOf(at,(lat+1))!=-1){

		    return false;

		 }



		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){

		    return false;

		 }



		 if (str.indexOf(dot,(lat+2))==-1){

		    return false;

		 }

		

		 if (str.indexOf(" ")!=-1){

		    return false;

		 }

 		 return true;					

	}



//----------------------------------------------------------

//----------------------------------------------------------

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

	objNameArr[9]  = "link_merchants";

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

//----------------------------------------------------------	

function getActivation(opt){

		var url = "srv_getActivationInterface.php?opt="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_activaciones");

	}



//----------------------------------------------------------

//----------------------------------------------------------	

function getDeactivation(opt){

		var url = "srv_getActivationInterface.php?opt="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_desactivaciones");

	}

//----------------------------------------------------------

//----------------------------------------------------------	



function getRedencion(opt){

		var url = "srv_getActivationInterface.php?opt="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_redencion");

	}



//----------------------------------------------------------

//----------------------------------------------------------	

function getConsulta(opt){

		var url = "srv_getActivationInterface.php?opt="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_consultas");

	}

/*---------------------------------------------------------*/	

/*   R E P O R T E S  */

//----------------------------------------------------------

//----------------------------------------------------------

function getReportes(){

		url = "srv_getReport.php";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_reportes");	

	}


//----------------------------------------------------------	

function getReportDateRange(){

		url = "srv_getRangeDateReport.php";

		nombreObjeto = "contenidoReports";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_reportes");	

	}

//----------------------------------------------------------

function getReportGraficos(){

		url = "srv_getGraphDateReport.php";

		nombreObjeto = "contenidoReports";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_reportes");	

	}

//----------------------------------------------------------

function getGraphicReport(tipoReporte){

			var comercio = document.getElementById("id_merchant").options[document.getElementById("id_merchant").selectedIndex].value;

			if(comercio == "" || comercio == '0'){

				alert("Por favor seleccione un comercio");

			}else{

				url = "srv_getGraphDateReport.php";

				nombreObjeto = "contenidoReports";

				getData(url, nombreObjeto);

				reiniciaToolBar("link_reportes");

			}

	}

/*---------------------------------------------------------------------*/

//TO-DO

//----------------------------------------------------------	

function getReportIDMerchant(){

	

	}



/*---------------------------------------------------------------------*/

//TO-DO

//----------------------------------------------------------	

function getReportStatus(){
	}

//---------------------------------------------------------

function getReporte(tipoReporte){
debugger;
		if(tipoReporte == 1){

			var obj2 = document.getElementById("contenidos").style.height = "auto";

			var fecha = document.getElementById("fecha_1_dia").options[document.getElementById("fecha_1_dia").selectedIndex].value + "-" + document.getElementById("fecha_1_mes").options[document.getElementById("fecha_1_mes").selectedIndex].value + "-" +document.getElementById("fecha_1_ano").options[document.getElementById("fecha_1_ano").selectedIndex].value;
			
			var url = "srv_getReportResults.php?fecha="+fecha;

			var nombreObjeto = "reportResults";

			//-- Current query ----------------

			document.getElementById("currentQuery").value = url;

		}

		if(tipoReporte == 2){

			var obj2 = document.getElementById("contenidos").style.height = "auto";

			var fecha_inicial = document.getElementById("fecha_1_dia").options[document.getElementById("fecha_1_dia").selectedIndex].value + "-" + document.getElementById("fecha_1_mes").options[document.getElementById("fecha_1_mes").selectedIndex].value + "-" +document.getElementById("fecha_1_ano").options[document.getElementById("fecha_1_ano").selectedIndex].value;

			var fecha_final   = document.getElementById("fecha_2_dia").options[document.getElementById("fecha_2_dia").selectedIndex].value + "-" + document.getElementById("fecha_2_mes").options[document.getElementById("fecha_2_mes").selectedIndex].value + "-" +document.getElementById("fecha_2_ano").options[document.getElementById("fecha_2_ano").selectedIndex].value;

			//var comercio = document.getElementById("id_merchant").options[document.getElementById("id_merchant").selectedIndex].value;

			var url = "srv_getReportResults.php?fecha="+fecha_inicial+"&fecha_final="+fecha_final;

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



//---------------------------------------------------------	

function ordenarResultado(campo){

		var nombreObjeto = "reportResults";

		var url = document.getElementById("currentQuery").value;

		var url_adcional = url + "&ordenado="+campo;

		getData(url_adcional, nombreObjeto);

	}	



//---------------------------------------------------------	

function getPost(current_tipoPos){

		var nombreObjeto = "contenidos";

		var comando = document.getElementById("comando").value;

		var url = "srv_getPOS_type.php?opt="+comando+"&postType="+current_tipoPos;		

		getData(url, nombreObjeto);

	}

/*--------------------------------------------------------*/

//----------------------------------------------------------

function getMiData(){

		url = "srv_getMiData.php";

		nombreObjeto = "contenidos";

		var obj2 = document.getElementById("contenidos").style.height = "auto";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_datos");	

	}

//----------------------------------------------------------

function editThisUser(){

		var url = "srv_editMyData.php";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar("link_datos");	

	}

//----------------------------------------------------------

var HAY_CAMBIOS=false;

function setChanges(){

		HAY_CAMBIOS = true;

	}

//----------------------------------------------------------

function getMiData_fromEdition(){

		if(HAY_CAMBIOS){

				if(confirm("Desea salir SIN guardar los cambios?,\n")){

					getMiData();

				}	

		

		}else{

			getMiData();

		}

	}

	

//----------------------------------------------------------

function saveUserChanges(){

		getMiData();

	}

    

  //---------------------------------------------------------

//checkMinNewUser(null,'userName','userNumber','userPassword','manNumSMSMonth','manNumSMSWeek','manNumSMSWeekClient')

function checkMinEditUser(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

   	mensajes["userName"]="- Nombre de usuario.\n";

	mensajes["nombre"]="- Nombre propio del usuario.\n";

	mensajes["apellidoP"]="- Apellido de usuario.\n";

   	mensajes["userPassword"]="- Contrasena de usuario.\n";

	//--------------------------------------

	var args=checkMinEditUser.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

	

	//---------------------------------

	if (errors){

		valido = false; 

		alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

		return false;

	}else{

		//----------------------------------

		var sel = document.getElementById("cmb_int_tipodeusuario");

		//--------------------------------------

		var lists = document.getElementsByTagName("input");

			for (var i = 0; i < lists.length; i++) {

                objectName  = lists[i].id;

                objectValue = lists[i].value;

                    if(lists[i].checked){

                    	variables = variables + objectName +"=" + objectValue + "&";

                    }else{

                        if(document.getElementById(objectName).type == "password" || document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden"){

                        	variables = variables + objectName +"=" + objectValue + "&";

                        }

                        

                    }

            }

		//--------------------------------------

		poststr = "tipoUsuario="+sel.options[sel.selectedIndex].value;

		poststr = poststr + "&do=1&"+variables;

		//----------------------------------

		//----------------------------------

		url = "srv_doUpdateUser.php?"+poststr;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

	}

	

	}



//----------------------------------------------------------

//----------------------------------------------------------	

function sendTransaccion(opt){

		var errors = "";

		var url = "srv_sendPeticion.php?";

		var nombreObjeto = "respuesta";

		var variables = "";

		//---------------------------------

		if(document.getElementById('numero_tarjeta')){

			if(document.getElementById('numero_tarjeta').value==''){

					errors += "Por favor ingrese el numero de la tarjeta\n";

				}

		}else{

			errors = "Existe un problema con la p&aacute;gina qe visita\n";	

		}

		//---------------------------------

		if(document.getElementById('numero_vendedor')){

			if(document.getElementById('numero_vendedor').value==''){

					errors += "Por favor ingrese el numero vendedor\n";

				}

		}

		//---------------------------------

		if(document.getElementById('monto_tarjeta')){

			if(document.getElementById('monto_tarjeta').value==''){

					errors += "Por favor ingrese el monto de la compra\n";

				}

		}

		//---------------------------------

		if(document.getElementById('numero_pedido')){

			if(document.getElementById('numero_pedido').value==''){

					errors += "Por favor ingrese el numero de pedido\n";

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

								if(document.getElementById("tipoPOS").value == 2){

									if(objectName == "numero_tarjeta"){

										var str = objectValue.replace(/[&$�%_B]/gi, "-");

										objectValue = str.replace(/--/gi, "-");//;

										variables = variables + objectName +"=" + objectValue + "&";

									}else{

										variables = variables + objectName +"=" + objectValue + "&";

									}

									

								}else{

									variables = variables + objectName +"=" + objectValue + "&";

								}

							}

						}

				}

			getData(url+variables, nombreObjeto);

			if(opt == 1){

			reiniciaToolBar("link_activaciones");

			var obj2 = document.getElementById("contenidos").style.height = "250px";

			}

			if(opt == 2){

			reiniciaToolBar("link_desactivaciones");

			var obj2 = document.getElementById("contenidos").style.height = "250px";	

			}

			if(opt == 3){

			reiniciaToolBar("link_consultas");

			var obj2 = document.getElementById("contenidos").style.height = "auto";

			}

			

			document.getElementById('numero_tarjeta').value = '';

			if(document.getElementById('monto_tarjeta')){

				document.getElementById('monto_tarjeta').value = '';

			}

			//---------------------------------

			if(document.getElementById('numero_vendedor')){

				document.getElementById('numero_vendedor').value = '';

			}

			//---------------------------------

			if(document.getElementById('numero_pedido')){

				document.getElementById('numero_pedido').value = '';

			}

			//---------------------------------

			if(opt == 4){

				var obj2 = document.getElementById("contenidos").style.height = "auto";



			}

		}	

	}

//----------------------------------------------------------

//----------------------------------------------------------

function getMiPerfil(){

		url = "srv_getProfile.php";

		nombreObjeto = "contenido";

		getData(url, nombreObjeto);

		reiniciaToolBar('menuPerfil');

	}

	

//----------------------------------------------------------

/*------ESPACIO PARA FUNCIONES DE USUARIOS ----------------*/

//----------------------------------------------------------

function getNuevoUsuario(){

		url = "srv_newUser.php";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

	}

//----------------------------------------------------------

function getListadoUsuario(opt){

		url = "srv_listUser.php?opt="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

		var obj2 = document.getElementById("contenidos").style.height = "auto";

	}



//----------------------------------------------------------

/*desaparecer: deprecated*/

//----------------------------------------------------------

function getEdicionUsuario(){

		url = "srv_listEditUser.php?opt=1";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

	}

	

//--------------------------------------------------------------------

/*---------------------------------------------------------------------*/

function getNewUsuario(){

		url = "srv_form_newUser.php";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		var obj2 = document.getElementById("contenidos").style.height = "auto";

		//reiniciaToolBar('link_usuarios');	

	}

//----------------------------------------------------------

function getUserInfo(idusuario){

		url = "srv_getUserInfo.php?do=1&id="+idusuario;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

	}



//----------------------------------------------------------	

function getUserEditForm(opt){

		url = "srv_editUser.php?do=1&id="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

	}

//----------------------------------------------------------

function deleteUser(){

		url = "srv_listUser.php?opt=2";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_usuarios');

	}



//----------------------------------------------------------

//----------------------------------------------------------	

function doDeleteUser(opt, rowName){

		if(confirm("La operacion que realiza es definitiva,\n desea continuar?")){

			   	url = "srv_doDeleteUser.php?do=1&id="+opt;

				nombreObjeto = "contenidos";

				getData(url, nombreObjeto);

				reiniciaToolBar('link_usuarios');

			}

	}



//----------------------------------------------------------

//----------------------------------------------------------	

function newlistaUsuarios(opt, obj){

				var filtro = obj.value;

			   	url = "srv_listaUsersFiltrada.php?do=1&idU="+filtro+"&id="+opt;

				nombreObjeto = "listadoDeUsuarios";

				getData(url, nombreObjeto);

				reiniciaToolBar('link_usuarios');

	}

	

//----------------------------------------------------------

//----------------------------------------------------------

function isUsuario(inputName){

	var valorInput    = document.getElementById(inputName).value;

	var valorMerchant = document.getElementById("id_merchant").value;

	if(valorInput == 2 || valorInput == 3){ // si es ventas o gerente

		getSucursales(valorMerchant);

	}else{

		regenUserForm();

	}

	checkOffAll();

	SelectDefaultUserPermissions(valorInput);

}



//----------------------------------------------------------

//----------------------------------------------------------

function regenUserForm(){

		document.getElementById('listadoDeMerchants').innerHTML = "";

		document.getElementById('nombrePDV').innerHTML          = "";

		document.getElementById('tipoPDV').innerHTML            = "";

	}



//----------------------------------------------------------

//----------------------------------------------------------

function checkActivation(obj){

		var datos;

		if (obj.checked) {

        	datos = 1;

			regenUserForm();

        }else{

			datos = 2;

		}

	}



/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/

function getListadoMerchants(){

		url = "srv_getListComercios.php?opt=1";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

		var obj2 = document.getElementById("contenidos").style.height = "auto";

}



//----------------------------------------------------------

function getNewMerchant(){

		url = "srv_newMerchantForm.php?do=1";

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

}



//----------------------------------------------------------

function doDeleteMerchant(opt, rowName, idMerchant){

		if(confirm("La operacion que realiza es definitiva,\n desea continuar?")){

			   	url = "srv_doDeleteMerchant.php?do=1&idm="+idMerchant+"&id="+opt;

				nombreObjeto = "contenidos";

				getData(url, nombreObjeto);

				reiniciaToolBar('link_merchants');

			}

	}



//----------------------------------------------------------

function getMerchantEditForm(opt){

		url = "srv_editMerchant.php?do=1&id="+opt;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

}



//----------------------------------------------------------

function saveNewMerchant(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

	mensajes["nombre"]="- Nombre para el comercio.\n";

	mensajes["identificador"]="- Abreviatura para el comercio.\n";

	//--------------------------------------

	var args=saveNewMerchant.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

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

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			url = "srv_doNewMerchant.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

		}

	}



//----------------------------------------------------------

function saveEditMerchant(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

	mensajes["nombre"]="- Nombre para el comercio.\n";

	mensajes["identificador"]="- Abreviatura para el comercio.\n";

	//--------------------------------------

	var args=saveEditMerchant.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

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

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			url = "srv_doEditMerchant.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

		}

}



//----------------------------------------------------------

//----------------------------------------------------------

function getSucursales(idMerchant){

			   	url = "srv_comboSucursales.php?do=1&id="+idMerchant;

				nombreObjeto = "listadoDeMerchants"; //listadoDeMerchants

				getData(url, nombreObjeto);

	}



//----------------------------------------------------------

function getSucursalInfo(idSucursal){

		url = "srv_getSucursalInfo.php?do=1&id="+idSucursal;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

	}



//----------------------------------------------------------	

function getSucursalEditForm(opt, merchant){

		url = "srv_editSucursal.php?do=1&id="+opt+"&idm="+merchant;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

	}



//----------------------------------------------------------

function saveEditSucursal(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

	mensajes["nombre"]="- Nombre de Sucursal.\n";

	var args=saveEditSucursal.arguments;

    for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

    //---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

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

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			url = "srv_doEditSucursal.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

        }

}



//----------------------------------------------------------

function doDeleteSucursal(opt, rowName, idMerchant){

		if(confirm("La operacion que realiza es definitiva,\n desea continuar?")){

			   	url = "srv_doDeleteSucursal.php?do=1&idm="+idMerchant+"&id="+opt;

				nombreObjeto = "contenidos";

				getData(url, nombreObjeto);

				reiniciaToolBar('link_merchants');

			}

	}



//----------------------------------------------------------

//----------------------------------------------------------

function getNewPos (idSucursal, idMerchant){

		url = "srv_form_pos.php?do=1&idm="+idMerchant+"&ids="+idSucursal;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

	}



//----------------------------------------------------------

function doDeletePOS(opt, rowName, idMerchant, idSucursal){

		if(confirm("La operacion que realiza es definitiva,\n desea continuar?")){

			   	url = "srv_doDeletePOS.php?do=1&idm="+idMerchant+"&idp="+opt+"&ids="+idSucursal;

				nombreObjeto = "POSList";

				getData(url, nombreObjeto);

				reiniciaToolBar('link_merchants');

			}

	}



//----------------------------------------------------------

function saveNewPOS(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

	mensajes["idPOS"]="- Identificador del POS.\n";

	mensajes["descripcion"]="- Nombre o descripcion del POS.\n";

	//--------------------------------------

	var args=saveNewPOS.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

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

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			url = "srv_doNewPOS.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

		}

	}



//----------------------------------------------------------

//----------------------------------------------------------

function getTipoUsuarios(){

			   	url = "srv_comboUsuarios.php?do=1";

				nombreObjeto = "listadoDeTiposUsuarios";

				getData(url, nombreObjeto);

	}

	

//----------------------------------------------------------

//----------------------------------------------------------

function getPOSCombo(idMerchant){

				var idsucursales  = document.getElementById("id_sucursal").value;

			   	url = "srv_comboPOS.php?do=1&idm="+idMerchant+"&ids="+idsucursales;

				nombreObjeto = "nombrePDV";

				getData(url, nombreObjeto);

	}

	

//----------------------------------------------------------

//----------------------------------------------------------

function getPOSTypeCombo(){

				url = "srv_comboPOSType.php?do=1";

				nombreObjeto = "tipoPDV";

				getData(url, nombreObjeto);	

	

	}



//-----------------------------------------------------------------------------------------

/* regresa true si el check esta seleccionado */

//-----------------------------------------------------------------------------------------

function getCheckedValue(numObj) {

    var cnt = -1;

    var largo = parseInt(document.getElementsByName("radio_"+numObj).length) - 1;

    for (var i=0; i<=largo; i++) {

        if (document.getElementsByName("radio_"+numObj)[i].checked) {

        	cnt = i;

            i = largo;

        }

    }

    if (cnt > -1){return true;} else {return false;} 

   

}



//-----------------------------------------------------------------------------------------

/* regresa el valor del check seleccionado */

//-----------------------------------------------------------------------------------------

function returnCheckedValue(numObj){

	radioObj = document.getElementsByName(numObj)

	//---------

	if(!radioObj)

		return "";

	var radioLength = radioObj.length;

	if(radioLength == undefined)

		if(radioObj.checked)

			return radioObj.value;

		else

			return "";

	for(var i = 0; i < radioLength; i++) {

		if(radioObj[i].checked) {

			return radioObj[i].value;

		}

	}

	return "";

}



/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/

function getListadoSucursales(id_merchant){

		url = "srv_listSucursales.php?opt=1&merchant="+id_merchant;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

		var obj2 = document.getElementById("contenidos").style.height = "auto";



}



/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/

function getNewSucursal(id_merchant){

		url = "srv_form_newSucursales.php?opt=1&merchant="+id_merchant;

		nombreObjeto = "contenidos";

		getData(url, nombreObjeto);

		reiniciaToolBar('link_merchants');

		var obj2 = document.getElementById("contenidos").style.height = "auto";

	

}



/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/

function saveNewSucursal(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

	mensajes["nombre"]="- Nombre de sucursal.\n";

	//--------------------------------------

	var args=saveNewSucursal.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

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

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			url = "srv_doNewSucursal.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

		}

}



/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/

function saveNewUser(){

	var valido = true;

	var errors = '';

	var variables = "";

	var poststr  = "";

	mensajes= new Object;

   	mensajes["user"]="- Nombre de usuario.\n";

	mensajes["userPassword"]="- Clave.\n";

	mensajes["nombre"]="- Nombre propio del usuario.\n";

	mensajes["apellido"]="- Apellido de usuario.\n";

   	mensajes["email"]="- Correo electronico.\n";

	mensajes["id_merchant"]="- Seleccione un merchant.\n";

	mensajes["int_tipodeusuario"]="- Tipo de usuario.\n";

	//--------------------------------------

	var args=saveNewUser.arguments;

	for(var i=1; i<(args.length); i++){

		if(document.getElementById(args[i]).value == ""){

			errors += mensajes[args[i]] ;

		};

	}

		//---------------------------------

		if (errors){

			valido = false; 

			alert('Necesitamos que complemente:\n'+errors+"\n\nLos acentos han sido intencionalmente omitidos");

			return false;

		}else{

			//----------------------------------

			//document.form2.submit();

			//var poststr = "userName=" + encodeURI( document.getElementById("userName").value ) +"&userNumber=" + encodeURI( document.getElementById("userNumber").value ) +"&userPassword=" + encodeURI( document.getElementById("userPassword").value )+"&manNumSMSMonth=" + encodeURI( document.getElementById("manNumSMSMonth").value )+"&manNumSMSWeek=" + encodeURI( document.getElementById("manNumSMSWeek").value )+"&manNumSMSWeekClient=" + encodeURI( document.getElementById("manNumSMSWeekClient").value );

			//var sel = document.getElementById("tipoUsuario");

			//--------------------------------------

			var lists = document.getElementsByTagName("input");

				for (var i = 0; i < lists.length; i++) {

					objectName  = lists[i].id;

					objectValue = lists[i].value;

						if(lists[i].checked){

							variables = variables + objectName +"=" + objectValue + "&";

						}else{

							if(document.getElementById(objectName).type == "text" || document.getElementById(objectName).type == "hidden" || document.getElementById(objectName).type == "password"){

								variables = variables + objectName +"=" + objectValue + "&";

							}

							

						}

				}

			//--------------------------------------

			//poststr = poststr + "tipoUsuario="+sel.options[sel.selectedIndex].value;

			poststr = poststr + "&do=1&"+variables;

			//----------------------------------

			//alert(poststr);

			//return false

			url = "srv_doNewUser.php?"+poststr;

			nombreObjeto = "contenidos";

			getData(url, nombreObjeto);

		}

	}

/*---------------------------------------------------------------------*/

/*--------------------- DESCARGAS -------------------------------------*/

//--------------------------------------------------------------------		

function getReporteXLS(){

		var url = document.getElementById("currentQuery").value;

		url =  url.replace("srv_getReportResults.php?", "");

		url = "services/srv_xls_reporte.php?"+url; //

		nombreObjeto = "contenido";

		window.open(url, 'excel');	

	}

    

//-----------------------------------------------------------------------------------------

function getReporteTXT(){

		var url = document.getElementById("currentQuery").value;

		url =  url.replace("srv_getReportResults.php?", "");

		url = "services/srv_txt_reporte.php?"+url; //

		nombreObjeto = "contenido";

		window.open(url, 'excel');

	}



//-----------------------------------------------------------------------------------------

function checkedOnOne(nombreObjeto){

		document.getElementById(nombreObjeto).checked=1;	

	}



//-----------------------------------------------------------------------------------------

function checkOffAll(){

	   for (i=0;i<document.newUserForm.elements.length;i++)

      	if(document.newUserForm.elements[i].type == "checkbox")

         	document.newUserForm.elements[i].checked=0 

	}

    

//-----------------------------------------------------------------------------------------

function checkOnAll(){

	   for (i=0;i<document.newUserForm.elements.length;i++)

      	if(document.newUserForm.elements[i].type == "checkbox"){

         	document.newUserForm.elements[i].checked=1;

		}

	}

    

//-----------------------------------------------------------------------------------------

function SelectDefaultUserPermissions(valor){
	debugger;
		switch (valor){

			case '1': //valores para  administrador

				checkOnAll();

				break;

			case '2'://valores para usuario

				var objNameArr = new Array('0','2','4','5');

				var vueltas = objNameArr.length;

				for (var i = 0; i < vueltas; i++){

					if(document.getElementById("permisos["+objNameArr[i]+"]")){

						document.getElementById("permisos["+objNameArr[i]+"]").checked=1;

					}

				}

				break

			case '3'://valores para gerencia

				document.getElementById("permisos[2]").checked=1;

				break;

			default:

				checkOffAll();

		}

	}

//-----------------------------------------------------------------------------------------	

function getTutorial(objectName, capitulo){

	url = "srv_getTutorial.php?idTema="+capitulo; //

	nombreObjeto = "explicacion";

	getData(url, nombreObjeto);

	var objNameArr = new Array(7);

	//-------------------------------

	objNameArr[0]  = "link_tema_1";

	objNameArr[1]  = "link_tema_2";

	objNameArr[2]  = "link_tema_3";

	objNameArr[3]  = "link_tema_4";

   //-------------------------------

	var obj1;

	var vueltas = objNameArr.length;

		for (var i = 0; i < vueltas; i++){

			if(document.getElementById(objNameArr[i])){

				obj1 = document.getElementById(objNameArr[i]).className = "btn_operacion";

			}

		}

		var obj2 = document.getElementById(objectName).className = "btn_operacion_current";

		var obj2 = document.getElementById("contenidos").style.height = "auto";

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

<?php



$_SESSION['access'] = false;

}

?>
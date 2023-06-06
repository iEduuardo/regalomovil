//-----------------------------------------------

//-----------------------------------------------

// FUNCIONES PARA TODOS LOS FORMULARIOS DE LOGIN

//-----------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------

function checkMinLogin(){

	var valido = true;

	var errors = '';

	mensajes= new Object;

   	mensajes["username"]="- Nombre de usuario.\n";

	mensajes["clave"]="- Contrasena de usuario.\n";

	//--------------------------------------

	var args=checkMinLogin.arguments;

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

		var poststr = "username=" + encodeURI( document.getElementById("username").value ) +"&clave=" + encodeURI( document.getElementById("clave").value );

		makePOSTRequest("../services/srv_validation.php", poststr, 'loginForm');

		//----------------------------------

	}

}



//----------------------------------------------------------

//----------------------------------------------------------



	var http_request = false;

   function makePOSTRequest(url, parameters, objeto) {

      http_request = false;

      if (window.XMLHttpRequest) { // Mozilla, Safari,...

         http_request = new XMLHttpRequest();

         if (http_request.overrideMimeType) {

         	// set type accordingly to anticipated content type

            //http_request.overrideMimeType('text/xml');

            http_request.overrideMimeType('text/html');

         }

      } else if (window.ActiveXObject) { // IE

         try {

            http_request = new ActiveXObject("Msxml2.XMLHTTP");

         } catch (e) {

            try {

               http_request = new ActiveXObject("Microsoft.XMLHTTP");

            } catch (e) {}

         }

      }

      if (!http_request) {

         alert('Cannot create XMLHTTP instance');

         return false;

      }

      

      http_request.onreadystatechange = alertContents;

      http_request.open('POST', url, true);

      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      // http_request.setRequestHeader("Content-Length", parameters.length);

      // http_request.setRequestHeader("Connection", "Keep-Alive");

      http_request.send(parameters);

   }

   

//----------------------------------------------------------

//----------------------------------------------------------



   function alertContents() {
debugger;
      if (http_request.readyState == 4) {

         if (http_request.status == 200) {

            //alert(http_request.responseText.trim());

            result = http_request.responseText.trim();

			if(result!="1"){

            	document.getElementById('loginForm').innerHTML = result;

			}else{

				window.location= "index.php";	

			}

         } else {

            alert('There was a problem with the request.');

         }

      }

	  

   }

   


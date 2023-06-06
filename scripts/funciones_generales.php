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

			document.getElementById(nombreObjeto).innerHTML = '<div style="display:block; height:20px; border:0px;" class="banner_loading" align="center"><img src="../images/loading.png"></div>';

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

//var alpha = /[a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ ]/g;



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



<?php



$_SESSION['access'] = false;

}

?>
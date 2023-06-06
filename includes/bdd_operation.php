<?php
define("MD5_PREFIX","This_Is_My_regalomovil_String_For_The_MD5_Hash_Algorithm");
define("_PREPOS","mvl_");

function conexion(){
		$DBname = '566276_smssender';
		mysql_connect('dbsregalosmovil.mysql.database.azure.com:3306','SqlAdminRegalos@dbsregalosmovil','uKTS9RGcpFjp$') or die("No pude conectarme a MySQL" . mysql_error());
		mysql_select_db($DBname) or die("Base de datos $DBname no se encuentra disponible");
		mysql_query ("SET NAMES 'utf8'");
}

#-----------------------------------------------------------------
## REGRESA RECORDSET ##
#-----------------------------------------------------------------
function getRecordSet($sql){
	conexion();
	$QUERY = mysql_query($sql) or die('1.' .$sql. "  - " . mysql_error());
	/* O J O*/
	mysql_close();
	return $QUERY;
	
}
#-----------------------------------------------------------------
## EJECUTA QUERY  REGRESA ID##
#-----------------------------------------------------------------
function executeQuery($sql){
	conexion();
	$QUERY = mysql_query($sql) or die('MySql Error: ' .$sql. "  - " . mysql_error());
	$IDQUERY = mysql_insert_id();
	mysql_close();
	return $IDQUERY ;
}
#-----------------------------------------------------------------
## EJECUTA QUERY REGRESA TRUE FALSE##
#-----------------------------------------------------------------
function executeQueryNoId($sql){
	conexion();
	$QUERY = mysql_query($sql) or die('MySql Error: ' .$sql. "  - " . mysql_error());
	mysql_close();
	return $QUERY ;
}
#-----------------------------------------------------------------
## EJECUTA QUERY REGRESA EL NUMERO DE ROWS AFECTADAS##
#-----------------------------------------------------------------
function executeQueryNumRows($sql){
	conexion();
	$QUERY = mysql_query($sql) or die('MySql Error: ' .$sql. "  - " . mysql_error());
	$_numRows = mysql_affected_rows();
	mysql_close();
	return $_numRows;
}
#-----------------------------------------------------------------
## EJECUTA QUERY REGRESA EL NUMERO DE ROWS AFECTADAS##
#-----------------------------------------------------------------
function executeQueryRowNum($sql){
	conexion();
	$QUERY = mysql_query($sql) or die('MySql Error: ' .$sql. "  - " . mysql_error());
	$_numRows = mysql_num_rows($QUERY);
	mysql_close();
	return $_numRows;
}
#-----------------------------------------------------------------
## DESCONECTA A BDD ##
#-----------------------------------------------------------------
function desconexion(){
	mysql_close($ID_CONEXION);
}
?>
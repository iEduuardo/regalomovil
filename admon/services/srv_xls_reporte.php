<?php require ('../../includes/function.php'); ?>

<?php  noCache();?>

<?php

	$sql = "";

	$_sql_base = "SELECT * FROM mvl_transaction_log ";

	//20-OCT-10

	//-----------------------------

	if($_GET['fecha'] && $_GET['fecha']!= ''){

		$sql_where = " (dt_fecha >= '".date('Y-m-d',strtotime($_GET['fecha']))."') ";// AND ROWNUM < ".$_paginacion;
		
		if($_GET['fecha_final'] && $_GET['fecha_final']!= ''){

			$_nextDay = date('Y-m-d', strtotime($_GET['fecha_final'])) ;

			$sql_where .= " AND (dt_fecha <= '".$_nextDay."') ";

		}else{

			$_nextDay = date('Y-m-d', strtotime('+1 day', strtotime($_GET['fecha']))) ;

			$sql_where .= " AND (dt_fecha < '".$_nextDay."') ";

		}

		//echo "<br>--> ".$_GET['fecha']. " -- " .$_GET['fecha_final']. " - " .$_nextDay . "<br>";

	}else{

		$sql_where = " (dt_fecha > '".date('Y-m-d')."') "; //AND ROWNUM < ".$_paginacion; //20-OCT-10

	}





	//-----------------------------

	if($_GET['ordenado'] && $_GET['ordenado']!= ''){

		$sql_where .= " ORDER BY ".$_GET['ordenado'];	

	}else{

		$sql_where .= " ORDER BY dt_fecha";	

	}

	/*----------------------------*/

	//$db = conexion();

	/*----------------------------*/

		if( strlen($sql_where) >5){

				$sql = $_sql_base. " WHERE " .$sql_where;

		}else{

				$sql  = $_sql_base;

		}

	//--------------------------------------------------------------

	$_file = getInicidenciasXLS($sql);

	if($_file){

	//die($_file);

	//--------------------------------------------------------------

					header("Content-Type: application/force-download");

					header("Content-Type: application/octet-stream");

					header("Content-Type: application/download");

					header("Content-Description: File Transfer");

					header("location:../".$_file);

	/*

					header("Content-Disposition: attachment; filename=" . urlencode("../".$_file));    

					header("Content-Type: application/force-download");

					header("Content-Type: application/octet-stream");

					header("Content-Type: application/download");

					header("Content-Description: File Transfer");             

					header("Content-Length: " . filesize("../".$_file));

					flush(); // this doesn't really matter.

					$fp = fopen("../".$_file, "r");

					if($fp){

						while (!feof($fp))

						{

							echo fread($fp, 65536); 

							flush(); // this is essential for large downloads

						}

					}

					fclose($fp);

					*/

	}else{

		die("problemas abriendo el archivo: ".$_file);

	}

	//--------------------------------------------------------------

?>
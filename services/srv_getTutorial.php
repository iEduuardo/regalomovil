<?php

if ($_GET['idTema'] && $_GET['idTema'] != ""){
		$_idTema = $_GET['idTema'];
		switch($_idTema){
				case "1":
						include("manual/introduccion.php");
					break;
				case "2":
						include("manual/consulta.php");
					break;
				case "3":
						include("manual/redencion.php");
					break;
				case "4":
						include("manual/impresion.php");
					break;
				default:
					$_respuesta = " Error - " ; //.$_comando;
		}
	}
?>


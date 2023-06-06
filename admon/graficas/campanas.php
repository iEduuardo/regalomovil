<?php require ('libchart/libchart/classes/libchart.php'); ?>
<?php header('Content-type: image/jpeg');	 ?>
<?php
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);
	//-------------------------------------------------------
		
		$_TIPOGRAFICA = $_GET['tipo'];
		$_arreglo = null;
		// PROCESO DE OBTENCIÓN DE INFORMACIÓN
		//-----------------------
		$DBname = '566276_smssender';
			$enlace = mysqli_connect("dbsregalosmovil.mysql.database.azure.com", "SqlAdminRegalos@dbsregalosmovil", "uKTS9RGcpFjp$", $DBname);
			if (!$enlace) {
				echo "Error: No se pudo conectar a MySQL.". PHP_EOL;
				echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
				echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			/*mysqli_close($enlace);*/
			
			if ($enlace->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		//-----------------------
		switch ($_TIPOGRAFICA){
			case '1':
				/*ventas diarias*/
				$_titulo = "Número de redenciones diarias";
				$_sql = "SELECT dt_fecha, count( dt_fecha ) AS datos FROM mvl_transaction_log WHERE int_operacion = 2 GROUP BY dt_fecha";	
				break;
			case '2':
				/*ventas del mes de cierto merchants*/
				$_titulo = "Número de Consultas diarias";
				$_sql = "SELECT dt_fecha, count( dt_fecha ) AS datos FROM mvl_transaction_log WHERE int_operacion = 3 GROUP BY dt_fecha";		
				break;
			case '3':
				/*ventas del mes de todos los merchants*/
				$_titulo = "Monto de venta-redención diarias";
				$_sql = "SELECT dt_fecha, SUM(str_monto) AS datos FROM mvl_transaction_log WHERE int_operacion = 2 GROUP BY dt_fecha";		
				break;
			default:
				/*ventas diarias*/
				$_titulo = "Número de redenciones diarias";
				$_sql = "SELECT count( dt_fecha )  AS datos, dt_fecha FROM mvl_transaction_log WHERE int_operacion = 4 GROUP BY dt_fecha";
				break;
		}
		$_arreglo = mysqli_query($enlace, $_sql);
		//-------------------------------------	
		if($_arreglo){
			
			$chart = new VerticalBarChart();
			$dataSet = new XYDataSet();	
			
			while ($_renglon = mysqli_fetch_row($_arreglo)){
				$dataSet->addPoint(new Point($_renglon[0], $_renglon[1]));
			}
			
			$chart->setDataSet($dataSet);
			$chart->getPlot()->setGraphCaptionRatio(0.65);

			$chart->setTitle($_titulo);
			$chart->render();
		}
?>

<?php require ('libchart/libchart/classes/libchart.php'); ?>
<?php header('Content-type: image/jpeg');	 ?>
<?php
	//include "../libchart/classes/libchart.php";

$chart = new VerticalBarChart();

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("YT", 64));
	$serie1->addPoint(new Point("NT", 63));
	$serie1->addPoint(new Point("BC", 58));
	$serie1->addPoint(new Point("AB", 58));
	$serie1->addPoint(new Point("SK", 46));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("YT", 61));
	$serie2->addPoint(new Point("NT", 60));
	$serie2->addPoint(new Point("BC", 56));
	$serie2->addPoint(new Point("AB", 57));
	$serie2->addPoint(new Point("SK", 52));
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("1990", $serie1);
	$dataSet->addSerie("1995", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);

	$chart->setTitle("Average family income (k$)");
	$chart->render();


?> 

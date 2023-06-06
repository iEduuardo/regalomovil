<?php

session_start();

	$_SESSION['access'] = true;

	$access = true;

	

	$_SESSION['access2'] = true;

	$access2 = true;



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<META http-equiv="Pragma" content="no-cache">

<?php include("includes/metas.php"); ?>

<script src="scripts/jquery-1.4.2.js" language="javascript"></script>

<link href="estilos/general.css" rel="stylesheet" type="text/css" />

<link href="estilos/menubar.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="container">

  <div id="header">

    <?php include("includes/header.php"); ?>

  </div>

  <div id="mainContent">

    <div id="contenidos">

    <h2 class="tituloGris" align="center"> <br />Ingreso ilegal, página inexistente. </h2>

    </div>

  </div>

  <div id="footer">

    <?php include("includes/footer.php"); ?>

  </div>

</div>

<script language="javascript">

$(document).ready(function() {

	MM_preloadImages('images/arrows_forward_on.png','images/loading.png');				   

});

</script>

</body>

</html>
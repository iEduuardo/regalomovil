<?php require ('../includes/function.php'); ?>
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
<?php include("../includes/metas.php"); ?>
<script src="scripts/funciones.js" language="javascript" type="application/javascript"></script>
<script src="../scripts/funciones.js" language="javascript" type="application/javascript"></script>
<script src="../scripts/funciones_login.js" language="javascript"></script>
<link href="../estilos/general.css" rel="stylesheet" type="text/css" />
<link href="estilos/general.css" rel="stylesheet" type="text/css" />

</head>

<body onkeydown="if(event.keyCode=='13'){checkMinLogin(null,'username','clave');}">
<div id="container">
      <div id="header">
        <?php include("../includes/header.php"); ?>
      </div>
      <div id="mainContent">
        <?php
			vaciaVariablesSession();
		?>
        <?php include("../includes/loginForm.php"); ?>
     </div>
      <div id="footer">
      	<?php include("../includes/footer.php"); ?>
      </div>
</div>
</body>
</html>


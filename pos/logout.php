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
<script src="../scripts/funciones.js" language="javascript" type="application/javascript"></script>
<script src="../scripts/funciones_login.js" language="javascript"></script>
<script src="../scripts/jquery-1.4.2.js" language="javascript"></script>
<!-- include Cycle plugin -->
<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.2.74.js"></script>


<link href="../estilos/general.css" rel="stylesheet" type="text/css" />

</head>

<body>
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
<script language="javascript">
$(document).ready(function() {
 $('#banner').cycle({ 
    fx:    'fade', 
    speed:  5500 
 });
});



</script>
</body>
</html>


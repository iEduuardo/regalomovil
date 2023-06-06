<?php require ('../includes/function.php'); ?>
<?php  noCache();?>
<?php
if ($_GET['id'] && $_GET['id'] != "") {
	$_idMerchant = $_GET['id'];
	echo getListaSucursales($_idMerchant);

}
?>
<?php require ('../includes/function.php'); ?>
<?php  noCache();?>
<?php
if ($_GET['ids'] && $_GET['ids'] != "") {
	$_id_merchant = $_GET['idm'];
	$_id_sucursal = $_GET['ids'];
	echo getListaPDVs($_id_merchant, $_id_sucursal);
}
?>
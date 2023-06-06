<?php require ('../../includes/function.php'); ?>
<?php  noCache();?>
<?php 
if(($_GET['numero_tarjeta'] && $_GET['numero_tarjeta'] != "") && ($_GET['comando'] && $_GET['comando'] != "")){
	if($_GET['monto_tarjeta'] && $_GET['monto_tarjeta'] != ""){
		$_monto = $_GET['monto_tarjeta'];
	}else{
		$_monto = 0;
	}
	if($_GET['numero_vendedor'] && $_GET['numero_vendedor'] != ""){
		$_id_vendedor = $_GET['numero_vendedor'];
	}else{
		$_id_vendedor = 0;
	}
	if($_GET['numero_pedido'] && $_GET['numero_pedido'] != ""){
		$_id_pedido = $_GET['numero_pedido'];
	}else{
		$_id_pedido = 0;
	}
	$_html = sendTransaction($_GET['comando'], $_GET['numero_tarjeta'], $_monto, $_id_vendedor, $_id_pedido);
	echo $_html;
}

?>
<?php
if (!isset($_SESSION)) {
					session_start();
		}
$_tipoUsuario = $_SESSION['MM_UserGroup'];
$_idUsuario   = $_SESSION['MM_UserID'];

?>
<div id="menu">
	<ul class="menu red">
		<li><a id="link_inicial" href="index.php" class="current">Inicial</a></li>
        <?php if(havePermission($_idUsuario, 3)){ ?>
		<li><a id="link_consultas" href="javascript:getConsulta(3);">Consultas</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 5)){ ?>
        <li><a id="link_reportes" href="javascript:getReportes();">Reportes</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 6)){ ?>
        <li><a id="link_usuarios" href="javascript:getListadoUsuario(1);">Usuarios</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 9)){ ?>
        <li><a id="link_merchants" href="javascript:getListadoMerchants(1);">Comercios</a></li>
        <?php } ?>
        <li><a id="link_datos" href="javascript:getMiData();">Mis datos</a></li>
        <li><a id="link_logout" href="logout.php">Salir</a></li>
	</ul>
</div>
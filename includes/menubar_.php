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
        <?php if(havePermission($_idUsuario, 1)){ ?>
		<li><a id="link_activaciones" href="javascript:getActivation(1);">Activaciones</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 2)){ ?>
        <li><a id="link_desactivaciones" href="javascript:getDeactivation(2);">Desactivaciones</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 3)){ ?>
		<li><a id="link_consultas" href="javascript:getConsulta(3);">Consultas</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 4)){ ?>
        <li><a id="link_redencion"  href="javascript:getRedencion(4);">Redenci&oacute;n</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 5)){ ?>
        <li><a id="link_reportes" href="javascript:getReportes();">Reportes</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 6)){ ?>
        <li><a id="link_usuarios" href="javascript:getListadoUsuario(1);">Usuarios</a></li>
        <?php } ?>
        <?php if(havePermission($_idUsuario, 8)){ ?>
        <li><a id="link_merchants" href="javascript:getListadoSucursales(1);">Sucursales</a></li>
        <?php } ?>
        <li><a id="link_datos" href="javascript:getMiData();">Mis datos</a></li>
        <li><a id="link_logout" href="logout.php">Salir</a></li>
	</ul>
</div>
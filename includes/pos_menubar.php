<?php

if (!isset($_SESSION)) {

					session_start();

		}

$_tipoUsuario = $_SESSION['MM_UserGroup'];

$_idUsuario   = $_SESSION['MM_UserID'];



?>

<div id="menu">

	<ul class="menu red">

        <?php if(havePermission($_idUsuario, 5)){ ?>
        <li><a id="link_reportes" href="javascript:getReportes();">Reportes</a></li>
		<?php } ?>
        <li><a id="link_datos" href="javascript:getMiData();">Mis datos</a></li>

        <li><a id="link_logout" href="logout.php">Salir</a></li>

	</ul>

</div>
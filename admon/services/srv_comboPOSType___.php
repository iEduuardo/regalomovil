<?php require ('../../includes/function.php'); ?>
<?php  noCache();?>
<?php
if ($_GET['do']) {
	echo getComboTypoPDVs();
}
?>
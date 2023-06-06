<?php require ('../includes/function.php'); ?>

<?php

//-----------------------------------------------------------

//-----------------------------------------------------------

function generatePassword ($length = 6)

{

  // start with a blank password

  $password = "";

  // define possible characters

  $possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 

  // set up a counter

  $i = 0; 

  // add random characters to $password until $length is reached

  while ($i < $length) { 

    // pick a random character from the possible ones

    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);        

    // we don't want this character if it's already in the password

    if (!strstr($password, $char)) { 

      $password .= $char;

      $i++;

    }

  }

  return $password;

}







	$sql   = "SELECT * FROM "._PREPOS."tbl_usuarios WHERE id_usuario >= 19";

	$_script_base = "UPDATE "._PREPOS."tbl_usuarios SET str_password = md5('{CLAVE}') WHERE id_usuario = {IDUSUARIO}";

	$RSCpn = getRecordSet($sql);

		if($RSCpn){

			while ($datosCampaingUsers = mysql_fetch_row($RSCpn)){

					//echo $datosCampaingUsers[0]."<br>";

					$_sql = str_replace("{IDUSUARIO}",$datosCampaingUsers[0],$_script_base );

					$_clave = generatePassword();

					$_sql = str_replace("{CLAVE}",$_clave ,$_sql );

					echo $_sql."\t \t  ".$_clave." \n";

			}	

		}

 ?>
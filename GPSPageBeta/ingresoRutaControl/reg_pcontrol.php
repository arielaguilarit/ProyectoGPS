<?php
session_start();
if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "../index.htm" ;
        </script>';
}

require("../conexiones/connect_db.php");
// verificamos si se han enviado ya las variables necesarias.
if (isset($_POST["ruta"])) {
	$ruta = $_POST['ruta'];
	$nombre = ucfirst($_POST["nom_control"]);
	$lat = $_POST['latitud'];
	$lng = $_POST['longitud'];
	$min = $_POST["minutos"];

	// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
	$checkcontrol = mysql_query("SELECT nom_control, ruta_id FROM control WHERE nom_control='$nombre' and ruta_id='$ruta'");
	$control_exist = mysql_num_rows($checkcontrol);

	if ($control_exist > 0){

		echo '<script language="javascript">alert("El nombre de control estan ya en uso");</script>';
		echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';

	}else{
		@mysql_query("INSERT INTO control (nom_control, lat_control, lng_control, min_control, ruta_id) VALUES ('$nombre','$lat','$lng','$min','$ruta')")or die ("problema con query porque :".mysql_error());
		mysql_close($link);
		echo '<script language="javascript">alert("El control '.$nombre.' ha sido registrado de manera satisfactoria.");</script>';
		echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresocontrol.php";</SCRIPT>';
	}
}else{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
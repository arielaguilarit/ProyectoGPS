<?php 
session_start();
if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "../index.htm" ;
        </script>';
}

//datos para establecer la conexion con la base de mysql.
require("../conexiones/connect_db.php");

// verificamos si se han enviado ya las variables necesarias.
if (isset($_POST["imei"])) {
	$imei = $_POST["imei"];
	$nom_dispo = ucfirst($_POST['nom_dispositivo']);
	$chip = ucfirst($_POST["chip"]);
   // $estado = $_POST['estado'];


	// Hay campos en blanco
	if($imei==NULL|$nom_dispo==NULL|$chip==NULL) {
			echo '<script language="javascript">alert("Un campo esta vacio");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		
	}else{
		// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
		$checkimei = mysql_query("SELECT imei FROM dispositivo WHERE imei='$imei'");
		$imei_exist = mysql_num_rows($checkimei);
		//Existe 1 y si no existe 0
		if ($imei_exist > 0) {
			echo '<script language="javascript">alert("El dispositivo ya esta en uso");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';

		}else{
			@mysql_query("INSERT INTO dispositivo VALUES ('$imei','$nom_dispo','$chip','2')");
			echo '<script language="javascript">alert("El dispositivo ha sido registrado de manera satisfactoria.");</script>';
			echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresodispositivo.php";</SCRIPT>';
			mysql_close($link);
		}
	}
}else{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
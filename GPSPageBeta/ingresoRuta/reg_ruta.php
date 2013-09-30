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
if (isset($_POST["nombreruta"]))
{
	$nombre = ucfirst($_POST["nombreruta"]);
    $ciudad = ucfirst($_POST['ciudadruta']);
    $empre =  ucfirst($_POST['empre']);
    
	// Hay campos en blanco
	if($nombre==NULL|$ciudad==NULL|$empre==NULL) {
			echo '<script language="javascript">alert("Un campo esta vacio");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
	}
        else
        {
		// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
		$check_control = mysql_query("SELECT nombre_ruta FROM ruta WHERE nombre_ruta='$nombre'");
		$control_exist = mysql_num_rows($check_control);
			//Existe 1 y si no existe 0
			if ($control_exist > 0) 
	        {
				echo '<script language="javascript">alert("Ya se encuentra una ruta definida con ese nombre");</script>';
				echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';

			}
	        else
	        {
				@mysql_query("INSERT INTO ruta (nombre_ruta, ciudad, id_empresa) VALUES ('$nombre','$ciudad','$empre')") or die("Error :". mysql_error());
				echo '<script language="javascript">alert("La ruta ha sido ingresado correctamente");</script>';
        		echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresoruta.php";</SCRIPT>';

				mysql_close($link);
			}
		}
}else{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
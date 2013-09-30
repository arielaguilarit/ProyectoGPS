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
if (isset($_POST["patente"])) {
	$patente = $_POST["patente"];
	$id = $_POST['id_unico'];
	$chofer = ucfirst($_POST["chofer"]);
	$rut_emp = ucfirst($_POST["nom_empre"]);
	$nom_emp = ucfirst($_POST["rut_empre"]);
    $tipo = ucfirst($_POST['tipo_vehiculo']);
    $marca = ucfirst($_POST['marca_vehiculo']);
    $empresa = $_POST['empresa'];
    $imei = $_POST['imei_disp'];


	// Hay campos en blanco
	if($patente==NULL|$id==NULL|$chofer==NULL|$rut_emp==NULL|$nom_emp==NULL|$tipo==NULL|$marca==NULL|$imei==NULL|$empresa==NULL) {
		echo '<script language="javascript">alert("Un campo esta vacio");</script>';
		echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		
	}else{
		// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
		$check_patente = mysql_query("SELECT patente FROM vehiculo WHERE patente='$patente'");
		$patente_exist = mysql_num_rows($check_patente);
		//Existe 1 y si no existe 0
		if ($patente_exist > 0) {
			echo '<script language="javascript">alert("El Vehiculo ya esta en uso por otro Cliente");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		}else{
			$ing_auto = @mysql_query("INSERT INTO vehiculo (patente, id_unico, chofer, rut_empresario, nombre_empresario, tipo_vehiculo, marca_vehiculo, id_empresa) VALUES ('$patente','$id','$chofer','$rut_emp','$nom_emp','$tipo','$marca','$empresa')") or die ("problema con query porque :".mysql_error());
			if($ing_auto){
				@mysql_query("INSERT INTO asociado VALUES ('$patente','$imei',now())");
				@mysql_query("UPDATE dispositivo set est_disp='1' where imei='$imei'");
				echo '<script language="javascript">alert("El Vehiculo ha sido registrado de manera satisfactoria.");</script>';
				echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresovehiculo.php";</SCRIPT>';
			}
			mysql_close($link);
		}
	}
}else{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
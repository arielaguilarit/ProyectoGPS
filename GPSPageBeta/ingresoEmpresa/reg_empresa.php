<?php
session_start();

if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "../index.htm" ;
        </script>';
}
include('../scripts/verificarRut.php');
//datos para establecer la conexion con la base de mysql.
require("../conexiones/connect_db.php");
// verificamos si se han enviado ya las variables necesarias.
if (isset($_POST["rut"]) && validaRut($_POST["rut"]) == true) {
	$user = $_POST["rut"];
	$user = str_replace('-','',$user);//Limpia el rut del guion
	$user =str_replace('.','',$user);//Limpia el rut de puntos
	$nombre = ucfirst($_POST['nombre']);
	$dir = ucfirst($_POST['direccion']);
	$ciudad = ucfirst($_POST['ciudad']);
	$fono = $_POST['telefono'];
	$email = $_POST['email'];
	$atraso = $_POST['atraso'];
	$adelanto = $_POST['adelanto'];

	// Hay campos en blanco
	if($user==NULL|$nombre==NULL|$dir==NULL|$ciudad==NULL|$fono==NULL|$email==NULL|$atraso==NULL|$adelanto==NULL) {
		echo '<script language="javascript">alert("Un campo esta vacio");</script>';
		//echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
	}else{
		$checkuser = mysql_query("SELECT rut_empresa FROM empresa WHERE rut_empresa='$user'");
		$user_exist = mysql_num_rows($checkuser);
		if ($user_exist > 0){
			echo '<script language="javascript">alert("El nombre de usuario ya esta en uso. Por favor ingrese un nuevo usuario.");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		}else{
			@mysql_query("INSERT INTO empresa VALUES ('$user','$nombre','$dir','$ciudad','$telefono','$email','$atraso','$adelanto')");
			
			//echo '<script language="javascript">alert("El usuario '.$user.' ha sido registrado de manera satisfactoria.");</script>';
			//echo '<SCRIPT LANGUAGE="javascript">location.href = "ingreso_empresa.php";</SCRIPT>';
			echo '<script language="javascript">alert("El turno ha sido ingresado correctamente.");</script>';
            echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresorecorrido.php";</SCRIPT>';
			mysql_close($link);
		}
	}
}else{
	echo '<script language="javascript">alert("El Rut del Usuario'.$_POST["rut"].' no es Valido.\nIngrese los datos de manera correcta");</script>';
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}


?>
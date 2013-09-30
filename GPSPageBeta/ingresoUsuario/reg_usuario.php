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
if (isset($_POST["rut"]) && validaRut($_POST["rut"]) == true) 
{
	$user = $_POST["rut"];
	$user = str_replace('-','',$user);//Limpia el rut del guion
	$user =str_replace('.','',$user);//Limpia el rut de puntos
	$pass = $_POST["clave"];
	$nombre = ucfirst($_POST['nombre']);
	$dir = ucfirst($_POST['direccion']);
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$priv= $_POST['priv'];
	$est= $_POST['estad'];
    $empresa=$_POST['empre'];

	// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
	$checkuser = mysql_query("SELECT rut_usuario FROM usuario WHERE rut_usuario='$user'");
	$user_exist = mysql_num_rows($checkuser);
	if ($user_exist > 0)
	{
		echo '<script language="javascript">alert("El nombre de Usuario ya esta en uso");</script>';
		echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
	}else{
        @mysql_query("INSERT INTO usuario VALUES ('$user','$pass','$nombre','$dir','$telefono','$email','$priv','$est','$empresa')");
        mysql_close($link);
        echo '<script language="javascript">alert("El Usuario '.$user.' ha sido registrado de manera satisfactoria.");</script>';
        echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresousuario.php";</SCRIPT>';
    }
}else{
	echo '<script language="javascript">alert("El Rut del Usuario '.$_POST["rut"].' no es Valido.\nIngrese los datos de manera correcta");</script>';
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}


?>
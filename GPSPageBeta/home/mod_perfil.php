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
if (isset($_POST["passNuevo"])) 
{
    $user=$_SESSION["rut"];
	$actual = $_POST["passActual"];
	$nueva= $_POST["passNuevo"];
    $rep= $_POST["passRep"];
	// ¿Coinciden las contraseñas?
	if($nueva!=$rep){
		echo '<script language="javascript">alert("Error :\nLas contraseñas no coinciden");</script>';
		echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
	}else{
		// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
        $checkuser = mysql_query("SELECT rut_usuario FROM usuario WHERE rut_usuario='$user' and pass_usuario='$actual'")or die("Error: ".  mysql_error());
		$user_exist = mysql_num_rows($checkuser);
		if ($user_exist>0){
            @mysql_query("UPDATE usuario SET pass_usuario ='$nueva' WHERE rut_usuario='$user'")or die("Error: ".  mysql_error());
            mysql_close($link);
            echo '<script language="javascript">alert("Ha actualizado satisfactoriamente la contrasena");</script>';
            echo '<SCRIPT LANGUAGE="javascript">location.href = "cambioContrasena.php";</SCRIPT>';
		}else{
            echo '<script language="javascript">alert("El nombre de usuario o la cuenta de correo estan ya en uso");</script>';
            echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
        }
    }
}else{
    echo '<script language="javascript">alert("Error:\nVerifique los campos");</script>';
    echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
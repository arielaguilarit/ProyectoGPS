<?php
session_start();
//datos para establecer la conexion con la base de mysql.
require_once('../conexiones/connect_db.php');
include('verificarRut.php');

function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");
	$mensaje = str_replace($nopermitidos, "", $mensaje);
	return $mensaje;
}
   
if(validaRut($_POST["usuario"]) == true && trim($_POST["password"]) != "")
{
/* Puedes utilizar la funcion para eliminar algun caracter en especifico
$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
$password = $HTTP_POST_VARS["password"];
o puedes convertir los a su entidad HTML aplicable con htmlentities */
	$usuario = strtolower(htmlentities($_POST["usuario"], ENT_QUOTES));
	$usuario = str_replace('-','',$usuario);
	$usuario =str_replace('.','',$usuario);
	$password = $_POST["password"];
	$result = mysql_query('SELECT pass_usuario,rut_usuario, nombre_usuario,rut_empresa,privilegio FROM usuario WHERE rut_usuario=\''.$usuario.'\'');
	if($row = mysql_fetch_array($result)){
		if($row["pass_usuario"] == $password){
			$_SESSION["rut"] = $row['rut_usuario'];
            $_SESSION["empresa"] = $row['rut_empresa'];
            $_SESSION["privilegio"] = $row['privilegio'];
            $_SESSION["nombre"] = $row["nombre_usuario"];
            echo '<SCRIPT LANGUAGE="javascript">location.href = "../home/home.php";</SCRIPT>';
			/*if($row['privilegio']!="3"){
                echo '<SCRIPT LANGUAGE="javascript">location.href = "../home/home.php";</SCRIPT>';
 			}
 			else{
                echo '<SCRIPT LANGUAGE="javascript">location.href = "../Trayecto/portada.php"; </SCRIPT>';
            }*/
		}else{
			echo '<script language="javascript">alert("Password incorrecto");</script>';
			echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		}
	}else{
		echo '<script language="javascript">alert("Usuario no existente");</script>';
		echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
	}
	mysql_free_result($result);
}else{
	echo '<script language="javascript">alert("Rut Invalidado. Verifique sus datos nuevamente");</script>';
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
mysql_close();
?>
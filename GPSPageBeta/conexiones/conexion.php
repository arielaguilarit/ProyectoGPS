<?php
$bd_host = "localhost"; 
$bd_usuario = "root"; 
$bd_password = ""; 
$bd_base = "servidorv5"; 
$cn = mysql_connect($bd_host, $bd_usuario, $bd_password) or die("Error en Conexion"); 
$db = mysql_select_db($bd_base) or die("Error en Db");
return($cn);
return($db);
?>
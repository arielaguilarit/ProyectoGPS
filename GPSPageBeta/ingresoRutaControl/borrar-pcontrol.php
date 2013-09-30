<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/connect_db.php");

//var_dump($_POST['delete']);

//count($_POST['delete'])
if (isset($_POST["delete"]))
{
    $var = $_POST["delete"];
	foreach ($var as $dato){
		/*$sql="DELETE FROM clientes WHERE idPedido=$dato"; 
		$res = mysql_query($sql,$db);*/ 
		$sql="delete from control where id_control='$dato'";
		//echo "<br>".$sql; 
		$res = mysql_query($sql) or die (" Error de Delete");  
		echo '<script language="javascript">alert("Se han eliminado los puntos seleccionados");</script>';
		echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresocontrol.php";</SCRIPT>';
		mysql_close($link);
	} 
}
else
{
    echo '<script language="javascript">alert("Error:\nNo ha seleccionado Puntos de Control");</script>';
    echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresocontrol.php";</SCRIPT>';
}
//header("location:menu.php"); 
?>
<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/connect_db.php");


if (isset($_POST["delete"]))
{
    $var = $_POST["delete"];
	foreach ($var as $dato){
		$sql="delete from ruta where id_ruta='$dato'";
		$res = mysql_query($sql) or die (" Error de Delete");
		echo '<script language="javascript">alert("Se han eliminado las Rutas seleccionadas");</script>';
		echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresoruta.php";</SCRIPT>';
	} 
}
else
{
    echo '<script language="javascript">alert("Error:\nNo ha seleccionado Rutas");</script>';
    //echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresoruta.php";</SCRIPT>';
}
?>
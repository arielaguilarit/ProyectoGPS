<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/conexion.php");

//var_dump($_POST['delete']);
$var = $_POST["delete"];
//count($_POST['delete'])
if (isset($_POST["delete"])){
	foreach ($var as $dato){
		/*$sql="DELETE FROM clientes WHERE idPedido=$dato"; 
		$res = mysql_query($sql,$db);*/ 
		$sql="delete from empresa where rut_empresa='$dato'";
		//echo "<br>".$sql; 
		$res = mysql_query($sql,$cn) or die (" Error de Delete");  
		echo '<script language="javascript">alert("Se han eliminado las empresas seleccionadas");</script>';
		echo '<SCRIPT LANGUAGE="javascript">location.href = "ingreso_empresa.php";</SCRIPT>';
	} 
}else{
	echo ('No has seleccionado ningún registro...');
}
//header("location:menu.php"); 
?>
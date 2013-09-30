<?php
 
    require("../conexiones/connect_db.php");
 	
 	$rut=$_GET['id'];
    $consulta = "SELECT * from usuario WHERE rut_usuario = '$rut'";
   // echo '<SCRIPT LANGUAGE="javascript">alert("'.$_GET['id'].'");</SCRIPT>';
    $query = mysql_query($consulta)or die (mysql_error());
    echo '<option value="---">---</option>';
    while ($fila = mysql_fetch_array($query)) {
    		//echo '<SCRIPT LANGUAGE="javascript">alert("'.$fila['rut_usuario'].'");</SCRIPT>';
            echo '<option value="'.$fila['nombre_usuario'].'">'.$fila['rut_usuario'].'</option>';

    }
 	
?>
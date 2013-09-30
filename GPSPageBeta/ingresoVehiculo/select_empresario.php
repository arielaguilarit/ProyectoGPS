<?php
 
    require("../conexiones/connect_db.php");
 	
    $consulta = "SELECT * from usuario WHERE rut_empresa = ".$_GET['id'];
    $query = mysql_query($consulta);
    echo '<option value="---">---</option>';
    while ($fila = mysql_fetch_array($query)) {
        echo '<option value="'.$fila['rut_usuario'].'">'.$fila['nombre_usuario'].'</option>';
    };
 	
?>
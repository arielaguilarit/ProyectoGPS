<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/connect_db.php");


if (isset($_POST["delete"]))
{
    $var = $_POST["delete"];
   
    foreach ($var as $dato){
        $sql="delete from recorrido where patente_vehiculo='$dato'";
        $res = mysql_query($sql) or die (" Error de Delete");
        echo '<script language="javascript">alert("Se han eliminado los recorridos seleccionados");</script>';
        echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresorecorrido.php";</SCRIPT>';
    }
}
else
{
    echo '<script language="javascript">alert("Error:\nNo ha seleccionado Recorridos");</script>';
    //echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresorecorrido.php";</SCRIPT>';
}
?>
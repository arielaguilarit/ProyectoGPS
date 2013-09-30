<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/conexion.php");

$var = $_POST["delete"];
if (isset($_POST["delete"])){
    foreach ($var as $dato){
        $sql2="delete from asociado where imei_dispositivo='$dato'";
        $res = @mysql_query($sql2,$cn) or die ("Problema 1 en: ".mysql_error());

        $sql="delete from dispositivo where imei='$dato'";
        $res = @mysql_query($sql,$cn) or die ("Problema 2 en: ".mysql_error());
        echo '<script language="javascript">alert("Se han eliminado los dispositivos seleccionados");</script>';
        echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresodispositivo.php";</SCRIPT>';
        mysql_close($cn);
    }
}else{
    echo ('No has seleccionado ningún registro...');
}

?>

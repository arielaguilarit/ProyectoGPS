<?php
//Establece una conexión con la BD y lanza un mensaje de error en el caso de que ésta no se haya realizado con éxito.
require("../conexiones/conexion.php");
$var = $_POST["delete"];
if (isset($_POST["delete"]))
{
  foreach ($var as $dato)
  {
    $checkAso = @mysql_query("SELECT * FROM asociado WHERE patente_veh ='$dato'")or die ("problema Verifica asociado porque :".mysql_error());
    $aso_exist = @mysql_num_rows($checkAso);
    //Existe la relacion en asociado??
    if($aso_exist > 0)
    {
      @mysql_query("UPDATE dispositivo SET est_disp='2' WHERE imei = (SELECT imei_dispositivo FROM asociado WHERE patente_veh = '$dato')", $cn)or die ("problema Asociado con dispo :".mysql_error());
      @mysql_query("DELETE FROM asociado WHERE patente_veh ='$dato'", $cn)or die ("problema con Asociado con dispo 2 porque :".mysql_error());
      @mysql_query("DELETE FROM vehiculo WHERE patente='$dato'", $cn)or die (" Error vehiculo asociado porque ".mysql_error());
      echo '<script language="javascript">alert("Se han eliminado los Vehiculos seleccionados");</script>';
      echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresovehiculo.php";</SCRIPT>';
    }else{
      @mysql_query("DELETE FROM vehiculo WHERE patente='$dato'", $cn)or die (" Error vehiculo no asociado porque ".mysql_error());
      echo '<script language="javascript">alert("Se han eliminado los Vehiculos seleccionados");</script>';
      echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresovehiculo.php";</SCRIPT>';
    }
  }
  mysql_close($cn);
}else{
    echo ('No has seleccionado ningún registro...');
}
?>

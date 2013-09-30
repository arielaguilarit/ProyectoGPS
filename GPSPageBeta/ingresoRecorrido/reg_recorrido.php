<?php 
/*session_start();
if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "../index.htm" ;
        </script>';
}*/
//datos para establecer la conexion con la base de mysql.
require("../conexiones/connect_db.php");

// verificamos si se han enviado ya las variables necesarias.
if (isset($_POST["vehiculo"])) {
	$patente = $_POST["vehiculo"];
	$ruta = $_POST['ruta'];
	$hora = $_POST["hora"];
    $fecha = $_POST['fecha'];
    
	// Hay campos en blanco
	if($patente==NULL|$ruta==NULL|$hora==NULL|$fecha==NULL) {
		echo '<script language="javascript">alert("Un campo esta vacio");</script>';
		//echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
		
	}else
        {
            @mysql_query("INSERT INTO recorrido (patente_vehiculo, ruta_id, hora_salida, fecha_salida) VALUES ('$patente','$ruta','$hora','$fecha')")or die("Error: ".  mysql_error());
            //@mysql_query("INSERT INTO asociado VALUES ('$patente','$imei',now())");
            //@mysql_query("UPDATE dispositivo set est_disp='1' where imei='$imei'");
            mysql_close($link);
            echo '<SCRIPT language="javascript" type="text/javascript">alert("El turno ha sido ingresado correctamente.");</SCRIPT>';
            echo '<SCRIPT languaje="javascript" type="text/javascript">location.href = "ingresorecorrido.php";</SCRIPT>';
        }
}
else
{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}
?>
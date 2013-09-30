<?php require_once('../conexiones/connect_db.php');                                // incluir el archivo de coneccion                 
                                                                     //$_POST['lista1'];  esta variable debe seradquiridad desde formaulario (select
//$cliente =$_GET['cliente'];
if(isset($_GET['ruta']))
{
$ruta=$_GET['ruta'];
         														
}
//$ruta=1;
//$codigo = 2;											                                                  
function parseToXML($htmlStr)                                            // funcion para el reeplazo de caracteres a XML
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
$xmlStr=str_replace("�",'N',$xmlStr); 
$xmlStr=str_replace("�",'E',$xmlStr); 
return $xmlStr; 
}
                                                                                                //  consulta sql
$rs = mysql_query("SELECT MAX(id_posiciones) AS id,dispositivo_id  FROM posicion where dispositivo_id ='$ruta'");
if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);
}
$query= "SELECT latitud,longitud,id_posiciones,velocidad FROM posicion where dispositivo_id ='$ruta' and '$id'=id_posiciones";

// $re= @mysql_query("SELECT fecha_pos,latitud,longitud,dispositivo_id,hora_pos FROM posicion where hora_pos>='$horaini' and hora_pos<='$horafin' and dispositivo_id= $codigo and fecha_pos='$fecha'");
//select * from noticias where fecha = (select max(fecha) from noticias where visualizar = 1) and hora  = (select max(hora) from noticias where visualizar = 1) group by codnoticia;

$result = mysql_query($query);
if (!$result) {
  die('consulta invalida: ' . mysql_error());
}
header("Content-type: text/xml");                                  //header para inicializa XML

echo '<markers>';                                                  // Iniciar XML , Aqui se imprime el NODO padre
//$ranking= 1;                                                       // variable ranking  se utiliza para generar ranking de comuna  se incia en 1
while ($row = @mysql_fetch_array($result)){                        // Recorre los datos e imprime los datos en los nodos
  //echo '<th>'.$row['lat_control']." ".$row['lng_control'].'</th>';
  echo '<marker ';                                                // Agregar Nodos  a XML 
//  echo 'name="' . parseToXML($row['com_nombre']) . '" ';
  echo 'lat="' . $row["latitud"] . '" ';
  echo 'lng="' . $row["longitud"] . '" ';
  echo 'valor="' . $row['id_posiciones'] . '" ';
  echo 'vel="' . $row['velocidad'] . '" ';
   //echo 'codigo="' . $codigo . '" ';
 // echo 'ranking="' . $ranking . '" ';
  echo '/>';
  //$ranking++;
}
echo '</markers>';                                                  // Fin DE archvo XML

?>


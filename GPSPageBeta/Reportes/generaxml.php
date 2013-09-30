<?php require_once('../conexiones/connect_db.php');                                // incluir el archivo de coneccion                 
                                                                     //$_POST['lista1'];  esta variable debe seradquiridad desde formaulario (select
//$cliente =$_GET['cliente'];
if(isset($_GET['ruta']))
{
  $ruta=$_GET['ruta'];
           														

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
    //$query= "SELECT * FROM posicion where";por ejemplo. Where Fecha >= '20090404' (Fecha deseada) And Fecha < '20090405' (Fecha deseada + 1)

    //$query= "SELECT * FROM posicion where hora_pos>='$horaini' and hora_pos<='$horafin' and dispositivo_id= $codigo and fecha_pos='$fecha'";
    $query= "SELECT * FROM control where ruta_id ='$ruta'";
    // $re= @mysql_query("SELECT fecha_pos,latitud,longitud,dispositivo_id,hora_pos FROM posicion where hora_pos>='$horaini' and hora_pos<='$horafin' and dispositivo_id= $codigo and fecha_pos='$fecha'");

    $result = mysql_query($query);
    if (!$result) {
      die('consulta invalida: ' . mysql_error());
    }
    header("Content-type: text/xml");                                  //header para inicializa XML

    echo '<markers>';                                                  // Iniciar XML , Aqui se imprime el NODO padre
    //$ranking= 1;                                                       // variable ranking  se utiliza para generar ranking de comuna  se incia en 1
    while ($row = @mysql_fetch_array($result))
    {                        // Recorre los datos e imprime los datos en los nodos
      //echo '<th>'.$row['lat_control']." ".$row['lng_control'].'</th>';
      echo '<marker ';                                                // Agregar Nodos  a XML 
    //  echo 'name="' . parseToXML($row['com_nombre']) . '" ';
      echo 'lat="' . $row["lat_control"] . '" ';
      echo 'lng="' . $row["lng_control"] . '" ';
      echo 'nombre="' . $row["nom_control"] . '" ';
      echo 'minutos="' . $row["min_control"] . '" ';
     // echo 'valor="' . $row['ic_valor'] . '" ';
       //echo 'codigo="' . $codigo . '" ';
     // echo 'ranking="' . $ranking . '" ';
      echo '/>';
      //$ranking++;
    }
  echo '</markers>';                                                  // Fin DE archvo XML
}
?>


<?php require_once('../conexiones/connect_db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (isset($_GET['codigo'])) {

//$cliente =$_GET['cliente'];$ruta
$ruta=$_GET['ruta'];
$codigo =$_GET['codigo']; 
$fecha =$_GET['fecha']; 
//$horaini1 =$_GET['tiempoini']; 
//$horafin1 =$_GET['tiempofin']; 
//$horaini = $horaini1.":00";
//$horafin = $horafin1.":00";

}
require("../conexiones/connect_db.php");
$query = "SELECT * FROM recorrido where ruta_id = '$ruta' and fecha_salida='$fecha'";  //  consulta sql
//$consulta="select * from tabla where campo=".$campo;
$resultado=mysql_query($query) or die (mysql_error());
if (mysql_num_rows($resultado)>0)
{

require("../conexiones/connect_db.php");
$vehiculo=mysql_query("select * from asociado, vehiculo where imei_dispositivo = ".$codigo." and patente = patente_veh");
while($v= mysql_fetch_array($vehiculo))
{
    $empresario= $v["nombre_empresario"];
    $chofer=$v["chofer"];
    $patente=$v["patente"];   
}
$salida= mysql_query("select * from asociado, recorrido where  imei_dispositivo= ".$codigo." and patente_veh =patente_vehiculo") ;
while($s= mysql_fetch_array($salida))
{
    //echo $s['imei_dispositivo']." ".$s['patente_veh']." ".$s['iden_ruta']." ".$s['hora_salida'];
    $horaSalida=$s['hora_salida'];
    $horaSalidaDec = time_to_decimal($s['hora_salida']);
    //$hora_calculada = $min_control;
    //echo date("H:i:s",$hora_calculada)." ". date("H:i:s",$minuit)." ". date("H:i:s",$min_control)." ".date("H:i:s",$horaSalida);
    //echo decimal_to_time($min_control);
}

//$obtenerRecorrido=mysql_query("select * from recorrido,asociado where patente_veh = ".$patente );
$control= mysql_query("select * from control where ruta_id = ".$ruta." order by id_control asc");
$posicion= mysql_query("select * from posicion where dispositivo_id =".$codigo);
$arrayPControl[]= array();
while($con=mysql_fetch_array($control))
{
    $arrayPControl[]=$con;
}


$aux=0;//sumar los minutos de los puntos de control
$indice=1;//moverme en el array de puntos


$hora_controlada[]=array();
$hora_marcada[]=array();
$fecha_pos[]=array();
$atrasos[]=array();
$multas[]=array();
$min_atrasos=0;
while($p = mysql_fetch_array($posicion))
    {
    //echo '<tbody>';
   
       if($indice<count($arrayPControl))
        {
        $a= $arrayPControl[$indice]["lat_control"]-0.001;//sucesor
        $b= $arrayPControl[$indice]["lat_control"]+0.001;//antecesor
        $c= $arrayPControl[$indice]["lng_control"]-0.001;
        $d= $arrayPControl[$indice]["lng_control"]+0.001;
      
       if((($a<=$p["latitud"])&&($p["latitud"]<=$b))&&(($c<=$p["longitud"])&&($p["longitud"]<=$d)))
            {
                $min_control_dec=time_to_decimal($arrayPControl[$indice]["min_control"]);
                $aux=$aux + $min_control_dec;
                $min_control_dec= $aux + $horaSalidaDec;
                $min_control=  decimal_to_time($min_control_dec);
                $hora_controlada[]=$min_control;
                $hora_marcada[]=$p["hora_pos"];
                $fecha_pos[]=$p["fecha_pos"];
                if($p["hora_pos"]>$min_control)
                {
                    $min_atraso= resta($p["hora_pos"],$min_control);
                    //$sig="+";
                }
                else
                {
                    $min_atraso= resta($min_control,$p["hora_pos"]);                
                    //$sig="-";
                }
                $min_atraso_dec = time_to_decimal($min_atraso);
                $min_atrasos=$min_atrasos+$min_atraso_dec;
                $atrasos[]=$min_atraso;

                //echo '<th>'.$min_atraso."(".$sig.")".'</th>';
                $multas[] = valor_multa($min_atraso_dec, 200);
                
                //echo '<th>'.$multa.'</th>';
                $indice++;
            }
        
    }
    // echo '</tbody>';


  /*for($i=1;$i<count($array);$i++)
  {
      echo '<br>'.$diferencia[$i].'</br>';
      
  }*/
 
    }
//echo $ruta;
//$codigo ='356612022837142'; 
//$cliente ='17211799'; 
//$codigo ='356612022837142'; 
//$fecha ='24-04-2013'; 
//$horaini ='12:00:00'; 
//$horafin ='13:00:00'; 
?>



<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
<script src="http://maps.google.com/maps?file=api&v=3&key=AIzaSyC6Woj1uHaQMDhBJqqtmfTVlelHzwgluIE" type="text/javascript"></script>
<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><script type="text/javascript">
//<![CDATA[
var array_marcada = new Array();
var array_controlada = new Array();
<?php
for ($i = 1, $total = count($hora_marcada); $i < $total; $i ++)
{
    echo "array_marcada[$i-1] = '$hora_marcada[$i]';";
    echo "array_controlada[$i-1]='$hora_controlada[$i]';";
}

?>
   
	
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setMapType();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        map.enableScrollWheelZoom();
        //map.setCenter(new GLatLng(-35.423199, -71.66008), 13);

        GDownloadUrl("generaxml.php?ruta=<?php echo $ruta ?>&fecha=<?php echo $fecha ?>", function(data) {
          var xml = GXml.parse(data);
          var puntoCentro = new GLatLng();
          var markers = xml.documentElement.getElementsByTagName("marker");
          //var array_js = new Array();
          //array_js = <?php //echo $hora_marcada;?>;
          //var array_controlada = new Array();
          //array_controlada = <?php// echo $hora_controlada;?>;
          for (var i = 0; i < markers.length; i++) {
             
             
            //var name = markers[i].getAttribute("name");
            //var name= <?php //echo $patente?>;
           // var valor = markers[i].getAttribute("valor");
            //var valor = <?php// echo $chofer?>;
            //var type = markers[i].getAttribute("ranking");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            map.setCenter(new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng"))), 15);                      
            var descripcion = '<b><p>Movil : <?php echo $patente?></b><br/><b> Chofer :<?php echo $chofer?></b><br/><b> Hora Controlada :'+array_controlada[i] +'</b><br/><b> Hora Marcada :'+array_marcada[i]+'</b>'; 
            var marker = informacion(point,descripcion);
            map.addOverlay(marker);
          }
        });

      
      }
    }
    function informacion(point, descripcion) 
    {  
    var marker = new GMarker(point);  
    GEvent.addListener(marker, "click", function() {  
    marker.openInfoWindowHtml(descripcion); } );  

    return marker;  
    }  

   /* function createMarker(point) {
      var marker = new GMarker(point);
      //var html = "<b>" + name + "</b><p> Ranking Regional: lugar " + type + "<br/>Valor Indicador: " + valor+ "<br><a href= '../detalle_ciudad.php?ciudad="+point+"&nombre="+name+"&ranking="+type+"&valor="+valor+"&codigo=<?php //echo $codigo?>'target='_new'>Mas detalles...</a> ";
      //var html = "<b>" + name + "</b><p> Movil: " + name + "<br/>Chofer: " + valor+ "<br> "  ;
      //GEvent.addListener(marker, 'click', function() {
      //marker.openInfoWindowHtml(html);
      //});
      return marker;
    }*/
    //]]>
</script>

<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../scripts/orangebox/js/orangebox.min.js"></script>
<link rel="stylesheet" href="../scripts/orangebox/css/orangebox.css" type="text/css" />


<script type="text/javascript">
oB.settings.inlineWidth = 0.7;
	oB.settings.fadeTime= 200;
	oB.settings.iframeHeight = 0.8;
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>


<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:1px;
	top:0px;
	width:99%;
	height:33px;
	z-index:1;
	background-image: url(../css/images/header_bg.gif);
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
	color: #333;
}
</style>
<link href="../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css">
<style type="text/css">
a:link {
	color: #06C;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #06C;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
a {
	font-weight: bold;
}
</style>
</head>
<body onLoad="load()" onUnload="GUnload()">

<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0"><img src="../Trayecto/Metroid_32_0005_taskmgr.png" width="20" height="20" align="absmiddle"> Click aquí para más información</div>
  <div class="CollapsiblePanelContent">
    <div class="body_resize">

<section id="tables">

    <h5>Registros</h5>
    <form class="form-horizontal" id="contacto" name="contacto" target="_top" action="" method="get" onsubmit="return validar(this);">
    <table class="table table-bordered table-striped table-hover" >
        <thead>
            <tr>
                <th>Empresario</th>
                <th>Chofer</th>
                <th>Vehiculo</th>
                <th>Fecha</th>
                <th>Hora Marcada</th>
                <th>Hora Control</th>
                <th>Minutos (hh:mm)</th>
                <th>Valor a Pagar</th>
            </tr>
        </thead>
<?php
echo '<tbody>';
$multa_total=0;

for($i=1;$i<count($hora_controlada);$i++)
{
    echo '<tr>';
    echo '<th>'.$empresario.'</th>';
    echo '<th>'.$chofer.'</th>';
    echo '<th>'.$patente.'</th>';
    echo '<th>'.$fecha_pos[$i].'</th>';
    echo '<th>'.$hora_marcada[$i].'</th>';
    echo '<th>'.$hora_controlada[$i].'</th>';
    echo '<th>'.$atrasos[$i].'</th>';
    
    echo '<th>'.$multas[$i].'</th>';
    $multa_total=$multa_total+$multas[$i];
    echo '</tr>';
}

echo '</tbody>';


 ?>
</table>
<tr>
    <td>
        <a href="../scripts/excel.php?empresario=<?php echo $empresario?>&chofer=<?php echo $chofer?>&patente=<?php echo $patente?>&min_atrasos=<?php echo $min_atrasos?>&multas_total=<?php echo $multa_total?>">
            <input class="btn btn-primary" value="Generar Reporte" >
        </a>
    </td>
</tr>
        
<!--<div aling="center"><button class="btn btn-large" type="submit" name="cargar" >Generar Reporte</button></div>-->
</form>
 
<?php   

} 
else {
echo '<SCRIPT LANGUAGE="javascript" type="text/javascript">
        alert("Error : \nNo hay datos para Ruta y Fecha especificada");
        location.href = "mapa_portada.php";            
</SCRIPT>';
}

function hora_calculada($hora_pos, $minutos_control)
 {  
      return  $hora_calculada = date("H:i:s", strtotime($hora_calculada."00"));;
 }
 function valor_multa($min_atraso_dec, $vlr_min_atraso)
 {
     return $min_atraso_dec * $vlr_min_atraso;
 }
 function decimal_to_time($decimal) {
    $hours = floor($decimal / 60);
    $minutes = floor($decimal % 60);
    $seconds = $decimal - (int)$decimal;
    $seconds = round($seconds * 60);
 
    return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
}
 function time_to_decimal($hora)
 {
    $desglose=  explode(":", $hora);
    
    $dec=$desglose[0]*60+$desglose[1];
    return $dec;
 }
 function suma($h_salida, $minutosControl)
  {
         $dif=date("H:i:s", strtotime("00:00:00") + strtotime($h_salida) + strtotime($minutosControl) ); 
      return $dif;
  }
  function resta($inicio, $fin)
  {
      //if($inicio>$fin)
      //{          
         $dif=date("H:i", strtotime("00:00:00") + strtotime($inicio) - strtotime($fin) ); 
      //}
      //else
      //{
        // $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
      //}
      return $dif;
  }
  //echo '<a href="abajo.php?vector_multas=multas&vector_diferencias=diferencia">inicio</a>';
  ?>

  </div>
</div>


<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen:false});
</script>
<div id="map" style="width: 100%; height: 93%"></div>
</body>
</html>
<?php 

?>


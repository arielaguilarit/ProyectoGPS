
<?php require_once('../conexiones/connect_db.php');

if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
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
  //$cliente =$_GET['cliente']; 
  $codigo =$_GET['codigo']; 
  $fecha =$_GET['fecha']; 
  $horaini1 =$_GET['tiempoini']; 
  $horafin1 =$_GET['tiempofin']; 
  $horaini = $horaini1.":00";
  $horafin = $horafin1.":00";
}
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
        <!-- Le styles -->
<link href="../bootstrap/css/bootstrapp.css" rel="stylesheet">
<link href="../css/estilo.css" type="text/css" rel="stylesheet">
<link href="http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
<script src="http://maps.google.com/maps?file=api&v=3&key=AIzaSyC6Woj1uHaQMDhBJqqtmfTVlelHzwgluIE" type="text/javascript"></script>
<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><script type="text/javascript">
//<![CDATA[
var markers;
  function load() {
    if (GBrowserIsCompatible()) 
    {
      var map = new GMap2(document.getElementById("map"));
      map.setMapType();
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.enableScrollWheelZoom();
      //map.setCenter(new GLatLng(-35.423199, -71.66008), 13);
      GDownloadUrl("generaxml.php?codigo=<?php echo $codigo?>&fecha=<?php echo $fecha?>&horaini=<?php echo $horaini?>&horafin=<?php echo $horafin?>", function(data) {
        var xml = GXml.parse(data);
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) 
        {

          
          var name = markers[i].getAttribute("name");
          var valor = markers[i].getAttribute("valor");
          var type = markers[i].getAttribute("ranking");
          var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),parseFloat(markers[i].getAttribute("lng")));
          if(i==0)
          {
            map.setCenter(point, 16);
          }
          //delay();
          var marker = createMarker(point, name, type, valor);
          map.addOverlay(marker);
        }
      });
      
    }
  }//Fin funcion Load

  function delay()
  {
    setTimeout('createMarker()',5000);
  }

  function createMarker(point, name,type,valor) {
    var marker = new GMarker(point);
    //var html = "<b>" + name + "</b><p> Ranking Regional: lugar " + type + "<br/>Valor Indicador: " + valor+ "<br><a href= '../detalle_ciudad.php?ciudad="+point+"&nombre="+name+"&ranking="+type+"&valor="+valor+"&codigo=<?php echo $codigo?>'target='_new'>Mas Detalles..</a> "  ;
    var html='<b> Velocidad :'+valor+'</b>'; 
      //var html =   ;
    GEvent.addListener(marker, 'click', function() {
      marker.openInfoWindowHtml(html);
    });
    return marker;
  }//Fin funcion createMarker
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


<link href="../bootstrap/css/style.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:1px;
	top:0px;
	width:120%;
	height:90%;
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
  <div class="CollapsiblePanelTab" tabindex="0"><img src="Metroid_32_0005_taskmgr.png" width="20" height="20" align="absmiddle"> Click aquí para más información</div>
  <div class="CollapsiblePanelContent">
    <div class="body_resize">

<section id="tables">
    <h5>Registros</h5>
   <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Latitud</th>
        <th>Longitud</th>
      </tr>
    </thead>
      <?php
      require('../conexiones/connect_db.php');  
      $sql = ("SELECT fecha_pos,latitud,longitud,dispositivo_id,hora_pos FROM posicion where hora_pos>='$horaini' and hora_pos<='$horafin' and dispositivo_id= $codigo and fecha_pos='$fecha'");
      $re= @mysql_query($sql)or die ("Error:".mysql_error());
      while($f= @mysql_fetch_array($re)){
        echo'<tbody>';
        echo '<th>'.$f["fecha_pos"].'</th>';
        echo '<th>'.$f["hora_pos"].'</th>';
        echo '<th>'.$f["latitud"].'</th>';
        echo '<th>'.$f["longitud"].'</th>';
        echo'</tbody>';
      }?> 
    </table>
    </section>
  </div>
</div>

<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen:false});
</script>
<div id="map" style="width: 100%; height: 93%"></div>
</body>
</html>

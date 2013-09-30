
<?php require_once('../conexiones/coneccion.php'); ?>
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
$codigo =$_GET['codigo']; 


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
    var iconUno = new GIcon(); 
    iconUno.image = 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/72/Map-Marker-Marker-Outside-Chartreuse-icon.png';
    //iconUno.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconUno.iconSize = new GSize(72, 72);
    //iconUno.shadowSize = new GSize(35, 35);
    iconUno.iconAnchor = new GPoint(6, 20);
    iconUno.infoWindowAnchor = new GPoint(5, 1);
   var customIcons = [];
    customIcons["1"] = iconUno;
   
	
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setMapType();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        map.enableScrollWheelZoom();
        //map.setCenter(new GLatLng(-35.423199, -71.66008), 13);

        GDownloadUrl("generaxml.php?ruta=<?php echo $codigo ?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("vel");
            var valor = markers[i].getAttribute("valor");
            var type = markers[i].getAttribute("ranking");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, type, valor);
            map.addOverlay(marker);
            map.setCenter(point, 16);
          }
        });

      
      }
    }

    function createMarker(point, name,type,valor) {
      //var marker = new GMarker(point, customIcons["1"]);
      var marker = new GMarker(point);
      var descripcion = '<b><p>Id:'+valor+'</b><br/><b> Velocidad:'+name+'</b>'; 
      //var html =   ;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(descripcion);
      });
      return marker;
    }
    //]]>
</script>

<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../scripts/orangebox/js/orangebox.min.js"></script>
<link rel="stylesheet" href="../scripts/orangebox/css/orangebox.css" type="text/css" />




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





<div id="map" style="width: 100%; height: 93%"></div>
</body>
</html>



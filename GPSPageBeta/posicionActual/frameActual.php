<?php 
session_start();
if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "../index.htm" ;
        </script>';
}
?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GPS</title>
 <link href="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/16/Map-Marker-Marker-Outside-Azure-icon.png" type="image/x-icon" rel="shortcut icon">
</head>
<frameset rows="150,*" cols="*" frameborder="no" border="0" framespacing="0">

  <frame src="headerActual.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="arriba" />
  <frameset rows="*" cols="*,304" framespacing="0" frameborder="no" border="0">
  
    <frameset rows="*,0" cols="*" framespacing="0" frameborder="no" border="0">
    
		<frame src="../Trayecto/mapa_portada.php" name="mainFrame" id="mainFrame" title="main" />
	</frameset>
   <frame src="headActual.php" name="rightFrame" scrolling="auto" noresize="noresize" id="rightFrame" title="derecha" />
 
 </frameset>
</frameset>
<noframes>
</noframes>
<noframes>
<frameset rows="*,80" frameborder="no" border="0" framespacing="0">
 
  <frame name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="abajo" />
</frameset>
</noframes>
 </body>
</html>
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/16/Map-Marker-Marker-Outside-Azure-icon.png" type="image/x-icon" rel="shortcut icon">
<title>GPS</title>
</head>
<body onLoad="load()" onUnload="GUnload()">
<?php include("../include/head.htm"); ?>
<?php include("../include/css/estilo.css"); ?>
      <div class="container" id="general">
          <div class="masthead">
            <div class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <ul class="nav">
                    <?php
                      if($_SESSION["privilegio"]=="1"){
                        //echo "<li><a href='../home/home.php'>Home</a></li>";
                        echo "<li class='active'><a href='frameActual.php'>Posicion Actual</a></li>";
                        echo "<li><a href='../Trayecto/portada.php'>Trayectoria</a></li>";
                        echo "<li ><a href='../Reportes/frameReportes.php'>Ruta</a></li>";
                        //echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                        //echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                        //echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
                        //echo "<li ><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                      }else if($_SESSION["privilegio"]=="2"){
                       // echo "<li><a href='../home/home.php'>Home</a></li>";
                        //echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                        //echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
                        //echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                      }
                    ?>
                  </ul>
                </div>
              </div>
            </div><!-- /.navbar -->
          </div>

          <div class="container-fluid">
            <div class="row-fluid" align="center">
                <div class="span12">
                  <div class="well ">
                  <!--<form method="GET" action="tablaReportes.php" target="mainFrame" name="Form1">-->
                    <form  name="Form1">
                        <?php
                          require("../conexiones/connect_db.php");
                          $re= mysql_query("select * from vehiculo");
                          //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                        ?>
                      <h5>Vehiculo</h5>
                      <?php
                        $re= mysql_query("select imei,patente_veh from dispositivo,asociado where imei = imei_dispositivo");
                        //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                      ?>
                      <select id="dispositivo" name="codigo" >
                      <?php
                        while($f=mysql_fetch_array($re)){
                          echo'<option value='.$f[imei].'>'.$f[patente_veh].'</option>';
                        }
                      ?>
                      </select>
                      <button class="btn btn-large" type="submit" id="boton"  >Cargar</button>
                      <!--<button class="btn btn-large" type="submit"  >Cargar</button>-->
                    </form>
                  </div><!--/.well -->
                </div><!--/span-->
              </div>

        <!-- -------------------------------------- mapa ---------------------------------------- -->  
              <div class="row-fluid" align="center">        
                <div class="span12">
                  
                    <div  class="well ">
                      <section id="tables">
                        <legend>Mapa</legend>
                        
                        <div id="map" style="width:850px;height:450px;"></div>
                        
                      </section>
                    </div>
                  
                </div>
              </div>
          </div>
        </div>

<!-- -------------------------------------- javascript ---------------------------------------- -->         
<script src="http://maps.google.com/maps?file=api&v=3&key=AIzaSyC6Woj1uHaQMDhBJqqtmfTVlelHzwgluIE" type="text/javascript"></script>
<script type="text/javascript">
      var map;
      function load() {
        if (GBrowserIsCompatible()) {
          map = new GMap2(document.getElementById("map"));
          map.setMapType();
          map.addControl(new GLargeMapControl());
          map.addControl(new GMapTypeControl());
          map.enableScrollWheelZoom();
          var point = new GLatLng(-35.423199, -71.66008); 
          var marker = new GMarker(point); 
          map.addOverlay(marker); 
          map.setCenter(point, 13);
          //evento para agregar marcadores donde se haga click el usuario
          /*GEvent.addListener(map,"click",function(overlay, latlng){
            //var lat=latlng.lat();
            //var lng = latlng.lng();
            //alert(lat +""+ lng);
            marker =createMarker(latlng);
            map.addOverlay(marker);
          });*/

            }
          }

      function createMarker(point, name,type,valor) {
        //var marker = new GMarker(point, customIcons["1"]);
        var lat=point.lat();
        var lng = point.lng();
        var marker = new GMarker(point);
        var descripcion = '<b><p>Latitud: '+lat+'<br>Longitud: '+lng+'</b>'; 
        //var html =   ;
        //evento para agregar info al marcador y verla cuandoel usuario haga click sobre este
       GEvent.addListener(marker, 'click', function() {
          marker.openInfoWindowHtml(descripcion);
        });
        return marker;
      }

      function newMarker(point, name,type,valor) {
      //var marker = new GMarker(point, customIcons["1"]);
      var marker = new GMarker(point);
      var descripcion = '<b><p>Velocidad :' + name+'</b><br/><b> Minutos Control :'+valor+'</b>'; 
      //var html =   ;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(descripcion);
      });
      return marker;
    }
   
    $(document).ready(function(){
    //alert("Hola mundo");
       $("#boton").click(function(event){
         var id = $("#dispositivo").find(':selected').val();
         //alert(id);
         if (GBrowserIsCompatible()) 
         {
              map = new GMap2(document.getElementById("map"));
              map.setMapType();
              map.addControl(new GLargeMapControl());
              map.addControl(new GMapTypeControl());
              map.enableScrollWheelZoom();

              GDownloadUrl("generaxml.php?ruta="+id, function(data) {
                var xml = GXml.parse(data);
                var markers = xml.documentElement.getElementsByTagName("marker");
                if(markers.length>0)
                {
                  for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute("vel");
                    var valor = markers[i].getAttribute("minutos");
                    var type = markers[i].getAttribute("ranking");
                    var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                            parseFloat(markers[i].getAttribute("lng")));
                    var marker = newMarker(point, name, type, valor);
                    map.addOverlay(marker);
                    map.setCenter(point, 13);
                    }

                  }
                  else
                  {
                    alert("No hay puntos para visualizar");
                    var point = new GLatLng(-35.423199, -71.66008); 
                    var marker = new GMarker(point); 
                    map.addOverlay(marker); 
                    map.setCenter(point, 13);

                  }
              });

              /*var point = new GLatLng(-35.43018328981312, -71.6352367401123); 
              var marker = new GMarker(point); 
              map.addOverlay(marker); 
              map.setCenter(point, 13);
              //evento para agregar marcadores donde se haga click el usuario
              GEvent.addListener(map,"click",function(overlay, latlng){
                //var lat=latlng.lat();
                //var lng = latlng.lng();
                //alert(lat +""+ lng);
                marker =createMarker(latlng);
                map.addOverlay(marker);
              });*/
          }
         //$('#map').show();
         //$("#map").load('mapa.php?id='+id);
         return false;
       });
    });//fin document
    //]]>
</script>

<?php include("../include/footer.htm"); ?>
</body>




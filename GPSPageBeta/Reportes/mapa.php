<script src="http://maps.google.com/maps?file=api&v=3&key=AIzaSyC6Woj1uHaQMDhBJqqtmfTVlelHzwgluIE" type="text/javascript"></script>
<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script><script type="text/javascript">
//<![CDATA[
    /*var iconUno = new GIcon(); 
    iconUno.image = 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/72/Map-Marker-Marker-Outside-Chartreuse-icon.png';
    //iconUno.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconUno.iconSize = new GSize(72, 72);
    //iconUno.shadowSize = new GSize(35, 35);
    iconUno.iconAnchor = new GPoint(6, 20);
    iconUno.infoWindowAnchor = new GPoint(5, 1);
   var customIcons = [];
    customIcons["1"] = iconUno;
   */
  
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setMapType();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        map.enableScrollWheelZoom();
        //map.setCenter(new GLatLng(-35.423199, -71.66008), 13);

        GDownloadUrl("generaxml.php?ruta=<?php echo $ruta?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("nombre");
            var valor = markers[i].getAttribute("minutos");
            var type = markers[i].getAttribute("ranking");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, type, valor);
            map.addOverlay(marker);
          }
        });

      map.setCenter(new GLatLng(-35.423199, -71.66008), 13);
      }
    }

    function createMarker(point, name,type,valor) {
      //var marker = new GMarker(point, customIcons["1"]);
      var marker = new GMarker(point);
      var descripcion = '<b><p>Nombre :' + name+'</b><br/><b> Minutos Control :'+valor+'</b>'; 
      //var html =   ;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(descripcion);
      });
      return marker;
    }
    //]]>
</script>
<div id="map" style="width: 100%; height: 93%" onLoad="load()"></div>
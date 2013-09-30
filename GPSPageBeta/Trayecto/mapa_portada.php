<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyC6Woj1uHaQMDhBJqqtmfTVlelHzwgluIE&sensor=true"
            type="text/javascript"></script>
    <!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAUkqK4272K97Szc98o2m6jhTLlWBLc7esyGapQX8sSnaeJvFZ6xS7tYi8-FBniM6uUMMVzC6NNNSvPg&sensor=false"
            type="text/javascript"></script> -->
  <script type="text/javascript">

    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(-35.423199, -71.66008), 8);
			var html = "Bienvenido" ;
		map.openInfoWindowHtml(map.getCenter(html),
	
                           document.createTextNode(html));
      }
    }

    </script>
  <style type="text/css">
  body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
	color: #06F;
}
  </style>
</head>
  <body onload="initialize()" onunload="GUnload()">
  <div id="map_canvas" style="width: 120%; height: 90%"></div>
</body>
</html
></html>

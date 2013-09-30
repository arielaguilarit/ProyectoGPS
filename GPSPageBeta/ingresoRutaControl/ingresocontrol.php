<?php
session_start();
if(!$_SESSION || $_SESSION["privilegio"]=="3"){
  echo '<script languaje= javascript>
    alert("Usuario no autetificado");
    self.location = "../index.htm" ;
    </script>';
}
?>
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
                echo "<li><a href='../ingresoEmpresa/ingreso_empresa.php'>Empresa</a></li>";
                echo "<li><a href='../ingresoUsuario/ingresousuario.php'>Usuario</a></li>";
                echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
                echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                echo "<li class='active'><a href='ingresocontrol.php'>Controles</a></li>";
                echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
              }else if($_SESSION["privilegio"]=="2"){
               // echo "<li><a href='../home/home.php'>Home</a></li>";
                echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                echo "<li class='active'><a href='ingresocontrol.php'>Controles</a></li>";
                echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                echo "<li><a href='../home/perfil.php'>Perfil</a></li>";
              }
            ?>
          </ul>
        </div>
      </div>
    </div><!-- /.navbar -->
  </div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Menú</li>
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registro P.Control</a></li>
              <li id="li_contacto"><a href="<?php print("javascript:display_contacto();");?>">Ingreso P.Control</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar P.Control</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

<!-- -------------------------------- MODIFICAR PUNTO DE CONTROL ------------------------------------>

        <div id="div_info">
          <div id="form-empresa" class="well">
            <section id="tables">
              <legend>Puntos de Control</legend>
              <form name="frmbusqueda" action="" onsubmit="buscarDato(); return false">
                <div align="center">Seleccionar Ruta:
                  <select name="dato" onclick="buscarDato()">
                    <?php
                    //Conexion a la Base de datos
                      require("../conexiones/connect_db.php");
                      if($_SESSION["privilegio"]==1)
                      {
                        $result= @mysql_query("select id_ruta, nombre_ruta from ruta")or die("Error: ".  mysql_error());
                      }
                      else
                      {
                          $empresa=$_SESSION["empresa"];
                         $result= @mysql_query("select id_ruta, nombre_ruta from ruta where id_empresa='$empresa'")or die("Error: ".  mysql_error());
                      }
                      //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                      while ($row=@mysql_fetch_array($result)){
                        echo'<option value='.$row["id_ruta"].'>'.$row["nombre_ruta"].'</option>';
                      }
                    ?>
                  </select>
                </div>
              </form>
              <fieldset>
                <div id="resultado"></div>
              </fieldset>
            </section>
          </div>
        </div>

<!-- -------------------------------- AGREGAR PUNTO DE CONTROL ------------------------------------>

        <div id="div_contacto" >
          <div id="form-empresa" class="well">
              <section id="tables">
                <legend>Ingresar Punto de Control</legend>
                  <form  class="form-horizontal" id="contacto" name="contacto" action="reg_pcontrol.php" method="post" onsubmit="return validar(this);">
                  <fieldset>
                  <table>
                      <!-- Ruta -->
                      <div class="control-group">
                      <label class="control-label" for="inputRuta">Ruta</label>
                      <div class="controls">
                      <select name="ruta" required>
                        <?php
                        //require("../conexiones/connect_db.php");
                        if($_SESSION["privilegio"]==1)
                        {
                            $result= @mysql_query("select id_ruta, nombre_ruta from ruta")or die("Error: ".  mysql_error());
                        }
                        else
                        {
                            $empresa=$_SESSION["empresa"];
                            $result= @mysql_query("select id_ruta, nombre_ruta from ruta where id_empresa='$empresa'")or die("Error: ".  mysql_error());
                        }
                        //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                        while ($row=@mysql_fetch_array($result))
                        {
                          echo'<option value='.$row["id_ruta"].'>'.$row["nombre_ruta"].'</option>';
                        }
                        ?>
                      </select>
                      </div>
                      </div>

                      <!-- Nombre Control -->
                      <div class="control-group">
                      <label class="control-label" for="inputControl">Nombre Control</label>
                      <div class="controls">
                      <input type="text" name="nom_control" size="25" placeholder="Nombre de Control" required>
                      </div>
                      </div>

                      <!-- Latitud -->
                      <div class="control-group">
                      <label class="control-label" for="inputLatitud">Latitud</label>
                      <div class="controls">
                      <input type="text" name="latitud" size="25" placeholder="Latitud" required>
                      </div>
                      </div>

                      <!-- Longitud -->
                      <div class="control-group">
                      <label class="control-label" for="inputLongitud">Longitud</label>
                      <div class="controls">
                      <input type="text" name="longitud" size="25" placeholder="Longitud" required>
                      </div>
                      </div>

                      <!-- Minutos -->
                      <div class="control-group">
                      <label class="control-label" for="inputMinutos">Tiempo(hrs/min) </label>
                      <div class="controls">
                      <input type="time" name="minutos" size="25" placeholder="Minutos" required>
                      </div>
                      </div>

                      <tr>
                      <td><input class="btn btn-success" type="submit" value="Ingresar"></td>
                      </tr> 
                  </table>    

                  </fieldset>  
                  </form>                 
                  
             </section> 
             
         </div>                      
        </div>

<!-- ---------------------------------- Eliminar Puntos de Control ---------------------------------------- -->
        <div id="div_estetica">
          <div class='well'>
            <section id='tables'>
                <legend>Puntos de Control</legend>
                <form action ='borrar-pcontrol.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>Seleccionar</th>
                        <th>Ruta</th>
                        <th>Punto</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Minutos</th>
                      </tr>
                    </thead>
                    <?php
                      $nbrow=0; 
                      $cont = 0; //Para el checkbox 
                      
                     if($_SESSION["privilegio"]==1)
                      {
                        $result= @mysql_query("select * from ruta,control where ruta_id=id_ruta  order by nombre_ruta")or die("Error: ".  mysql_error());
                      }
                      else
                      {
                         $empresa=$_SESSION["empresa"];
                         $result= @mysql_query("select * from ruta,control where id_empresa='$empresa'and ruta_id=id_ruta")or die("Error: ".  mysql_error());
                      }
                      while($row=@mysql_fetch_array($result)){ 
                        $nbrow++;
                        $cont++;
                        $id=$row["id_control"];
                        $nom=$row["nom_control"];
                        $lat =$row["lat_control"];
                        $long = $row["lng_control"];
                        $hora =$row["min_control"];
                        $ruta =$row["nombre_ruta"];
                      ?>
                    <tbody>
                      <th>
                        <center><input type="checkbox" name="delete[]" value="<?php echo $id ?>"></center>
                      </th>
                      <?php
                        echo "<th> $ruta</th>";
                        echo "<th> $nom</th>";
                        echo "<th> $lat</th>";
                        echo "<th> $long</th>";
                        echo "<th> $hora</th>";}?>
                    </tbody>
                  </table>
                  <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
                </form>
            </section>
          </div>
        </div>
<!-- ------------------------------------ Fin -------------------------------------------- -->

        </div><!--/span9-->
      </div><!--/row-fluid-->

      <legend>Mapa</legend>
        <div id="map" style="width:900px;height:450px;"></div>
  </div><!--/container-fluid-->
</div>


      <!-- <div>
          <div>
              <legend>Localizador de Coordenadas</legend>
                  <div>
                      <object data="http://www.maps.pixelis.es" width="1020" height="720"> 
                          <embed wmode="transparent" src="http://www.maps.pixelis.es" width="600" height="400" />
                          Error: Embedded data could not be displayed.
                      </object>
                  </div>
          </div>
       </div> --> 

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
          //map.addOverlay(marker); 
          map.setCenter(point, 13);
          //evento para agregar marcadores donde se haga click el usuario
          GEvent.addListener(map,"click",function(overlay, latlng){
            //var lat=latlng.lat();
            //var lng = latlng.lng();
            //alert(lat +""+ lng);
            marker =createMarker(latlng);
            map.addOverlay(marker);
          });

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
</script>
   

<?php include("../include/footer.htm"); ?>
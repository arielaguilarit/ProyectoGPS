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

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <title>GPS </title>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
  </head>

<?php
    require("../conexiones/connect_db.php");
?>

<section id="tables">
 
 <form method="GET" action="mapa.php" target="mainFrame" name="Form1">
 <!-- <h5>Cliente</h5>
  <?php
    //$re= mysql_query("select * from cliente");
    //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
   ?>
<select id="cleinte" name="cliente" >
    <?php
    //while($f=mysql_fetch_array($re)){
     //   echo'<option value='.$f[rut].'>'.$f[nombre]. ' ' .$f[apellido].'</option>';
        //}
    ?>
</select>-->


<h5>Vehiculo</h5>
    <?php
    $re= mysql_query("select imei,patente_veh from dispositivo,asociado where imei=imei_dispositivo")or die("Error:".  mysql_error());
    //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
   ?>
<select id="dispositivo" name="codigo" required="required" >
    <?php
    while($f=mysql_fetch_array($re)){
        echo'<option value='.$f[imei].'>'.$f[patente_veh].'</option>';
        }
    ?>
</select>

<h5>Fecha </h5>
    <input type="date" required="required" name="fecha" style="margin-left:0px;" id="fechaini" class="form-emp" size="30" maxlength="1000" />
        <?php //$fechaini= fechaini?>
  <h5>Hora Inicial</h5>
  <input type="time" required="required" name="tiempoini" style="margin-left:0px;" id="tiempoini" class="form-emp" size="30" maxlength="1000" /> 

  <h5>Hora Final</h5>
  <input type="time" name="tiempofin" style="margin-left:0px;" id="fechafin" class="form-emp" size="30" maxlength="1000" required="required" />

<td>
<button class="btn btn-large" type="submit">Cargar</button></td></tr>

</form>

    </section>
    </div>
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap-transition.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrap/js/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>
    </body>

</html>


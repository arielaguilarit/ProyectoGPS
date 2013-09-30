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
 
 <form method="GET" action="tablaActual.php" target="mainFrame" name="Form1">


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



<button class="btn btn-large" type="submit"  >Cargar</button>

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


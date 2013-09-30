<?php
include("../conexiones/conexion.php");
//$nombre= $_GET["variable"];
?>

<!DOCTYPE html>
<!-- saved from url=(0062)http://twitter.github.io/bootstrap/examples/justified-nav.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../bootstrap/js/funciones_nueva_pagina.js"></script>
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <!--  FancyBox librerias -->
  <script lang="javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="../fancybox/lib/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js"></script>  
  <link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css" />
    <body>

  <?php
        //$rut=null;
        //$rut=$_GET["variable"];
        if(isset($_GET["patente"]))
        {
          $bus=$_GET["patente"];
          $imei=$_GET["imei_disp"];
          $sql="select * from vehiculo,asociado,empresa where patente='$bus' and patente_veh='$bus' and id_empresa = rut_empresa";
          $cs=mysql_query($sql,$cn)or die (mysql_error());
          while($resul=mysql_fetch_array($cs))
          {
            $var=$resul["patente"];
            $var1=$resul["id_unico"];
            $var2=$resul["chofer"];
            $var3=$resul["rut_empresario"];
            $var4=$resul["nombre_empresario"];
            $var5=$resul["tipo_vehiculo"];
            $var6=$resul["marca_vehiculo"];
            $var7=$resul["nombre_empresa"];
            $var8=$resul["imei_dispositivo"];
                          
          }
}

?>
<section id="tables">
 

<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
      <legend>Vehiculo</legend>
      <fieldset> 

<table>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Patente</label>
<div class="controls">
<input  type="text"  name="nombre" size="25"  value="<?php echo $var?>" disabled>  
</div>
</div>

<!-- COntraseña--> 
<div class="control-group">
<label class="control-label" for="inputPassword">Identificador</label>
<div class="controls">
<input type="text" name="clave" size="25"  value="<?php echo $var1?>" disabled>
</div>
</div>

<!-- telefono -->
<div class="control-group">
<label class="control-label" for="inputPassword">Conductor</label>
<div class="controls">
<input type="text" name="telefono" size="25"  value="<?php echo $var2?>" disabled>
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Rut Empresario</label>
<div class="controls">
<input type="text" name="direccion" size="25"  value="<?php echo $var3?>" disabled >
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Empresario</label>
<div class="controls">
<input type="text" name="direccion" size="25"  value="<?php echo $var4?>" disabled >
</div>
</div>

<!-- Email -->
<div class="control-group">
<label class="control-label" for="inputPassword">Tipo Vehiculo</label>
<div class="controls">
<input type="text" name="email" size="25"  value="<?php echo $var5?>" disabled>
</div>
</div>

<!-- Privilegio -->
<div class="control-group">
<label class="control-label" for="inputPassword">Marca del Vehiculo</label>
<div class="controls">
<input type="text" name="multa_atraso" size="25"  value="<?php echo $var6?>" disabled>
</div>
</div>

<!-- Estado -->
<div class="control-group">
<label class="control-label" for="inputPassword">Empresa</label>
<div class="controls">
<input type="text" name="multa_adelanto" size="25"  value="<?php echo $var7?>" disabled>
</div>
</div>

<!-- Empresa -->
<div class="control-group">
<label class="control-label" for="inputPassword">Dispositivo</label>
<div class="controls">
<input type="text" name="multa_adelanto" size="25"  value="<?php echo $var8?>" disabled>
</div>
</div>


<!--<tr>
<td><input class="btn btn-primary" type="submit" name="btn1" value="Actualizar">
</tr>-->
</table> 

</fieldset>  

</form>
</div>
</section>

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

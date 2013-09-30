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
    <!-- Le styles -->
    <script src="../bootstrap/js/funciones_nueva_pagina.js"></script>
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
        $rut='';
        if(isset($_GET["variable"]))
        {
		$bus=$_GET["variable"];
        $id=$bus;
		$sql="select * from recorrido,ruta,vehiculo where id_recorrido='$bus' and patente_vehiculo=patente and ruta_id=id_ruta";
		$cs=mysql_query($sql,$cn)or die (mysql_error());
		while($resul=mysql_fetch_array($cs)){
			$var=$resul["id_recorrido"];
			$var1=$resul["id_unico"];
			$var2=$resul["nombre_ruta"];
			$var3=$resul["hora_salida"];
			$var4=$resul["fecha_salida"];
			
		}


	if(isset($_POST["btn1"]))
	{
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar")
		{
			$veh=$_POST["vehiculo"];
			$rut=$_POST["ruta"];
			$hor=$_POST["hora"];
			$fec=$_POST["fecha"];
			$sql="update recorrido set patente_vehiculo='$veh',ruta_id='$rut',hora_salida='$hor',fecha_salida='$fec' where id_recorrido='$id'";
			$cs=mysql_query($sql,$cn) or die("error : ".  mysql_error());
			echo "<script> alert('Se actualizo correctamente');</script>";
			echo "<!--  Ejecuta la Aplicacion Fancybox -->
					<script type='text/javascript'>
						parent.location.reload(true);
						parent.jQuery.fancybox.close();
					</script>";
		}
	}
}

?>
<section id="tables">
<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
      <legend>Actualizar Recorrido</legend>
      <fieldset> 

<table>
<!-- Rut -->
<div class="control-group" hidden>
<label class="control-label">Rut</label>
<div class="controls">
<input type="text" name="id" size="25" value="<?php echo $var?>">
</div>
</div>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Iden. Vehiculo</label>
<div class="controls">
<select name="vehiculo">
    <?php
    $sql="select * from vehiculo";
    $cs=mysql_query($sql,$cn)or die (mysql_error());
    while($f=mysql_fetch_array($cs))
    {
        if($var1==$f["id_unico"])
        {
             echo'<option  selected="selected" value='.$f["patente"].'>'.$f["id_unico"].'</option>';
        }
        else
        {
            echo'<option value='.$f["patente"].'>'.$f["id_unico"].'</option>';
        }
    }
    ?>  
</select>
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Ruta</label>
<div class="controls">
<select name="ruta">
    <?php
    $sql="select * from ruta";
    $cs=mysql_query($sql,$cn)or die (mysql_error());
    while($f=mysql_fetch_array($cs))
    {
        if($var2==$f["nombre_ruta"])
        {
             echo'<option  selected="selected" value='.$f["id_ruta"].'>'.$f["nombre_ruta"].'</option>';
        }
        else
        {
            echo'<option value='.$f["id_ruta"].'>'.$f["nombre_ruta"].'</option>';
        }
    }
    ?>  
</select>
</div>
</div>

<!-- ciudad -->
<div class="control-group">
<label class="control-label" for="inputPassword">Hora Salida</label>
<div class="controls">
<input type="time" name="hora" size="25"  value="<?php echo $var3?>" required>
</div>
</div>

<!-- telefono -->
<div class="control-group">
<label class="control-label" for="inputPassword">Fecha Salida</label>
<div class="controls">
<input type="date" name="fecha" size="25"  value="<?php echo $var4?>" required>
</div>
</div>

<tr>
<td><input class="btn btn-primary" type="submit" name="btn1" value="Actualizar">
</tr>

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
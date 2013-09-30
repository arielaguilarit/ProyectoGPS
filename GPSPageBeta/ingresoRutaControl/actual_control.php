<?php
include("../conexiones/connect_db.php");
$nombre= $_GET["variable"];
?>

<!DOCTYPE html>
<!-- saved from url=(0062)http://twitter.github.io/bootstrap/examples/justified-nav.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Ingreso Ruta</title>
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
	$btn="";
	$var="";
	$var1="";
	$var2="";
	$var3="";
	$var4="";
	$var5="";

	if(isset($_GET["variable"])){
		$bus=$_GET["variable"];
		$sql="select * from control where id_control='$bus'";
		$cs=mysql_query($sql)or die (mysql_error());
		while($resul=mysql_fetch_array($cs)){
			$var=$resul[0];
			$var1=$resul[1];
			$var2=$resul[2];
			$var3=$resul[3];
			$var4=$resul[4];
			$var5=$resul[5];
		}

	if(isset($_POST["btn1"]))
	{
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar"){
			$ruta=$_POST["ruta"];
			$control=$_POST["id_control"];
			$nombre=$_POST["nombre"];
			$lat=$_POST["latitud"];
			$lng=$_POST["longitud"];
			$min=$_POST["minutos"];
			
			$sql="update control set nom_control='$nombre',lat_control='$lat',lng_control='$lng',min_control='$min' where ruta_id='$ruta' and id_control='$control'";
			//("INSERT INTO cliente VALUES ('$username','$password','$nombre','$apellido','$direccion','$ciudad','$telefono','$email','$priv')");
			$cs=mysql_query($sql)or die("Error: ".mysql_error());
			echo "<script> alert('Se actualizo correctamente');</script>";
			echo "<!--  Ejecuta la Aplicacion Fancybox -->
					<script type='text/javascript'>
						parent.location.reload(true);
						parent.jQuery.fancybox.close();
					</script>";
			mysql_close($link);
		}
	}
}

?>
<section id="tables">
 

<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
      <h5>Puntos de Control</h5>
      <fieldset> 

<table>

<!-- Ruta -->
<div class="control-group" hidden>
<label class="control-label" for="inputRuta">Ruta</label>
<div class="controls">
<input type="text" name="ruta" size="25" value="<?php echo $var5?>">
</div>
</div>

<!-- Id_Control -->
<div class="control-group" hidden>
<label class="control-label">Control</label>
<div class="controls">
<input  type="text" name="id_control" size="25" value="<?php echo $var?>" required>
</div>
</div>

<!-- Nombre -->
<div class="control-group">
<label class="control-label">Nombre</label>
<div class="controls">
<input  type="text" name="nombre" size="25" value="<?php echo $var1?>" required>
</div>
</div>

<!-- Latitud -->
<div class="control-group">
<label class="control-label" for="inputLat">Latitud</label>
<div class="controls">
<input  type="text" name="latitud" size="25" value="<?php echo $var2?>" required>  
</div>
</div>

<!-- Longitud -->
<div class="control-group">
<label class="control-label" for="inputLng">Longitud</label>
<div class="controls">
<input  type="text" name="longitud" size="25" value="<?php echo $var3?>" required>
</div>
</div>

<!-- minutos -->
<div class="control-group">
<label class="control-label" for="inputMin">Minutos</label>
<div class="controls">
<input type="text" name="minutos" size="25" value="<?php echo $var4?>" required>
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
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

	if(isset($_GET["variable"])){
		$bus=$_GET["variable"];
		$sql="select * from ruta where id_ruta='$bus'";
		$cs=mysql_query($sql)or die (mysql_error());
		while($resul=mysql_fetch_array($cs)){
			$var=$resul[0];
			$var1=$resul[1];
			$var2=$resul[2];
		}

	if(isset($_POST["btn1"]))
	{
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar"){
			$ruta=$_POST["ruta"];
			$nombre=$_POST["nombre"];
			$ciudad=$_POST["ciudad"];
			
			$sql="update ruta set nombre_ruta='$nombre', ciudad='$ciudad' where id_ruta='$ruta'";
			//("INSERT INTO cliente VALUES ('$username','$password','$nombre','$apellido','$direccion','$ciudad','$telefono','$email','$priv')");
			$cs=mysql_query($sql);
			echo "<script> alert('Se actualizo correctamente');</script>";
			echo "<!--  Ejecuta la Aplicacion Fancybox -->
					<script type='text/javascript'>
						parent.location.reload(true);
						parent.jQuery.fancybox.close();
					</script>";
                        
		}
	}
       mysql_close($link);
}

?>
<section id="tables">
 

<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
  <legend>Ruta</legend>
    <fieldset>
<table>

<!-- Ruta -->
<div class="control-group" hidden>
<label class="control-label" for="inputRuta">Ruta</label>
<div class="controls">
<input type="text" name="ruta" size="25" value="<?php echo $var?>">
</div>
</div>

<!-- Nombre -->
<div class="control-group">
<label class="control-label">Nombre</label>
<div class="controls">
<input  type="text" name="nombre" size="25" value="<?php echo $var1?>" required>
</div>
</div>

<!-- Ciudad -->
<div class="control-group">
<label class="control-label" for="inputLat">Ciudad</label>
<div class="controls">
<input  type="text" name="ciudad" size="25" value="<?php echo $var2?>" required>  
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
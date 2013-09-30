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
        $rut=null;
        if(isset($_GET["variable"]))
        {
		$bus=$_GET["variable"];
                $rut=$bus;
		$sql="select * from empresa where rut_empresa='$bus'";
		$cs=mysql_query($sql,$cn)or die (mysql_error());
		while($resul=mysql_fetch_array($cs)){
			$var=$resul["rut_empresa"];
			$var1=$resul["nombre_empresa"];
			$var2=$resul["dir_empresa"];
			$var3=$resul["tel_empresa"];
			$var4=$resul["email_empresa"];
			$var5=$resul["ciudad_empresa"];
			$var6=$resul["valor_atraso"];
			$var7=$resul["valor_adelanto"];
		}


	if(isset($_POST["btn1"]))
	{
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar")
		{
			$nom=$_POST["nombre"];
			$dir=$_POST["direccion"];
			$ciu=$_POST["ciudad"];
			$tel=$_POST["telefono"];
			$email=$_POST["email"];
			$mul_at=$_POST["multa_atraso"];
            $mul_ad=$_POST["multa_adelanto"];
			$sql="update empresa set nombre_empresa='$nom',dir_empresa='$dir',ciudad_empresa='$ciu',tel_empresa='$tel',email_empresa='$email',valor_atraso='$mul_at',valor_adelanto='$mul_ad' where rut_empresa='$rut'";
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
      <legend>Actualizar Empresa</legend>
      <fieldset> 

<table>
<!-- Rut -->
<div class="control-group" hidden>
<label class="control-label">Rut</label>
<div class="controls">
<input type="text" name="rut" size="25" value="<?php echo $var?>">
</div>
</div>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Nombre Empresa</label>
<div class="controls">
<input  type="text"  name="nombre" size="25"  value="<?php echo $var1?>" required>  
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Dirección</label>
<div class="controls">
<input type="text" name="direccion" size="25"  value="<?php echo $var2?>"required >
</div>
</div>

<!-- ciudad -->
<div class="control-group">
<label class="control-label" for="inputPassword">Telefono</label>
<div class="controls">
<input type="text" name="ciudad" size="25"  value="<?php echo $var3?>" required>
</div>
</div>

<!-- telefono -->
<div class="control-group">
<label class="control-label" for="inputPassword">Email</label>
<div class="controls">
<input type="text" name="telefono" size="25"  value="<?php echo $var4?>" required>
</div>
</div>

<!-- Email -->
<div class="control-group">
<label class="control-label" for="inputPassword">Ciudad</label>
<div class="controls">
<input type="text" name="email" size="25"  value="<?php echo $var5?>" required>
</div>
</div>

<!-- Multa Atraso -->
<div class="control-group">
<label class="control-label" for="inputPassword">Multa Atraso</label>
<div class="controls">
<input type="text" name="multa_atraso" size="25"  value="<?php echo $var6?>" required>
</div>
</div>

<!-- Multa Adelanto -->
<div class="control-group">
<label class="control-label" for="inputPassword">Multa Adelanto</label>
<div class="controls">
<input type="text" name="multa_adelanto" size="25"  value="<?php echo $var7?>" required>
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
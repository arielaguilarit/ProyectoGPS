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
        //$rut=$_GET["variable"];
        if(isset($_GET["variable"]))
        {
		$bus=$_GET["variable"];
		$sql="select * from empresa where rut_empresa='$bus'";
		$cs=mysql_query($sql,$cn)or die (mysql_error());
		while($resul=mysql_fetch_array($cs))
                {
                    $var=$resul["rut_empresa"];
                    $var1=$resul["nombre_empresa"];
                    $var2=$resul["dir_empresa"];
                    $var3=$resul["ciudad_empresa"];
                    $var4=$resul["tel_empresa"];
                    $var5=$resul["email_empresa"];
                    $var6=$resul["valor_atraso"];
                    $var7=$resul["valor_adelanto"];
		}
	}

?>
<section id="tables">
 

<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
      <legend>Empresa</legend>
      <fieldset> 

<table>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Nombre Cliente</label>
<div class="controls">
<input  type="text"  name="nombre" size="25"  value="<?php echo $var1?>" disabled>  
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Dirección</label>
<div class="controls">
<input type="text" name="direccion" size="25"  value="<?php echo $var2?>" disabled >
</div>
</div>

<!-- ciudad -->
<div class="control-group">
<label class="control-label" for="inputPassword">Ciudad</label>
<div class="controls">
<input type="text" name="ciudad" size="25"  value="<?php echo $var3?>" disabled>
</div>
</div>

<!-- telefono -->
<div class="control-group">
<label class="control-label" for="inputPassword">Teléfono</label>
<div class="controls">
<input type="text" name="telefono" size="25"  value="<?php echo $var4?>" disabled>
</div>
</div>

<!-- Email -->
<div class="control-group">
<label class="control-label" for="inputPassword">Correo Electronico</label>
<div class="controls">
<input type="text" name="email" size="25"  value="<?php echo $var5?>" disabled>
</div>
</div>

<!-- Multa Atraso -->
<div class="control-group">
<label class="control-label" for="inputPassword">Multa Atraso</label>
<div class="controls">
<input type="text" name="multa_atraso" size="25"  value="<?php echo $var6?>" disabled>
</div>
</div>

<!-- Multa Adelanto -->
<div class="control-group">
<label class="control-label" for="inputPassword">Multa Adelanto</label>
<div class="controls">
<input type="text" name="multa_adelanto" size="25"  value="<?php echo $var7?>" disabled>
</div>
</div>

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

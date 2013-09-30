<!DOCTYPE html>
<!-- saved from url=(0062)http://twitter.github.io/bootstrap/examples/justified-nav.html -->
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
	$btn="";
	$var="";
	$var1="";
	$var2="";
	$var3="";

	if(isset($_GET["imei"])){
        include("../conexiones/connect_db.php");
        //estado del dispositivo
        $dato=$_GET["estad"];
        $imei=$_GET["imei"];
        $sql="select * from dispositivo where imei='$imei'";
        $cs=@mysql_query($sql);
        while($resul=mysql_fetch_array($cs)){
            $var=$resul["imei"];
            $var1=$resul["nom_dispositivo"];
            $var2=$resul["chip"];
            $var3=$resul["est_disp"];
        }
        if($var3=="2"){
            $var3="selected";
        }
	if(isset($_POST["btn1"])){
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar"){
            $var=$_POST["imei"];
            $var1=$_POST["nom_dispositivo"];
            $var2=$_POST["chip"];
            $var3=$_POST["est_disp"];
            // Existe el imei?
            $checkDisp = @mysql_query("SELECT imei FROM dispositivo WHERE imei='$var'");
            $disp_exist = @mysql_num_rows($checkDisp);
            if ($disp_exist>0){
                @mysql_query("update dispositivo set imei ='$var', nom_dispositivo ='$var1', chip ='$var2',est_disp ='$var3' where imei = '$var'") or die ("problema con query porque :".mysql_error());
                //Si el dispositivo pasa a Inactivo se modifica la tabla asociados
                if ($var3 == "2") {
                    @mysql_query("update asociado set imei_dispositivo = NULL, fecha_asociado = NULL where imei_dispositivo = '$var'");
                }
                mysql_close($link);
                echo '<script language="javascript">alert("El dispositivo '.$var1.' ha sido actualizado satisfactoriamente.");</script>';
                echo "<!--  Ejecuta la Aplicacion Fancybox -->
					   <script type='text/javascript'>
						  parent.location.reload(true);
						  parent.jQuery.fancybox.close();
					   </script>";
                //echo '<SCRIPT LANGUAGE="javascript">location.href = "ingresodispositivo.php";</SCRIPT>';
            }else{
                echo '<script language="javascript">alert("Error:\n No debe ni modificar y borrar el imei del dispostivo");</script>';
                //echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
            }
        }
    }	
}

?>
<section id="tables">
<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post">
<div  class="well"> 
      <legend>Actualizar Dispositivo</legend>
      <fieldset>
<table>
<!-- Imei -->
<div class="control-group" hidden>
<label class="control-label">Imei</label>
<div class="controls">
<input type="text" name="imei" size="25" value="<?php echo $var?>" required>
</div>
</div>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Nombre</label>
<div class="controls">
<input  type="text" name="nom_dispositivo" size="25" value="<?php echo $var1?>" required>  
</div>
</div>

<!-- Chip -->
<div class="control-group">
<label class="control-label" for="inputRut">Chip</label>
<div class="controls">
<input  type="text" name="chip" size="25" value="<?php echo $var2?>" required>
</div>
</div>


<!-- Estado -->
<?php
if ($dato == "INACTIVO") {
    echo "<div class='control-group' hidden>";
}else{
    echo "<div class='control-group'>";
}
?>
<label class="control-label" for="inputPassword">Estado</label>
<div class="controls">
<select name="est_disp">
<option value="1" >Activo</option>
<option value="2" <?php echo $var3?> >Inactivo</option>
</select>
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
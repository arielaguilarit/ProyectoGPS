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
        $rut='';
	if(isset($_GET["variable"])){
		$bus=$_GET["variable"];
        $rut=$bus;
		$sql="select * from usuario,empresa where rut_usuario='$bus' and usuario.rut_empresa = empresa.rut_empresa";
		$cs=mysql_query($sql,$cn)or die (mysql_error());
		while($resul=mysql_fetch_array($cs)){
			$var=$resul["nombre_usuario"];
			$var1=$resul["pass_usuario"];
			$var2=$resul["dir_usuario"];
			$var3=$resul["tel_usuario"];
			$var4=$resul["email_usuario"];
			$var5=$resul["privilegio"];
			$var6=$resul["estado"];
            $var7=$resul["rut_empresa"];
        }

	if(isset($_POST["btn1"]))
	{
  		$btn=$_POST["btn1"];
		if($btn=="Actualizar")
        {
            //$rut=$_POST["rut"];
            $nom=$_POST["nombre"];
            //$ape=$_POST["apellido"];
            $cla1=$_POST["clave"];
            //$cla2=$_POST["clave2"];
            $dir=$_POST["direccion"];
            //$ciu=$_POST["ciudad"];
            $tel=$_POST["telefono"];
            $mai=$_POST["email"];
            $pri=$_POST["priv"];
            $est=$_POST["estad"];
            $empre=$_POST["empre"];
			
			$sql="update usuario set pass_usuario='$cla1',nombre_usuario='$nom',dir_usuario='$dir',tel_usuario='$tel',email_usuario='$mai',privilegio='$pri' ,estado='$est', rut_empresa='$empre' where rut_usuario='$rut'";
			//("INSERT INTO cliente VALUES ('$username','$password','$nombre','$apellido','$direccion','$ciudad','$telefono','$email','$priv')");
			$cs=mysql_query($sql,$cn)or die("Error:".  mysql_error());
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
      <legend>Actualizar Usuario</legend>
      <fieldset> 

<table>

<!-- Nombre -->
<div class="control-group">
<label class="control-label" for="inputRut">Nombre Cliente</label>
<div class="controls">
<input  type="text"  name="nombre" size="25"  value="<?php echo $var?>" required>  
</div>
</div>

<!-- COntraseña -->
<div class="control-group">
<label class="control-label" for="inputPassword">Contraseña</label>
<div class="controls">
<input type="text" name="clave" size="25"  value="<?php echo $var1?>" required>
</div>
</div>

<!-- Direccion -->
<div class="control-group">
<label class="control-label" for="inputPassword">Dirección</label>
<div class="controls">
<input type="text" name="direccion" size="25"  value="<?php echo $var2?>"required >
</div>
</div>

<!-- telefono -->
<div class="control-group">
<label class="control-label" for="inputPassword">Teléfono</label>
<div class="controls">
<input type="text" name="telefono" size="25"  value="<?php echo $var3?>" required>
</div>
</div>

<!-- Email -->
<div class="control-group">
<label class="control-label" for="inputPassword">Correo Electronico</label>
<div class="controls">
<input type="text" name="email" size="25"  value="<?php echo $var4?>" required>
</div>
</div>

<!-- Privilegio -->
<div class="control-group">
<label class="control-label" for="inputPassword">Privilegio</label>
<div class="controls">
<select name="priv">
<?php
    if($var5==1)
    {
       print "<option value='1' selected='selected'>Administrador</option>";
       print "<option value='2'>Operador</option>";
       print "<option value='3'>Usuario</option>"; 
       print "<option value='4'>Digitador</option>";  
    }
    else if($var5==2)
    {
       print "<option value='1'>Administrador</option>";
       print "<option value='2'  selected='selected'>Operador</option>";
       print "<option value='3'>Usuario</option>";
       print "<option value='4'>Digitador</option>"; 
        
    }
    else if($var5==3)
    {
       print "<option value='1'>Administrador</option>";
       print "<option value='2'>Operador</option>";
       print "<option value='3' selected='selected'>Usuario</option>";
       print "<option value='4'>Digitador</option>";   
    }
    else if($var5==4)
    {
       print "<option value='1'>Administrador</option>";
       print "<option value='2'>Operador</option>";
       print "<option value='3'>Usuario</option>";
       print "<option value='4' selected='selected'>Digitador</option>";   
    }


?>  
</select>
</div>
</div>

<!-- Estado -->
<div class="control-group">
<label class="control-label" for="inputPassword">Estado</label>
<div class="controls">
<select name="estad">
    <?php
    if($var6==1)
    {
       print "<option value='1' selected='selected'>Activo</option>";
       print "<option value='2'>Inactivo</option>";
    }
    else if($var6==2)
    {
       print "<option value='1'>Activo</option>";
       print "<option value='2' selected='selected'>Inactivo</option>";
        
    }
?>  
</select>
</div>
</div>

<!-- Empresa -->
<div class="control-group">
<label class="control-label" for="inputPassword">Empresa</label>
<div class="controls">
<select name="empre">
    <?php
    $sql="select * from empresa";
    $cs=mysql_query($sql,$cn)or die (mysql_error());
    while($f=mysql_fetch_array($cs))
    {
        if($var7==$f["rut_empresa"])
        {
             echo'<option  selected="selected" value='.$f["rut_empresa"].'>'.$f["nombre_empresa"].'</option>';
        }
        else
        {
            echo'<option value='.$f["rut_empresa"].'>'.$f["nombre_empresa"].'</option>';
        }
    }
    ?>  
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
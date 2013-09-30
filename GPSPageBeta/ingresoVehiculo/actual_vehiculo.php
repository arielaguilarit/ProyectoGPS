<!DOCTYPE html>
<!-- saved from url=(0062)http://twitter.github.io/bootstrap/examples/justified-nav.html -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Ingreso Ruta</title>
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
	$patente ="";
	$id = "";
	$chofer = "";
  $rut_emp = "";
  $nom_emp = "";
  $tipo = "";
  $marca = "";
  $empresa = "";
  $imei = "";
  
	if(isset($_GET["id_vehiculo"])){
    include("../conexiones/conexion.php");
    $p1 = $_GET["id_vehiculo"];
    $sql="select * from vehiculo where id_vehiculo='$p1'";
    $cs=@mysql_query($sql, $cn)or die ("problema con query porque :".mysql_error());
    while($resul=mysql_fetch_array($cs)){
      $patente = $resul["patente"];
      $id = $resul['id_unico'];
      $chofer = ucfirst($resul['chofer']);
      $rut_emp= ucfirst($resul['rut_empresario']);
      $nom_emp= ucfirst($resul['nombre_empresario']);
      $tipo = ucfirst($resul['tipo_vehiculo']);
      $marca = ucfirst($resul['marca_vehiculo']);
      $empresa = ucfirst($resul['id_empresa']);
    }
    $aso = "select imei_dispositivo from asociado where patente_veh ='$patente'";
    $cs = @mysql_query($aso, $cn)or die ("problema con query porque :".mysql_error());
    while($resul=mysql_fetch_array($cs))
    {
      $imei = $resul['imei_dispositivo'];
    }

	if(isset($_POST["btn1"])){
  	$btn=$_POST["btn1"];
		if($btn=="Actualizar"){
      $ant_imei = $imei;
      $patente = $_POST["patente"];
      $id = $_POST['id_unico'];
      $chofer = ucfirst($_POST["chofer"]);
      $rut_emp = $_POST["rut_emp"];
      $nom_emp = ucfirst($_POST["nom_emp"]);
      $tipo = ucfirst($_POST['tipo_vehiculo']);
      $marca = ucfirst($_POST['marca_vehiculo']);
      $empresa = $_POST['id_empresa'];
      $imei = $_POST['disp'];
      $flag = false; //Bandera para imprimir Con asociado - Sin dispositivo
                    
      if($patente==NULL|$id==NULL|$chofer==NULL|$tipo==NULL|$marca==NULL|$nom_emp==NULL|$rut_emp==NULL){
        echo '<script language="javascript">alert("No deben haber campos esta vacios");</script>';
			  echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';  
      }else{
      // Existe el vehiculo?
        //$checkVeh = @mysql_query("SELECT patente FROM vehiculo WHERE patente ='$patente'")or die ("problema con Existe vehiculo porque:".mysql_error());
        $checkVeh = @mysql_query("SELECT patente FROM vehiculo WHERE id_vehiculo ='$p1'")or die ("problema con Existe vehiculo porque:".mysql_error());
        $veh_exist = @mysql_num_rows($checkVeh);
        if ($veh_exist > 0)
        {
            //actualiza el vehiculo
            //@mysql_query("UPDATE vehiculo set patente ='$patente', id_unico ='$id', chofer ='$chofer',rut_empresario ='$rut_emp', nombre_empresario ='$nom_emp', tipo_vehiculo ='$tipo', marca_vehiculo='$marca', id_empresa='$empresa' where patente = '$patente'") or die ("problema con Actualiza vehiculo 1 porque :".mysql_error());
            @mysql_query("UPDATE vehiculo set patente ='$patente', id_unico ='$id', chofer ='$chofer',rut_empresario ='$rut_emp', nombre_empresario ='$nom_emp', tipo_vehiculo ='$tipo', marca_vehiculo='$marca', id_empresa='$empresa' where id_vehiculo = '$p1'") or die ("problema con Actualiza vehiculo 1 porque :".mysql_error());
            $checkAso = @mysql_query("SELECT * FROM asociado WHERE patente_veh ='$patente'")or die ("problema con Actualiza vehiculo 2 porque :".mysql_error());
            $aso_exist = @mysql_num_rows($checkAso);
            //Existe la relacion en asociado??
            if($aso_exist > 0)
            {
              //Con asociado - Con dispositivo (estado 1 es activo)
              if($imei !== '')
              {
                //echo '<script language="javascript">alert("Aqui");</script>';
                @mysql_query("UPDATE asociado set patente_veh = '$patente', imei_dispositivo ='$imei', fecha_asociado = now() where patente_veh ='$patente' or imei_dispositivo = '$imei' ")or die ("problema con Con asociado - Con dispositivo 1 porque :".mysql_error());
                if($imei == $ant_imei)
                {
                  @mysql_query("UPDATE dispositivo set est_disp='1' where imei='$imei'")or die ("problema con Con asociado - Con dispositivo 2 porque :".mysql_error());
                }
                else
                {  
                  @mysql_query("UPDATE dispositivo set est_disp='2' where imei='$ant_imei'")or die ("problema Con asociado - Sin dispositivo 2 porque :".mysql_error());
                }
              //Con asociado - Sin dispositivo (estado 2 es inactivo)
              }else{
                @mysql_query("DELETE FROM asociado WHERE patente_veh ='$patente'")or die ("problema con Con asociado - Sin dispositivo 1 porque :".mysql_error());
                @mysql_query("UPDATE dispositivo set est_disp='2' where imei='$ant_imei'")or die ("problema Con asociado - Sin dispositivo 2 porque :".mysql_error());
                echo '<script language="javascript">alert("Si el Vehiculo no tiene un Gps, porfavor comuniquese con el Administrador pronto.");</script>';
                $flag = true;
              }
            }else{
              //Sin asociado - Con dispositivo
              if($imei !== '')
              {
                @mysql_query("INSERT INTO asociado(patente_veh, imei_dispositivo, fecha_asociado) VALUES ('$patente','$imei',now())")or die ("problema Sin asociado - Con dispositivo porque :".mysql_error());
                @mysql_query("UPDATE dispositivo set est_disp='1' where imei='$imei'")or die ("problema con Con asociado - Con dispositivo 2 porque :".mysql_error());
              }
            }
            mysql_close($cn);
            if($flag == false){
              echo '<script language="javascript">alert("El Vehiculo ha sido actualizado satisfactoriamente.");</script>';
            }
            echo "<!--  Ejecuta la Aplicacion Fancybox -->
  					<script type='text/javascript'>
  						parent.location.reload(true);
  						parent.jQuery.fancybox.close();
  					</script>";
        }else{
          echo '<script language="javascript">alert("Error:\n No debe ni modificar y borrar el imei del dispostivo");</script>';
          //echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
        }
      }
    }
  }
}
?>

<form  class="form-horizontal" id="contacto" name="contacto" action="#" method="post" onsubmit="return validar(this);">
  <div  class="well">
    <legend>Actualizar Vehiculo</legend>
      <fieldset>
        <table>

        <!-- Patente -->
        <div class="control-group">
        <label class="control-label" for="inputPatente">Patente</label>
        <div class="controls">
        <input type="text" name="patente" value="<?php echo $patente?>" size="25" placeholder="Patente" required>
        </div>
        </div>

        <!-- Id Unico -->
        <div class="control-group">
        <label class="control-label" for="inputIdUnico">Identificador</label>
        <div class="controls">
        <input  type="text"  name="id_unico" value="<?php echo $id?>" size="25" placeholder="Identificador" required>
        </div>
        </div>

        <!-- Chofer -->
        <div class="control-group">
        <label class="control-label" for="inputChofer">Nombre Conductor</label>
        <div class="controls">
        <input  type="text" name="chofer" value="<?php echo $chofer?>"size="25" placeholder="Conductor del vehiculo" required>
        </div>
        </div>
        
        <!-- Rut Empresario -->
        <div class="control-group">
        <label class="control-label" for="inputEmpresario">Rut Empresario</label>
        <div class="controls">
        <input  type="text" name="rut_emp" value="<?php echo $rut_emp?>" size="25" placeholder="Rut Empresario" required>
        </div>
        </div>
        
        <!-- Nombre Empresario -->
        <div class="control-group">
        <label class="control-label" for="inputEmpresario">Nombre Empresario</label>
        <div class="controls">
        <input  type="text" name="nom_emp" value="<?php echo $nom_emp?>" size="25" placeholder="Nombre Empresario" required>
        </div>
        </div>

        <!-- Tipo -->
        <div class="control-group">
        <label class="control-label" for="inputTipo">Tipo de Vehiculo</label>
        <div class="controls">
        <input type="text" name="tipo_vehiculo" value="<?php echo $tipo?>" size="25" placeholder="Tipo de Vehiculo" required>
        </div>
        </div>

        <!-- Marca -->
        <div class="control-group">
        <label class="control-label" for="inputMarcaVeh">Marca del Vehiculo</label>
        <div class="controls">
        <input type="text" name="marca_vehiculo" value="<?php echo $marca?>"size="25"  placeholder="Marca del Vehiculo" required>
        </div>
        </div>

        <!-- Nombre Empresa -->
        <div class='control-group'>
        <label class='control-label'for='inputNomRuta'>Nombre del Empresa</label>
        <div class='controls'>
        <select name='id_empresa'>
          <?php
          require("../conexiones/conexion.php");
          $result= @mysql_query("select rut_empresa, nombre_empresa from empresa where rut_empresa='$empresa'",$cn);
          while ($row=@mysql_fetch_array($result))
          {
            echo'<option value='.$row["rut_empresa"].'>'.$row["nombre_empresa"].'</option>'; 
          }
        ?>
        </select>
        </div>
        </div>
                  
        <!-- Imei Dispositivo -->
        <div class='control-group'>
        <label class='control-label' for='inputNomRuta'>Dispositivo</label>
        <div class='controls'>
        <select name='disp'>
          <!-- Primero un dispositivo vacio -->
          <option value=''>...</option>
          <?php
          $compara='';
          $res= @mysql_query("select imei, nom_dispositivo from dispositivo where imei = (select imei_dispositivo from asociado where patente_veh = '$patente')",$cn);
          while ($r=@mysql_fetch_array($res))
          {
            $compara = $r["imei"];
          }
          $result= @mysql_query("select imei, nom_dispositivo from dispositivo where est_disp='2' or imei = (select imei_dispositivo from asociado where patente_veh = '$patente')",$cn);
          while ($row=@mysql_fetch_array($result))
          {
            if ($compara == $row["imei"]) {
              //Luego el dispositivo asociado si es que existe
              echo'<option selected value='.$row["imei"].'>'.$row["nom_dispositivo"].'</option>';
            }else{
              //Finalmente los dispositivos disponibles
              echo'<option value='.$row["imei"].'>'.$row["nom_dispositivo"].'</option>';
            }
          }
          ?>
        </select>
        </div>
        </div>
        
        <tr>
        <td><input class="btn btn-primary" type="submit" name="btn1" value="Actualizar"></td>
        </tr>
        </table> 
      </fieldset>
    </div>
  </form>
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
<?php
session_start();
if(!$_SESSION || $_SESSION["privilegio"]!="1"){
  echo '<script languaje= javascript>
    alert("Usuario no autetificado");
    self.location = "../index.htm" ;
    </script>';
}
?>
<?php include("../include/head.htm"); ?>
<?php include("../include/css/estilo.css"); ?>
<div class="container" id="general">
<div class="masthead">
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav">
          <?php
            if($_SESSION["privilegio"]=="1"){
              //echo "<li><a href='../home/home.php'>Home</a></li>";
              echo "<li><a href='../ingresoEmpresa/ingreso_empresa.php'>Empresa</a></li>";
              echo "<li><a href='../ingresoUsuario/ingresousuario.php'>Usuario</a></li>";
              echo "<li class='active'><a href='ingresodispositivo.php'>Dispositivos</a></li>";
              echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
              echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
              echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
              echo "<li ><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
            }else if($_SESSION["privilegio"]=="2"){
             // echo "<li><a href='../home/home.php'>Home</a></li>";
              echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
              echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
              echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div><!-- /.navbar -->
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Menú</li>
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registro Dispositivos</a></li>
              <li id="li_productos"><a href="<?php print("javascript:display_productos();");?>">Ingresar Dispositivos</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar Dispositivos</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

<!-- -------------------------------------- Registro Dispositivos ---------------------------------------- -->          

        <div id="div_info">
          <div id="form-empresa" class="well">
            <section id="tables">
              <legend>Dispositivos</legend>
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Imei</th>
                    <th>Nombre del Dispositivo</th>
                    <th>Chip del Dispositivo</th>
                    <th>Estado</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                <?php
                  require("../conexiones/connect_db.php");
                  $re= @mysql_query("SELECT * from dispositivo");
                  while($f= @mysql_fetch_array($re))
                  {
                    if($f["est_disp"]=="1")
                    {
                      $state="label label-success";
                      $valor="ACTIVO";
                    }else{
                      $state="label label-important";
                      $valor="INACTIVO";
                    }
                    echo '<tbody>';
                    echo '<th>'.$f["imei"].'</th>';
                    echo '<th>'.$f["nom_dispositivo"].'</th>';
                    echo '<th>'.$f["chip"].'</th>';
                    echo '<th><span class="'.$state.'">'.$valor.'</span></th>';
                  ?>
                  <td><a id="modal" class="fancy" href="actual_disp.php?imei=<?php echo $f['imei'];?>&estad=<?php echo $valor?>"  data-width="900" data-height="500">
                  <button class="btn btn-mini btn-success" type="button">Modificar</button></a></td>
                  <?php
                  echo '</tbody>';
                  }?>
              </table>
            </section>
          </div>
        </div>
  <!-- ---------------------------------- Ingreso Dispositivos ---------------------------------------------- -->
        
        <div id="div_productos">
          <div id="form-productos" class="well">
              <section id="tables">
                <legend>Dispositivos</legend>
                  <form  class="form-horizontal" id="contacto" name="contacto" action="reg_disp.php" method="post" onsubmit="return validar(this);">
                  <fieldset>
                  <table>
                      <!-- imei -->
                      <div class="control-group">
                      <label class="control-label" for="inputImei">Imei</label>
                      <div class="controls">
                      <input type="text" name="imei" size="25"  placeholder="imei" required="required">
                      </div>
                      </div>
                      <!-- Marca dispositivo -->
                      <div class="control-group">
                      <label class="control-label" for="inputMarca_disp">Nombre</label>
                      <div class="controls">
                      <input type="text" name="nom_dispositivo" size="25"  placeholder="Nombre Dispositivo" required="required">
                      </div>
                      </div>
                      <!-- Chip del Dispositivo -->
                      <div class="control-group">
                      <label class="control-label" for="inputChip">Chip</label>
                      <div class="controls">
                      <input type="text" name="chip" size="25"  placeholder="Chip del Dispositivo" required="required">
                      </div>
                      </div>
                      <tr>
                      <td><input class="btn btn-success" type="submit" value="Ingresar"></td>
                      </tr> 
                  </table>
                  </fieldset>
                  </form>
              </section>
         </div>
        </div>

<!-- ------------------------------------ Eliminar Dispositivos ------------------------------------ -->
  
        <div id="div_estetica">
          <div class='well'>
            <section id='tables'>
                <legend>Dispositivos</legend>
                <form action ='borrar_disp.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>Seleccionar</th>
                        <th>Estado</th>
                        <th>Imei</th>
                        <th>Nombre Dispositivo</th>
                        <th>Chip </th>
                      </tr>
                    </thead>
                    <?php
                    include("../conexiones/conexion.php");
                      $nbrow=0; 
                      $cont = 0; //Para el checkbox 
                      $result = @mysql_query("SELECT * FROM dispositivo");
                      while($row=@mysql_fetch_array($result)){
                        $nbrow++;
                        $cont++;
                        $imei=$row["imei"]; 
                        $nombre =$row["nom_dispositivo"]; 
                        $chip = $row["chip"]; 
                        if($row["est_disp"]=="1"){
                            $state="label label-success";
                            $valor="ACTIVO";
                        }else{
                             $state="label label-important";
                             $valor="INACTIVO";
                         }
                      ?>
                    <tbody>
                      <th>
                        <center><input type="checkbox" name="delete[]" value="<?php echo $imei ?>"></center>
                      </th>
                      <?php
                        echo '<th><span class="'.$state.'">'.$valor.'</span></th>';
                        print "<th> $imei</th>"; 
                        print "<th> $nombre</th>"; 
                        print "<th> $chip</th>";
                      }?>
                    </tbody>
                  </table>
                  <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
                </form>
            </section>
          </div>
        </div>
  
  <!-- --------------------------------------------   Fin   -------------------------------------------------- -->

        </div><!--/span9-->
      </div><!--/row-fluid-->
    </div><!--/container-fluid-->
  </div>
<?php include("../include/footer.htm"); ?>
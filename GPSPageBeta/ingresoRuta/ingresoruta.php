<?php
session_start();
if(!$_SESSION || $_SESSION["privilegio"]=="3"){
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
                echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
                echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                echo "<li class='active'><a href='ingresoruta.php'>Rutas</a></li>";
                echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
                echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
              }else if($_SESSION["privilegio"]=="2"){
                //echo "<li><a href='../home/home.php'>Home</a></li>";
                echo "<li class='active'><a href='ingresoruta.php'>Rutas</a></li>";
                echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
                echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                echo "<li><a href='../home/perfil.php'>Perfil</a></li>";
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
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registro Ruta</a></li>
              <li id="li_contacto"><a href="<?php print("javascript:display_contacto();");?>">Ingresar Ruta</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar Ruta</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

<!-- -------------------------------- MODIFICAR PUNTO DE CONTROL ------------------------------------>

        <div id="div_info">
          <div class="well">
            <section id="tables">
              <Legend>Rutas</Legend>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                  <?php 
                  require("../conexiones/connect_db.php");
                  if($_SESSION["privilegio"]==1)
                  { 
                  
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Nombre</th>';
                    echo '<th>Ciudad</th>';
                    echo '<th>Empresa</th>';
                    echo '<th>Modificar</th>';
                    echo '</tr>';
                    echo '</thead>';                  
                    $re= @mysql_query("SELECT * from ruta,empresa where id_empresa=rut_empresa order by nombre_empresa asc");
                    while($f= @mysql_fetch_array($re)){
                      echo '<tbody>';
                      echo '<th>'.$f["nombre_ruta"].'</th>';
                      echo '<th>'.$f["ciudad"].'</th>';
                      echo '<th>'.$f["nombre_empresa"].'</th>';
                    ?>
                      <td><a id="modal" class="fancy" href="actual_ruta.php?variable=<?php echo $f['id_ruta'];?>" data-width="900" data-height="500">
                      <button class="btn btn-mini btn-success" type="button">Modificar</button></td>
                      </tbody>
                    <?php
                    }
                  }
                  else if($_SESSION["privilegio"]==2)
                  {
                    $empresa=$_SESSION["empresa"];  
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Nombre</th>';
                    echo '<th>Ciudad</th>';
                    echo '<th>Modificar</th>';
                    echo '</tr>';
                    echo '</thead>';                  
                    $re= @mysql_query("SELECT * from ruta where id_empresa='$empresa' order by nombre_ruta asc");
                    echo '<tbody>';
                    while($f= @mysql_fetch_array($re)){
                      echo '<th>'.$f["nombre_ruta"].'</th>';
                      echo '<th>'.$f["ciudad"].'</th>';
                    ?>
                      <td><a id="modal" class="fancy" href="actual_ruta.php?variable=<?php echo $f['id_ruta'];?>" data-width="900" data-height="500">
                      <button class="btn btn-mini btn-success" type="button">Modificar</button></a></td>
                      </tbody>
                    <?php
                    }
                      
                  }
                  ?>
              </table>
            </section>
          </div>
        </div>

<!-- -------------------------------- AGREGAR RUTA ------------------------------------ -->

        <div id="div_contacto">
          <div id="form-empresa" class="well">
              <section id="tables">
              <legend>Ingresar Ruta</legend>
              <form  class="form-horizontal" id="contacto" name="contacto" action="reg_ruta.php" method="post" onsubmit="return validar(this);">
                  <fieldset>
                  <table>
                      <?php
                      if($_SESSION["privilegio"]==1)
                      {
                      ?>
                      <!-- Empresa -->
                      <div class="control-group">
                          <label class="control-label" for="inputEst">Empresa</label>
                          <div class="controls">
                          <select name="empre">
                          <?php
                              require("../conexiones/connect_db.php");
                              $re= @mysql_query("SELECT * from empresa");
                              while($f= @mysql_fetch_array($re))
                              {
                                  echo'<option value='.$f["rut_empresa"].'>'.$f["nombre_empresa"].'</option>';
                              }
                          ?>
                          </select>
                          </div>
                      </div>
                      <?php
                      }
                      else
                      {
                          $empresa=$_SESSION["empresa"];
                          echo '<input type="hidden" name="empre" value='.$empresa.'>';
                      }
                      ?>

                      <!-- Nombre Ruta -->
                      <div class="control-group">
                      <label class="control-label" for="inputRuta">Nombre Ruta</label>
                      <div class="controls">
                      <input type="text" name="nombreruta" size="25"  placeholder="nombreruta" required="required">
                      </div>
                      </div>

                      <!-- Ciudad -->
                      <div class="control-group">
                      <label class="control-label" for="inputCiudad">Ciudad</label>
                      <div class="controls">
                      <input type="text" name="ciudadruta" size="25"  placeholder="ciudadruta" required="required">
                      </div>
                      </div>
                      <tr>
                          <tr>
                              <td><input class="btn btn-success" type="submit" value="Ingresar"></td>
                          </tr>
                      </tr>
                  </table>
                  </fieldset>  
              </form>
              </section>
          </div>
        </div>

<!-- ---------------------------------- Eliminar Rutas ---------------------------------------- -->
        <div id="div_estetica">
          <div class='well'>
            <section id='tables'>
                <legend>Rutas</legend>
                <form action ='borrar-ruta.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                    <?php 
                    require("../conexiones/connect_db.php");
                    if($_SESSION["privilegio"]==1)
                    { 
                      echo '<thead>';
                      echo '<tr>';
                      echo '<th>Seleccionar</th>';
                      echo '<th>Nombre</th>';
                      echo '<th>Ciudad</th>';
                      echo '<th>Empresa</th>';
                      echo '</tr>';
                      echo '</thead>'; 

                      $result = @mysql_query("SELECT * FROM ruta,empresa where id_empresa = rut_empresa order by nombre_empresa");
                      echo '<tbody>';
                      while($row=@mysql_fetch_array($result))
                      {
                       ?>
                      <th>
                        <center><input type="checkbox" name="delete[]" value="<?php echo $row["id_ruta"] ?>"></center>
                      </th>  
                      <?php
                        echo '<th>'.$row["nombre_ruta"].'</th>';
                        echo '<th>'.$row["ciudad"].'</th>';
                        echo '<th>'.$row["nombre_empresa"].'</th>';
                        echo '</tbody>';  
                      }
                       
                    }
                    else if($_SESSION["privilegio"]==2)
                    { 
                      $empresa=$_SESSION["empresa"];
                      echo '<thead>';
                      echo '<tr>';
                      echo '<th>Seleccionar</th>';
                      echo '<th>Nombre</th>';
                      echo '<th>Ciudad</th>';
                      echo '</tr>';
                      echo '</thead>'; 

                      $result = @mysql_query("SELECT * FROM ruta where id_empresa ='$empresa' order by nombre_ruta");
                      echo '<tbody>';
                      while($row=@mysql_fetch_array($result))
                      {
                       ?>
                      <th>
                        <center><input type="checkbox" name="delete[]" value="<?php echo $row["id_ruta"] ?>"></center>
                      </th>  
                      <?php
                        echo '<th>'.$row["nombre_ruta"].'</th>';
                        echo '<th>'.$row["ciudad"].'</th>';
                        echo '</tbody>'; 
                      }

                    }?>
                  </table>
                  <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
                </form>
            </section>
          </div>
        </div>
<!-- ------------------------------------ Fin -------------------------------------------- -->

        </div><!--/span9-->
      </div><!--/row-fluid-->
    </div><!--/container-fluid-->
  </div>
    <?php include("../include/footer.htm"); ?>
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
                //echo "<li><a href='../home/home.php'><i class='icon-home icon-black'></i>Home</a></li>";
                echo "<li><a href='../ingresoEmpresa/ingreso_empresa.php'>Empresas</a></li>";
                echo "<li><a href='../ingresoUsuario/ingresousuario.php'>Usuarios</a></li>";
                echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
                echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
                echo "<li class='active'><a href='ingresorecorrido.php'>Turnos</a></li>";
              }else if($_SESSION["privilegio"]=="2"){
                //echo "<li><a href='../home/home.php'>Home</a></li>";
                echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
                echo "<li class='active'><a href='ingresorecorrido.php'>Turnos</a></li>";
                echo "<li><a href='../home/perfil.php'>Perfil</a></li>";
              }elseif ($_SESSION["privilegio"]=="4") {
                      //echo "<li><a href='../home/home.php'>Home</a></li>";
                      echo "<li class='active'><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
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
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Ingresar Turno</a></li>
              <?php
              if($_SESSION["privilegio"]!="4")
              {?>
              <li id="li_productos"><a href="<?php print("javascript:display_productos();");?>">Eliminar Turnos</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Modificar Turnos</a></li>
              <li id="li_contacto"><a href="<?php print("javascript:display_contacto();");?>">Generar Informe</a></li>
              <?php
              }?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        
        <div class="span9">
    
  <!-- ----------------------------------  Ingresar Recorridos  ---------------------------------------------- -->          
        
        <div id="div_info"> 
            <div id="form-empresa" class="well">                                                
                    <section id="tables">
                    <legend>Turnos</legend>
                    <form  class="form-horizontal" id="contacto" name="contacto" action="reg_recorrido.php" method="post" onsubmit="return validar(this);">
                    <fieldset>
                    <table>
                    <!--Vehiculo -->
                    <div class="control-group">
                    <label class="control-label" for="inputvehiculo">Iden. Vehiculo</label>
                    <div class="controls">
                    <select name="vehiculo">
                          <?php
                          require("../conexiones/connect_db.php");
                          if($_SESSION["privilegio"]==1)
                          {
                              $result= @mysql_query("select patente, id_unico from vehiculo");
                          }
                          else
                          {
                             $result= @mysql_query("select patente, id_unico from vehiculo where id_empresa=".$_SESSION["empresa"]);  
                          }
                          //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                          while ($row=@mysql_fetch_array($result))
                          {
                          echo'<option value='.$row["patente"].'>'.$row["id_unico"].'</option>';
                          }?>
                    </select>
                    </div>
                    </div>

                    <!--Ruta -->
                    <div class="control-group">
                    <label class="control-label" for="inputRuta">Ruta</label>
                    <div class="controls">
                    <select name="ruta">
                    <?php
                    if($_SESSION["privilegio"]==1)
                    {
                      $result= @mysql_query("select nombre_ruta, id_ruta from ruta");
                    }
                    else
                    {
                       $result= @mysql_query("select nombre_ruta, id_ruta from ruta where id_empresa=".$_SESSION["empresa"]); 
                    }
                    //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                    while ($row=@mysql_fetch_array($result))
                    {
                          echo'<option value='.$row["id_ruta"].'>'.$row["nombre_ruta"].'</option>';
                    }
                    ?>
                    </select>
                    </div>
                    </div>

                    <!-- Hora Salida -->
                    <div class="control-group">
                    <label class="control-label" for="inputHora">Hora de salida</label>
                    <div class="controls">
                    <input type="time" name="hora" size="25"  placeholder="">
                    </div>
                    </div>

                    <!-- Fecha Salida -->
                    <div class="control-group">
                    <label class="control-label" for="inputFecha">Fecha de Salida</label>
                    <div class="controls">
                    <input type="date" name="fecha" size="25"  placeholder="">
                    </div>
                    </div>
                   
                    <tr>
                    <tr> <td><input class="btn btn-success" type="submit" value="Ingresar"></td></tr>
                    </tr>
                    </table>
                    </fieldset>  
                    </form>
                    </section>
            </div>                      
        </div>

  <!-- ------------------------------------ Eliminar Recorridos ---------------------------------------------- -->
<?php
if($_SESSION["privilegio"]!="4")
{?>
        <div id="div_productos">
          <div class='well'>
            <section id='tables'>
                <legend>Turnos</legend>
                <form action ='borrar_recorrido.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>Seleccionar</th>
                        <th>Chofer</th>
                        <th>Ruta</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <?php
                      if($_SESSION["privilegio"]==1)
                      {    
                        $result= @mysql_query("SELECT * from vehiculo,recorrido,ruta where patente=patente_vehiculo and ruta_id=id_ruta")or die("Error :".  mysql_error());
                      }
                      else
                      {
                        $empresa = $_SESSION["empresa"];
                        $result= @mysql_query("SELECT * from vehiculo,recorrido where patente = patente_vehiculo and id_empresa='$empresa'")or die("Error :".  mysql_error());  
                      }
                      while($row=@mysql_fetch_array($result)){
                        $id=$row["patente_vehiculo"];
                        $chofer =$row["chofer"];  
                        $ruta =$row["nombre_ruta"]; 
                        $hora = $row["hora_salida"]; 
                        $fecha =$row["fecha_salida"];
                      ?>
                    <tbody>
                      <th>
                        <center>
                            <input type="checkbox" name="delete[]" value="<?php echo $id_recorrido?>">
                        </center>
                      </th>
                      <?php
                        print "<th> $chofer</th>"; 
                        print "<th> $ruta</th>"; 
                        print "<th> $hora</th>"; 
                        print "<th> $fecha</th>";
                      }?>
                    </tbody>
                  </table>
                  <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
                </form>
            </section>
          </div>
        </div>

        <!-- -------------------------------------- Modificar Recorrido ---------------------------------------- -->          

        <div id="div_estetica">
          <div id="form-empresa" class="well">
            <section id="tables">
              <legend>Turnos</legend>
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Iden. Vehiculo</th>
                    <th>Ruta</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                <?php
                      if($_SESSION["privilegio"]==1)
                      {    
                        $result= @mysql_query("SELECT * from vehiculo,recorrido,ruta where patente=patente_vehiculo and ruta_id=id_ruta")or die("Error :".  mysql_error());
                      }
                      else
                      {
                        $empresa = $_SESSION["empresa"];
                        $result= @mysql_query("SELECT * from vehiculo,recorrido where patente = patente_vehiculo and id_empresa='$empresa'")or die("Error :".  mysql_error());  
                      }
                      while($row=@mysql_fetch_array($result))
                      {
                        
                    echo '<tbody>';
                    echo '<th>'.$row["id_unico"].'</th>';
                    echo '<th>'.$row["nombre_ruta"].'</th>';
                    echo '<th>'.$row["hora_salida"].'</th>';
                    echo '<th>'.$row["fecha_salida"].'</th>';
                  ?>
                  <td><a id="modal" class="fancy" href="actual_recorrido.php?variable=<?php echo $row['id_recorrido'];?>"  data-width="900" data-height="500">
                  <button class="btn btn-mini btn-success" type="button">Modificar</button></a></td>
                  <?php
                  echo '</tbody>';
                  }?>
              </table>
            </section>
          </div>
        </div>

<!-- --------------------------------------  Generar Informe  ------------------------------------------------ -->          
        
        <div id="div_contacto"> 
          <div id="form-empresa" class="well">                                                
            <section id="tables">
            <legend>Turnos</legend>
              <form class="form-horizontal" id="contacto" name="fo3"  method="post" action="envio.php" >
              <fieldset>
              <table>

              <!-- Vehiculo -->
              <div class="control-group">
              <label class="control-label" for="inputVehiculo">Identificador del Vehiculo</label>
              <div class="controls">
              <select name="vehiculo" required>
              <?php
              $result= @mysql_query("SELECT patente, id_unico, chofer, nombre_empresario, tipo_vehiculo, id_empresa from vehiculo where id_empresa = ".$_SESSION["empresa"]."")or die ("problema con query porque :".mysql_error());
              while ($row=@mysql_fetch_array($result))
              {
                echo'<option value='.$row["patente"].'>'.$row["id_unico"].'</option>';
              }?>
              </select>
              </div>
              </div>

              <!-- Fecha -->
              <div class="control-group">
              <label class="control-label" for="inputFecha">Fecha</label>
              <div class="controls">
              <input type="date" name="fecha" size="25" required>
              </div>
              </div>
              
              <tr>
              <td><input class="btn btn-primary" type="submit" name="mysubmit" value="Datos"></td>
              </tr>
              </table> 
              </fieldset>  
              </form>
              <div id="result"></div>
            </section>
          </div>                      
        </div>
<?php
}?>

  <!-- --------------------------------------------  Fin  ---------------------------------------------------- -->          

      </div><!--/span9-->
    </div><!--/row-fluid-->
  </div><!--/container-fluid-->
</div>
<?php include("../include/footer.htm"); ?>
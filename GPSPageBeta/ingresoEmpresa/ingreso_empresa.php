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
                echo "<li class='active'><a href='ingreso_empresa.php'>Empresa</a></li>";
                echo "<li><a href='../ingresoUsuario/ingresousuario.php'>Usuario</a></li>";
                echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
                echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
                echo "<li ><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
              }else if($_SESSION["privilegio"]=="2"){
                //echo "<li><a href='../home/home.php'>Home</a></li>";
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
                <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registro Empresas</a></li>
                <li id="li_contacto"><a href="<?php print("javascript:display_contacto();");?>">Ingresar Empresas</a></li>
                <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar Empresas</a></li>

              </ul>
            </div><!--/.well -->
          </div><!--/span-->
          <div class="span9">
    
  <!-- --------------------------------- Modificar ------------------------------------>
          <div id="div_info">
              <div class="well">
              <section id="tables">
              <Legend><p align="center">Empresa</p></Legend>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                            <th>Rut</th>
                            <th>Empresa</th>
                            <th>Multa Atraso</th>
                            <th>Multa Adelanto</th>
                            <th>Modificar</th>
                            <th>Detalle</th>
                            </tr>
                        </thead>
                        <?php
                        require("../conexiones/connect_db.php");
                        $re= @mysql_query("SELECT * from empresa");
                        while($f= @mysql_fetch_array($re)){
                        echo '<tbody>';
                        echo '<th>'.$f["rut_empresa"].'</th>';
                        echo '<th>'.$f["nombre_empresa"].'</th>';
                        echo '<th>'.$f["valor_atraso"].'</th>';
                        echo '<th>'.$f["valor_adelanto"].'</th>';
                        ?>
                        <td><a id="modal"  class="fancy" href="actual_empresa.php?variable=<?php echo $f['rut_empresa'];?>"  data-width="900" data-height="500">
                        <button class="btn btn-mini btn-success" type="button">Modificar</button></td>
                        <td><a id="modal"  class="fancy" href="detalle_empresa.php?variable=<?php echo $f['rut_empresa'];?>"  data-width="900" data-height="500">
                        <button class="btn btn-mini btn-info" type="button">Detalle</button></td>
                        <?php
                        echo '</tbody>';
                        }?>      
                    </table>
              </section>
              </div>
          </div>
          
  <!-- ----------------Registrar empresa-------------------------------------------------------------------------- -->          
          
  <div id="div_contacto"> 
    <div id="form-empresa" class="well">                                                
      <section id="tables">

          <legend>Empresa</legend>
                    <form  class="form-horizontal" id="contacto" name="contacto" action="reg_empresa.php" method="post" onsubmit="return validar(this);">
                    <fieldset> 
                    <table>

                    <!-- Rut -->
                    <div class="control-group">
                    <label class="control-label" for="inputRut">Rut</label>
                    <div class="controls">
                    <input type="text" name="rut" size="25" required placeholder="Rut">
                    </div>
                    </div>

                    <!-- Nombre Empresa -->
                    <div class="control-group">
                    <label class="control-label" for="inputEmpresa">Nombre Empresa</label>
                    <div class="controls">
                    <input  type="text" name="nombre" size="25" required placeholder="Nombre Empresa">  
                    </div>
                    </div>

                    <!-- Direccion -->
                    <div class="control-group">
                    <label class="control-label" for="inputDir">Dirección</label>
                    <div class="controls">
                    <input type="text" name="direccion" size="25" required placeholder="Dirección">
                    </div>
                    </div>

                    <!-- ciudad -->
                    <div class="control-group">
                    <label class="control-label" for="inputCiudad">Ciudad</label>
                    <div class="controls">
                    <input type="text" name="ciudad" size="25" required placeholder="Ciudad">
                    </div>
                    </div>

                    <!-- telefono -->
                    <div class="control-group">
                    <label class="control-label" for="inputFono">Teléfono</label>
                    <div class="controls">
                    <input type="text" name="telefono" size="25" required placeholder="Teléfono">
                    </div>
                    </div>

                    <!-- Email -->
                    <div class="control-group">
                    <label class="control-label" for="inputMail">Correo Electronico</label>
                    <div class="controls">
                    <input type="text" name="email" size="25" required placeholder="Correo Electronico">
                    </div>
                    </div>

                    <!-- Valor por Atraso -->
                    <div class="control-group">
                    <label class="control-label" for="inputAtraso">Valor Atraso</label>
                    <div class="controls">
                    <input type="text" value="0" name="atraso" size="25" required placeholder="Valor Minuto Atraso">
                    </div>
                    </div>

                    <!-- Valor por Adelanto -->
                    <div class="control-group">
                    <label class="control-label" for="inputAdelanto">Valor Adelanto</label>
                    <div class="controls">
                    <input type="text" value="0" name="adelanto" size="25" required placeholder="Valor Minuto Adelanto">
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

        
  <!-- ----------------------------------- Eliminar --------------------------------- -->
    
    <div id="div_estetica">
            <div class='well'>
              <section id='tables'>
                  <legend>Empresa</legend>
                  <form action ='borrar_empresa.php' method='post'>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th>Seleccionar</th>
                          <th>Rut</th>
                          <th>Empresa</th>
                          <th>Direccion</th>
                          <th>Telefono</th>
                          <th>Email</th>
                          <th>Ciudad</th>
                          <!--<th>Multa Atraso</th>
                          <th>Multa Adelanto</th>-->                 
                        </tr>
                      </thead>
                      <?php
                      include("../conexiones/conexion.php");
                        $nbrow=0; 
                        $cont = 0; //Para el checkbox 
                        $result = @mysql_query("SELECT * FROM empresa");
                        while($row=@mysql_fetch_array($result)){
                          $nbrow++;
                          $cont++;
                          $id=$row["rut_empresa"];
                          $nombre =$row["nombre_empresa"];
                          $direccion = $row["dir_empresa"];
                          $tel =$row["tel_empresa"];
                          $email =$row["email_empresa"];
                          $ciudad =$row["ciudad_empresa"];
                         // $multa_atraso=$row["valor_atraso"];
                          //$multa_adelanto=$row["valor_adelanto"];                        
                        ?>
                      <tbody>
                        <th>
                          <center><input type="checkbox" name="delete[]" value="<?php echo $id ?>"></center>
                        </th>
                        <?php
                          print "<th> $id</th>";
                          print "<th> $nombre</th>";
                          print "<th> $direccion</th>";
                          print "<th> $tel</th>";
                          print "<th> $email</th>";
                          print "<th> $ciudad</th>";
                          //print "<th> $multa_atraso</th>";
                          //print "<th> $multa_adelanto</th>";
                        }?>
                      </tbody>
                    </table>
                    <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
                  </form>
              </section>
            </div>
          </div>

    <!-- -------------------Fin----------------------------------------------------------------------- -->          

                </div><!--/span9-->
            </div><!--/row-fluid-->
        </div><!--/container-fluid-->
</div> <!--container id='general'-->
<?php include("../include/footer.htm"); ?>
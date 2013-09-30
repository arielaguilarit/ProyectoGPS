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
               // echo "<li><a href='../home/home.php'>Home</a></li>";
                echo "<li><a href='../ingresoEmpresa/ingreso_empresa.php'>Empresa</a></li>";
                echo "<li class='active'><a href='ingresousuario.php'>Usuario</a></li>";
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
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registros Usuarios</a></li>
              <li id="li_contacto"><a href="<?php print("javascript:display_contacto();");?>">Ingresar Usuarios</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar Usuarios</a></li>

            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
  
<!-- --------------------------------- Modificar ------------------------------------>
        <div id="div_info">
            <div class="well">
            <section id="tables">
            <Legend>Usuarios</Legend>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                      <thead>
                          <tr>
                          <th>Estado</th>
                          <th>Rut</th>
                          <th>Nombre</th>
                          <th>Privilegio</th>
                          <th>Empresa</th>
                          <th>Modificar</th>
                          <th>Detalle</th>
                          </tr>
                      </thead>
                      <?php
                      require("../conexiones/connect_db.php");
                      $re= @mysql_query("SELECT * from usuario,empresa where usuario.rut_empresa = empresa.rut_empresa");
                      while($f= @mysql_fetch_array($re)){
                      //  echo'<option value='.$f[id_ciudad].'>'.$f[NombreCiudad].'</option>'; where nombre_compania LIKE '%$nombre%
                      if($f["estado"]=="1")
                      {
                        $state="label label-success";
                        $valor="ACTIVO";
                      }else
                      {
                        $state="label label-important";
                        $valor="INACTIVO";
                      }
                      
                     
                      if($f["privilegio"]=="1")
                      {
                          $priv="administrador";
                      }
                      else if($f["privilegio"]=="2")
                      {
                          $priv="operador";
                      }
                      else if($f["privilegio"]=="3")
                      {
                          $priv="usuario";
                      }
                      else if($f["privilegio"]=="4")
                      {
                          $priv="digitador";
                      }
                      echo '<tbody>';
                      echo '<th><span class="'.$state.'">'.$valor.'</span></th>';
                      echo '<th>'.$f["rut_usuario"].'</th>';
                      echo '<th>'.$f["nombre_usuario"].'</th>';
                      echo '<th>'.$priv.'</th>';
                      echo '<th>'.$f["nombre_empresa"].'</th>';
                      ?>
                      <td><a id="modal"  class="fancy" href="actual_usuario.php?variable=<?php echo $f['rut_usuario'];?>"  data-width="900" data-height="500">
                      <button class="btn btn-mini btn-success" type="button">Modificar</button></td>
                      <td><a id="modal"  class="fancy" href="detalle_usuario.php?variable=<?php echo $f['rut_usuario'];?>"  data-width="900" data-height="500">
                      <button class="btn btn-mini btn-info" type="button">Detalle</button></td>
                      <?php
                      echo '</tbody>';
                      }?>      
                  </table>
            </section>
            </div>
        </div>
<!-- ----------------PROYECTOS-------------------------------------------------------------------------- -->          
        
        <div id="div_contacto"> 
          <div id="form-empresa" class="well">                                                
            <section id="tables">

                <legend>Usuarios</legend>
                  <form  class="form-horizontal" id="contacto" name="contacto" action="reg_usuario.php" method="post" onsubmit="return validar(this);">
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
                  <label class="control-label" for="inputEmpresa">Nombre Usuario</label>
                  <div class="controls">
                  <input  type="text" name="nombre" size="25" required placeholder="Nombre Usuario">  
                  </div>
                  </div>

                  <!-- COntraseña -->
                  <div class="control-group">
                  <label class="control-label" for="inputPassword">Contraseña</label>
                  <div class="controls">
                  <input type="password" name="clave" size="25" required placeholder="Contraseña">
                  </div>
                  </div>

                  <!-- Direccion-->
                  <div class="control-group">
                  <label class="control-label" for="inputDir">Dirección</label>
                  <div class="controls">
                  <input type="text" name="direccion" size="25" required placeholder="Dirección">
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

                  <!-- privilegio -->
                  <div class="control-group">
                  <label class="control-label" for="inputPriv">Privilegio</label>
                  <div class="controls">
                  <select name="priv">
                  <option value="1">Administrador</option>
                  <option value="2">Operador</option>
                  <option value="3">Usuario</option>
                  </select>
                  </div>
                  </div>

                  <!-- Estado -->
                  <div class="control-group">
                  <label class="control-label" for="inputEst">Estado</label>
                  <div class="controls">
                  <select name="estad">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                  </select>
                  </div>
                  </div>
                  
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
                <legend>Usuarios</legend>
                <form action ='borrar_usuario.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
                    <thead>
                      <tr>
                        <th>Seleccionar</th>
                        <th>Estado</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Privilegio</th>
                        <th>Empresa</th>
                      </tr>
                    </thead>
                    <?php
                    include("../conexiones/conexion.php");
                      //$nbrow=0; 
                      //$cont = 0; //Para el checkbox 
                      $result = @mysql_query("SELECT * from usuario,empresa where usuario.rut_empresa = empresa.rut_empresa");
                      while($f=@mysql_fetch_array($result))
                      {    
                      echo '<tbody>';
                     ?>
                       <th>
                        <center><input type="checkbox" name="delete[]" value="<?php echo $f["rut_usuario"] ?>"></center>
                      </th>
                     <?php
                      if($f["estado"]=="1"){
                        $state="label label-success";
                        $valor="ACTIVO";
                      }else{
                        $state="label label-important";
                        $valor="INACTIVO";
                      }
                      if($f["privilegio"]=="1")
                      {
                          $priv="administrador";
                      }
                      else if($f["privilegio"]=="2")
                      {
                          $priv="operador";
                      }
                      else if($f["privilegio"]=="3")
                      {
                          $priv="usuario";
                      }
                      
                      echo '<th><span class="'.$state.'">'.$valor.'</span></th>';
                      echo '<th>'.$f["rut_usuario"].'</th>';
                      echo '<th>'.$f["nombre_usuario"].'</th>';
                      echo '<th>'.$priv.'</th>';
                      echo '<th>'.$f["nombre_empresa"].'</th>';                  
                      echo '</tbody>';
                      }?>
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
</div>         
    <?php include("../include/footer.htm"); ?>
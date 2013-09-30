<?php
session_start();
if(!$_SESSION || $_SESSION["privilegio"]=="1"){
  echo '<script languaje= javascript>
    alert("Usuario no autetificado");
    self.location = "../index.htm" ;
    </script>';
}
?>
<?php include("../include/head.htm"); ?>
<?php include("../include/css/estilo.css"); ?>

<title> GPS </title>

<div class="masthead">
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav">
          <?php
            if($_SESSION["privilegio"]=="2"){
              echo "<li><a href='../home/home.php'>Home</a></li>";
              echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
              echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
              echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turno</a></li>";
              echo "<li class='active'><a href='perfil.php'>Perfil</a></li>";
            }else if($_SESSION["privilegio"]=="3"){
              echo "<li><a href='../home/home.php'>Home</a></li>";
              echo "<li class='active'><a href='perfil.php'>Perfil</a></li>";
            }elseif ($_SESSION["privilegio"]=="4") {
                    echo "<li><a href='../home/home.php'>Home</a></li>";
                    echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                    echo "<li class='active'><a href='perfil.php'>Perfil</a></li>";
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
              <li class="nav-header">Indice</li>
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Cambiar Contrasena</a></li>              
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

<!-- ----------------PROYECTOS-------------------------------------------------------------------------- -->
        
<div id="div_info"> 
  <div id="form-empresa" class="well">                                                
    <section id="tables">

        <legend>Cambio Contraseña</legend>
                  <form  class="form-horizontal" id="contacto" name="contacto" action="act_contrasena.php" method="post" onsubmit="return validar(this);">
                  <fieldset> 
                  <table>

                  <!-- COntraseña -->
                  <div class="control-group">
                  <label class="control-label" for="inputPassword">Contraseña Actual</label>
                  <div class="controls">
                  <input type="password" name="passActual" size="25" required placeholder="Contraseña">
                  </div>
                  </div>
                  <!-- COntraseña -->
                  <div class="control-group">
                  <label class="control-label" for="inputPassword">Nueva Contraseña</label>
                  <div class="controls">
                  <input type="password" name="passNuevo" size="25" required placeholder="Contraseña">
                  </div>
                  </div>

                  <!-- repetirCotraseña -->
                  <div class="control-group">
                  <label class="control-label" for="inputPassword2">Repetir Contraseña</label>
                  <div class="controls">
                  <input type="password" name="passRep" size="25" required placeholder="Repetir Contraseña">
                  </div>
                  </div>

                  <tr>
                  <td><input class="btn btn-success" type="submit" value="Confirmar"></td>
                  </tr>
                  </table> 
                  </fieldset>  
                  </form>
                  </section>
     </div>                      
</div>

  <!-- -------------------Fin----------------------------------------------------------------------- -->          

              </div><!--/span9-->
          </div><!--/row-fluid-->
      </div><!--/container-fluid-->
    <?php include("../include/footer.htm"); ?>
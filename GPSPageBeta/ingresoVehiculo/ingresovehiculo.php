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
              echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
              echo "<li class='active'><a href='ingresovehiculo.php'>Vehiculos</a></li>";
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
              <li class="active" id="li_info"><a href="<?php print("javascript:display_informacion();");?>">Registro Vehiculos</a></li>
              <li id="li_productos"><a href="<?php print("javascript:display_productos();");?>">Ingresar Vehiculos</a></li>
              <li id="li_estetica"><a href="<?php print("javascript:display_estetica();");?>">Eliminar Vehiculo</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="span9">
    
  <!-- -------------------------------------- Registro Vehiculos ---------------------------------------- -->

        <div id="div_info">
          <div id="form-empresa" class="well">
            <section id="tables">
            <legend>Vehiculos</legend>
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Patente</th>
                    <th>Identificador</th>
                    <th>Empresa</th>
                    <th>Dispositivo</th>
                    <th>Modificar</th>
                    <th>Detalle</th>
                  </tr>
                </thead>
              <?php
              require("../conexiones/connect_db.php");
              $f=array();
              $g=array();
              $vehiculos = @mysql_query("SELECT * from vehiculo, empresa where id_empresa = rut_empresa")or die ("problema con query porque :".mysql_error());
              $asociados = @mysql_query("SELECT patente_veh, imei_dispositivo from asociado")or die ("problema con query porque :".mysql_error());
              while($v = @mysql_fetch_array($vehiculos))
              {
                $f[]=$v;
              }
              while($a = @mysql_fetch_array($asociados))
              {
                $g[]=$a;
              }
              for($i = 0;$i < count($f);$i++)
              {
                echo '<tbody>';
                echo '<th>'.$f[$i]["patente"].'</th>';
                echo '<th>'.$f[$i]["id_unico"].'</th>';
                echo '<th>'.$f[$i]["nombre_empresa"].'</th>';
                $entro=false;
                for($j=0;$j<count($g);$j++)
                {
                  if($f[$i]["patente"]==$g[$j]["patente_veh"])
                  {
                    echo '<th>'.$g[$j]["imei_dispositivo"].'</th>';
                    $entro=true;
                    ?>
                    <td><a id="modal" class="fancy" href="actual_vehiculo.php?id_vehiculo=<?php echo $f[$i]['id_vehiculo'];?>&imei_disp=<?php echo $g[$j]["imei_dispositivo"];?>" data-width="900" data-height="500">
                    <button class="btn btn-mini btn-success" type="button">Modificar</button></a></td>
                    <td><a id="modal"  class="fancy" href="detalle_vehiculo.php?patente=<?php echo $f[$i]['patente'];?>&imei_disp=<?php echo $g[$j]["imei_dispositivo"];?>"  data-width="900" data-height="500">
                    <button class="btn btn-mini btn-info" type="button">Detalle</button></td>
                    <?php
                  }  
                }
                if($entro==false)
                {
                  echo '<th></th>';
                  ?>
                  <td><a id="modal" class="fancy" href="actual_vehiculo.php?id_vehiculo=<?php echo $f[$i]['id_vehiculo'];?>&imei_disp=''" data-width="900" data-height="500">
                  <button class="btn btn-mini btn-success" type="button">Modificar</button></a></td>
                  <td><a id="modal"  class="fancy" href="detalle_vehiculo.php?patente=<?php echo $f['patente'];?>&imei_disp=''"  data-width="900" data-height="500">
                  <button class="btn btn-mini btn-info" type="button">Detalle</button></td>
                  <?php
                }
                echo '</tbody>';
              }
              ?>       
            </table>
          </section>
        </div>
        </div>

  <!-- ---------------------------------- Ingreso Vehiculos ---------------------------------------------- -->

        <div id="div_productos"> 
        <div id="form-productos" class="well">                                                
        <section id="tables">
            <legend>Vehiculos</legend>
            <form  class="form-horizontal" id="contacto" name="contacto" action="reg_vehiculo.php" method="post" onsubmit="return validar(this);">
              <fieldset>
                <table>

                    <!-- Patente -->
                    <div class="control-group">
                    <label class="control-label" for="inputPatente">Patente</label>
                    <div class="controls">
                    <input type="text" name="patente" size="25" placeholder="Patente" required>
                    </div>
                    </div>

                    <!-- Id Unico -->
                    <div class="control-group">
                    <label class="control-label" for="inputIdUnico">Identificador</label>
                    <div class="controls">
                    <input  type="text"  name="id_unico" size="25" placeholder="Identificador" required>  
                    </div>
                    </div>

                    <!-- Chofer -->
                    <div class="control-group">
                    <label class="control-label" for="inputChofer">Nombre Conductor</label>
                    <div class="controls">
                    <input  type="text" name="chofer" size="25" placeholder="Conductor del vehiculo" required>
                    </div>
                    </div>

                     <!-- Nombre Empresa -->
                    <div class="control-group">
                    <label class="control-label" for="inputNomRuta">Nombre Empresa</label>
                    <div class="controls">
                    <select name="empresa" id="empresa" required>
                      <option value="---">---</option>
                        <?php
                        //require("../conexiones/connect_db.php");
                        $result= @mysql_query("select rut_empresa, nombre_empresa from empresa");
                        //el @ sirve para que no salga ese mensaje de NOTICE al momento de ejecutar por 1ra ve nuestro codigo.
                        while ($row=@mysql_fetch_array($result))
                        {
                            echo'<option value='.$row["rut_empresa"].'>'.$row["nombre_empresa"].'</option>';
                        }
                        ?>
                    </select>
                    </div>
                    </div>

                    <!-- Nombre Empresario -->       
                    <div class="control-group">
                    <label class="control-label" for="inputEmp">Nombre Empresario</label>
                    <div class="controls">
                    <select name="nom_empre" id="nom_empresario">
                    <option value="---">---</option>
                    </select>
                    <!--<input  type="text" name="nom_empre" size="25" placeholder="Nombre Empresario" required>-->
                    </div>
                    </div>

                    <!-- Rut Empresario -->
                    <div class="control-group">
                    <label class="control-label" for="inputRutEmp">Rut Empresario</label>
                    <div class="controls">
                    <select name="rut_empre" id="rut_empresario">
                    <option value="---">---</option>
                    </select>
                    <!--<input  type="text" name="rut_empre" size="25" placeholder="Rut Empresario" required>-->
                    </div>
                    </div>

                    <!-- Tipo -->
                    <div class="control-group">
                    <label class="control-label" for="inputTipo">Tipo de Vehiculo</label>
                    <div class="controls">
                    <input type="text" name="tipo_vehiculo" size="25" placeholder="Tipo de Vehiculo" required>
                    </div>
                    </div>

                    <!-- Marca -->
                    <div class="control-group">
                    <label class="control-label" for="inputMarcaVeh">Marca del Vehiculo</label>
                    <div class="controls">
                    <input type="text" name="marca_vehiculo" size="25"  placeholder="Marca del Vehiculo" required>
                    </div>
                    </div>

                   

                    <!-- Imei Dispositivo -->
                    <div class="control-group">
                    <label class="control-label" for="inputImeiDisp">Dispositivo</label>
                    <div class="controls">
                    <select name="imei_disp">
                      <option value='NULL'>...</option>
                      <?php
                      $result= @mysql_query("select imei, nom_dispositivo from dispositivo where est_disp='2'");
                      while ($row=@mysql_fetch_array($result))
                      {
                        echo'<option value='.$row["imei"].'>'.$row["nom_dispositivo"].'</option>';
                      }?>
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

<!-- ------------------------------------ Eliminar Dispositivos ------------------------------------ -->

        <div id="div_estetica">
             <div class="well">
                 <section id="tables">
                 <legend>Eliminar Vehiculo</legend> 
                 <form action ='borrar_veh.php' method='post'>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">

                    <?php 
                    //require("../conexiones/connect_db.php");
                    $f=array();
                    $g=array();
                    $vehiculos= @mysql_query("SELECT * from vehiculo, empresa where id_empresa = rut_empresa")or die ("problema con query porque :".mysql_error());
                    $asociados= @mysql_query("SELECT * from asociado")or die ("problema con query porque :".mysql_error());
                    while($v=@mysql_fetch_array($vehiculos))
                    {
                        $f[]=$v;
                    }
                    while($a= @mysql_fetch_array($asociados))
                    {
                         $g[]=$a; 
                    }
                    //require("../conexiones/connect_db.php");
                    //$db=mysql_connect('localhost','root','020787')or die ("error connexion base"); 
                    //$base=mysql_select_db('servidor',$db)or die ("error connect database"); 
                    //$nbrow=0; 
                    //$cont = 0; //Para el checkbox 
                   // print "<form action ='borrar_veh.php' method='post'>";
                    echo "<thead>
                            <tr>
                            <th>Seleccionar</th>
                            <th>Patente</th>
                            <th>id.MAQ</th>
                             <th>Empresario</th>
                            <th>Empresa</th>
                            <th>Dispositivo</th>
                            </thead>";
                    //$patente="";

                    for($i=0;$i<count($f);$i++)
                    {
                        echo '<tbody>';
                        print "<th><center><input type=\"checkbox\" name=\"delete[]\" value=\"".$f[$i]["patente"]."\"></font></font></div></center></th>"; 
                        echo '<th>'.$f[$i]["patente"].'</th>';
                        echo '<th>'.$f[$i]["id_unico"].'</th>';
                        echo '<th>'.$f[$i]["rut_empresario"].'</th>';
                        echo '<th>'.$f[$i]["nombre_empresario"].'</th>';
                        $entro=false;
                        for($j=0;$j<count($g);$j++)
                        {
                            if($f[$i]["patente"]==$g[$j]["patente_veh"])
                            {
                               echo '<th>'.$g[$j]["imei_dispositivo"].'</th>';
                               $entro=true;
                            }             
                        }
                        if($entro==false)
                        {
                            echo '<th></th>';
                        }
                        echo '</tbody>';
                    }
                    //print "</form> \n"; 
                    //print "</table>\n";
                    //print "<input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'> \n";
                    ?>
                  </table>
                <input  class='btn btn-danger' type='submit' name='borrar' value='Borrar'>
              </form>   
            </section>
          </div>
        </div>
  <!-- --------------------Fin ---------------------------------------------->

        <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
        <script language="JavaScript" type="text/JavaScript">
            $(document).ready(function(){
              //alert("Hola mundo");
                $("#empresa").change(function(event){
                    var id = $("#empresa").find(':selected').val();
                    $("#nom_empresario").load('select_empresario.php?id='+id);
                });

                 $("#nom_empresario").change(function(event){
                    var id = $("#nom_empresario").find(':selected').val();
                    $("#rut_empresario").load('select_rut.php?id='+id);
                });
            });
        </script>
        </div><!--/span9-->
      </div><!--/row-fluid-->
    </div><!--/container-fluid-->
  </div>
<?php include("../include/footer.htm"); ?>
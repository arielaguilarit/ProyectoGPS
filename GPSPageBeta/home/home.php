<?php
session_start();
if(!$_SESSION){
  echo '<script languaje= javascript>
    alert("Usuario no autetificado");
    self.location = "../index.htm" ;
    </script>';
}
?>
<!DOCTYPE html>
<!-- saved from url=(0062)http://twitter.github.io/bootstrap/examples/justified-nav.html -->
<html lang="en">
  <head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Bootstrap -->
  <script src="../bootstrap/js/funciones_nueva_pagina.js"></script>  
  <link href="../bootstrap/css/bootstrapp.css" rel="stylesheet">
  <!-- FancyBox librerias -->
  <script lang="javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css" />

  <!-- Icono Pestaña -->
  <link href="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/16/Map-Marker-Marker-Outside-Azure-icon.png" type="image/x-icon" rel="shortcut icon">
  <!-- HTML5 shim, para que IE6-8 soporte elementos HTML5 -->
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <title> GPS </title>
  </head>
  
  <body>
      <!-- Docs master nav -->
  
  <!--<img src="../bootstrap/img/cabecera.png" class="bg"/>
    <!--  Ejecuta la Aplicacion Fancybox -->
    <script type="text/javascript"> 
      $(document).ready(function(){
      //Fancy es el nombre de la class
        $(".fancy").fancybox({
          'autoScale': false,
          'transitionIn': 'none',
          'transitionOut': 'none',
          'width': 500,
          'height': 800,
          'type': 'iframe',
          'onClosed': function(){ 
            parent.location.reload(true);
          }
        });
      });
    </script>
    <!--<div class="container">-->
      
    <?php include("../include/head.htm"); ?>
    <?php include("../include/css/estilo.css"); ?>
      <div class="container" id="general">
           <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                  <?php
                    if($_SESSION["privilegio"]=="1"){
                      //echo "<li class='active'><a href='home.php'>Home</a></li>";
                      echo "<li><a href='../ingresoEmpresa/ingreso_empresa.php'>Empresa</a></li>";
                      echo "<li><a href='../ingresoUsuario/ingresousuario.php'>Usuario</a></li>";
                      echo "<li><a href='../ingresoDispositivo/ingresodispositivo.php'>Dispositivos</a></li>";
                      echo "<li><a href='../ingresoVehiculo/ingresovehiculo.php'>Vehiculos</a></li>";
                      echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                      echo "<li><a href='../ingresoRutacontrol/ingresocontrol.php'>Controles</a></li>";
                      echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                    }else if($_SESSION["privilegio"]=="2"){
                      //echo "<li class='active'><a href='home.php'>Home</a></li>";
                      echo "<li><a href='../ingresoRuta/ingresoruta.php'>Rutas</a></li>";
                      echo "<li><a href='../ingresoRutaControl/ingresocontrol.php'>Controles</a></li>";
                      echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                      echo "<li><a href='perfil.php'>Perfil</a></li>";
                    }elseif ($_SESSION["privilegio"]=="3") {
                      //echo "<li class='active'><a href='../home/home.php'>Home</a></li>";
                      echo "<li><a href='perfil.php'>Perfil</a></li>";
                    }elseif ($_SESSION["privilegio"]=="4") {
                      //echo "<li class='active'><a href='../home/home.php'>Home</a></li>";
                      echo "<li><a href='../ingresoRecorrido/ingresorecorrido.php'>Turnos</a></li>";
                      echo "<li><a href='perfil.php'>Perfil</a></li>";
                    }
                  ?>
                </ul>
          </div><!-- /.navbar -->
        </div>

      <!-- Jumbotron -->
        <div class="jumbotron">
            <h2>Ingreso al Sistema</h2>
            <hr>
            <p class="lead"></p>
            <img src="mapa.png">
            <br></br>
            <?php
            if($_SESSION["privilegio"]!="4")
            {?>
              <a class="btn btn-large btn-primary" href="../Trayecto/portada.php"><i class="icon-search"></i> Monitoreo</a>
            <?php
            }
            ?>
            
        </div>
      </div>

    <?php include("../include/footer.htm"); ?>
    </body>
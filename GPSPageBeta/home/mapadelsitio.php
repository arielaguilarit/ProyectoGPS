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
      <div class="container row" id="general">
           <div class="navbar">
            <div class="navbar-inner" a>
           
              <legend><h4 style"background-color: #4B6EAB;" align="center">MAPA DEL SITIO</h4></legend>
            
            <div class="row">
              <div class="span4 offset3">
                <h5><a href="home.php" style="color:#084B8A">Home</a> </h2>
                <h5><a href="../ingresoEmpresa/ingreso_empresa.php" style="color:#084B8A">&raquo; Empresas </a></h5>
                <h5><a href="../ingresoUsuario/ingresousuario.php" style="color:#084B8A">&raquo; Usuario</a></h5>
                <h5><a href="../ingresoDispositivo/ingresodispositivo.php" style="color:#084B8A">&raquo; Dispositivos</a></h5>
                <h5><a href="../ingresoVehiculo/ingresoVehiculo.php" style="color:#084B8A">&raquo; Vehiculos</a></h5>
                <h5><a href="../ingresoRuta/ingresoruta.php" style="color:#084B8A">&raquo; Ruta</a></h5>
                <h5><a href="../ingresoRutaControl/ingresocontrol.php" style="color:#084B8A">&raquo; Controles</a></h5>
                <h5><a href="../ingresoRecorrido/ingresorecorrido.php" style="color:#084B8A">&raquo; Turnos</a></h5>
              </div>
              <div class="span2">
                <h5><a href="../Trayecto/portada.php" style="color:#084B8A">Monitoreo</a> </h2>
                <h5><a href="../Trayecto/portada.php" style="color:#084B8A">&raquo; Trayecto </a></h5>
                <h5><a href="../posicionActual/frameActual.php" style="color:#084B8A">&raquo; Posicion Actual </a></h5>
                <h5><a href="../Reportes/frameReportes.php" style="color:#084B8A">&raquo; Rutas</a></h5>
              </div>    
            </div>        
          </div><!-- /.navbar -->
        </div>
      </div><!-- container -->

    <?php include("../include/footer.htm"); ?>
    </body>
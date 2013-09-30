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
            <div class="navbar-inner" align="center">
                
                <h4>¿Cómo la solicito?</h4>
                <li>Solicítala en el Mesón de Atención Clientes.</li>
                <li>Llamar a soporte al fono:09 XXXXXXXX.</li>
                <li>Envie un correo a asdsad@correo.cl.</li> 
                <br><br>
                Para mayor información, llámanos al (600) 999 999 las 24 horas los 7 días de la semana.
                
          </div><!-- /.navbar -->
        </div>
      </div><!-- container -->

    <?php include("../include/footer.htm"); ?>
    </body>
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
              <div class="row-fluid">
                <div class="container">
                  <div class="span12">
                   <legend><h4 align="center">CONTACTENOS</h4></legend>
                  </div>
                
                  <p>
                    <ul>
                      Para encontrar rápidamente respuestas a sus preguntas, hemos recopilado esta lista de información de contacto y recursos comunes para señalarle en la dirección correcta.
                      <h6><a href="#">&raquo;Guia de Introduccion</a></h6>
                      <h6><a href="#">&raquo;Preguntas Frecuentes</a></h6>
                      <h6><a href="#">&raquo;Guia y tips</a></h6>
                      <h6><a href="#">&raquo;Soporte y facturacion</a></h6>
                    </ul>
                  </p>
                </div>
              </div>
              <br/>
               <legend><h4 align="center">Contacto</h4></legend>
              <ul>
                <p>Para obtener asistencia, facturación, o cualquier otro problema contactenose a nuestros telefonos.</p>

                <p><a href="email@correo.com">email@correo.com</a>: Para denunciar una violación o cualquier otros abusos de nuestros servicios.</p>

                <p>Comentarios / Sugerencias / Preguntas sobre el sitio Web. Si usted tiene una pregunta o problema con nuestro servicio, por favor utilice la linea de soporte. Respuestas de apoyo de producto se retrasará si se envían a esta dirección.</p>
              </ul>
              <br>
              <legend><h4 align="center">Direccion</h4></legend>
              <p>
              <ul>
                COPROMA<br>
                c/o DOMINIO.com<br>
                3 ORIENTE<br>
                TALCA, #980<br>
                CHILE<br>
                Calle Tres Oriente 980 Talca, Maule Region, Chile
                <a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=escuela+de+conductores+profesionales+del+Maule+Chile+&sll=-35.428959,-71.663457&sspn=0.016634,0.062399&ie=UTF8&hq=&hnear=escuela+de+conductores+profesionales+del+maule+&z=15">Ver Map</a>
                </ul>
              </p>
              <br>
                <legend><h4  align="center">Telefonos</h4></legend>
                <p class="para44">
                  <ul>
                  (09) 99643376 <BR>
                  <br>
                  horario de atencion: 6:30am - 6:00pm hora del Pacifico, Lunes-Viernes <br>
                  </BR>
                  <small>Por favor consulte nuestra Guía de Introducción antes de contactar con nosotros. Si aún necesita ayuda, por favor deje un mensaje o comuniquese con soporte si llama fuera del horario laboral.</small>
                  </BR>
                  </ul>
                </p>
             
            
            
          </div>   
          </div><!-- /.navbar -->
        </div>
      </div><!-- container -->



    <?php include("../include/footer.htm"); ?>
    </body>
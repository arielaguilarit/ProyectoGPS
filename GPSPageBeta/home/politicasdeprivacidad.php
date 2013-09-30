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
        <div class="row-fluid">
                
                  <div class="span12">
                   <legend><h4 align="center">POLITICAS DE PRIVACIDAD</h4></legend>
                  </div>
                
                 <p class="para2">No-IP.com ha redactado este documento, que detalla cómo recopilar y difundir información, en un esfuerzo para demostrar nuestro firme compromiso con la privacidad en línea. Por favor, póngase en contacto con nosotros si tiene alguna pregunta sobre nuestra política de privacidad.</p>
  
                  <p class="para1 tosp"><em>No divulgamos DATOS PERSONALES A TERCEROS NO AFILIADOS</em></p>
                  
                  <p class="para2">Excepto por lo descrito en esta Política, No-IP.com no revela datos personales de clientes, incluyendo direcciones de correo electrónico, a terceras partes no afiliadas. Nosotros recogemos, utilizamos, y permitimos a nuestros afiliados y socios de usar, los datos del cliente para varios propósitos, que se discuten en detalle más adelante.</p>
                  
                  <h3>¿Cómo recopilamos y utilizamos la información?</h3>
                  
                  <p class="para1 tosp"><em>INFORMACIÓN DE REGISTRO</em></p>
                  
                  <p class="para2">Área de registro de nuestro sitio requiere que los clientes para proporcionar información de contacto, como el nombre y dirección de correo electrónico e información demográfica, como su código postal, edad o nivel de ingresos. Utilizamos esta información para enviarle materiales de promoción de nuestra empresa y de algunos de nuestros socios. Sin embargo, los usuarios pueden optar por no - o optar por - estos mensajes promocionales de correo electrónico en cualquier momento. (Ver Opt Out / opt in, a continuación.)</p>
                  
                  <p class="para1 tosp"><em>INFORMACIÓN DEMOGRÁFICA</em></p>
                  
                  <p class="para2">También recopilamos datos demográficos y el perfil que usamos para adaptar su experiencia en No-IP.com. Basándose en esta información, se muestra productos y contenidos que sentimos que pueden interesarle.</p>
                  
                  <p class="para1 tosp"><em>INFORMACIÓN ENCUESTA ONLINE</em></p>
                  
                  <p class="para2">Cuando usted realiza un pedido, No-IP.com solicitudes de información, tales como información de contacto, número de tarjeta de crédito y la información demográfica. La información de contacto que usted proporciona se utiliza para enviar los pedidos, información de la compañía y material promocional de nuestros socios. Usted puede optar por u optar en cualquier momento. (Ver Opt Out / Opt In, a continuación.) La información financiera se utiliza con el único propósito de que la facturación de productos y servicios. Los datos demográficos se recopilan para personalizar las visitas futuras al mostrar el contenido que sentimos que le interesen más.</p>
                  
                  <p class="para1 tosp"><em>INFORMACIÓN RECOGIDA EN CONCURSOS</em></p>
                  
                  <p class="para2">Para participar en nuestros concursos, se le solicitará que proporcione información de contacto y demográfica. No-IP.com utiliza estos datos para enviarle información acerca de la compañía. Podemos utilizar esta información para comunicarnos con usted en caso necesario. Sin embargo, tiene la opción de, o optar por nuestro Boletin en cualquier momento. (Ver Opt Out / Opt In, a continuación.) Los datos demográficos y el perfil se recoge en nuestro sitio y se utilizan para personalizar las visitas futuras al mostrar el contenido que cree que más te interese.</p>               
                  
                  <p class="para1 tosp"><em>Dirección IP y la actividad de los usuarios</em></p>
                  
                  <p class="para2">Nosotros, o de terceros que prestan servicios en nuestro nombre, recogemos direcciones IP, datos de registro, y otra información relacionada con la forma en acceso y uso de nuestro sitio y servicios. Esta información puede ser utilizada por varias razones, entre ellas para ofrecer nuestros servicios a usted, para procesar sus solicitudes u órdenes, para ayudar a diagnosticar problemas con nuestro servidor, para administrar nuestra página web, para ayudar a identificar a usted oa su carrito de compras, para recopilar demográfica información para investigar, prevenir o tomar medidas contra violaciónes reales o sospechosos de esta Política de Privacidad o los Términos de Uso, por otros motivos de seguridad, y para otros fines que se describen en esta Política de Privacidad. </p> 
          </div><!-- /.navbar -->
        </div>
      </div><!-- container -->



    <?php include("../include/footer.htm"); ?>
    </body>
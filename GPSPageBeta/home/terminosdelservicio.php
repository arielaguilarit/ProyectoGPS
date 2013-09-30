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
                   <legend><h4 align="center">TERMINOS DE LOS SERVICIOS</h4></legend>
                  </div>
                
                  <p class="para1 tosp"><em>1. Aceptacion de los terminos</em></p>

                  <p class="para2">COPROMA.com es un sitio Web basado en Internet que ofrece hospedaje de DNS, DNS dinámico, redirección de URL, email hosting, registro de dominios, la supervisión de servidores y utilidades de software (cada uno un "servicio" y colectivamente "Servicios"). Vitalwerks Internet Solutions, LLC, que opera bajo el No-IP.com, (en adelante, "No-IP.com" o "Vitalwerks"), proporciona los servicios sujetos a los términos y condiciones establecidos en los Términos de Servicio ("TOS" ). Al completar el proceso de registro y haciendo clic en el botón "aceptar", usted ("Cliente") está indicando su aceptación a estar obligado por todos los términos y condiciones de los TOS.</p>

                  <p class="para1 tosp"><em>2. USO DE LA INFORMACIÓN AL CLIENTE Y POLÍTICA DE PRIVACIDAD</em></p>

                  <p class="para2">Ninguna información personal identificable que usted proporciona a No-IP.com o información relativa a la forma en que usted usa No-IP.com será compartida por los No-IP, excepto según lo permitido por esta TOS. Al convertirse en un suscriptor, el usuario acepta que No-IP.com puede compartir con otros partidos tanto de la información agregada y la información individual limitada recopilada durante su uso del No-IP.com. "La información en conjunto" es información que describe los hábitos, patrones de uso y / o la demografía de los clientes como grupo, pero no indica la identidad de los clientes particulares. "La información individual" es información sobre un cliente se presenta en una forma distinguible de información relativa a otros clientes, pero no en una forma que permite que el destinatario para identificar cualquier cliente particular. Vea nuestra Política de Privacidad para obtener información completa sobre las políticas Vitalwerks 'con respecto a la información del cliente.</p>

                  <p class="para1 tosp"><em>3. PROPIEDAD DEL CONTENIDO DEL SITIO</em></p>

                  <p class="para2">Vitalwerks y / o de sus proveedores el propietario absoluto de todos los artículos, ilustraciones, programas, servicios, procesos, diseños, software, tecnologías, marcas, nombres comerciales, inventos, y los materiales que comprenden COPROMA.com.</p>


                  <p class="para1 tosp"><em>4. USO ACEPTABLE</em></p>

                  <ol class="para2" type=A>
                  <li>Cliente certifica que él o ella tiene al menos 18 años de edad.
                  <li>Cliente es el único responsable de su / su uso de los servicios. Cada cliente es responsable de asegurar que todos los usuarios autorizados de su sistema o red conozcan y sigan estas CDS. Uso del Cliente de los servicios está sujeta a, y el Cliente está de acuerdo en cumplir, todas las leyes locales, estatales, nacionales, y las leyes y reglamentos, como internacionales, pero no limitado a (1) la ley de EE.UU. con respecto a la transmisión de datos técnicos exportados desde los Estados Unidos y (2) las regulaciones de Internet, políticas y procedimientos.
                  <li>El cliente puede utilizar el Servicio para cualquier propósito legal, siempre y cuando él o ella no abuse o fraudulentamente usar el Servicio, (ii) usar el Servicio de una manera que interfiera o altere otro suscriptor o del uso del usuario autorizado de (i) los servicios no-ip, o (iii) cualquier otro uso del Servicio de manera que viole esta TOS. Los términos de esta TOS se aplican a cualquier aplicación o utilización de los servicios.
                  <li>Cliente para utilizar el servicio gratuito de No-IP para su uso personal.  
                  <li>Las actividades que caen dentro del alcance de C (i), (ii) o (iii) anterior incluyen, pero no se limitan a, lo siguiente:
                  <ul>
                    <li> transmisión de mensajes comerciales no solicitados (UCE)
                      <li> transmisión de correo electrónico masivo
                      <li> la publicación de artículos de Usenet granel
                      <li> Ataques de denegación de servicio de cualquier tipo
                      <li> infracción de derechos de autor
                      <li> no proporcionar información de contacto legítimo
                      <li> misrepresentation of No-IP's services
                  </ul>
                  </ol>


                  <p class="para1 tosp"><em>5. FINALIZACIÓN DE SERVICIO</em></p>

                  <p class="para2">No-IP.com puede suspender o cancelar su cuenta o derechos a servicios en cualquier momento el acceso, sin previo aviso, por conductas que no-IP.com cree razonablemente viole esta TOS o cualesquiera otras normas aplicables o guías que nadie tiene IP.com publicado en el Sitio Web No-IP.com. Además de restringir o cancelar el acceso del Cliente al Servicio, No-IP puede quitar cualquier material que tenemos motivos razonables para creer que están en violación de las leyes de copyright de los Estados Unidos o puede ser de otra manera ilegal, nos expone a ser pasivo o que violar esta TOS. No-IP también podrá cooperar con autoridades legales y / o terceros en la investigación de cualquier sospecha de actividad criminal.</p>

                  <p class="para1 tosp"><em>6. INDEMNIZACIÓN</em></p>

                  <p class="para2">Cliente se compromete a mantener No-IP.com indemne de cualquier reclamación, ya sea llevados por el Cliente o por un tercero, y gastos, incluyendo los honorarios razonables de abogados y costas judiciales, relacionados con o que surjan del incumplimiento por parte del Cliente o violación de cualquiera de los términos de este TOS, o de cualquier información, software o el contenido colocado por el Cliente en un servidor accesible a través de un servicio.</p>


                  <p class="para1 tosp"><em>7. ELECCIÓN DE LA LEY</em></p>

                  <p class="para2">Esta TOS se interpretarán y controlados por las leyes del estado de Nevada. Cualquier disputa que surja de los términos de esta TOS o el incumplimiento de esta TOS se regirá por las leyes de Nevada sin tener en cuenta los conflictos de principios legales de la misma, y ​​será llevada ante un tribunal estatal o federal en Nevada. Cliente se compromete a someterse a la jurisdicción personal de cualquiera de dichos tribunales.</p>


                  <p class="para1 tosp"><em>8. ACUERDO COMPLETO</em></p>

                  <p class="para2">Esta TOS constituyen el acuerdo completo entre las partes con respecto a la materia contenida en este documento y sustituye toda anteriores y contemporáneos acuerdos, propuestas y comunicaciones, escritos u orales entre los representantes no-IP.com y clientes. No-IP.com puede enmendar o modificar esta TOS o imponer nuevas condiciones en cualquier momento mediante notificación por escrito de no-IP.com al cliente, ya sea por correo electrónico o mediante la publicación en el sitio web No-IP.com. Cualquier uso del Servicio por parte del cliente después de dicha notificación se considerará como una aceptación por parte del cliente de tales enmiendas, modificaciones o nuevas condiciones.</p>
                   

                  <p class="para1 tosp"><em>9. NO REVENTA DE ESTE SERVICIO</em></p>

                  <p class="para2">Derecho del Cliente a utilizar el Servicio es personal para los clientes. El Cliente acepta no revender el servicio sin el consentimiento expreso de No-IP.com.</p>

                  <p class="para1 tosp"><em>10. EXCLUSIÓN DE RESPONSABILIDAD DE CONTENIDO DE TERCEROS</em></p>

                  <p class="para2">Vitalwerks no asume ninguna responsabilidad por el contenido de cualquier material que se encuentra en los servidores de terceros fuera de su control, incluyendo todos los servidores de acceso a través de un servicio. Vitalwerks no tiene control sobre los sitios Web u otro material alojado en esos servidores externos. Vitalwerks se reserva el derecho, a su única discreción, de cancelar servicios de conformidad con la sección 7 anterior, si la conducta de un cliente en la organización de dicho contenido infringe las Condiciones del servicio. </p>


                  <p class="para1 tosp"><em>11. LIMITACIÓN DE RESPONSABILIDAD Y GARANTÍA</em></p>

                  <p class="para2">EL CLIENTE ACEPTA QUE EL USO DEL SERVICIO ES BAJO SU CUENTA Y RIESGO DEL CLIENTE. SE OFRECEN SIN IP.COM 'S SERVICIOS "TAL CUAL", SIN GARANTÍA DE NINGÚN TIPO, YA SEA EXPRESA O IMPLÍCITA, INCLUYENDO SIN LIMITACIÓN CUALQUIER GARANTÍA DE INFORMACIÓN, DE LOS SERVICIOS, ACCESO ININTERRUMPIDO O PRODUCTOS OFRECIDOS A TRAVÉS DE O EN CONEXION CON EL SERVICIO, INCLUYENDO SIN LIMITACIÓN DEL SOFTWARE NO-IP.COM LICENCIA AL CLIENTE Y LOS RESULTADOS OBTENIDOS A TRAVÉS DEL SERVICIO. ESPECÍFICAMENTE, NO-IP.COM NIEGA TODAS LAS GARANTÍAS, INCLUYENDO SIN LIMITACIÓN: 1) TODAS LAS GARANTÍAS RELATIVAS A LA DISPONIBILIDAD, EXACTITUD O CONTENIDO DE LA INFORMACIÓN, PRODUCTOS O SERVICIOS, Y 2) LAS GARANTÍAS DE TÍTULO O GARANTÍAS DE COMERCIALIZACIÓN O IDONEIDAD PARA UN PROPÓSITO PARTICULAR.
                  </p>

                  <p class="para2">ESTA RENUNCIA DE RESPONSABILIDAD SE APLICA A CUALQUIER DAÑO O PERJUICIO CAUSADO POR CUALQUIER FALLO DE RENDIMIENTO, ERROR, OMISIÓN, INTERRUPCIÓN, ELIMINACIÓN, DEFECTO, DEMORA EN LA OPERACIÓN O TRANSMISIÓN, VIRUS INFORMÁTICO, FALLA EN LA LÍNEA DE COMUNICACIÓN, ROBO O DESTRUCCIÓN O ACCESO NO AUTORIZADO, ALTERACIÓN , O USO DE REGISTRO, YA SEA POR INCUMPLIMIENTO DE CONTRATO, COMPORTAMIENTO ILÍCITO, NEGLIGENCIA O POR CUALQUIER OTRA CAUSA DE ACCIÓN. CLIENTE RECONOCE EXPRESAMENTE QUE NO-IP.COM NO ES RESPONSABLE POR LA CONDUCTA DE DIFAMACIÓN, OFENSIVA O ILEGAL DE OTROS CLIENTES O TERCEROS Y QUE EL RIESGO DE LESIÓN DE LA ANTERIOR ES EXCLUSIVO DEL CLIENTE.</p>

                  <p class="para2">NI NO-IP.COM NI NINGUNO DE SUS AGENTES, AFILIADOS O PROVEEDORES DE CONTENIDO SERÁN RESPONSABLES POR NINGÚN DAÑO DIRECTO, INDIRECTO, INCIDENTAL, ESPECIAL O COMO CONSECUENCIA DEL USO DEL SERVICIO O LA IMPOSIBILIDAD DE ACCEDER O USO DEL SERVICIO, O EL INCUMPLIMIENTO DE CUALQUIER GARANTÍA. CLIENTE RECONOCE QUE LAS DISPOSICIONES DE ESTA SECCIÓN SE APLICAN A TODO EL CONTENIDO DEL SERVICIO. El Cliente acepta que INTERNET SOLUTIONS VITALWERKS, LLC NO SE HACE RESPONSABLE POR CUALQUIER PÉRDIDA DE USO DEL NOMBRE DE DOMINIO DEL CLIENTE, O INTERRUPCIÓN DE NEGOCIO, O CUALQUIER DAÑO INDIRECTO, ESPECIAL, INCIDENTAL O CONSECUENTE O CUALQUIER TIPO (INCLUYENDO LA PÉRDIDA DE BENEFICIOS) INDEPENDIENTEMENTE DE LA FORMA, YA SEA POR CONTRATO, AGRAVIO (INCLUYENDO NEGLIGENCIA), O CUALQUIER OTRA FORMA, Y SIN IMPORTAR SI SE HA NOTIFICADO VITALWERKS DE LA POSIBILIDAD DE TALES DAÑOS.</p>


                  <p class="para1 tosp"><em>12. CUOTAS, PAGO Y DURACIÓN DE SERVICIO.</em></p>

                  <p class="para2">Como contraprestación por los servicios que ha seleccionado, se compromete a pagar Vitalwerks los cargos por servicios aplicables (s) expuestos en nuestro sitio Web en el momento de la selección. Todas las tarifas se deben de inmediato y no son reembolsables. Vitalwerks pueden tomar todos los recursos disponibles para cobrar los honorarios debidos. A menos que se especifique lo contrario, cada Servicio Vitalwerks tiene un plazo de un año. Toda renovación de sus servicios con nosotros está sujeto a nuestros términos y condiciones vigentes en ese momento y el pago de todos los cargos de servicio vigentes en el momento de la renovación.</p>


                  <p class="para1 tosp"><em>13. MODIFICACIONES DE DOMINIO DE CLIENTES</em></p>

                  <p class="para2">El Cliente entiende que el dominio para el que se compra un servicio particular puede ser sustituido una vez durante el período para el que se haya pagado la cuota de servicio particular, y que las sustituciones adicionales resultará en un cargo de ser cargadas. Cliente también entiende que no hay dominio de sustitución en el caso de registro del nombre de dominio del Servicio. No-IP.com se reserva el derecho a interponer un recurso en caso de pago fraudulento, de cargo o de lo contrario incobrables honorarios incluyendo, pero no limitado a, la suspensión de todos los servicios prestados en dicho nombre de dominio o litigio que comienza.</p>

          </div><!-- /.navbar -->
        </div>
      </div><!-- container -->



    <?php include("../include/footer.htm"); ?>
    </body>
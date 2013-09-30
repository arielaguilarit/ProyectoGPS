
<?php 

session_start();
if(!$_SESSION)
{
    echo '<script languaje= javascript> 
        alert("Usuario no autetificado"); 
        self.location = "index.htm" ;
        </script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>GPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrapp.css" rel="stylesheet">
    <link href="http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="http://icons.iconarchive.com/icons/icons-land/vista-map-markers/16/Map-Marker-Marker-Outside-Azure-icon.png" type="image/x-icon" rel="shortcut icon">
    <?php include("../include/css/estilo.css"); ?>
</head>
<body>
    <div class="container">
        <?php 
        if(isset($_SESSION["nombre"]))
        {
            echo "<h10 class='muted'> Bienvenido: ".ucfirst($_SESSION["nombre"])."</h10>\n";
            echo "<h10 class='muted'><a href='../home/logout.php' target='_top' >Cerrar Sesion</a></h10>";
            echo "<div class='masthead'>";
            
            if($_SESSION["privilegio"] == 1)
              echo " <h3 class='muted'>Administrador Control GPS</h3>";
            else if($_SESSION["privilegio"] == 2)
              echo " <h3 class='muted'>Operador Control GPS</h3>";
            else if($_SESSION["privilegio"] == 3)
              echo " <h3 class='muted'>Usuario Control GPS</h3>";
        }
        ?>
      <div class="masthead">
        <!--<h3 class="muted">Administrador Control GPS</h3>-->
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li><a href="../home/home.php" target="_top">Home</a></li>
                <li><a href="../Trayecto/portada.php" target="_top">Trayectoria</a></li>
                <li class="active"><a href="../posicionActual/frameActual.php" target="_top">Posicion Actual</a></li>
                <?php
                  if($_SESSION["privilegio"]!=3)
                    echo "<li><a href='../Reportes/frameReportes.php' target='_top'>Reportes</a></li>";
                  /*if($_SESSION["privilegio"]!=1)
                    echo "<li><a href='../home/perfil.php' target='_top'>Perfil</a></li>";*/
                ?>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

</body>
</html>

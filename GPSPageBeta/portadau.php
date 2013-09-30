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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> GPS </title>
</head>

<frameset rows="80,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="header.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="arriba" />
    <frameset rows="*" cols="*,304" framespacing="0" frameborder="no" border="0">
    <frameset rows="*,0" cols="*" framespacing="0" frameborder="no" border="0">
    <frame src="Trayecto/mapa_portada.php" name="mainFrame" id="mainFrame" title="main" />
    </frameset>
    <frame src="head.php" name="rightFrame" scrolling="auto" noresize="noresize" id="rightFrame" title="derecha" />
       
                </frameset>
              </frameset>
            <noframes>
          </noframes>
        <noframes>
  <frameset rows="*,80" frameborder="no" border="0" framespacing="0">
   <frame name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="abajo" />
  </frameset>
  </noframes>
 </body>
</html>

<?php
require("../conexiones/connect_db.php");

if(isset($_POST["vehiculo"]) && isset($_POST["fecha"]))
{
	$pate = $_POST["vehiculo"];
	$fech = $_POST["fecha"];
	$id = "";
	$chofer = "";
	$empresario = "";
	$empresa = "";
	$hora_controlada[]=array();
	$hora_marcada[]=array();}
	$fecha_pos[]=array();
	$atrasos[]=array();
	$adelanto[]=array();
	$multas_atrasos[]=array();
	$min_atrasos=0;
	$aux=0;//sumar los minutos de los puntos de control
	$indice=1;//moverme en el array de puntos




  $sql="select * from recorrido where patente_vehiculo = '$pate' and fecha_salida= '$fech'";
  $cs=@mysql_query($sql) or die ("Error :".mysql_error());
  if(mysql_num_rows($cs)>0)
  {

  	//$sql="select * from vehiculo where patente = '$pate'";
  	//$cs=@mysql_query($sql);
  		//Recupero el recorrido del vehiculo
	  	while($resul = mysql_fetch_array($cs))
	  	{
	    	$id_recorrido = $resul["id_recorrido"];
	    	$patente = $resul["patente_vehiculo"];
	    	$id_ruta = $resul["ruta_id"];
	    	$hora_salida = $resul["hora_salida"];
	    	$fecha_salida =$resul["fecha_salida"];
	  	}

	  	//Recupero el imei asociado al vehiculo
	  	$cs=@mysql_query("select imei_dispositivo from asociado where patente_veh = '$pate'")  or die ("Error :".mysql_error());
	  	while($resul = mysql_fetch_array($cs))
	  	{
	  		$dispositivo=$resul["imei_dispositivo"];
	  	}

	  	//Recupero los putos de control del recorrido del vehiculo
	  	$ptsControl[]= array();//declaro un vector para almacenar los puntos de control 
	  	$cs=@mysql_query("select * from control where ruta_id = '$id_ruta'") or die ("Error :".mysql_error());
	  	while($resul = mysql_fetch_array($cs))
	  	{
	  		$ptsControl[]=$resul;
	  		
	  	}

	  	//Vector para almacenar la hora a controlar
	  	//$hraControl[]= array();//declaro un vector para almacenar la hora a controlar
	  	//$hra_aux=$hora_salida;
	  	//for($i=1;$i<count($ptsControl);$i++)
		//{
			
			//$hra_aux=$hra_aux+$ptsControl[$i]["min_control"];
			//$hraControl[]=$hra_aux;
		//}

		//Recupero las posiciones del vehiculo
	  	$ptsPosicion[]= array();//declaro un vector para almacenar los puntos de posicion
	  	$cs=@mysql_query("select * from posicion where dispositivo_id = '$dispositivo' and fecha_pos = '$fech'")  or die ("Error :".mysql_error());
	  	while($resul = mysql_fetch_array($cs))
	  	{
	  		$ptsPosicion[]=$resul;
	  		
	  	}

	  	$i=1;

	  		//obtengo el punto a controlar y les sumo un rango
	  		$a= $ptsControl[$i]["lat_control"]-0.001;//sucesor
        	$b= $ptsControl[$i]["lat_control"]+0.001;//antecesor
        	$c= $ptsControl[$i]["lng_control"]-0.001;
        	$d= $ptsControl[$i]["lng_control"]+0.001;

	  		for($j=1;$j<count($ptsPosicion);$j++)
	  		{
	  			
        		//Consulto si se encuentra por el punto a controlar en las posicion
        		if((($a<=$ptsPosicion[$j]["latitud"])&&($ptsPosicion[$j]["latitud"]<=$b))&&(($c<=$ptsPosicion[$j]["longitud"])&&($ptsPosicion[$j]["longitud"]<=$d)))
        		{
        			$min_control_dec = time_to_decimal($ptsControl[$i]["min_control"]);//recupero los minutos de control y los paso a decimal
	                $aux = $aux + $min_control_dec;//le sumo lo anterior
	                $min_control_dec = $aux + $hora_salida;//se los sumo a la hora de salida 
	                $min_control =  decimal_to_time($min_control_dec);// paso a time
	                $hora_controlada[] = $min_control;//los guardo en el vector
	                $hora_marcada[] = $ptsPosicion[$j]["hora_pos"];//obtengo la hora de posicicon
	                //$fecha_pos[]=$ptsPosicion[$j]["fecha_pos"];
	                //si hora pos es mayor a min_control
	                if($ptsPosicion[$j]["hora_pos"]>$min_control)
	                {
	                    $min_atrasos= resta($ptsPosicion[$j]["hora_pos"],$min_control);
	                    //$sig="+";
	                    $atrasos[]=$min_atrasos;
	                }
	                else
	                {
	                    $min_atrasos= resta($min_control,$ptsPosicion[$j]["hora_pos"]);                
	                    //$sig="-";
	                    $adelanto[]=$min_atrasos;
	                }

	                //$atrasos[]=$min_atrasos;
	                //$min_atraso_dec = time_to_decimal($min_atrasos);
	                //$min_atrasos=$min_atrasos+$min_atraso_dec;
	                //echo '<th>'.$min_atraso."(".$sig.")".'</th>';
	                //$multas[] = valor_multa($min_atraso_dec, 200);
	                //encontro le punto y salgo del for para buscar otro punto
	                
	                //echo '<th>'.$multa.'</th>';
	                $i++;
        		} 

        		if($i<count($ptsControl))
	            {   
		            $a= $ptsControl[$i]["lat_control"]-0.001;//sucesor
	        		$b= $ptsControl[$i]["lat_control"]+0.001;//antecesor
	        		$c= $ptsControl[$i]["lng_control"]-0.001;
	        		$d= $ptsControl[$i]["lng_control"]+0.001;
		  		}
	        	else
	        	{
	        		$i=1;
	        		$a= $ptsControl[$i]["lat_control"]-0.001;//sucesor
	        		$b= $ptsControl[$i]["lat_control"]+0.001;//antecesor
	        		$c= $ptsControl[$i]["lng_control"]-0.001;
	        		$d= $ptsControl[$i]["lng_control"]+0.001;
	        	}
	        	
	        		
	  		}

	  	

	  	//Recorro los vectores de ptsPosicion y ptsControl 
	  	/*for($i=1;$i<count($ptsControl);$i++)
	  	{
	  		//obtengo el punto a controlar y les sumo un rango
	  		$a= $ptsControl[$i]["lat_control"]-0.001;//sucesor
        	$b= $ptsControl[$i]["lat_control"]+0.001;//antecesor
        	$c= $ptsControl[$i]["lng_control"]-0.001;
        	$d= $ptsControl[$i]["lng_control"]+0.001;

	  		for($j=1;$j<count($ptsPosicion);$j++)
	  		{
	  			
        		//Consulto si se encuentra por el punto a controlar en las posicion
        		if((($a<=$ptsPosicion[$j]["latitud"])&&($ptsPosicion[$j]["latitud"]<=$b))&&(($c<=$ptsPosicion[$j]["longitud"])&&($ptsPosicion[$j]["longitud"]<=$d)))
        		{
        			$min_control_dec = time_to_decimal($ptsControl[$i]["min_control"]);//recupero los minutos de control y los paso a decimal
	                $aux = $aux + $min_control_dec;//le sumo lo anterior
	                $min_control_dec = $aux + $hora_salida;//se los sumo a la hora de salida 
	                $min_control =  decimal_to_time($min_control_dec);// paso a time
	                $hora_controlada[] = $min_control;//los guardo en el vector
	                $hora_marcada[] = $ptsPosicion[$j]["hora_pos"];//obtengo la hora de posicicon
	                //$fecha_pos[]=$ptsPosicion[$j]["fecha_pos"];
	                //si hora pos es mayor a min_control
	                if($ptsPosicion[$j]["hora_pos"]>$min_control)
	                {
	                    $min_atrasos= resta($ptsPosicion[$j]["hora_pos"],$min_control);
	                    //$sig="+";
	                    $atrasos[]=$min_atrasos;
	                }
	                else
	                {
	                    $min_atrasos= resta($min_control,$ptsPosicion[$j]["hora_pos"]);                
	                    //$sig="-";
	                    $adelanto[]=$min_atrasos;
	                }

	                //$atrasos[]=$min_atrasos;
	                //$min_atraso_dec = time_to_decimal($min_atrasos);
	                //$min_atrasos=$min_atrasos+$min_atraso_dec;
	                //echo '<th>'.$min_atraso."(".$sig.")".'</th>';
	                //$multas[] = valor_multa($min_atraso_dec, 200);
	                //encontro le punto y salgo del for para buscar otro punto
	                $j=count($ptsPosicion);
	                //echo '<th>'.$multa.'</th>';
	                //$indice++;
        		} 

	  		}

	  	}*/

	  	//Recupero las empresa y las multas

	  	$cs=@mysql_query("select * from vehiculo,empresa where patente = '$pate' and id_empresa = rut_empresa")  or die ("Error :".mysql_error());
	  	while($resul = mysql_fetch_array($cs))
	  	{
	  		$empresa = $resul["nombre_empresa"];
	  		$chofer=$resul["chofer"];
	  		$empresario=$resul["nombre_empresario"];
	  		$multa_atraso = $resul["valor_atraso"];
	  		$multa_adelanto = $resul["valor_adelanto"];
	  		 
	  	}

	  	for($i=1;$i<count($atrasos);$i++)
	  	{
	  		$min_atraso_dec = time_to_decimal($atrasos[$i]);
	  		$multas[]=valor_multa($min_atraso_dec,$multa_atraso);
	  	}
	  	for($i=1;$i<count($adelanto);$i++)
	  	{
	  		$min_atraso_dec = time_to_decimal($adelanto[$i]);
	  		$multas[]=valor_multa($min_atraso_dec,$multa_adelanto);
	  	}
?>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
<legend>Detalle</legend>
  <thead>
    <tr>
      <th>Empresa</th>
      <th>Chofer</th>
      <th>Vehiculo</th>
      <th>Hora Salida</th>
      <th>Hora Marcada</th>
      <th>Hora Control</th>
      <th>Min Atrasos</th>
      <th>Min Adelanto</th>
      <th>Multa</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $multa_total=0;
    $min_atrasos=0;
    	//print "<th>$min_atrasos</th>";
    	//print "<th>$vehiculo</th>";
    	//print "<th>$id_ruta</th>";
    	//print "<th>$hora_salida</th>";
    	//print "<th>$fecha_salida</th>";
    	//print "<th>$dispositivo</th>";
	    //echo '<tbody>';
		//$multa_total=0;
		
		//echo '<th>'.$b.'</th>';
		//echo '<th>'.$c.'</th>';
		//echo '<th>'.$d.'</th>';
    //echo '$hora_controlada ='. count($hora_controlada);
    //echo '$hora_marcada ='. count($hora_marcada);
    //echo '$atrasos ='. count($atrasos);
    //echo '$adelanto ='. count($adelanto);
    //echo '$multas ='. count($multas);
    //echo '$hora_salida ='.$hora_salida; 

	   for($i=1;$i<count($hora_controlada);$i++)
		{

			
		    echo '<tr>';
		    echo '<th>'.$empresa.'</th>';
		    echo '<th>'.$chofer.'</th>';
		    echo '<th>'.$patente.'</th>';
		    echo '<th>'.$hora_salida.'</th>';
		   // echo '<th>'.$fecha_pos[$i].'</th>';
		    echo '<th>'.$hora_marcada[$i].'</th>';
		    echo '<th>'.$hora_controlada[$i].'</th>';
		    if($i<count($atrasos))
		    {	
		    	echo '<th>'.$atrasos[$i].'</th>';
		    	$min_atrasos=$min_atrasos+time_to_decimal($atrasos[$i]);
		    }
		    else
		    {
		    	echo '<th></th>';
		    }

		    if($i<count($adelanto))
		    {	
		    	echo '<th>'.$adelanto[$i].'</th>';
		    	$min_atrasos= $min_atrasos+time_to_decimal($adelanto[$i]);
		    }
		    else
		    {
		    	echo '<th></th>';
		    }

		    echo '<th>'.$multas[$i-1].'</th>';
		    $multa_total=$multa_total+$multas[$i-1];
		    echo '</tr>';
		}
		//echo '</tbody>';*/
	?>
  </tbody>
</table>

<section id="tables">
	<form class="form-horizontal" id="contacto" name="contacto" action="../scripts/excel.php" method="post">
		<!-- Empresa -->
		<div class="control-group" hidden>
		<label class="control-label">Patente</label>
		<div class="controls">
		<input type="text" name="empresa" size="25" value="<?php echo $empresa?>">
		</div>
		</div>

		<!-- Empresario -->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Id</label>
		<div class="controls">
		<input type="text" name="empresario" size="25" value="<?php echo $empresario?>">  
		</div>
		</div>

		<!-- Chofer -->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Id</label>
		<div class="controls">
		<input type="text" name="chofer" size="25" value="<?php echo $chofer?>">  
		</div>
		</div>

		<!-- Vehiculo -->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Empresario</label>
		<div class="controls">
		<input type="text" name="patente" size="25" value="<?php echo $patente?>">
		</div>
		</div>

		<!--Hora Salida 
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Chofer</label>
		<div class="controls">
		<input type="text" name="hora_salida" size="25" value="<?php //echo $hora_salida?>">
		</div>
		</div>
		-->

		<!-- Minutos atraso y adelanto-->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Empresa</label>
		<div class="controls">
		<input type="text" name="min_atraso" size="25" value="<?php echo $min_atrasos?>">
		</div>
		</div>

		<!-- fecha -->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Empresa</label>
		<div class="controls">
		<input type="text" name="fecha" size="25" value="<?php echo $fech?>">
		</div>
		</div>

		<!-- Multa -->
		<div class="control-group" hidden>
		<label class="control-label" for="inputRut">Empresa</label>
		<div class="controls">
		<input type="text" name="multa" size="25" value="<?php echo $multa_total?>">
		</div>
		</div>

		


		
		<td><input class="btn btn-success" type="submit" name="btn2" value="Informe">
	</form>
</section>
<?php
}
else
{
	echo '<SCRIPT LANGUAGE="javascript" type="text/javascript">
    alert("Error : \nNo hay datos asosciados a la fecha especificada");
    //location.href = "mapa_portada.php";            
	//SCRIPT>';
}
		
function hora_calculada($hora_pos, $minutos_control)
{  
	return  $hora_calculada = date("H:i:s", strtotime($hora_calculada."00"));
}
function valor_multa($min_atraso_dec, $vlr_min_atraso)
{
	return $min_atraso_dec * $vlr_min_atraso;
}
function decimal_to_time($decimal) 
{
	$hours = floor($decimal / 60);
    $minutes = floor($decimal % 60);
    $seconds = $decimal - (int)$decimal;
    $seconds = round($seconds * 60);
	 
    return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
}
function time_to_decimal($hora)
{
	$desglose=  explode(":", $hora);
	$dec=$desglose[0]*60+$desglose[1];
	return $dec;
}
function suma($h_salida, $minutosControl)
{
	$dif=date("H:i:s", strtotime("00:00:00") + strtotime($h_salida) + strtotime($minutosControl) ); 
	return $dif;
}
function resta($inicio, $fin)
{
	      //if($inicio>$fin)
	      //{          
	$dif=date("H:i", strtotime("00:00:00") + strtotime($inicio) - strtotime($fin) ); 
	      //}
	      //else
	      //{
	        // $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
	      //}
	return $dif;
}


?>

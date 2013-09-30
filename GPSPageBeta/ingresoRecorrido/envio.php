<?php
session_start();
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
	$ptsPosicion[]= array();//declaro un vector para almacenar los puntos de posicion
	$ptsControl[]= array();//declaro un vector para almacenar los puntos de control 
	$recorridos[]=array();//decla el vercto para lamacenar los recorridos
	$min_atrasos=0;
	$aux=0;//sumar los minutos de los puntos de control
	$indice=1;//moverme en el array de puntos
	

  $sql="select * from recorrido,vehiculo where patente_vehiculo = '$pate' and fecha_salida= '$fech' and patente_vehiculo = patente";
  $cs=@mysql_query($sql) or die ("Error :".mysql_error());
  if(mysql_num_rows($cs)>0)
  {
  	//echo mysql_num_rows($cs);
 	 //$sql="select * from vehiculo where patente = '$pate'";
  	//$cs=@mysql_query($sql);
  	//Recupero los recorrido del vehiculo ese dia
  	while($resul = mysql_fetch_array($cs))
  	{
  		$recorridos[]=$resul;
  		//$id_recorrido = $resul["id_recorrido"];
  		$id_unico = $resul["id_unico"];
    	$id_ruta = $resul["ruta_id"];
     	//$hora_salida = $resul["hora_salida"];
    	//$fecha_salida =$resul["fecha_salida"];
    }
    //Recupero el imei asociado al vehiculo
    $cs=@mysql_query("select imei_dispositivo from asociado where patente_veh = '$pate'")  or die ("Error :".mysql_error());
    //******verificar si sta asociado algun dispositivo al movil
    if(mysql_num_rows($cs)>0)
  	{

	  	while($resul = mysql_fetch_array($cs))
	  	{
	  		$dispositivo=$resul["imei_dispositivo"];
	  	}

	  	//Recupero los putos de control del recorrido del vehiculo
	  	$cs=@mysql_query("select * from control where ruta_id = '$id_ruta'") or die ("Error :".mysql_error());
	  	//*******compruebo si la ruta tiene puntos de control
	  	if(mysql_num_rows($cs)>0)
  		{
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
		  	
		  	$cs=@mysql_query("select * from posicion where dispositivo_id = '$dispositivo' and fecha_pos = '$fech'")  or die ("Error :".mysql_error());
		  	//******controlar si existen posiciones para el dispostivo y la fecha indicada

		  	if(mysql_num_rows($cs)>0)
  			{
			  	while($resul = mysql_fetch_array($cs))
			  	{
			  		$ptsPosicion[]=$resul;
			  		
			  	}

			  	$aux_k=1;
			  	
			  	for($i=1;$i<count($recorridos);$i++)
			  	{
			  		$id_recorrido = $recorridos[$i]["id_recorrido"];
			  		//$patente = $resul["patente_vehiculo"];
			    	//$id_ruta = $resul["ruta_id"];
			    	$hora_salida = $recorridos[$i]["hora_salida"];
			    	//$fecha_salida =$resul["fecha_salida"];

			    	for($j=1;$j<count($ptsControl);$j++)
			    	{

				  		//obtengo el punto a controlar y les sumo un rango
				  			
					  	$a= $ptsControl[$j]["lat_control"]-0.001;//sucesor
				        $b= $ptsControl[$j]["lat_control"]+0.001;//antecesor
				        $c= $ptsControl[$j]["lng_control"]-0.001;
				        $d= $ptsControl[$j]["lng_control"]+0.001;

				        for($k=$aux_k;$k<count($ptsPosicion);$k++)
					  	{
					  			
				        	//Consulto si se encuentra por el punto a controlar en las posicion
				        	if((($a<=$ptsPosicion[$k]["latitud"])&&($ptsPosicion[$k]["latitud"]<=$b))&&(($c<=$ptsPosicion[$k]["longitud"])&&($ptsPosicion[$k]["longitud"]<=$d)))
				        	{
				        		if($hora_salida<$ptsPosicion[$j]["hora_pos"])
				        		{
	
					        		$min_control_dec = time_to_decimal($ptsControl[$j]["min_control"]);//recupero los minutos de control y los paso a decimal
					        		//echo $ptsControl[$j]["min_control"]." ".$min_control_dec.'<br>';
					        		$h_salida_dec=time_to_decimal($hora_salida);//paso a decimal la hora de salida
					        		//echo $hora_salida." ".$h_salida_dec.'<br>';
					        		//$res= $h_salida_dec+$min_control_dec ;
					        		//echo decimal_to_time($res)." ".$res;
						            $aux = $aux + $min_control_dec;//le sumo lo anterior
						            $min_control_dec = $aux + $h_salida_dec;//se los sumo a la hora de salida 
						            $min_control =  decimal_to_time($min_control_dec);// paso a time
						            $hora_controlada[] = decimal_to_time($min_control_dec);//los guardo en el vector
						            $hora_marcada[] = $ptsPosicion[$k]["hora_pos"];//obtengo la hora de posicicon
						            //$fecha_pos[]=$ptsPosicion[$j]["fecha_pos"];
						            //si hora pos es mayor a min_control
						            if($ptsPosicion[$j]["hora_pos"]>$min_control)
						            {
						                $min_atrasos= resta($ptsPosicion[$k]["hora_pos"],$min_control);
						                //$sig="+";
						                $atrasos[]=$min_atrasos;
						            }
						            
						            if($ptsPosicion[$j]["hora_pos"]<$min_control)
						            {
						                $min_atrasos= resta($min_control,$ptsPosicion[$k]["hora_pos"]);                
						                //$sig="-";
						                $adelanto[]=$min_atrasos;
						            }

						            $aux_k=$k;
						        	$k=count($ptsPosicion);
					        	}
					        }					        

					  	}//fin for $k

				  	}//fin for j	

			  	}//fin for $i
			  		  	
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
			  		$min_atraso_dec = time_to_min($atrasos[$i]);
			  		$multas[]=valor_multa($min_atraso_dec,$multa_atraso);
			  	}
			  	for($i=1;$i<count($adelanto);$i++)
			  	{
			  		$min_atraso_dec = time_to_min($adelanto[$i]);
			  		//echo $min_atraso_dec;
			  		$multas[]=valor_multa($min_atraso_dec,$multa_adelanto);

			  	}
?>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed" id="Exportar_a_Excel">
			<legend>AG de <?php echo $empresa?></legend>
			  <thead>
			  	<label class="control-label">Numero Maquina : <?php echo $id_unico?></label>
			  	<label class="control-label">Empresario     : <?php echo $empresario?></label>
			  	<label class="control-label">Vueltas 		: <?php echo count($recorridos)-1?></label>
			  	<strong>Detalle</strong>
			    <tr>
			    <!--<th>Empresa</th>
			      <th>Empresario</th>
			      <th>N°</th>
			      <th>Hora Salida</th>-->
			      <th>Hora Marcada</th>
			      <th>Hora Control</th>
			      <th>Min Atrasos</th>
			      <th>Min Adelanto</th>
			      <th>Multa</th>
			    </tr>
			  </thead>
			  <tbody>
<?php
		    (int)$multa_total=0;
		    $min_atrasos=0;

			   for($i=1;$i<count($hora_controlada);$i++)
				{
					
				    echo '<tr>';
				    //echo '<th>'.$empresa.'</th>';
				    //echo '<th>'.$empresario.'</th>';
				    //echo '<th>'.$id_unico.'</th>';
				    //echo '<th>'.$hora_salida.'</th>';
				   	//echo '<th>'.$fecha_pos[$i].'</th>';
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
				    $multa_total= $multa_total + $multas[$i-1];
				    echo '</tr>';

				    
				}
				$_SESSION["hora_marcada"] = $hora_marcada;
				$_SESSION["min_atrasos"] = $atrasos;
				$_SESSION["min_adelanto"] = $adelanto;
				$_SESSION["multas"] = $multas;
				//echo '</tbody>';*/
?>
				  </tbody>
				</table>

				<section id="tables">
					<!--<form class="form-horizontal" id="contacto" name="contacto" action="../scripts/excel.php" method="post">-->
					<form class="form-horizontal" id="contacto" name="contacto" action="../scripts/excel.php" method="post">
						<!-- Empresa -->
						<input type="hidden" name="empresa" size="25" value="<?php echo $empresa?>">
						<!--<div class="control-group" hidden>
						<label class="control-label">Patente</label>
						<div class="controls">
						<input type="text" name="empresa" size="25" value="<?php echo $empresa?>">
						</div>
						</div>-->

						<!-- Empresario -->
						<input type="hidden" name="empresario" size="25" value="<?php echo $empresario?>"> 
						<!--<div class="control-group" hidden>
						<label class="control-label" for="inputRut">Id</label>
						<div class="controls">
						<input type="text" name="empresario" size="25" value="<?php echo $empresario?>">  
						</div>
						</div>-->

						<!-- numero de maquina -->
						<input type="hidden" name="num_maq" size="25" value="<?php echo $id_unico?>"> 

						<!-- Vueltas-->
						<input type="hidden" name="vueltas" size="25" value="<?php echo count($recorridos)-1?>"> 
												
						<!-- fecha -->
						<input type="hidden" name="fecha" size="25" value="<?php echo $fech?>">
						
						<!-- multa -->
						<input type="hidden" name="multa" size="25" value="<?php echo $multa_total?>">
			
						<p><input class="btn btn-success" type="image" src="../bootstrap/img/excel.png" name="btn2" value="Informe"></p>
					</form>
				</section>
<?php
			}
			else
			{
				mensageError("No hay posiciones registradas en esta fecha");

			}
		}
		else
		{
			mensageError("La ruta seleccionada no posee puntos para controlar");
		}
	}
	else
	{
		mensageError("El vehiculo no esta asociados a ningun dispositivo");
	}
}
else
{
	mensageError("No hay datos asosciados a la fecha especificada");
}


function mensageError($texto)
{
	echo '<SCRIPT LANGUAGE="javascript" type="text/javascript">
    alert("Error : \n'.$texto .'");
    //location.href = "mapa_portada.php";            
	</SCRIPT>';
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

	$hours = floor($decimal / 3600);
	$resto=floor($decimal%3600);
    $minutes = floor($resto / 60);
    $seconds = $decimal - (int)$decimal;
    $seconds = round($seconds * 60);
	 
    return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
}
function time_to_decimal($hora)
{
	$desglose=  explode(":", $hora);
	$dec=$desglose[0]*3600+$desglose[1]*60;
	return $dec;
}
function time_to_min($hora)
{
	$desglose=  explode(":", $hora);
	$dec=$desglose[0]*3600+$desglose[1];
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

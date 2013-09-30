<?php
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=reporte.xls");

$empresa = $_POST['empresa'];
$empresario=$_POST["empresario"];
$num_maq=$_POST['num_maq'];
$vueltas=$_POST['vueltas'];
$fecha=$_POST['fecha'];
$multa_total=$_POST['multa'];
$atrasos = unserialize($_POST['atrasos']);
$adelantos = unserialize($_POST['adelantos']);
$multas = unserialize($_POST['multas']);
$hora_marcada=unserialize($_POST['hora_marcada']);
$hora_controlada=unserialize($_POST['hora_controlada']);
$recorridos=unserialize($_POST['recorridos']);
	//$chofer = $_POST['chofer'];
	//$patente = $_POST['patente'];
	//$hora_salida = $_POST['hora_salida'];
	//$min_atrasos=$_POST['min_atraso'];
	
//$multa=$_POST['multa'];
?>

<form  action="../scripts/exportar_excel.php" method="post">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed" id="Exportar_a_Excel">
			<legend>AG de <?php echo $empresa?></legend>
			  <thead>
			  	<label class="control-label">Numero Maquina : <?php echo $num_maq?></label>
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
		   	//echo $multa_atraso." ".$multa_adelanto;
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
				    $multa_total= $multa_total + (int)$multas[$i-1];
				    echo '</tr>';
				    
				}
				//echo $multa_total;
				//echo '</tbody>';*/
?>
				  </tbody>
				</table>
				</form>
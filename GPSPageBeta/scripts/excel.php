<?php
session_start();
//datos para establecer la conexion con la base de mysql.
require("../conexiones/connect_db.php");
//Librerias Excel
require_once("../PHPExcel/Classes/PHPExcel.php");
require_once("../PHPExcel/Classes/PHPExcel/Writer/Excel5.php");
if(isset($_POST["btn2"]) && isset($_SESSION['hora_marcada']))
{
	
	$empresa = $_POST['empresa'];
	$empresario=$_POST["empresario"];
	$num_maq=$_POST['num_maq'];
	$vueltas=$_POST['vueltas'];
	$fecha=$_POST['fecha'];
	//$atrasos = unserialize($_POST['atrasos']);
	
	$hora_marcada = $_SESSION["hora_marcada"];
	$atrasos=$_SESSION["min_atrasos"];
	$adelantos= $_SESSION["min_adelanto"];
	$multas = $_SESSION["multas"];
	//$chofer = $_POST['chofer'];
	//$patente = $_POST['patente'];
	//$hora_salida = $_POST['hora_salida'];
	//$min_atrasos=$_POST['min_atraso'];
	
	$multa=$_POST['multa'];
	//var_dump($atrasos);
	
?>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed" id="Exportar_a_Excel">
			<legend>AG de <?php echo $empresa?></legend>
			<br>
			  <thead>
			  	<label class="control-label">Numero Maquina : <?php echo $num_maq?></label>
			  	<br>
			  	<label class="control-label">Empresario     : <?php echo $empresario?></label>
			  	<br>
			  	<label class="control-label">Vueltas 		: <?php echo $vueltas?></label>
			  	<br>
			  	<strong>Detalle</strong>
			    <tr>
			    <!--<th>Empresa</th>
			      <th>Empresario</th>
			      <th>N°</th>
			      <th>Hora Salida</th>-->
			      <th>Fecha </th>
			      <th>Hora </th>
			      <th>Min Atrasos</th>
			      <th>Min Adelanto</th>
			      
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
			   for($i=1;$i<count($hora_marcada);$i++)
				{
					
				    echo '<tr>';

				    //echo '<th>'.$empresa.'</th>';
				    //echo '<th>'.$empresario.'</th>';
				    //echo '<th>'.$id_unico.'</th>';
				    //echo '<th>'.$hora_salida.'</th>';
				   	echo '<th>'.$fecha.'</th>';
				    echo '<th>'.$hora_marcada[$i].'</th>';
				    
				    if($i<count($atrasos))
				    {	
				    	echo '<th>'.$atrasos[$i].'</th>';
				    	//$min_atrasos=$min_atrasos+time_to_decimal($atrasos[$i]);
				    }
				    else
				    {
				    	echo '<th></th>';
				    }

				    if($i<count($adelantos))
				    {	
				    	echo '<th>'.$adelantos[$i].'</th>';
				    	//$min_atrasos= $min_atrasos+time_to_decimal($adelantos[$i]);
				    }
				    else
				    {
				    	echo '<th></th>';
				    }
				    $multa_total= $multa_total + $multas[$i-1];
				    echo '</tr>';

				    
				}
				echo '<th>Atrasos</th><th></th><th></th><th></th><th>'.$multa_total.'</th>';

				header("Content-type: application/vnd.ms-excel; name='excel'");
				header("Content-Disposition: filename=".$empresario."-".date("Y-m-d").".xls");
				header("Pragma: no-cache");
				header("Expires: 0");

	//$empresario1 = $_POST['empresario1'];
    //$chofer1 = $_POST['chofer1'];
    //$patente1 = $_POST['patente1'];
    //$id1 = $_POST['id1'];
    //$empresa1 = $_POST['emp1'];
    //$fech1 = $_POST['fech1'];

    /*	
		//Creamos un nuevo archivo Excel
		$objPHPExcel = new PHPExcel();
		//Algunos datos sobre autoría
		$objPHPExcel->getProperties()->setCreator("SistemaGPS");
		$objPHPExcel->getProperties()->setLastModifiedBy("SistemaGPS");
		$objPHPExcel->getProperties()->setTitle("Reporte");
		$objPHPExcel->getProperties()->setSubject("");
		$objPHPExcel->getProperties()->setDescription("");
		//Estilo negrita y alineado al centro
		$styleArray = array(
			'font' => array('bold' => true,),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
		);
		//Escribimos los titulos con el estilo StyleArray
		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
		//Tamaño por defecto
		$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		//Trabajamos con la hoja activa principal
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue("A1", 'Empresa')
		->setCellValue("B1", 'Empresario')
		->setCellValue("C1", 'Chofer')
		->setCellValue("D1", 'Fecha')
		->setCellValue("E1", 'Vehiculo')
		->setCellValue("F1", 'Minutos de Atraso')
		->setCellValue("G1", 'Multa')
		//Escribimos los datos recibidos
		->setCellValue("A2", $empresa)
		->setCellValue("B2", $empresario)
		->setCellValue("C2", $num_maq)
		->setCellValue("D2", $fecha)

		for($i=0;$i<count($hora_marcada);$i++)
		{
			->setCellValue("D".$i+3., $hora_marcada[$i])
		}
		//->setCellValue("E2", $patente)
		//->setCellValue("F2", $min_atrasos)
		->setCellValue("G2", $multa);

		
		//Titulo del libro y seguridad 
		$objPHPExcel->getActiveSheet()->setTitle('Reporte');
		$objPHPExcel->setActiveSheetIndex(0);
		//$objPHPExcel->getSecurity()->setLockWindows(true);
		//$objPHPExcel->getSecurity()->setLockStructure(true);

		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$empresario.$fecha.'.xls"');
		header('Cache-Control: max-age=0');

		//Creamos el Archivo .xlsx
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		*/
		
}
else
{
	echo '<SCRIPT LANGUAGE="javascript">history.back();</SCRIPT>';
}



?>
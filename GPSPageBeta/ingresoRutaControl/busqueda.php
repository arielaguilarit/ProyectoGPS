<?php
require("../conexiones/connect_db.php");

$busqueda=$_POST['busqueda'];
if ($busqueda<>''){
	$trozos=explode(" ",$busqueda);
	$numero=count($trozos);
	if ($numero==1) {
		$cadbusca="SELECT * FROM control WHERE ruta_id= '$busqueda' LIMIT 10;";
	} elseif ($numero>1) {
		//SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
		$cadbusca="SELECT * , MATCH ( ruta_id ) AGAINST ( '$busqueda' ) AS Score FROM control WHERE MATCH ( ruta_id ) AGAINST ( '$busqueda' ) ORDER BY Score DESC LIMIT 50;";
	}
?>
	<legend>Tabla de Puntos</legend>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-condensed">
	<tbody>
		<thead>
		<tr>
			<th>Punto</th>
			<th>Latitud</th>
			<th>Longitud</th>
			<th>Tiempo</th>
			<th>Modificar</th>
		</tr>
		</thead>
<?php
	$result=@mysql_query($cadbusca);
	$i=1;
	while ($row = @mysql_fetch_array($result)){
		echo '
			<tr>
				<th>'.$row['nom_control'].'</th>
				<th>'.$row['lat_control'].'</th>
				<th>'.$row['lng_control'].'</th>
				<th>'.date('H:i',strtotime(($row['min_control']))).'</th>
				<td><a id="modal" class="fancy" href="actual_control.php?variable='.$row['id_control'].'" data-width="900" data-height="500">
            	<button class="btn btn-mini btn-success" type="button">Modificar</button></td></tr>
			</tr>';

		$i++;
	}
}
?>
	</tbody>
	</table>
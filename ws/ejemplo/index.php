<?php
	include('../../admin/abarrotera.class.php');
	$datos = $abarrotera->consultar('SELECT * FROM empleado');
	header('Constent-Type: Application/json');
	$json = json_encode($datos);
	echo $json; 
?>
<?php
	include '../../../admin/abarrotera.class.php';
	$metodo=$_SERVER['REQUEST_METHOD'];
	echo $metodo;
	header('Content-Type: application/json');
	$json=array('mensaje'=>'No se implemento ninguna accion');
	$json=json_encode($json);
	switch ($metodo) {
		case 'POST':
			# Aqui voy a insertar
			break;
		case 'PUT':
			# Aqui voy a actializar
			break;
		case 'DELETE':
			# Aqui voy a borrar
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			$datos=$abarrotera->consultar("SELECT * FROM empleado");
			if (isset($_GET['id'])) {
				$parametros['id_empleado']=$_GET['id'];
				$datos=$abarrotera->consultar("SELECT * FROM empleado WHERE id_empleado=:id_empleado",$parametros);
			}
			$json=json_encode($datos);
			break;
	}
	echo $json;
?>
<?php
	include '../../admin/deposito.class.php';
	$metodo=$_SERVER['REQUEST_METHOD'];
	//print_r($metodo); die();
	header('Content-Type: application/json');
	$json=array('mensaje'=>'No se implemento ninguna accion');
	//$json=json_encode($json);
	switch ($metodo) {
		case 'POST':
			# Aqui voy a insertar
			$json=file_get_contents('php://input');
			$json=json_decode($json);
			foreach ($json as $key => $value) {
				$parametros['unidad_medida']=$value->unidad_medida;
				$deposito->insertar('unidad_medida',$parametros);
				$json=array('mensaje'=>'Se inserto la unidad de medida');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['unidad_medida']=$value->unidad_medida;
					$llave['id_unidad_medida']=$_GET['id'];
					$deposito->actualizar('unidad_medida',$parametros,$llave);
					$json=array('mensaje'=>'Se actualizo la unidad de medida');
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico la unidad de medida');
					}else{
						$json=array('mensaje'=>'La unidad de medida no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de unidad de medida es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_unidad_medida']=$_GET['id'];
				//echo $fa->rowCount(); die();
				$deposito->borrar('unidad_medida',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino la unidad de medida');	
				}else{
					$json=array('mensaje'=>'No existe la unidad de medida');
				}
			}else{
				$json=array('mensaje'=>'id de unidad de medida es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_unidad_medida']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM unidad_medida WHERE id_unidad_medida=:id_unidad_medida ORDER BY id_unidad_medida",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM unidad_medida ORDER BY id_unidad_medida");
			}
			/*if (sizeof($json==0) {
				$json=array('mensaje'=>'El empleado no existe');
			}*/
			break;
	}
	http_response_code(200);
	$json=json_encode($json);
	echo $json;
?>
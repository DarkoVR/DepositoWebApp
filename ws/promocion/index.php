<?php
	include '../../admin/deposito.class.php';
	$metodo=$_SERVER['REQUEST_METHOD'];
	header('Content-Type: application/json');
	$json=array('mensaje'=>'No se implemento ninguna accion');
	//$json=json_encode($json);
	switch ($metodo) {
		case 'POST':
			# Aqui voy a insertar
			$json=file_get_contents('php://input');
			$json=json_decode($json);
			foreach ($json as $key => $value) {
				$parametros['fechai']=$value->fechai;
				$parametros['fechaf']=$value->fechaf;
				$deposito->insertar('promocion',$parametros);
				$json=array('mensaje'=>'Se inserto la promocion');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['fechai']=$value->fechai;
					$parametros['fechaf']=$value->fechaf;
					$llave['id_promocion']=$_GET['id'];
					$deposito->actualizar('promocion',$parametros,$llave);
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico la promocion');
					}else{
						$json=array('mensaje'=>'La promocion no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de la promocion es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_promocion']=$_GET['id'];
				$deposito->borrar('promocion',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino la promocion');	
				}else{
					$json=array('mensaje'=>'No existe la promocion');
				}
			}else{
				$json=array('mensaje'=>'id de promocion es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_promocion']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM promocion WHERE id_promocion=:id_promocion",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM promocion");
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
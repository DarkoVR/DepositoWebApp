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
				$parametros['proveedor']=$value->proveedor;
				$parametros['logo']=$value->logo;
				$deposito->insertar('proveedor',$parametros);
				$json=array('mensaje'=>'Se inserto el proveedor');	
			}
			break;
		case 'PUT':
			# Aqui voy a actualizar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['proveedor']=$value->proveedor;
					$llave['id_proveedor']=$_GET['id'];
					$deposito->actualizar('proveedor',$parametros,$llave);
					$json=array('mensaje'=>'Se actualizo el proveedor');
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico el proveedor');
					}else{
						$json=array('mensaje'=>'El proveedor no existe no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id del proveedor es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_proveedor']=$_GET['id'];
				//echo $fa->rowCount(); die();
				$deposito->borrar('proveedor',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino el proveedor');	
				}else{
					$json=array('mensaje'=>'No existe el proveedor');
				}
			}else{
				$json=array('mensaje'=>'id el proveedor es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_proveedor']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM proveedor WHERE id_proveedor=:id_proveedor ORDER BY id_proveedor",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM proveedor ORDER BY id_proveedor");
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
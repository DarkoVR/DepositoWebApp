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
				$parametros['producto']=$value->producto;
				$parametros['id_marca']=$value->id_marca;
				$deposito->insertar('producto',$parametros);
				$json=array('mensaje'=>'Se inserto el producto');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['producto']=$value->producto;
					$parametros['id_marca']=$value->id_marca;
					$llave['id_producto']=$_GET['id'];
					$deposito->actualizar('producto',$parametros,$llave);
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico el producto');
					}else{
						$json=array('mensaje'=>'El producto no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de la marca es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_producto']=$_GET['id'];
				$deposito->borrar('producto',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino el producto');	
				}else{
					$json=array('mensaje'=>'No existe el producto');
				}
			}else{
				$json=array('mensaje'=>'id de marca es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_producto']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM producto WHERE id_producto=:id_producto",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM producto");
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
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
				$parametros['categoria']=$value->categoria;
				$deposito->insertar('categoria',$parametros);
				$json=array('mensaje'=>'Se inserto la categoria');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['categoria']=$value->categoria;
					$llave['id_categoria']=$_GET['id'];
					$deposito->actualizar('categoria',$parametros,$llave);
					$json=array('mensaje'=>'Se actualizo la categoria');
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico la categoria');
					}else{
						$json=array('mensaje'=>'La categoria no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de la categoria es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_categoria']=$_GET['id'];
				//echo $fa->rowCount(); die();
				$deposito->borrar('categoria',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino la categoria');	
				}else{
					$json=array('mensaje'=>'No existe la categoria');
				}
			}else{
				$json=array('mensaje'=>'id de categoria es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_categoria']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM categoria WHERE id_categoria=:id_categoria ORDER BY id_categoria",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM categoria ORDER BY id_categoria");
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
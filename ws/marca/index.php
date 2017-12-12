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
				$parametros['marca']=$value->marca;
				$parametros['id_proveedor']=$value->id_proveedor;
				$parametros['id_categoria']=$value->id_categoria;
				$deposito->insertar('marca',$parametros);
				$json=array('mensaje'=>'Se inserto la marca');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['marca']=$value->marca;
					$llave['id_marca']=$_GET['id'];
					$deposito->actualizar('marca',$parametros,$llave);
					$json=array('mensaje'=>'Se actualizo la marca');
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico la marca');
					}else{
						$json=array('mensaje'=>'La marca no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de la marca es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_marca']=$_GET['id'];
				$deposito->borrar('marca',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino la marca');	
				}else{
					$json=array('mensaje'=>'No existe la marca');
				}
			}else{
				$json=array('mensaje'=>'id de marca es obligatorio');
			}
			break;
		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id'])) {
				$parametros['id_marca']=$_GET['id'];
				$json=$deposito->consultar("SELECT * FROM marca WHERE id_marca=:id_marca ORDER BY id_categoria",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM marca ORDER BY id_categoria");
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
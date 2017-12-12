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
				$parametros['id_producto']=$value->id_producto;
				$parametros['sku']=$value->sku;
				$parametros['presentacion']=$value->presentacion;
				$parametros['preciou']=$value->preciou;
				$parametros['cantidadm']=$value->cantidadm;
				$parametros['preciom']=$value->preciom;
				$parametros['imagen']=$value->imagen;
				$parametros['id_unidad_medida']=$value->id_unidad_medida;
				$deposito->insertar('presentacion',$parametros);
				$json=array('mensaje'=>'Se inserto la presentacion');	
			}
			break;
		case 'PUT':
			# Aqui voy a actializar
			if (isset($_GET['id'])) {
				$json=file_get_contents('php://input');
				$json=json_decode($json);
				foreach ($json as $key => $value) {
					$parametros['id_producto']=$value->id_producto;
					$parametros['sku']=$value->sku;
					$parametros['presentacion']=$value->presentacion;
					$parametros['preciou']=$value->preciou;
					$parametros['cantidadm']=$value->cantidadm;
					$parametros['preciom']=$value->preciom;
					$parametros['imagen']=$value->imagen;
					$parametros['id_unidad_medida']=$value->id_unidad_medida;
					$llave['id_producto']=$_GET['id'];
					$llave['sku']=$_GET['sku'];
					$deposito->actualizar('presentacion',$parametros,$llave);
					if ($deposito->fa==1) {
						$json=array('mensaje'=>'Se modifico la presentacion');
					}else{
						$json=array('mensaje'=>'La presentacion no existe');
					}	
				}
			}else{
				$json=array('mensaje'=>'id de la presentacion es obligatorio');
			}
			break;
		case 'DELETE':
			# Aqui voy a borrar
			if (isset($_GET['id'])) {
				$parametros['id_producto']=$_GET['id'];
				$parametros['sku']=$_GET['sku'];
				$deposito->borrar('presentacion',$parametros);
				if ($deposito->fa==1) {
					$json=array('mensaje'=>'Se elimino la presentacion');	
				}else{
					$json=array('mensaje'=>'No existe la presentacion');
				}
			}else{
				$json=array('mensaje'=>'id de presentacion es obligatorio');
			}
			break;		
		default:
		case 'GET':
			# Aqui voy a consultar
			if (isset($_GET['id']) && isset($_GET['sku'])) {
				$parametros['id_producto']=$_GET['id'];
				$parametros['sku']=$_GET['sku'];
				$json=$deposito->consultar("SELECT * FROM presentacion WHERE id_producto=:id_producto AND sku=:sku",$parametros);
			}else{
				$json=$deposito->consultar("SELECT * FROM presentacion");
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
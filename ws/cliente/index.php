<?php
	include('../../admin/deposito.class.php');
	$metodo=$_SERVER['REQUEST_METHOD'];
	header('Content-Type: application/json');
	$json=array('mensaje'=>'no se implementó ninguna acción');
	switch ($metodo) {
	  	case 'POST':
	  		//"Aqui voy a insertar datos"
	  		$json=file_get_contents('php://input');
	  		$json=json_decode($json);
	  		foreach ($json as $key => $value) {
		  		$parametros=array();
		  		$parametros['email']=$value->email;
		  		$parametros['password']=md5($value->password);
		  		$deposito->insertar('usuario', $parametros);
		  		$datos=$deposito->consultar('SELECT id_usuario FROM usuario where email=:email AND password=:password', $parametros);

		  		$parametros=array();
		  		$parametros['id_usuario']=$datos[0]['id_usuario'];
				$parametros['id_rol']=1;		  		
				$deposito->insertar('usuario_rol', $parametros);

				$parametros=array();
				$parametros['id_usuario']=$datos[0]['id_usuario'];
		  		$parametros['nombre']=$value->nombre;
		  		$parametros['apaterno']=$value->apaterno;
		  		$parametros['amaterno']=$value->amaterno;
		  		$parametros['domicilio']=$value->domicilio;
		  		$parametros['foto']=$value->foto;
		  		$deposito->insertar('cliente', $parametros);
		  		$json=array('mensaje'=>'El cliente se insertó');
	  		}
	  	break;
	  	case 'PUT':
	  		//"Aqui voy a actualizar datos"
		  	if (isset($_GET['id'])) {
		  		$json=file_get_contents('php://input');
		  		$json=json_decode($json);
		  		$parametros['id_cliente']=$_GET['id'];
		  		$datos=$deposito->consultar("SELECT * FROM cliente c join usuario u ON c.id_usuario=u.id_usuario WHERE id_cliente=:id_cliente",$parametros);
		  		foreach ($json as $key => $value) {
		  			$parametros=array();
			  		$parametros['nombre']=$value->nombre;
			  		$parametros['apaterno']=$value->apaterno;
			  		$parametros['amaterno']=$value->amaterno;
			  		$parametros['domicilio']=$value->domicilio;
		  			$parametros['foto']=$value->foto;
			  		$llaves['id_cliente']=$_GET['id'];
			  		$deposito->actualizar('cliente', $parametros, $llaves);
			  		$i=$deposito->fa;

			  		$parametros=array();
			  		$llaves=array();
				  	$parametros['email']=$value->email;
			  		$parametros['password']=md5($value->password);
			  		$llaves['id_usuario']=$datos[0]['id_usuario'];
		  			$deposito->actualizar('usuario', $parametros, $llaves);
		  			$j=$deposito->fa;
			  		if ($i>0 || $j>0) {
			  			$json=array('mensaje'=>'El cliente se modificó');
			  		}else{
			  			$json=array('mensaje'=>'El cliente no existe o no ha sido modificado');
			  		}
		  		}
		  	}else{
		  		$json=array('mensaje'=>'Id del cliente es obligatorio');
		  	}
	  	break;
	  	case 'DELETE':
	  		//"Aqui voy a borrar datos"
	  		if (isset($_GET['id'])) {
	  			$parametros['id_cliente']=$_GET['id'];
  				$dato_usuario=$deposito->consultar('SELECT * FROM cliente WHERE id_cliente=:id_cliente', $parametros);
  				$parametros=array();
  				$parametros['id_usuario']=$dato_usuario[0]['id_usuario'];
  				$deposito->borrar('usuario_rol', $parametros);
  				$deposito->borrar('cliente', $parametros);
  				$deposito->borrar('usuario', $parametros);
  				if ($deposito->fa>0) {
  					$json=array('mensaje'=>'El cliente se ha eliminado');
  				}
  				else{
  					$json=array('mensaje'=>'El cliente no existe');
  				}	
	  		}else{
	  			$json=array('mensaje'=>'Id del cliente es obligatorio');
	  		}
	  	break;
	  	default:
	  	case 'GET':		  	
	  		//"Aqui voy a consultar datos"
		  	if (isset($_GET['id'])) {
		  		$parametros['id_cliente']=$_GET['id'];
		  		$json=$deposito->consultar('SELECT * FROM cliente c JOIN usuario u ON c.id_usuario=u.id_usuario WHERE id_cliente=:id_cliente ORDER BY id_cliente', $parametros);
		  	}else{
		  		$json=$deposito->consultar('SELECT * FROM cliente c JOIN usuario u ON c.id_usuario=u.id_usuario ORDER BY id_cliente');
		  	}
		  	if (sizeof($json)==0) {
		  		$json=array('mensaje'=>'El cliente no existe');
		  	}  	
	}  
	http_response_code(200);
	$json=json_encode($json);
	echo $json;
?>
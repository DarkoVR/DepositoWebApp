<?php
	include_once '../deposito.class.php';
	if(isset($_POST['enviar'])){
		if (isset($_FILES['foto']['name'])) {
			$origen=$_FILES['foto']['tmp_name'];
			$destino='../../images/clientes/'.$_FILES['foto']['name'];
			if($deposito->validar_imagen($_FILES['foto'])){
				if(move_uploaded_file($origen, $destino)){
					$parametros['correo']=$_POST['correo'];
					$parametros['contrasena']=md5($_POST['contrasena']);
					$deposito->insertar('usuario',$parametros);
					$datos=$deposito->consultar("SELECT id_usuario FROM usuario WHERE correo=:correo AND contrasena=:contrasena",$parametros);
					$parametros=array();

					$parametros['id_usuario']=$datos[0]['id_usuario'];
					$parametros['nombre']=$_POST['nombre'];
					$parametros['apaterno']=$_POST['apaterno'];
					$parametros['amaterno']=$_POST['amaterno'];
					$parametros['domicilio']=$_POST['domicilio'];
					$parametros['foto']=$_FILES['foto']['name'];
					$deposito->insertar('cliente',$parametros);
					$parametros=array();

					$parametros['id_usuario']=$datos[0]['id_usuario'];
					$parametros['id_rol']=1;
					$deposito->insertar('usuario_rol',$parametros);

					$mensaje='Se inserto el cliente';
					$color='success';
					if ($_POST['enviar']=="Guardar y salir") {
						include_once 'index.php';
					}
					}else{
						$mensaje='No se pudo transferir la imagen, ni se inserto el cliente';
						$color='danger';
				}
			}else{
				$mensaje='El archivo que intento subir no esta permitido, solo se permiten archivos con extension PNG,JPG y PNG';
				$color='danger';
			}
		}
	}
?>
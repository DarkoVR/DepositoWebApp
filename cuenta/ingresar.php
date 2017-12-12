<?php
	include_once '../deposito.class.php';
	if (isset($_POST['entrar'])) {
		$parametros['correo']=$_POST['correo'];
		$parametros['contrasena']=md5($_POST['contrasena']);
		$datos=$deposito->consultar("SELECT * FROM usuario WHERE correo=:correo AND contrasena=:contrasena",$parametros);
		$email=$_POST['correo'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if (count($datos)>0) {
				$parametros=array();
				$parametros['id_usuario']=$datos[0]['id_usuario'];
				$datos_roles=$deposito->consultar("SELECT rol FROM rol r JOIN usuario_rol ur USING(id_rol) WHERE id_usuario=:id_usuario",$parametros);
				$mensaje='El usuario '.$email.' ha ingresado a la base datos';
				$color='success';
				$_SESSION['validado']=true;
				$_SESSION['usuario']=$datos[0];
				$i=0;
				foreach ($datos_roles as $key => $value) {
					$_SESSION['roles'][$i]=$datos_roles[$i]['rol'];
					$i++;
				}
				header("Location: ../cliente/index.php");
			}else{
				$mensaje='El correo o contraseña son incorrectos';
				$color='danger';
			}
    	}else{
    		$mensaje='Este (email) no es valido';
			$color='danger';
    	} 
	}
	if (isset($_GET['error'])) {
		$color='danger';
		switch ($_GET['error']) {
			case 2:
				$mensaje="La sesion no es valida";
				break;
			case 3:
				$mensaje="Usted no tiene los privilegios para acceder a esta pagina";
				break;
			
			default:
			case 1:
				$mensaje="Necesita iniciar sesion";
				break;
		}
	}
?>
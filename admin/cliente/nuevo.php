<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		if (isset($_FILES['foto']['name'])) {
			$origen=$_FILES['foto']['tmp_name'];
			$destino='../../images/clientes/'.$_FILES['foto']['name'];
			if($deposito->validar_imagen($_FILES['foto'])){
				if(move_uploaded_file($origen, $destino)){
					$parametros['email']=$_POST['email'];
					$parametros['password']=md5($_POST['password']);
					$deposito->insertar('usuario',$parametros);
					$datos=$deposito->consultar("SELECT id_usuario FROM usuario WHERE email=:email AND password=:password",$parametros);
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
	include_once '../header.php';
?>
<h1>Nuevo cliente</h1>
<form action="nuevo.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_nombre_cliente">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="form_nombre_cliente" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="form_apaterno_cliente">Apellido paterno</label>
    <input type="text" name="apaterno" class="form-control" id="form_apaterno_cliente" placeholder="Apellido paterno">
  </div>
  <div class="form-group">
    <label for="form_amaterno_cliente">Apellido materno</label>
    <input type="text" name="amaterno" class="form-control" id="form_amaterno_cliente" placeholder="Apellido materno">
  </div>
  <div class="form-group">
    <label for="form_domicilio">Domicilio</label>
    <input type="text" name="domicilio" class="form-control" id="form_domicilio" placeholder="Domicilio">
  </div>
  <div class="form-group">
    <label for="form_foto">Foto</label>
    <input type="file" name="foto" class="form-control" id="form_foto" placeholder="Fotografia">
  </div>
  <div class="form-group">
    <label for="form_email">Correo</label>
    <input type="text" required name="email" class="form-control" id="form_email" placeholder="email">
  </div>
  <div class="form-group">
    <label for="form_password">Contraseña</label>
    <input type="password" required name="password" class="form-control" id="form_password" placeholder="contraseña">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include_once '../footer.php';
?>
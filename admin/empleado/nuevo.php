<?php
	include_once '../deposito.class.php';
  $rol[0]='administrador';
  $deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		$parametros['email']=$_POST['email'];
		$parametros['password']=md5($_POST['password']);
		$deposito->insertar('usuario',$parametros);
		$datos=$deposito->consultar("SELECT id_usuario FROM usuario WHERE email=:email AND password=:password",$parametros);
		$parametros=array();

		$parametros['id_usuario']=$datos[0]['id_usuario'];
		$parametros['nombre']=$_POST['nombre'];
		$parametros['apaterno']=$_POST['apaterno'];
		$parametros['amaterno']=$_POST['amaterno'];
		$deposito->insertar('empleado',$parametros);
		$mensaje='Se inserto el empleado';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include_once 'index.php';
		}
	}
	include_once '../header.php';
?>
<h1>Nuevo empleado</h1>
<form action="nuevo.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_nombre_empleado">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="form_nombre_empleado" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="form_apaterno_empleado">Apellido paterno</label>
    <input type="text" name="apaterno" class="form-control" id="form_apaterno_empleado" placeholder="Apellido paterno">
  </div>
  <div class="form-group">
    <label for="form_amaterno_empleado">Apellido materno</label>
    <input type="text" name="amaterno" class="form-control" id="form_amaterno_empleado" placeholder="Apellido materno">
  </div>
  <div class="form-group">
    <label for="form_email">Email</label>
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
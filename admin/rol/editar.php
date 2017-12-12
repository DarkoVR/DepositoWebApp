<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_rol'])) {
    	$parametros['id_rol']=$_REQUEST['id_rol'];
  	}else{
    	header("Location: /deposito/admin/rol/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM rol WHERE id_rol=:id_rol",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['rol']=$_POST['rol'];
		$llaves['id_rol']=$_POST['id_rol'];
		$deposito->actualizar('rol',$parametros,$llaves);
		$mensaje='Se actualizo la rol';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar rol</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_rol">Rol</label>
    <input type="text" name="rol" class="form-control" id="form_rol" placeholder="rol" value="<?php echo $datos[0]['rol']; ?>">
    <input type="hidden" name="id_rol" value="<?php echo $datos[0]['id_rol']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
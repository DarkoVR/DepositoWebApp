<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_unidad_medida'])) {
    	$parametros['id_unidad_medida']=$_REQUEST['id_unidad_medida'];
  	}else{
    	header("Location: /deposito/admin/unidad_medida/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM unidad_medida WHERE id_unidad_medida=:id_unidad_medida",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['unidad_medida']=$_POST['unidad_medida'];
		$llaves['id_unidad_medida']=$_POST['id_unidad_medida'];
		$deposito->actualizar('unidad_medida',$parametros,$llaves);
		$mensaje='Se actualizo la unidad de medida';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar unidad medida</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_unidad_medida">Unidad de medida</label>
    <input type="text" name="unidad_medida" class="form-control" id="form_unidad_medida" placeholder="Unidad de medida" value="<?php echo $datos[0]['unidad_medida']; ?>">
    <input type="hidden" name="id_unidad_medida" value="<?php echo $datos[0]['id_unidad_medida']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
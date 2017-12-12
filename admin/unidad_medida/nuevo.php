<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		$parametros['unidad_medida']=$_POST['unidad_medida'];
		$deposito->insertar('unidad_medida',$parametros);
		$mensaje='Se inserto la unidad de medida';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Nueva unidad medida</h1>
<form action="nuevo.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Unidad de medida</label>
    <input type="text" name="unidad_medida" class="form-control" id="exampleInputEmail1" placeholder="Unidad de medida">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
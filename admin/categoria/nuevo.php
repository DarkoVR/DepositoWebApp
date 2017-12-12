<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		$parametros['categoria']=$_POST['categoria'];
		$deposito->insertar('categoria',$parametros);
		$mensaje='Se inserto una categoria';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Nueva categoria</h1>
<form action="nuevo.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Categoria</label>
    <input type="text" name="categoria" class="form-control" id="exampleInputEmail1" placeholder="Categoria">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
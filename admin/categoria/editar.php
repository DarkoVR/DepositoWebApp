<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_categoria'])) {
    	$parametros['id_categoria']=$_REQUEST['id_categoria'];
  	}else{
    	header("Location: /deposito/admin/categoria/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM categoria WHERE id_categoria=:id_categoria",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['categoria']=$_POST['categoria'];
		$llaves['id_categoria']=$_POST['id_categoria'];
		$deposito->actualizar('categoria',$parametros,$llaves);
		$mensaje='Se actualizo la categoria';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar Ctegoria</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_categoria">Categoria</label>
    <input type="text" name="categoria" class="form-control" id="form_categoria" placeholder="categoria" value="<?php echo $datos[0]['categoria']; ?>">
    <input type="hidden" name="id_categoria" value="<?php echo $datos[0]['id_categoria']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
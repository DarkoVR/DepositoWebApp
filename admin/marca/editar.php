<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_marca'])) {
    	$parametros['id_marca']=$_REQUEST['id_marca'];
  	}else{
    	header("Location: /deposito/admin/marca/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM marca WHERE id_marca=:id_marca",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['marca']=$_POST['marca'];
		$llaves['id_marca']=$_POST['id_marca'];
		$deposito->actualizar('marca',$parametros,$llaves);
		$mensaje='Se actualizo la marca';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar marca</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_marca">Marca</label>
    <input type="text" name="marca" class="form-control" id="form_marca" placeholder="Marca" value="<?php echo $datos[0]['marca']; ?>">
    <input type="hidden" name="id_marca" value="<?php echo $datos[0]['id_marca']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
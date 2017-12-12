<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_sucursal'])) {
    	$parametros['id_sucursal']=$_REQUEST['id_sucursal'];
  	}else{
    	header("Location: /deposito/admin/sucursal/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM sucursal WHERE id_sucursal=:id_sucursal",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['sucursal']=$_POST['sucursal'];
		$llaves['id_sucursal']=$_POST['id_sucursal'];
		$deposito->actualizar('sucursal',$parametros,$llaves);
		$mensaje='Se actualizo la sucursal';
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
    <label for="form_sucursal">Sucursal</label>
    <input type="text" name="sucursal" class="form-control" id="form_sucursal" placeholder="Sucursal" value="<?php echo $datos[0]['sucursal']; ?>">
    <input type="hidden" name="id_sucursal" value="<?php echo $datos[0]['id_sucursal']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
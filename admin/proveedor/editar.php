<?php
	include_once('../deposito.class.php');
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if (isset($_REQUEST['id_proveedor'])) {
    	$parametros['id_proveedor']=$_REQUEST['id_proveedor'];
  	}else{
    	header("Location: /deposito/admin/proveedor/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM proveedor WHERE id_proveedor=:id_proveedor",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['proveedor']=$_POST['proveedor'];
		$parametros['logo']=$_POST['logo'];
		$llaves['id_proveedor']=$_POST['id_proveedor'];
		$deposito->actualizar('proveedor',$parametros,$llaves);
		$mensaje='Se actualizo el proveedor';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar proveedor</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_proveedor">Proveedor</label>
    <input type="text" name="proveedor" class="form-control" id="form_proveedor" placeholder="Unidad de medida" value="<?php echo $datos[0]['proveedor']; ?>">
    <input type="hidden" name="id_proveedor" value="<?php echo $datos[0]['id_proveedor']; ?>">
  </div>
  <div class="form-group">
    <label for="form_logo">Logotipo</label>
    <input type="text" name="logo" class="form-control" id="form_logo" placeholder="Logotipo" value="<?php echo $datos[0]['logo']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
<?php
	include_once('../deposito.class.php');
  $rol[0]='administrador';
  $deposito->guardia($rol);
	if (isset($_REQUEST['id_producto'])) {
    	$parametros['id_producto']=$_REQUEST['id_producto'];
  	}else{
    	header("Location: /deposito/admin/producto/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM producto WHERE id_producto=:id_producto",$parametros);

    $marcas=$deposito->dropdownlist("SELECT id_marca as id,marca as opcion FROM marca ORDER BY marca ASC","id_marca",$datos[0]['id_marca']);
	if(isset($_POST['enviar'])){
		$parametros['producto']=$_POST['producto'];
		$parametros['id_marca']=$_POST['id_marca'];
		$llaves['id_producto']=$_POST['id_producto'];
		$deposito->actualizar('producto',$parametros,$llaves);
		$mensaje='Se actualizo la producto';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}
	include('../header.php');
?>
<h1>Editar Producto</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_producto">producto</label>
    <input type="text" name="producto" class="form-control" id="form_producto" placeholder="producto" value="<?php echo $datos[0]['producto']; ?>">
    <input type="hidden" name="id_producto" value="<?php echo $datos[0]['id_producto']; ?>">
  </div>
  <div class="form-group">
    <label for="form_amaterno_presentacion">Marca</label>
    <?php echo $marcas; ?>
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
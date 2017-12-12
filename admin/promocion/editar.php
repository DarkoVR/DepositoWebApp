<?php
	include_once('../deposito.class.php');
  $rol[0]='administrador';
  $deposito->guardia($rol);
	if (isset($_REQUEST['id_promocion'])) {
    	$parametros['id_promocion']=$_REQUEST['id_promocion'];
  	}else{
    	header("Location: /deposito/admin/promocion/index.php");
  	}
  	$datos=$deposito->consultar("SELECT * FROM promocion WHERE id_promocion=:id_promocion",$parametros);
	if(isset($_POST['enviar'])){
		$parametros['fechai']=$_POST['fechai'];
		$parametros['fechaf']=$_POST['fechaf'];
		$parametros['imagen']=$_POST['imagen'];
		$llaves['id_promocion']=$_POST['id_promocion'];
		$deposito->actualizar('promocion',$parametros,$llaves);
		$mensaje='Se actualizo la promocion';
		$color='success';
		if ($_POST['enviar']=="Guardar y salir") {
			include 'index.php';
			die();
		}
	}0
	include('../header.php');
?>
<h1>Editar promocion</h1>
<form action="editar.php" method="POST">
  <div class="form-group">
    <label for="form_fechai">fechai</label>
    <input type="text" name="fechai" class="form-contfechai" id="form_fechai" placeholder="fechai" value="<?php echo $datos[0]['fechai']; ?>">
    <input type="hidden" name="id_fechai" value="<?php echo $datos[0]['id_fechai']; ?>">
  </div>
  <div class="form-group">
    <label for="form_fechaf">fechaf</label>
    <input type="text" name="fechaf" class="form-contfechaf" id="form_fechaf" placeholder="fechaf" value="<?php echo $datos[0]['fechaf']; ?>">
  </div>
  <div class="form-group">
    <label for="form_imagen">imagen</label>
    <input type="text" name="imagen" class="form-contimagen" id="form_imagen" placeholder="imagen" value="<?php echo $datos[0]['imagen']; ?>">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include('../footer.php');
?>
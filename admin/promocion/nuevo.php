<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		if (isset($_FILES['imagen']['name'])) {
			$origen=$_FILES['imagen']['tmp_name'];
			$destino='../../images/promociones/'.$_FILES['imagen']['name'];
			if($deposito->validar_imagen($_FILES['imagen'])){
				if(move_uploaded_file($origen, $destino)){
					$parametros['fechai']=$_POST['fechai'];
					$parametros['fechaf']=$_POST['fechaf'];
					$parametros['imagen']=$_FILES['imagen']['name'];
					$deposito->insertar('promocion',$parametros);
					$mensaje='Se inserto la promocion';
					$color='success';
					if ($_POST['enviar']=="Guardar y salir") {
						include_once 'index.php';
					}
					}else{
						$mensaje='No se pudo transferir la imagen, ni se inserto el promocion';
						$color='danger';
				}
			}else{
				$mensaje='El archivo que intento subir no esta permitido, solo se permiten archivos con extension PNG,JPG y PNG';
				$color='danger';
			}
		}
	}
	include_once '../header.php';
?>
<h1>Nueva promocion</h1>
<form action="nuevo.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_fechai_promocion">Fecha de iicio de promocion</label>
    <input type="text" name="fechai" class="form-control" id="form_fechai_promocion" placeholder="Fecha de inicio">
  </div>
  <div class="form-group">
    <label for="form_fechaf_promocion">Fecha de termino de la promocion</label>
    <input type="text" name="fechaf" class="form-control" id="form_fechaf_promocion" placeholder="Fecha de final">
  </div>
  <div class="form-group">
    <label for="form_imagen">imagen</label>
    <input type="file" name="imagen" class="form-control" id="form_imagen" placeholder="imagen">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include_once '../footer.php';
?>
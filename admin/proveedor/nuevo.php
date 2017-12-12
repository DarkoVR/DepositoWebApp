<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	if(isset($_POST['enviar'])){
		if (isset($_FILES['logo']['name'])) {
			$origen=$_FILES['logo']['tmp_name'];
			$destino='../../images/proveedores/'.$_FILES['logo']['name'];
			if($deposito->validar_imagen($_FILES['logo'])){
				if(move_uploaded_file($origen, $destino)){
					$parametros['proveedor']=$_POST['proveedor'];
					$parametros['logo']=$_FILES['logo']['name'];
					$deposito->insertar('proveedor',$parametros);
					$mensaje='Se inserto el proveedor';
					$color='success';
					if ($_POST['enviar']=="Guardar y salir") {
						include_once 'index.php';
					}
					}else{
						$mensaje='No se pudo transferir la imagen, ni se inserto el proveedor';
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
<h1>Nuevo proveedor</h1>
<form action="nuevo.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="form_proveedor">proveedor</label>
    <input type="text" name="proveedor" class="form-control" id="form_proveedor" placeholder="proveedor">
  </div>
  <div class="form-group">
    <label for="form_logo">Logo</label>
    <input type="file" name="logo" class="form-control" id="form_logo" placeholder="Logotipo">
  </div>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar">Guardar</button>
  <button type="submit" class="btn btn-default" name="enviar" value="Guardar y salir">Guardar y salir</button>
</form>
<?php
	include_once '../footer.php';
?>
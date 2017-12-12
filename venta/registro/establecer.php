<?php
	include_once '../deposito.class.php';
	if(isset($_REQUEST['recuperacion'])){
		$parametros['recuperacion']=$_REQUEST['recuperacion'];
		$datos= $deposito->consultar('SELECT * FROM usuario where recuperacion=:recuperacion',$parametros);
    		if(count($datos)>0 && strlen($parametros['recuperacion'])>0){
    			if(isset($_POST['enviar'])){
    				$llaves['recuperacion']=$_POST['recuperacion'];
    				$param['password']=md5($_POST['password']);
    				$param['recuperacion']=null;
					$deposito->actualizar('usuario',$param,$llaves);
					header('Location: ../login/index.php');
    			}
    		}else
    			header('Location: ../login/index.php');
	}

	include_once '../header.php';
?>
<form action="establecer.php" method="POST">
	<div class="form-group">
		<label>Escribe tu nueva contraseña</label>
		<input type="password" name="password" placeholder="Password" class="form-control">
		<input type="hidden" name="recuperacion" placeholder="Password" value="<?php echo $parametros['recuperacion']?> ">
	</div>
	<div class="form-group">
		<input type="submit" name="enviar">
	</div>
</form>
<?php
	include_once '../footer.php';
?>
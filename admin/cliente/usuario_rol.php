<?php
include '../deposito.class.php';
$rol[0] = 'administrador';
$deposito->guardia($rol);	
if(isset($_REQUEST['id_usuario'])){
	$parametros['id_usuario']=$_REQUEST['id_usuario'];
}else{
	header('Location: /deposito/admin/producto/index.php');
}
if(isset($_POST['enviar'])){
	$param['id_rol']=$_POST['id_rol'];
	$param['id_usuario']=$parametros['id_usuario'];
	$existe = $deposito->consultar('SELECT * FROM usuario_rol where id_usuario=:id_usuario and id_rol=:id_rol', $param);
	if(count($existe)==0){
		$deposito->insertar('usuario_rol', $param);
		$mensaje = 'Rol asignado al empleado';
		$color = 'success';
	}else{
		$mensaje = 'El rol ya a sido asignado al empleado';
		$color = 'danger';		
	}
}
$rol = $deposito->dropdownList('SELECT id_rol as id, rol as opcion FROM rol order by rol asc', 'id_rol');
$datos = $deposito->consultar('SELECT * from usuario_rol join rol using(id_rol) WHERE id_usuario=:id_usuario', $parametros);
include('../header.php');
?>
<form action="usuario_rol.php" method="POST">
	<?php echo $rol?>
	<input type="submit" name="enviar" value="Agregar">
	<input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']?>">
</form>

<?php
echo '<table class="container table">';
		echo '<tr>';
		echo '<th>Rol asignado</th>';
		echo '<th></th>';
		echo '<th></th>';
		echo '</tr>';
		foreach ($datos as $key => $value) {
			echo '<tr>';
			echo '<td>';
			echo $value['rol'];
			echo '</td>';
			echo '<td><a href="eliminar_usuario_rol.php?id_rol='.$value['id_rol'].'&id_usuario='.$value['id_usuario'].'" class="btn btn-danger" role="button">Eliminar</a></td>';
			echo '</tr>';
		}
	echo '</table>';
include('../footer.php');
?>
<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos = $deposito->consultar('SELECT id_empleado, email, u.id_usuario, concat(nombre," ",apaterno," ",amaterno) as nombre from empleado c join usuario u on c.id_usuario = u.id_usuario order by nombre asc');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>empleado</th>";
	echo "<th>email</th>";
	echo "<th>Rol</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['nombre']."</td>";
			echo "<td>".$value['email']."</td>";
			//echo "<td>".$value['rol']."</td>";
			echo "<td><a class='btn btn-success' href='usuario_rol.php?id_usuario=".$value['id_usuario']."' role='button'>Roles</a></td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_empleado=".$value['id_empleado']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_empleado=".$value['id_empleado']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
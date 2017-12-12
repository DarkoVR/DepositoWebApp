<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos=$deposito->consultar("SELECT id_cliente,id_usuario,email,concat(nombre,' ',apaterno,' ',amaterno) as nombre,rol FROM cliente JOIN usuario using(id_usuario) JOIN usuario_rol using(id_usuario) JOIN rol using(id_rol) GROUP BY id_cliente ORDER BY nombre");
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>Cliente</th>";
	echo "<th>email</th>";
	echo "<th>Rol</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['nombre']."</td>";
			echo "<td>".$value['email']."</td>";
			//echo "<td>".$value['rol']."</td>";
			echo "<td><a class='btn btn-success' href='usuario_rol.php?id_usuario=".$value['id_usuario']."' role='button'>Roles</a></td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_cliente=".$value['id_cliente']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_cliente=".$value['id_cliente']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
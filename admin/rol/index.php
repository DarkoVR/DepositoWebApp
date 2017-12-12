<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos=$deposito->consultar('SELECT * FROM rol');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>rol</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['rol']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_rol=".$value['id_rol']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_rol=".$value['id_rol']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
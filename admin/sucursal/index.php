<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos=$deposito->consultar('SELECT * FROM sucursal');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>sucursal</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['sucursal']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_sucursal=".$value['id_sucursal']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_sucursal=".$value['id_sucursal']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos=$deposito->consultar('SELECT * FROM producto join marca using(id_marca)');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>producto</th>";
	echo "<th>marca</th>";
	echo "<th>marca</th>";
	echo "<th>marca</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['producto']."</td>";
			echo "<td>".$value['marca']."</td>";
			echo "<td><a class='btn btn-success' href='../presentacion/index.php?id_producto=".$value['id_producto']."' role='button'>Ver presentacion</a></td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_producto=".$value['id_producto']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_producto=".$value['id_producto']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
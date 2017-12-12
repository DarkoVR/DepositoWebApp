<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include_once '../header.php';
	$datos=$deposito->consultar('SELECT * FROM promocion');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>Fecha inicio</th>";
	echo "<th>Fecha final</th>";
	echo "<th>Imagen</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['fechai']."</td>";
			echo "<td>".$value['fechaf']."</td>";
			echo "<td>".$value['imagen']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_promocion=".$value['id_promocion']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_promocion=".$value['id_promocion']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include_once '../footer.php';
?>
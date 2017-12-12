<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$datos=$deposito->consultar('SELECT * FROM unidad_medida');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>Unidad_medida</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['unidad_medida']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_unidad_medida=".$value['id_unidad_medida']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_unidad_medida=".$value['id_unidad_medida']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
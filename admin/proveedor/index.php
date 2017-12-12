<?php
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include_once '../header.php';
	$datos=$deposito->consultar('SELECT * FROM proveedor');
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>proveedor</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['proveedor']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?id_proveedor=".$value['id_proveedor']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?id_proveedor=".$value['id_proveedor']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include_once '../footer.php';
?>
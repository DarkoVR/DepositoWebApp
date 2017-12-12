<?php
	include '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	include '../header.php';
	$id_producto=$_GET['id_producto'];
	if (isset($_GET['id_producto'])) {
		$parametros['id_producto']=$_GET['id_producto'];
	}else{
		header("Location: /deposito/admin/producto/index.php");
	}
	$datos=$deposito->consultar("SELECT * FROM presentacion JOIN unidad_medida using(id_unidad_medida) WHERE id_producto=".$_GET['id_producto']);
	//print_r($datos);
	echo "<br />";
	echo "<td><a class='btn btn-success' href='nuevo.php?id_producto=".$parametros['id_producto']."' role='button'>Nuevo</a></td>";
	echo "<br />";
	echo "<br />";
	echo "<table class='table'>";
	echo "<th>SKU</th>";
	echo "<th>presentacion</th>";
	echo "<th>id_unidad_medida</th>";
	echo "<th>preciou</th>";
	echo "<th>cantidadm</th>";
	echo "<th>preciom</th>";
	echo "<th>imagen</th>";
		foreach ($datos as $key => $value) {
			echo "<tr>";
			echo "<td>".$value['sku']."</td>";
			echo "<td>".$value['presentacion']."</td>";
			echo "<td>".$value['id_unidad_medida']."</td>";
			echo "<td>".$value['preciou']."</td>";
			echo "<td>".$value['cantidadm']."</td>";
			echo "<td>".$value['preciom']."</td>";
			echo "<td>".$value['imagen']."</td>";
			echo "<td><a class='btn btn-primary' href='editar.php?sku=".$value['sku']."' role='button'>Editar</a></td>";
			echo "<td><a class='btn btn-danger' href='eliminar.php?sku=".$value['sku']."' role='button'>Eliminar</a></td>";
			echo "</tr>";
		}
	echo "</table>";
	include '../footer.php';
?>
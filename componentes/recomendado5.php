<?php
	echo "<ul>";
	foreach ($conexion->query("SELECT p.id_producto, pr.sku, p.producto FROM producto p inner join presentacion pr USING(id_producto) group by 1, 2, 3 order by rand() desc limit 5") as $fila) {
		echo "<li><a href='ver_producto.php?sku=".$fila['sku']."'>".$fila['producto']."</a></li>";
	}
	echo "</ul>";
?>
<?php
	echo "<ol>";
	foreach ($conexion->query("SELECT p.id_producto, pr.sku, p.producto, pr.presentacion, sum(cd.cantidad) FROM producto p inner join presentacion pr USING(id_producto) inner join carrito_detalle cd USING(sku) group by 1, 2, 3 order by sum(cd.cantidad) desc limit 5") as $fila) {
		echo "<li><a href='ver_producto.php?sku=".$fila['sku']."'>".$fila['producto']."</a></li>";
	}
	echo "</ol>";
?>
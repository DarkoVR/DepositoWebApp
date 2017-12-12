<?php 
	include('../deposito.class.php');
	$rol[0] = 'cliente';
	$deposito->guardia($rol);
	include('../header.php');
	echo '<div class="container">';	
	$datos = $deposito->consultar('SELECT * from vw_productos');
	echo '<br/>';
	echo '<br/> <br/>';
	echo '<form action="carrito.php" method="POST">';
	echo '<table class="table">';
		echo '<tr>';
		echo '<th>Cantidad solicitada</th>';
		echo '<th>SKU</th>';
		echo '<th>Cantidad mayoreo</th>';
		echo '<th>Producto</th>';
		echo '<th>Presentacion</th>';
		echo '<th>Unidad de medida</th>';
		echo '<th>ID marca</th>';
		echo '<th>Categoria</th>';
		echo '<th>Imagen</th>';
		echo '<th>Precio unitario</th>';
		echo '<th>Precio mayoreo</th>';
		echo '<th>Descuento</th>';
		echo '<th>Precio con descuento</th>';
		echo '<th>Precio mayoreo con descuento</th>';
		echo '</tr>';
		foreach ($datos as $key => $value) {
			echo '<tr>';
			echo '<td><input type="text" size="4" name="carrito['.$value['sku'].']"></td>';
			echo '<td>'.$value['sku'].'</td>';
			echo '<td>'.$value['cantidadm'].'</td>';
			echo '<td>'.$value['producto'].'</td>';
			echo '<td>'.$value['presentacion'].'</td>';
			echo '<td>'.$value['unidad_medida'].'</td>';
			echo '<td>'.$value['id_marca'].'</td>';
			echo '<td>'.$value['categoria'].'</td>';
			echo '<td><img src="../../images/productos/'.$value['imagen'].'"></td>';
			echo '<td>$'.round($value['preciou'],2).'</td>';
			echo '<td>$'.round($value['preciom'],2).'</td>';
			echo '<td>'.round($value['descuento'],2).'%</td>';
			echo '<td>$'.round($value['preciou_descuento'],2).'</td>';
			echo '<td>$'.round($value['preciom_descuento'],2).'</td>';
			echo '</tr>';
		}
	echo '</table><input type="submit" name="solicitar" value="Solicitar"></form>';
	echo '</div>';
	include('../footer.php');
?>

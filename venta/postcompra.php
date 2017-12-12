<?php
	$mensaje="Gracias por su compra";
	$color="success";
	include_once 'header.php';
	include_once 'footer.php';
	if (isset($_GET['id_venta'])) {
		echo '<a class="btn btn-primary" href="producto/exemple00.php?id_venta='.$_GET['id_venta'].'" role="button">Ver recibo de compra</a>';
		echo '<a class="btn btn-primary" href="cliente/" role="button">Regresar al index de compra</a>';
	}
?>
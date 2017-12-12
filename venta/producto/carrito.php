<?php
	include_once('../deposito.class.php');
	
	//unset($_SESSION['carrito']);
	//die();
	$rol[0]='cliente';
	$deposito->guardia($rol);
	$carrito=array();
	if (isset($_GET['accion'])) {
		$accion=$_GET['accion'];
		switch ($accion) {
			case 'eliminar':
				$sku=$_GET['sku'];
				unset($_SESSION['carrito'][$sku]);
				break;	
			case 'vaciar':
				unset($_SESSION['carrito']);
			default:
				# code...
				break;
		}
	}
	if (isset($_POST['solicitar']) or isset($_SESSION['carrito'])) {
		if (isset($_SESSION['carrito'])) {
			foreach ($_SESSION['carrito'] as $key => $value) {
			$carrito[$key]=$value;
			}
		}
		if (isset($_POST['carrito'])) {
			foreach ($_POST['carrito'] as $key => $value) {
				if(!empty($value)){
					$carrito[$key]['cantidad']=(isset($carrito[$key]))?$carrito[$key]['cantidad']+$value:$value;
					$parametros['sku']=$key;
					$datos=$deposito->consultar('SELECT * from vw_productos where sku=:sku', $parametros);
					if($value>=$datos[0]['cantidadm'])
						$carrito[$key]['precio_unitario']=$datos[0]['preciom_descuento'];
					else
						$carrito[$key]['precio_unitario']=$datos[0]['preciou_descuento'];
					$carrito[$key]['descuento_aplicado']=$datos[0]['descuento'];
					$carrito[$key]['subtotal']=$carrito[$key]['cantidad']*$carrito[$key]['precio_unitario'];
				}
			}
			$_SESSION['carrito']=$carrito;
		}
		
	}
	include_once('../header.php');
	echo '<h1>Detalle de compra</h1>';
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo '<form action="pedido.php" method="POST">';
	echo '<table class="table">';
	echo '<tr>';
	echo '<td>Cantidad</th>';
	echo '<th>Precio Unitario</th>';
	echo '<th>Descuento Aplicado</th>';
	echo '<th>Subtotal</th>';
	echo '<th></th>';
	echo '</tr>';
	$grantotal=0;
	foreach ($carrito as $key => $value) {
		echo '<tr>';
			echo '<th><input type="text" name="carrito['.$key.']" value="'.$value['cantidad'].'"size=4></th>';
			echo '<td>'.round($value['precio_unitario'],2).'</td>';
			echo '<td>'.$value['descuento_aplicado'].'%</td>';
			echo '<th>$'.round($value['subtotal'],2).'</th>';
			echo '<td><a class="btn btn-danger" href="carrito.php?accion=eliminar&sku='.$key.'" role="button">Eliminar</a></td>';
		echo '</tr>';
		$grantotal+=round($value['subtotal'],2);
	}
	echo '<tr><td></td><td></td><td><h3>Gran Total:</h3></td><td><h3>$'.$grantotal.'</h3></td></tr>';
	echo '</table>';
	if (count($carrito)>0) {
		echo '<input class="btn btn-success" type="submit" name="comprar" value="Realizar Compra">';
		echo '<td><a class="btn btn-danger" href="carrito.php?accion=vaciar" role="button">Vaciar Carrito</a></td>';
	}
	echo '</form>';
	include_once('../footer.php');
?>
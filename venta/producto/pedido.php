<?php
	include_once '../deposito.class.php';
	$rol[0]='cliente';
	$deposito->guardia($rol);

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
	}else{
		header("Location: index.php");
	}
	
	//Generar el carrito
	$pedido['id_empleado']=1;
	$param['id_usuario']=$_SESSION['usuario']['id_usuario'];
	$cliente=$deposito->consultar('SELECT id_cliente from cliente where id_usuario=:id_usuario',$param);
	$pedido['id_cliente']=$cliente[0]['id_cliente'];
	$pedido['fecha']=date('Y-m-d');
	$deposito->insertar('venta',$pedido);
	$pedido=array();
	$pedido['id_cliente']=$cliente[0]['id_cliente'];
	$detalle=$deposito->consultar('SELECT * from venta where id_cliente=:id_cliente order by id_venta desc limit 1',$pedido);
	$pedido=array();
	$pedido['id_venta']=$detalle[0]['id_venta'];
	foreach ($carrito as $key =>$value) {
		$pedido['sku']=$key;
		$pedido['precio_unitario']=$carrito[$key]['precio_unitario'];
		$pedido['cantidad']=$carrito[$key]['cantidad'];
		$pedido['descuento_aplicado']=$carrito[$key]['descuento_aplicado'];
		$deposito->insertar('detalle_venta',$pedido);
	}
	unset($_SESSION['carrito']);
	//print_r($pedido['id_venta']); die();
	header("Location: ../postcompra.php?id_venta=".$pedido['id_venta']);
?>
<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_cliente = $_GET['sku'];
$parametros['sku']=$id_cliente;
$datos = $deposito->consultar("SELECT * FROM presentacion JOIN using(sku) JOIN promocion_producto using(sku) WHERE sku=:sku",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' carrito(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('presentacion',$parametros);
	$mensaje='Se han eliminado '.$fe.' presentacion';
	$color = 'success';
}
include_once('index.php');
?>
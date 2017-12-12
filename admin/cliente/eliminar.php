<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_cliente = $_GET['id_cliente'];
$parametros['id_cliente']=$id_cliente;
$datos = $deposito->consultar("SELECT * FROM carrito where id_cliente=:id_cliente",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' carrito(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('cliente',$parametros);
	$mensaje='Se han eliminado '.$fe.' cliente';
	$color = 'success';
}
include_once('index.php');
?>
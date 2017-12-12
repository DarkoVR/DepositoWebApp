<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_sucursal = $_GET['id_sucursal'];
$parametros['id_sucursal']=$id_sucursal;
$datos = $deposito->consultar("SELECT * FROM carrito where id_sucursal=:id_sucursal",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' carrito(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('sucursal',$parametros);
	$mensaje='Se han eliminado '.$fe.' sucursal';
	$color = 'success';
}
include_once('index.php');
?>
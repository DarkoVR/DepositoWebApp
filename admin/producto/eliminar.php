<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_producto = $_GET['id_producto'];
$parametros['id_producto']=$id_producto;
$datos = $deposito->consultar("SELECT * FROM presentacion where id_producto=:id_producto",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' presentacione(s) asociadas';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('producto',$parametros);
	$mensaje='Se han eliminado '.$fe.' producto';
	$color = 'success';
}
include_once('index.php');
?>
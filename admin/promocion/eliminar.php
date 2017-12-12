<?php
include_once '../deposito.class.php';
$rol[0]='administrador';
$deposito->guardia($rol);
$id_proveedor = $_GET['id_proveedor'];
$parametros['id_proveedor']=$id_proveedor;
$datos = $deposito->consultar("SELECT * FROM marca where id_proveedor=:id_proveedor",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' marca(s) asociadas';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('proveedor',$parametros);
	$mensaje='Se han eliminado '.$fe.' proveedor';
	$color = 'success';
}
include_once 'index.php';
?>
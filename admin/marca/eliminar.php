<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_marca = $_GET['id_marca'];
$parametros['id_marca']=$id_marca;
$datos = $deposito->consultar("SELECT * FROM producto where id_marca=:id_marca",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' producto(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('marca',$parametros);
	$mensaje='Se han eliminado '.$fe.' marca';
	$color = 'success';
}
include_once('index.php');
?>
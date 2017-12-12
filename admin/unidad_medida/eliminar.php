<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_unidad_medida = $_GET['id_unidad_medida'];
$parametros['id_unidad_medida']=$id_unidad_medida;
$datos = $deposito->consultar("SELECT * FROM presentacion where id_unidad_medida=:id_unidad_medida",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' producto(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('unidad_medida',$parametros);
	$mensaje='Se han eliminado '.$fe.' unidad de medida';
	$color = 'success';
}
include_once('index.php');
?>
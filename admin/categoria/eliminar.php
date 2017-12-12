<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_categoria = $_GET['id_categoria'];
$parametros['id_categoria']=$id_categoria;
$datos = $deposito->consultar("SELECT * FROM marca where id_categoria=:id_categoria",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' marca(s) asociadas';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('categoria',$parametros);
	$mensaje='Se han eliminado '.$fe.' categoria';
	$color = 'success';
}
include_once('index.php');
?>
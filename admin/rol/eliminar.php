<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_rol = $_GET['id_rol'];
$parametros['id_rol']=$id_rol;
$datos = $deposito->consultar("SELECT * FROM usuario_rol where id_rol=:id_rol",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' usuario(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('rol',$parametros);
	$mensaje='Se han eliminado '.$fe.' rol';
	$color = 'success';
}
include_once('index.php');
?>
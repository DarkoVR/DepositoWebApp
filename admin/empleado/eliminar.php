<?php
include_once('../deposito.class.php');
$rol[0]='administrador';
$deposito->guardia($rol);
$id_empleado = $_GET['id_empleado'];
$parametros['id_empleado']=$id_empleado;
$datos = $deposito->consultar("SELECT * FROM carrito where id_empleado=:id_empleado",$parametros);
$mensaje='No se pueden eliminar por que hay '.count($datos).' carrito(s) asociados';
$color = 'danger';
if (count($datos)==0) {
	$fe = $deposito->borrar('empleado',$parametros);
	$mensaje='Se han eliminado '.$fe.' empleado';
	$color = 'success';
}
include_once('index.php');
?>
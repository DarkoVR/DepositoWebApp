<?php 
	include_once '../deposito.class.php';
	$rol[0]='administrador';
	$deposito->guardia($rol);
	$parametros['id_usuario']=$_GET['id_usuario'];
	$parametros['id_rol']=$_GET['id_rol'];
	$deposito->borrar('usuario_rol', $parametros);
	$mensaje="Se han eliminado el rol";
	$color='success';
	include_once 'index.php';
?>
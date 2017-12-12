<?php
/*Configuración de la base de datos - Conexión*/
	session_start();
	define('USER', 'admin');
	define('PASSWORD', 'admin');
	define('SGDB', 'mysql');
	define('DB', 'deposito');
	define('SGDB_SERVER', 'localhost');
	$conexion = new PDO(SGDB.':host='.SGDB_SERVER.';dbname='.DB, USER, PASSWORD);

	/*Variables del sistema*/
	$configuracion['imagenes_permitidas']=array('image/png','image/jpeg','image/pjpeg','image/gif');
	//$imagenes_permitidas=array('image/png','image/jpeg','image/pjpeg','image/gif');
?>
<?php  
	require_once("config.php");

	$usuario = new Usuario();

	$usuario->loadbyId(2);

	echo $usuario;



?>
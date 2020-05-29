<?php  
	require_once("config.php");

	$usuario = new Usuario();

	$usuario->loadById(2);

	echo $usuario;

	//$sql= new Sql();

	//$usuario = $sql->select("SELECT * FROM tb_usuarios");

	//echo json_encode($usuario);



?>
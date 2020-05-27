<?php  
	require_once("config.php");

	$Sql = new Sql();

	$usuarios = $Sql->select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios);



?>
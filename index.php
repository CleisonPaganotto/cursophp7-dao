<?php  
	require_once("config.php");

	$aluno = new Usuario("Cleia1b2c3","Cleia1b2c3");

	//$aluno->setLogin("Aluno");
	//$aluno->setSenha("12345");

	$aluno->insert();

	echo $aluno;


	/*Carrega um usuario usando o login e a senha

	$user = new Usuario();
	$user->login("Cleison","cleia1b2c3");

	echo $user;
	*/

	/*
	Carrega uma lista de usuario buscando pelo campo login

	$search = Usuario::search("e");
	echo json_encode($search);
	*/

	/*
	Carrega uma lista de todos os usuarios cadastrados

	$lista = Usuario::getList();
	echo json_encode($lista);
	*/

	/*
	Desta forma ele esta utilizando a função loadbyID criada na classe Usuario, para listar somente o usuario
	com o id igual á 2 

	$usuario = new Usuario();
	$usuario->loadbyId(2);
	echo $usuario;
	*/

	/*
	Metodo utilizado para fazer o Select sem a classe Usuario

	$sql= new Sql();
	$usuario = $sql->select("SELECT * FROM tb_usuarios");
	echo json_encode($usuario);
	*/
?>
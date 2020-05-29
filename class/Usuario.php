<?php  

	class Usuario{

		// Definindo os atributos da Classe Usuario

		private $idusuario;
		private $login;
		private $senha;
		private $dtCad;

		// Criando os Getters and Setters do atributos definidos na classe

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getLogin(){
			return $this->login;
		}

		public function setLogin($value){
			$this->login = $value;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($value){
			$this->senha = $value;
		}

		public function getDtcad(){
			return $this->dtCad;
		}

		public function setDtcad($value){
			$this->dtCad = $value;
		}

		// Essa função faz o select apenas do ID passado como parametro no arquivo index.php desta forma retornar somente um valor
		// Essa função tambem seta o valor de cada campo nos seus respectivos Setters
		public function loadbyId($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0) {

				$this->setData($results[0]);
			}

		}

		//Metodo utilizado para listar todos os itens cadastrados nesta tabela do banco de dados

		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY login");
		}

		//Metodo para fazer a busca pelo Login do usuario

		public static function search($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login",array(
				':SEARCH'=>"%".$login."%"

			));
		}

		// Função que puxa os dados se o usuario esta autenticado

		public function login($login, $pass){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN AND senha = :PASS", array(
				":LOGIN"=>$login,
				":PASS"=>$pass
			));

			if (count($results) > 0) {

				$this->setData($results[0]);
				
			} else {

				throw new Exception("Login ou Senha invalidos");
				

			}
		}

		// Este metodo estava sendo repetido varias vezes dentro das funções, então criamos uma função apenas para colocar os dados dentro das variaveis, desta forma chamando apenas a função.

		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setLogin($data['login']);
			$this->setSenha($data['senha']);
			$this->setDtcad(new DateTime($data['dtCad']));	
		}

		//Metodo utilizando para inserir os dados no banco de dados utilizando uma procedure

		public function insert(){

			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
				':LOGIN'=>$this->getLogin(),
				':SENHA'=>$this->getSenha()
			));

			if (count($results) > 0) {

				$this->setData($results[0]);
			}
		}

		//Metodo utilizado para fazer um Update no usuario com o id informado no arquivo index.php

		public function update($login, $senha){

			$this->setLogin($login);
			$this->setSenha($senha);

			$sql = new Sql();

			$sql ->query("UPDATE tb_usuarios SET login =:LOGIN, senha =:SENHA WHERE idusuario =:ID", array(
				':LOGIN'=>$this->getLogin(),
				':SENHA'=>$this->getSenha(),
				':ID'=>$this->getIdusuario()
			));

		}

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				':ID'=>$this->getIdusuario()
			));

			$this->setIdusuario(0);
			$this->setLogin("");
			$this->setSenha("");
			$this->setDtcad(new DateTime());
		}

		//Metodo construtor da classe Usuario, com o metodo construtor podemos passar os parametro diretamente dentro do objeto, em seu metodo construtor que é chamado

		public function __construct($login = "", $password = ""){
			$this->setLogin($login);
			$this->setSenha($password);
		}

		// Essa função utiliza os Getters para setar o valor de cada atributo dentro de um Json utilizando o json_encode

		public function __toString(){

			return json_encode(array(

				"idusuario"=>$this->getIdusuario(),
				"login"=>$this->getLogin(),
				"senha"=>$this->getSenha(),
				"dtCad"=>$this->getDtcad()->format("d/m/Y H:i:s")
			));
		}

	}

?>
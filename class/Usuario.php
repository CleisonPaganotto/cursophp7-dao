<?php  

	class Usuario{

		private $idusuario;
		private $login;
		private $senha;
		private $dtCad;

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

		public function loadbyId($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0) {

				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setLogin($row['login']);
				$this->setSenha($row['senha']);
				$this->setDtcad(new DateTime($row['dtCad']));
			}

		}

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
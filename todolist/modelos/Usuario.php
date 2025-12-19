<?php

    namespace modelos ;
	
	use Clases\Database;
	use Clases\Sesion ;
	
	class Usuario
    {
        private int $idUsuario ;
		public int $id {
			get => $this->idUsuario ;
		}
		
        private string $dni;
        private string $nombre;
        private string $apellido;
	    public private(set) string $email;
        private string $password;
		
		/**
		 * @param string $password
		 * @return bool
		 */
		private function verify(string $password): bool
		{
			return password_verify($password, $this->password) ;
		}
	    
	    /**
	     * @return array
	     */
		public function tareas(): array
		{
			return Tarea::getByUser($this) ;
		}
		
		/**
		 * @param string $email
		 * @param string $password
		 * @return Usuario|null
		 */
		public static function getByEmailAndPassword(string $email, string $password): Usuario|false
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :ema ;") ;
			$stmt->execute([ ":ema" => $email, ]) ;
			
			# recuperamos usuario
			$usuario = $stmt->fetchObject(Usuario::class) ;
			
			if (is_object($usuario)):
				if ($usuario->verify($password)):
					return $usuario ;
				endif ;
			endif ;
			
			return false ;
		}
		
		/**
		 * @param int $id
		 * @return Usuario|false
		 */
		public static function getById(int $id): Usuario|false
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = :id") ;
			$stmt->execute([ ":id" => Sesion::get("id") ]) ;
			
			# devolvemos el usuario
			return $stmt->fetchObject(Usuario::class) ;
		}
	    
	    /**
         * @return string
         */
        public function __toString(): string
        {
            return "$this->dni: $this->nombre $this->apellido, $this->email<br/>" ;
        }

    }

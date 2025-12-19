<?php
	
	namespace Clases ;
	
	use Clases\Sesion;
	use Modelos\Usuario;
	
	final class Auth
	{
		/**
		 * @param string $email
		 * @param string $pass
		 * @return boolean
		 */
		public static function login(string $email, string $pass): bool
		{
			$usuario = Usuario::getByEmailAndPassword($email, $pass) ;
			
			# iniciamos sesión si se ha encontrado el usuario
			if (is_object($usuario)) Sesion::init($usuario) ;
			
			#
			return is_object($usuario) ;
		}
		
		/**
		 * @return Usuario|false
		 */
		public static function user(): Usuario|false
		{
			# si hay una sesión activa recuperamos el usuario
			if (Sesion::active()):
				return Usuario::getById(Sesion::get("id")) ;
			endif ;
			
			return false ;
		}
	}

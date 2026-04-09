<?php
	
	namespace Clases ;
	
	final class Request
	{
		const RUTAS = [
			"main"   => "main",
			"logout" => "logout",
			"categorias" => "categorias",

			"tarea.nueva"  => "tarea/nueva",
			"tarea.editar" => "tarea/editar",

			"categoria.nueva" => "categoria/nueva",
			"categoria.editar" => "categoria/editar",
			"categoria.borrar" => "categoria/borrar",
		] ;
		
		private function __construct() { }
		
		/**
		 * @param string $method
		 * @return string
		 */
		public static function isMethod(string $method): string
		{
			return strtolower($method) === strtolower($_SERVER["REQUEST_METHOD"]) ;
		}
		
		/**
		 * @param string $key
		 * @return string|null
		 */
		public static function get(string $key): ?string
		{
			return $_POST[$key]??$_GET[$key]??null ;
		}
		
		/**
		 * @param string $name
		 * @return string
		 */
		public static function route(string $name): string
		{
			return "http://" . $_SERVER["HTTP_HOST"] . "/" . self::RUTAS[strtolower($name)] ;
		}

		/**
		 * @param string $name
		 * @return bool
		 */
		public static function isRoute(string $name): bool
		{
			return strtolower($name) === strtolower(ltrim(strtok($_SERVER["REQUEST_URI"], "?"),"/")) ;
		
		}
		
		/**
		 * @param string $url
		 * @return void
		 */
		public static function redirect(string $url): never
		{
			header("Location: {$url}") ;
			exit() ;
		}
		
		/**
		 * @param string $name
		 * @return never
		 */
		public static function redirectToRoute(string $name): never
		{
			self::route($name) |> self::redirect(...) ;
			#self::redirect(self::route($name)) ;
		}
	}

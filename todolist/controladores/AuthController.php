<?php
	
	namespace Controladores ;
	
	use Clases\Request ;
	use Clases\Sesion ;
	use Clases\Auth ;
	
	class AuthController extends BaseController
	{
		
		/**
		 * @return void
		 * @throws \Twig\Error\LoaderError
		 * @throws \Twig\Error\RuntimeError
		 * @throws \Twig\Error\SyntaxError
		 */
		public function index(): void
		{
			if (Request::isMethod("get")):
				$this->render("login.twig") ;
			else:
				# recuperamos los parámetros
				$email = Request::get("email") ;
				$password = Request::get("password") ;
				
				# intentamos hacer login
				if (Auth::login($email, $password)):
					Request::redirectToRoute("main") ;
				else:
					Request::redirect("/?error") ;
				endif ;
			endif ;
		}
		
		/**
		 * @return void
		 */
		public function logout(): void
		{
			Sesion::close() ;
			Request::redirect("/") ;
		}
	}

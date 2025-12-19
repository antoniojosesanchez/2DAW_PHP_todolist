<?php
	
	namespace Controladores;
	
	use Modelos\Tarea ;
	use Clases\Request ;
	
	class TareaController extends BaseController
	{
		/**
		 * @return void
		 * @throws \Twig\Error\LoaderError
		 * @throws \Twig\Error\RuntimeError
		 * @throws \Twig\Error\SyntaxError
		 */
		public function list(): void
		{
			
			$datos = \Clases\Auth::user()->tareas() ;
			$this->render("main.twig", [ "listado" => $datos ]) ;
		}
		
		/**
		 * @return void
		 */
		public function create(): void
		{
			if (Request::isMethod("get")):
				$this->render("create.twig") ;
			else:
				
				Tarea::create([ "descripcion" => $_POST["descripcion"],
								"fecha"       => $_POST["fecha"],
								"completada"  => $_POST["completada"],
							  ]) ;
				#
				Request::redirectToRoute("main") ;
				
			endif ;
		}
	}
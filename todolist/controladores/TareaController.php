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

		/**
		 * @return void
		 */
		public function editar(): void
		{

			# recuperamos la tarea
			$tarea = Tarea::getById(Request::get("id")) ;

			# si es un GET, renderizamos la vista de edición
			if (Request::isMethod("get")):
				$this->render("edit.twig", [ "tarea" => $tarea ]) ;
			else:
				# modificamos la tarea (sólo los campos permitidos)
				$tarea->descripcion = Request::get("descripcion") ;
				$tarea->completada = Request::get("completada") ;
				$tarea->save() ;
				
				# redirigimos a la lista de tareas
				Request::redirectToRoute("main") ;
			endif ;
		}

		/**
		 * @return void
		 */
		public function borrar(): void
		{
			if ($id = Request::get("id")) Tarea::borrar($id) ;
			Request::redirectToRoute("main") ;
		}
	}
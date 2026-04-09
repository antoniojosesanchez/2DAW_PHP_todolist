<?php

	/**
	 * @author Antonio José Sánchez Bujaldón
	 * @since 2026
	 */
	
	namespace Controladores;
	
	use Modelos\Tarea ;
	use Modelos\Categoria ;
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
			# recuperamos la categoría seleccionada
			$categoria = empty(Request::get("categoria")) ? null : Request::get("categoria");

			$datos = \Clases\Auth::user()->tareas($categoria) ;
			$this->render("main.twig", [ "listado" => $datos, 
										 "categorias" => Categoria::getAll(),
										 "categoriaSeleccionada" => $categoria ]) ;
		}
		
		/**
		 * @return void
		 */
		public function create(): void
		{
			if (Request::isMethod("get")):
				$this->render("tareas/form.twig", [ "categorias" => Categoria::getAll() ]) ;
			else:
				
				Tarea::create([ "descripcion" => $_POST["descripcion"],
								"fecha"       => $_POST["fecha"],
								"completada"  => $_POST["completada"],
								"categoria"   => $_POST["categoria"],
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
				$this->render("tareas/form.twig", [ "tarea" => $tarea, "categorias" => Categoria::getAll() ]) ;
			else:
				# modificamos la tarea (sólo los campos permitidos)
				$tarea->descripcion = Request::get("descripcion") ;
				$tarea->completada = Request::get("completada") ;
				$tarea->categoria = Request::get("categoria") ;
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
			if ($id = Request::get("id")):
				if ($tarea = Tarea::getById((int)$id)):
					$tarea->borrar() ;
				endif ;
			endif ;
			Request::redirectToRoute("main") ;
		}
	}

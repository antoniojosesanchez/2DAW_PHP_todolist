<?php
	
	namespace Controladores;
	
	use Modelos\Categoria ;
	use Clases\Request ;
	
	class CategoriaController extends BaseController 
    {
        /**
         * @return void
         */
        public function list(): void
        {
            $categorias = Categoria::getAll() ;
            $this->render("categorias/categorias.twig", [ "categorias" => $categorias ]) ;
        }

        /**
         * @return void
         */
        public function create(): void
        {
            if (Request::isMethod("get")):
                $this->render("categorias/form.twig") ;
            else:
                Categoria::create([ "nombre" => Request::get("nombre") ]) ;
                Request::redirectToRoute("categorias") ;
            endif ;
        }

        /**
         * @return void
         */
        public function editar(): void
        {
            # recuperamos la categoria
            $categoria = Categoria::getById(Request::get("id")) ;

            # si es un GET, renderizamos la vista de edición
            if (Request::isMethod("get")):
                $this->render("categorias/form.twig", [ "categoria" => $categoria ]) ;
            else:
                # modificamos la categoria (sólo los campos permitidos)
                $categoria->nombre = Request::get("nombre") ;
                $categoria->save() ;
				
                # redirigimos al listado de categorías
                Request::redirectToRoute("categorias") ;
            endif ;
        }

        /**
         * @return void
         */
        public function borrar(): void
        {
            if ($id = Request::get("id")):
				if ($tarea = Categoria::getById((int)$id)):
					$tarea->borrar() ;
				endif ;
			endif ;
			Request::redirectToRoute("categorias") ;
        }
    }
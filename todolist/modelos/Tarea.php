<?php

	namespace modelos ;
	
	use Modelos\Usuario ;
	use Clases\Auth ;
	use Clases\Database ;
	
	class Tarea
	{
	    
		# clave primaria de la tabla usuario
		# utilizamos propiedad virtual para acceder a la clave primaria
	    private int $idTarea ;
		public int $id {
			get => $this->idTarea ;
		}

		private ?int $idCategoria ;
	    private int $idUsuario ;
	    public string $descripcion ;
	    public bool $completada ;
		
		/**
		 * @var string
		 * comentamos la propiedad virtual para la fecha y la mantenemos
		 * como una propiedad normal, ya que utilizaremos el filtro de twig
		 * para formatearla de manera apropiada.
		 */
		public private(set) string $fecha ;
		#public private(set) string $fecha {
		#	get => date("d/m/Y", strtotime($this->fecha) ) ;
		#}
		

		/**
		 * @return void	
		 */
		public function save(): void
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("UPDATE tarea SET descripcion = :descripcion, 
													completada = :completada
								   WHERE idTarea = :idTarea ;") ;
								   
			$stmt->execute([ ":descripcion" => $this->descripcion, 
							 ":completada" => $this->completada?1:0, 
							 ":idTarea" => $this->id ]) ;
		}

		/**
		 * @param int $id
		 * @return void
		 */
		public static function borrar(int $id): void
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("DELETE FROM tarea WHERE idTarea = :id ;") ;
			$stmt->execute([ ":id" => $id ]) ;
		}
		
		/**
		 * @param array $datos
		 * @return void
		 */
		public static function create(array $datos): void
		{
			$pdo = Database::connect() ;
			$stmt= $pdo->prepare("INSERT INTO tarea(idUsuario, descripcion, fecha, completada)
									    VALUES (:idu, :descripcion, :fecha, :completada) ;") ;
			$stmt->execute( [":idu" => Auth::user()->id, ...$datos] ) ;
		}
		
		/**
		 * @return array
		 */
		public static function getByUser(Usuario $usuario): array
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("SELECT * FROM tarea WHERE idUsuario = :idu ;") ;
 			$stmt->execute([ ":idu" => $usuario->id ]) ;
			 
 			return $stmt->fetchAll(\PDO::FETCH_CLASS, Tarea::class) ;
		}

		/**
		 * @param int $id
		 * @return Tarea|false
		 */
		public static function getById(int $id): Tarea|false
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("SELECT * FROM tarea WHERE idTarea = :id ;") ;
			$stmt->execute([ ":id" => $id ]) ;
			$tarea = $stmt->fetchObject(Tarea::class) ;

			return is_object($tarea) ? $tarea : false ;

		}


	}
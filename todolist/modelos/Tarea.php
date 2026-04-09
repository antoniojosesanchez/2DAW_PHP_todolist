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

	    private int $idUsuario ;
	    public string $descripcion ;
	    public bool $completada ;

		# propiedad virtual para acceder a la clave foránea
		private ?int $idCategoria ;
		public int $categoria {
			get => $this->idCategoria ;
			set => $this->idCategoria = $value ;
		}
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
													completada = :completada,
													idCategoria = :idCategoria
								   WHERE idTarea = :idTarea ;") ;
								   
			$stmt->execute([ ":descripcion" => $this->descripcion, 
							 ":completada" => $this->completada?1:0, 
							 ":idCategoria" => $this->categoria,
							 ":idTarea" => $this->id ]) ;
		}

		/**
		 * @return void
		 */
		public function borrar(): void
		{
			$pdo = Database::connect() ;
			$stmt = $pdo->prepare("DELETE FROM tarea WHERE idTarea = :id ;") ;
			$stmt->execute([ ":id" => $this->id ]) ;
		}
		
		/**
		 * @param array $datos
		 * @return void
		 */
		public static function create(array $datos): void
		{
			$pdo = Database::connect() ;
			$stmt= $pdo->prepare("INSERT INTO tarea(idUsuario, idCategoria, descripcion, fecha, completada)
										VALUES (:idu, :idc, :descripcion, :fecha, :completada) ;") ;
			$stmt->execute([
				":idu"         => Auth::user()->id,
				":idc"         => $datos["categoria"] ?? null,
				":descripcion" => $datos["descripcion"],
				":fecha"       => $datos["fecha"],
				":completada"  => !empty($datos["completada"]) ? 1 : 0,
			]) ;
		}
		
		/**
		 * @return array
		 */
		public static function getByUser(Usuario $usuario, $categoria = null): array
		{
			$pdo = Database::connect() ;

			# construimos la consulta SQL base
			$sql = "SELECT * FROM tarea WHERE idUsuario = :idu" ;
			$params = [ ":idu" => $usuario->id ] ;

			# aplicamos el filtro de categoría solo cuando haya valor
			if ($categoria !== null && $categoria !== ''):
				$sql .= " AND idCategoria = :idc" ;
				$params[":idc"] = $categoria ;
			endif ;

			# ejecutamos la consulta
			$stmt = $pdo->prepare("{$sql} ;") ;
			$stmt->execute($params) ;

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
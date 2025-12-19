<?php

	namespace modelos ;
	
	use Modelos\Usuario ;
	use Clases\Auth ;
	use Clases\Database ;
	
	class Tarea
	{
	    private ?int $idCategoria ;
	    private int $idUsuario ;
	    private int $idTarea ;
	    public private(set) string $descripcion ;
	    public private(set) bool $completada ;
		
		/**
		 * @var string
		 */
		public private(set) string $fecha {
			get => date("d-m-Y", strtotime($this->fecha) ) ;
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
	}
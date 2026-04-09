<?php

	/**
	 * @author Antonio José Sánchez Bujaldón
	 * @since 2026
	 */

    namespace modelos ;

    use Clases\Database ;

    class Categoria
    {
        private int $idCategoria ;
        public string $nombre ;

        # propiedad virtual para acceder a la clave primaria
        public int $id {
            get => $this->idCategoria ;
        }

        /**
         * @return array
         */
        public static function getAll(): array
        {
            $pdo = Database::connect() ;
            $stmt = $pdo->prepare("SELECT * FROM categoria ;") ;
            $stmt->execute() ;

            return $stmt->fetchAll(\PDO::FETCH_CLASS, Categoria::class) ;
        }

        /**
         * @return void
         */
        public function borrar(): void
        {
            $pdo = Database::connect() ;
            $stmt = $pdo->prepare("DELETE FROM categoria WHERE idCategoria = :id ;") ;
            $stmt->execute([ ":id" => $this->id ]) ;
        }

        /**
         * @return void
         */
        public function save(): void
        {
            $pdo = Database::connect() ;
            $stmt = $pdo->prepare("UPDATE categoria SET nombre = :nombre WHERE idCategoria = :id ;") ;
            $stmt->execute([ ":nombre" => $this->nombre, ":id" => $this->id ]) ;
        }

        /**
         * @param array $datos
         * @return void
         */
        public static function create(array $datos): void
        {
            $pdo = Database::connect() ;
            $stmt = $pdo->prepare("INSERT INTO categoria (nombre) VALUES (:nombre) ;") ;
            $stmt->execute([ ":nombre" => $datos["nombre"] ]) ;
        }

        /**
         * @param int $id
         * @return Categoria|false
         */
        public static function getById(int $id): Categoria|false
        {
            $pdo = Database::connect() ;
            $stmt = $pdo->prepare("SELECT * FROM categoria WHERE idCategoria = :id ;") ;
            $stmt->execute([ ":id" => $id ]) ;
            return $stmt->fetchObject(Categoria::class) ;
        }
		
    }

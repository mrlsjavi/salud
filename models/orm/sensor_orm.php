<?php
	class sensor_orm extends ORM {
		public $id, $titulo,  $descripcion, $estado;
		protected static $table = 'sensor';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->id = isset($data['id']) ? intval($data['id']) : null;

			$this->titulo = isset($data['titulo']) ? $data['titulo'] : null;
			$this->descripcion = isset($data['descripcion']) ? $data['descripcion'] : null;
			
			$this->estado = isset($data['estado']) ? intval($data['estado']) : null;
		


			
		}
	}


?>
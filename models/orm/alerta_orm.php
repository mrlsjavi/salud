<?php
	class alerta_orm extends ORM {
		public $id, $nombre, $medida_sensor, $obj_medida_sensor, $umbral_min, $umbral_max, $estado;
		protected static $table = 'alerta';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->id = isset($data['id']) ? intval($data['id']) : null;

			$this->nombre = isset($data['nombre']) ? $data['nombre'] : null;

			$this->medida_sensor = isset($data['medida_sensor']) ? $data['medida_sensor'] : null;

			if($this->medida_sensor){
				$this->obj_medida_sensor = medida_sensor_orm::find($this->medida_sensor);	
				
			}

			$this->umbral_min = isset($data['umbral_min']) ? $data['umbral_min'] : null;
			$this->umbral_max = isset($data['umbral_max']) ? $data['umbral_max'] : null;
			$this->estado = isset($data['estado']) ? intval($data['estado']) : null;
		


			
		}
	}


?>
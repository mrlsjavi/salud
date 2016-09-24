<?php
	class bitacora_orm extends ORM {
		public $id, $usuario, $obj_usuario, $medida_sensor, $obj_medida_sensor, $dato, $fecha_hora;
		protected static $table = 'bitacora';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->id = isset($data['id']) ? intval($data['id']) : null;

			$this->usuario = isset($data['usuario']) ? $data['usuario'] : null;
			if($this->usuario){
				$this->obj_usuario = usuario_orm::find($this->usuario);

			}
			$this->medida_sensor = isset($data['medida_sensor']) ? $data['medida_sensor'] : null;

			if($this->medida_sensor){
				//$this->obj_medida_sensor = medida_sensor_orm::find($this->usuario);

			}
			$this->dato = isset($data['dato']) ? $data['dato'] : null;

			$this->fecha_hora = isset($data['fecha_hora']) ? intval($data['fecha_hora']) : null;
		}
	}


?>

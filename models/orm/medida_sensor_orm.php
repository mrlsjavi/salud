 <?php
	class medida_sensor_orm extends ORM {
		public $id, $sensor, $obj_sensor, $unidad_medida, $obj_unidad_medida, $estado;
		protected static $table = 'medida_sensor';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->id = isset($data['id']) ? intval($data['id']) : null;

			$this->sensor = isset($data['sensor']) ? $data['sensor'] : null;

			if($this->sensor){
				$this->obj_sensor = sensor_orm::find($this->sensor);	
				
			}


			$this->unidad_medida = isset($data['unidad_medida']) ? $data['unidad_medida'] : null;

			if($this->unidad_medida){
				$this->obj_unidad_medida = unidad_medida_orm::find($this->unidad_medida);	
				
			}
			
			$this->estado = isset($data['estado']) ? intval($data['estado']) : null;
		


			
		}
	}


?>
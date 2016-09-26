<?php
	class dispositivo_orm extends ORM {
		public $id, $usuario, $obj_usuario, $ip, $estado;
		protected static $table = 'dispositivo';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->id = isset($data['id']) ? intval($data['id']) : null;

			$this->usuario = isset($data['usuario']) ? $data['usuario'] : null;

			if($this->usuario !=null){
				$this->obj_usuario = usuario_orm::find($this->usuario);
			}

			$this->ip = isset($data['ip']) ? intval($data['ip']) : null;

			$this->estado = isset($data['estado']) ? intval($data['estado']) : null;
		}
	}


?>

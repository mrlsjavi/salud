<?php
	class notificacion_orm extends ORM {
		public $usuario, $obj_usuario, $token;
		protected static $table = 'notificacion';

		public function __construct($data){
			parent::__construct(); //llamo el orm
			if($data && sizeof($data)){
				$this->populateFromRow($data);
			}
		}


		public function populateFromRow($data){

			$this->usuario = isset($data['usuario']) ? intval($data['usuario']) : null;

			if($this->usuario){
				$this->obj_usuario = usuario_orm::find($this->usuario);

			}

			$this->token = isset($data['token']) ? $data['token'] : null;
		}
	}


?>

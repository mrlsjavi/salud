<?php
	class usuario_alerta_orm extends ORM {
		public $id, $usuario, $obj_usuario, $alerta, $obj_alerta, $mail, $notificacion, $estado;
		protected static $table = 'usuario_alerta';

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

			$this->alerta = isset($data['alerta']) ? $data['alerta'] : null;
			if($this->alerta){
				$this->obj_alerta = alerta_orm::find($this->alerta);	
				
			}

			$this->mail = isset($data['mail']) ? $data['mail'] : null;
			$this->notificacion = isset($data['notificacion']) ? $data['notificacion'] : null;
			$this->estado = isset($data['estado']) ? intval($data['estado']) : null;
		


			
		}
	}


?>
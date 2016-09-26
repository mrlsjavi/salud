<?php

class Registro_Model {

	public function __construct(){

			//parent::__construct();
			
	}

	public function guardar(){
		$info = json_decode($_POST['info']);

		$data = array(
			'id'=>'',
			'rol'=>2,
			'nombre'=>$info->nombre,
			'login'=>$info->login, 
			'password'=>md5($info->password),
			'direccion'=>$info->direccion, 
			'telefono'=>$info->telefono,
			'estado'=>1);


		$registro = new usuario_orm($data);

		$result = $registro->save();

	 	echo json_encode($result);
	}




	
}

?>